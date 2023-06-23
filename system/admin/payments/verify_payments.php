<?php $payments = "active" ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Payments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>admin/payments/add_payments.php" class="btn btn-sm btn-outline-secondary">Add Payments</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Payment</button>
            </div>

        </div>
    </div>
    <?php
    if ((isset($_GET['success'])) && $_GET['success'] == true) {

        $message = "Payments updated successfully";
        echo"<script>window.alert('$message');</script>";
    }
    ?>


    <div class="table-responsive">
        <?php
        
        $db = dbConn();
        $sqlpaid = "SELECT * FROM tbl_members RIGHT JOIN tbl_payment ON tbl_members.MemberId = tbl_payment.member_id LEFT JOIN tbl_paymonths ON tbl_payment.month_id = tbl_paymonths.month_id WHERE tbl_payment.payment_status = 0";
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
                    <th scope="col">Slip Image</th>
                    <th scope="col">Update Status</th>
                    <th scope="col">Payment</th>
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
                            <td><?php
                                echo $yearof = $rowpaid['payment_year'];
                                $idmonth = $rowpaid['month_id'];
                                ?>
                            </td>
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
                            <td> <a href="download.php?memberid=<?= $rowpaid['member_id'] ?>&month_name=<?= $rowpaid['month_id'] ?>"> Download </a></td>


                            <td>
                                <form method="get" action="pay_status.php">
                                    <input type="hidden" name="memberId" value="<?= $rowpaid['member_id'] ?>">
                                    <input type="hidden" name="monthId" value="<?= $rowpaid['month_id'] ?>">
                                    <input type="hidden" name="year" value="<?= $rowpaid['payment_year'] ?>">
                                    <select name="changestatus">
                                        <option>--</option>
                                        <option value="1">Received</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                    <button type="submit">update</button>
                                </form>
                            </td>
                            <td>
                                <?php
                                $statussql = "SELECT payment_status FROM tbl_payment WHERE member_id ='$idmember' AND month_id = '$idmonth'  AND payment_year = '$yearof'";
                                $results = $db->query($statussql);
                                $rowstatus = $results->fetch_assoc();
                                $statusdb = $rowstatus['payment_status'];

                                if ($statusdb == 0) {
                                    echo '<span style="color: orange; font-weight: bold;">Verify</span>';
                                } elseif ($statusdb == 1) {
                                    echo '<span style="color: green; font-weight: bold;">Paid</span>';
                                    $totalAmount += $row['Price']; // Add the amount to the total
                                } else {
                                    echo '<span style="color: red; font-weight: bold;">Rejected</span>';
                                }
                                ?>
                            </td>

                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>

                <?php if ($totalAmount > 0) : ?>
                    <tr>
                        <td colspan="5"></td>
                        <td><strong>Received Total Amount: </strong></td>
                        <td><strong>LKR <?= $totalAmount ?>.00</strong></td>
                        <td colspan="7"></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    
</main>