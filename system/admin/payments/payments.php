<?php $payments = "active" ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Payments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>admin/payments/add_payments.php" class="btn btn-sm btn-outline-secondary">Add Payments</a>

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
        $filterMonth = isset($_POST['filter_month']) ? $_POST['filter_month'] : '';
        $filterYear = isset($_POST['filter_year']) ? $_POST['filter_year'] : '';
        $filterPayment = isset($_POST['filter_payment']) ? $_POST['filter_payment'] : '';
        $db = dbConn();
        $sqlpaid = "SELECT * FROM tbl_members RIGHT JOIN tbl_payment ON tbl_members.MemberId = tbl_payment.member_id LEFT JOIN tbl_paymonths ON tbl_payment.month_id = tbl_paymonths.month_id";

        // Add the filter conditions if month, year, and payment are provided
        if (!empty($filterMonth)) {
            // Escape the input to prevent SQL injection
            $filterMonth = mysqli_real_escape_string($db, $filterMonth);

            // Append the filter condition to the SQL query
            $sqlpaid .= " WHERE tbl_paymonths.month_name = '$filterMonth'";
        }

        if (!empty($filterYear)) {
            // Escape the input to prevent SQL injection
            $filterYear = mysqli_real_escape_string($db, $filterYear);

            // Append the filter condition to the SQL query
            $sqlpaid .= (!empty($filterMonth) ? " AND" : " WHERE") . " tbl_payment.payment_year = '$filterYear'";
        }

        if ($filterPayment !== '') {
            // Escape the input to prevent SQL injection
            $filterPayment = mysqli_real_escape_string($db, $filterPayment);

            if ($filterPayment === '0') {
                // Append the filter condition to the SQL query for "Verify" rows
                $sqlpaid .= (!empty($filterMonth) || !empty($filterYear) ? " AND" : " WHERE") . " (tbl_payment.payment_status = '0' OR tbl_payment.payment_status IS NULL)";
            } else {
                // Append the filter condition to the SQL query for "Paid" and "Rejected" rows
                $sqlpaid .= (!empty($filterMonth) || !empty($filterYear) ? " AND" : " WHERE") . " tbl_payment.payment_status = '$filterPayment'";
            }
        }

        $db = dbConn();
        $resultpaid = $db->query($sqlpaid);
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <label for="filter_month">Filter by Month:</label>
            <select name="filter_month" id="filter_month">
                <option value="">--</option>
                <?php
                $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                foreach ($months as $month) {
                    echo "<option value='$month'" . ($filterMonth == $month ? " selected" : "") . ">$month</option>";
                }
                ?>
            </select>

            <label for="filter_year">Filter by Year:</label>
            <input type="text" name="filter_year" id="filter_year" value="<?php echo $filterYear; ?>">

            <label for="filter_payment">Filter by Payment:</label>
            <select name="filter_payment" id="filter_payment">
                <option value="">--</option>
                <option value="0"<?php echo ($filterPayment === '0') ? " selected" : ""; ?>>Verify</option>
                <option value="1"<?php echo ($filterPayment === '1') ? " selected" : ""; ?>>Paid</option>
                <option value="2"<?php echo ($filterPayment === '2') ? " selected" : ""; ?>>Rejected</option>
            </select>

            <button type="submit">Filter</button>
        </form>


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
                            <td>
                                <?php
                                if ($rowpaid['payment_type'] == "Cash") {
                                    echo "Cash Payment";
                                } else {
                                    ?>
                                    <form method="POST" action="slipimage.php" id="slip">
                                        <input type="hidden" name="member_id" value="<?= $rowpaid ['member_id'] ?>" >
                                        <input type="hidden" name="month_id" value="<?= $rowpaid ['month_id'] ?>" >
                                        <input type="hidden" name="payment_id" value="<?= $rowpaid ['payment_id'] ?>" >
                                        <button name="action" > click </button> 
                                    </form><?php
                                }
                                ?>

                            </td>  


                            <td>

                                <?php
                                if ($rowpaid['payment_type'] == "Cash") {
                                    
                                } else {
                                    ?>
                                    <form method="get" action="payment_status.php" >
                                        <input type="hidden" name="memberId" value="<?= $rowpaid ['member_id'] ?>">
                                        <input type="hidden" name="paymentId" value="<?= $rowpaid ['payment_id'] ?>">
                                        <input type="hidden" name="monthId" value="<?= $rowpaid ['month_id'] ?>">
                                        <input type="hidden" name="year" value="<?= $rowpaid ['payment_year'] ?>">

                                        <?php
                                        $sta = $rowpaid['payment_status'];

                                        if ($sta == 1 || $sta == 2) {
                                            $disable = "disabled";
                                        }
                                        ?> 
                                        <select name="changestatus" <?= @$disable ?>  >
                                            <option>--</option>

                                            <option value="1">Received</option>
                                            <option value="2">Rejected</option>



                                        </select>



                                        <button type="submit" <?= @$disable ?> >update </button>

                                    </form><?php
                                }
                                ?>


                            </td>
                            <td>
                                <?php
                                $pid = $rowpaid ['payment_id'];
                                //$statussql = "SELECT * FROM tbl_payment WHERE member_id ='$idmember' AND month_id = '$idmonth'  AND payment_year = '$yearof'";
                                $statussql = "SELECT * FROM tbl_payment WHERE member_id ='$idmember' and payment_id = '$pid' ";
                                $results = $db->query($statussql);

                                $rowstatus = $results->fetch_assoc();
                                $statspayement = $rowstatus['payment_status'];
                                if ($statspayement == 0) {
                                    echo '<span style="color: orange; font-weight: bold;">Verify</span>';
                                } elseif ($statspayement == 1) {
                                   echo '<span style="color: green; font-weight: bold;">Approved</span>';
                                    $totalAmount += $row['Price']; // Add the amount to the total
                                } elseif ($statspayement == 2) {
                                     echo '<span style="color: red; font-weight: bold;">Rejected</span>';
                                }
                                ?>

                            </td>

                        </tr>
                        <?php
                        $i++;
                        $disable = '';
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