<?php ob_start(); ?>
<?php $payments = "active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<?php include 'sidebar.php'; ?>

<?php
$db = dbConn();
$memberidsession = $_SESSION['MemberId'];
//echo $memberidsession;
$sql = "SELECT * FROM tbl_members WHERE MemberId= '$memberidsession' AND Approval_Status='1'";
$results = $db->query($sql);

if ($results->num_rows == null) {
    header("Location:profile.php");
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">My Payments</h1>
    </div>

    <div>
        <?php
        $memberid = $_SESSION['MemberId'];
        $db = dbConn();
        $sql4 = "SELECT * FROM tbl_pricing INNER JOIN tbl_members ON tbl_pricing.PricingId = tbl_members.PricingId WHERE MemberId='$memberid' ";

        $results = $db->query($sql4);
        ?>

        <?php
        $rowm = $results->fetch_assoc();
        ?>

        Package Name : <?= $rowm['Package_Name']; ?>
        <br>
        Amount : <?= $rowm['Price']; ?>
        <?php
        $memberNic = $rowm['Nic'];
        $packageId = $rowm['PricingId'];
        ?>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);
        $messages = array();

        $month = cleanInput($month);
        $amount = cleanInput($amount);

        if (empty($month)) {
            $messages['error_Month'] = "The month should not be empty..!";
        }


        if ($_FILES['payementslip']['name'] == "") {
            $messages['error_slip'] = "The slip should not be empty..!";
        }


        if ($_FILES['payementslip']['name'] != "") {
            $slipImage = $_FILES['payementslip'];
            $filename = $slipImage['name'];
            $filetmpname = $slipImage['tmp_name'];
            $filesize = $slipImage['size'];
            $fileerror = $slipImage['error'];
            //take file extension
            $file_ext = explode(".", $filename);
            $file_ext = strtolower(end($file_ext));
            //select allowed file type
            $allowed = array("jpg", "jpeg", "png", "pdf");
            //check wether the file type is allowed
            if (in_array($file_ext, $allowed)) {
                if ($fileerror === 0) {
                    //file size gives in bytes
                    if ($filesize <= 40000000) {
                        //giving appropriate file name. Can be duplicate have to validate using function
                        $file_name_new = uniqid() . $memberNic . 'month' . $month . '.' . $file_ext;
                        //directing file destination
                        $file_path = "../../system/assets/images/paymentSlips/" . $file_name_new;
                        //moving binary data into given destination
                        if (move_uploaded_file($filetmpname, $file_path)) {
                            "The file is uploaded successfully";
                        } else {
                            $messages['file_error'] = "File is not uploaded";
                        }
                    } else {
                        $messages['file_error'] = "File size is invalid";
                    }
                } else {
                    $messages['file_error'] = "File has an error";
                }
            } else {
                $messages['file_error'] = "Invalid File type";
            }
        }

        if ((!empty($month)) && ($_FILES['payementslip']['name'] != "")) {
            $currentYear = date("Y");
            $db = dbConn();
            $sqlcheck = "SELECT * FROM tbl_payment WHERE member_id = '$memberid' and month_id = '$month' and payment_year = '$currentYear' and payment_status = 1;";
            $results = $db->query($sqlcheck);
            $results->num_rows;
            if ($results->num_rows > 0) {
                $messages['error'] = "error";
                ?>
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'You have already paid for the selected month . .  ',

                    })
                </script><?php
            }
        }

        if (empty($messages)) {
            $db = dbConn();
            $currentYear = date("Y");
            $pDate = date('Y-m-d');
            $sql = "INSERT INTO tbl_payment(member_id,month_id,payment_slip,payment_date,package_id,payment_amount,payment_year,payment_type) VALUES ('$memberid','$month','$file_name_new','$pDate','$packageId','$amount','$currentYear','Bank_Transfer')";
            $results = $db->query($sql);
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Your payment details are submitted Successfully . .  ',

                })
            </script><?php
        }
    }
    ?>

    <!-- Card with an image on left -->
    <div class="card mb-12">

        <div class="row g-0">

            <?php
            $sqlpaid = "SELECT * FROM tbl_payment LEFT JOIN tbl_paymonths on tbl_payment.month_id = tbl_paymonths.month_id WHERE member_id= '$memberid';";
            $resultpaid = $db->query($sqlpaid);
            ?>

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Month</th>
                        <th scope="col">Year</th>

                        <th scope="col">Payment Status</th>
                         <th scope="col">Payment Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultpaid->num_rows > 0) {

                        $i = 1;
                        while ($rowpaid = $resultpaid->fetch_assoc()) {
                            $idmonth = $rowpaid['month_id'];
                            $yearof = $rowpaid['payment_year'];
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $rowpaid['month_name'] ?></td>         
                                <td><?= $rowpaid['payment_year'] ?></td>
                                <td>
                                    <?php
                                    $pid = $rowpaid ['payment_id'];
                                    //$statussql = "SELECT payment_status FROM tbl_payment WHERE member_id ='$memberid' AND month_id = '$idmonth'  AND payment_year = '$yearof'";
                                    $statussql = "SELECT * FROM tbl_payment WHERE member_id ='$memberid' and payment_id = '$pid' ";
                                    $results = $db->query($statussql);
                                    $rowstatus = $results->fetch_assoc();
                                    $statusdb = $rowstatus['payment_status'];

                                    if ($statusdb == 0) {
                                        echo "Paid, Verification Pending";
                                    } elseif ($statusdb == 1) {
                                        echo "Paid";
                                    } else {
                                        echo "Rejected";
                                    }
                                    ?>
                                </td>
                                <td><?= $rowpaid['payment_type'] ?></td>
                                
                           
                                
                               
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>



    <section>
        <!-- Card with an image on left -->
        <div class="card mb-12">
            <div class="row g-0">
                <section>
                    <div class="row">
                        <div class="col-md-1" ></div>
                        <div class="col-md-4 p-2" style="box-shadow: 5px 5px 5px 5px #888888;">
                            <h2>Bank Details </h2> 
                            <h5>Name  : Life Fitness Gym</h5>
                            <h5>Account Number : 1040 5760 3447 </h5>
                            <h5>Bank : Sampath Bank</h5>
                            <h5>Branch : Athurugiriya</h5>
                        </div>
                        <div class="col-md-1" ></div>
                        <div class="col-md-4 p-2" style="box-shadow: 5px 5px 5px 5px #888888;"> 
                            <h2>Bank Details </h2> 
                            <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                                <div class="form-outline mb-2">


                                    <!--month start's-->


                                    <div class="form-outline mb-2">
                                        <div class="form-outline mb-2">
                                            <?php
                                            $currentYear = date('Y');

                                            // Find the last paid month
                                            $sqlLastPaidMonth = "SELECT MAX(month_id) AS last_paid_month FROM tbl_payment WHERE payment_year = {$currentYear} AND payment_status = 1 AND member_id = '$memberid'";
                                            $db = dbConn();
                                            $resultLastPaidMonth = $db->query($sqlLastPaidMonth);
                                            $lastPaidMonth = ($resultLastPaidMonth->num_rows > 0) ? $resultLastPaidMonth->fetch_assoc()['last_paid_month'] : 0;

                                            // Determine the next month
                                            $nextMonth = ($lastPaidMonth + 1) % 13;
                                            if ($nextMonth === 0) {
                                                $nextMonth = 1;
                                                $currentYear++;
                                            }

                                            $sqlMonth = "SELECT * FROM tbl_paymonths WHERE month_id >= {$nextMonth} AND month_id <= 12 AND month_id > {$lastPaidMonth} LIMIT 1";
                                            $resultMonth = $db->query($sqlMonth);
                                            ?>
                                            <label>Select Month</label>
                                            <select id="month_name" name="month" class="form-control">
                                                <option value="">--</option>
                                                <?php
                                                if ($resultMonth->num_rows > 0) {
                                                    while ($row = $resultMonth->fetch_assoc()) {
                                                        $selected = ($month == $row['month_id']) ? "selected" : "";
                                                        echo '<option value="' . $row['month_id'] . '" ' . $selected . '>' . $row['month_name'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>

                                            <div class="text-danger"> <?= @$messages['error_Month']; ?></div>
                                        </div>




                                        <!--                    month ends-->



                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="form1Example13">Amount</label>
                                            <input type="number" placeholder="" class="form-control form-control-sm" id="amount" value="<?= $rowm['Price']; ?>" disabled>
                                            <input type="hidden" placeholder="" class="form-control form-control-sm" id="amount" name="amount" value="<?= $rowm['Price']; ?>" >
                                            <div class="text-danger"> <?= @$messages['error_Amount']; ?></div>
                                        </div>


                                        <label for="ProductImage" class="form-label">Slip upload</label>
                                        <input class="form-control" type="file" id="ProductImage"  name="payementslip">
                                        <div class="text-danger"> <?= @$messages['error_slip']; ?></div>
                                        <div class="text-danger"> <?= @$messages['file_error']; ?></div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Upload</button>
                            </form>

                        </div>



                    </div>

                </section>




            </div>
        </div><!-- End Card with an image on left -->
    </section>
</main>

<?php ?>

<?php ob_end_flush(); ?>