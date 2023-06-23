<?php $payment_report = "active" ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Payment Summary</h1>
    </div>

    <div class="table-responsive">
        <?php
        $db = dbConn();
        $sqlpaid = "SELECT * FROM tbl_members RIGHT JOIN tbl_payment ON tbl_members.MemberId = tbl_payment.member_id LEFT JOIN tbl_paymonths ON tbl_payment.month_id = tbl_paymonths.month_id WHERE tbl_payment.payment_status = 1";

        $db = dbConn();
        $resultpaid = $db->query($sqlpaid);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">NIC</th>
                    <th scope="col">Month</th>
                    <th scope="col">Year</th>
                    <th scope="col">Package</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalAmount = 0; // Initialize total amount variable

                if ($resultpaid->num_rows > 0) {
                    $i = 1;
                    while ($rowpaid = $resultpaid->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $rowpaid['First_Name'] ?></td>
                            <td><?= $rowpaid['Nic'] ?></td>
                            <td><?= $rowpaid['month_name'] ?></td>         
                            <td><?= $rowpaid['payment_year'] ?></td> <!-- Display payment year -->
                            <?php
                            $db = dbConn();
                            $sql = "SELECT m.MemberId, m.First_Name, m.PricingId, p.Package_Name, p.Price FROM tbl_members AS m INNER JOIN tbl_pricing AS p ON m.PricingId = p.PricingId WHERE m.MemberId = '{$rowpaid['member_id']}'";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                ?>
                                <td><?= $row['Package_Name'] ?></td>
                                <td><?= $row['Price'] ?></td>
                                <?php
                            }
                            ?>

                            <?php $idmember = $rowpaid['member_id']; ?>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>

                <?php if ($totalAmount > 0) : ?>
                    <tr>
                        <td colspan="5"></td>
                        <td><strong>Paid Total Amount: </strong></td>
                        <td><strong>LKR <?= $totalAmount ?>.00</strong></td>
                        <td colspan="7"></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div id="content">
        <div id="chartContainer" style="max-width: 600px; margin: 0 auto;">
            <canvas id="paymentBar"></canvas>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Year</th>
                    <th scope="col">Month</th>
                    <th scope="col">Total Received Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $db = dbConn();

                // Retrieve payment summary data
                $summarySql = "SELECT SUM(p.payment_amount) AS received_amount, pm.month_name, p.payment_year FROM tbl_members AS m INNER JOIN tbl_payment AS p ON m.MemberId = p.member_id INNER JOIN tbl_paymonths AS pm ON p.month_id = pm.month_id WHERE p.payment_status = 1 GROUP BY p.payment_year, pm.month_id ORDER BY p.payment_year, pm.month_id;";
                $summaryResult = $db->query($summarySql);

                while ($summaryRow = $summaryResult->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $summaryRow['payment_year'] ?></td>
                        <td><?= $summaryRow['month_name'] ?></td>
                        <td><?= $summaryRow['received_amount'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include '../../footer.php'; ?>
</main>

<?php
// Retrieve payment summary data for chart
$chartSql = "SELECT SUM(p.payment_amount) AS received_amount, pm.month_name, p.payment_year FROM tbl_members AS m INNER JOIN tbl_payment AS p ON m.MemberId = p.member_id INNER JOIN tbl_paymonths AS pm ON p.month_id = pm.month_id WHERE p.payment_status = 1 GROUP BY p.payment_year, pm.month_id ORDER BY p.payment_year, pm.month_id;";
$chartResult = $db->query($chartSql);

// Prepare data for the chart
$data_label = array();
$data_value = array();

while ($chartRow = $chartResult->fetch_assoc()) {
    $data_label[] = $chartRow['payment_year'] . ' ' . $chartRow['month_name'];
    $data_value[] = $chartRow['received_amount'];
}
?>

<script>
  /* globals Chart:false, feather:false */
  (() => {
    'use strict';

    feather.replace({ 'aria-hidden': 'true' });

    // Graphs
    const ctx = document.getElementById('paymentBar');
    // eslint-disable-next-line no-unused-vars
    const paymentBar = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [
          <?= "'".implode("','", $data_label)."'" ?>
        ],
        datasets: [{
          data: [
            <?= implode(',', $data_value) ?>
          ],
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          borderWidth: 4,
          pointBackgroundColor: '#007bff'
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        legend: {
          display: false
        }
      }
    });
  })();
</script>
