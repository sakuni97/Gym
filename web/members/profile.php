<?php ob_start(); ?>
<?php $profile = "active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<?php include 'sidebar.php'; ?>

<?php
$db = dbConn();
$memberidsession = $_SESSION['MemberId'];
$sql = "SELECT * FROM tbl_members WHERE MemberId= '$memberidsession' AND Approval_Status=0";
$results = $db->query($sql);
$row = $results->fetch_assoc();
?>

<main id="main">
    <section id="about" class="about">
        <div class="container" >


            <div class="section-header">
                <h3>Hey <?= @$_SESSION['First_Name'] ?> !!</h3>
                <p>You are in the correct track, We got you...</p>
                <?php
                if ($results->num_rows == 1) {
                    echo '<span style="color: red;">Your membership is still pending! Please make the payment to continue.</span>';
                    ?>

                    <section>
                        <?php
                        $memberNic = $row['Nic'];
                        $packageId = $row['PricingId'];
                        ?>

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
                                $sqlcheck = "SELECT * FROM tbl_payment WHERE member_id = '$memberidsession' and month_id = '$month' and payment_year = '$currentYear';";
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
                                $sql = "INSERT INTO tbl_payment(member_id,month_id,payment_slip,payment_date,package_id,payment_amount,payment_year) VALUES ('$memberidsession','$month','$file_name_new','$pDate','$packageId','$amount','$currentYear')";
                                $results = $db->query($sql);
                                ?>
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Your payment details are submitted Successfully . .  ',

                                    })
                                </script>
                                    <?php
                                    header("Location:pending_membership.php");
                            }
                        }
                        ?>


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


                                        <!-- month start's-->

                                        <!-- start of ram -->
                                        <div class="form-outline mb-2">
                                            <?php
                                            $sqlMonth = "SELECT * FROM tbl_paymonths";
                                            $db = dbConn();
                                            $resultMonth = $db->query($sqlMonth);

                                            $currentYear = date('Y');
                                            $currentMonth = date('m');
                                            $registrationDate = $row['Joined_Date'];
                                            // Calculate the cutoff date for payment
                                            $cutoffDay = 20;

                                            $selectedMonth = ''; // Default value for $month
                                            ?>
                                            <label>Select Month</label>
                                            <select id="month_name" name="month" class="form-control">
                                                <option value="">--</option>
                                                <?php
                                                if ($resultMonth->num_rows > 0) {
                                                    while ($rowx = $resultMonth->fetch_assoc()) {
                                                        $monthId = $rowx['month_id'];
                                                        $monthName = $rowx['month_name'];

                                                        // Calculate the month's cutoff date
                                                        $cutoffDate = sprintf("%04d-%02d-%02d", $currentYear, $monthId, $cutoffDay);

                                                        // Determine if the member needs to pay for this month
                                                        if (strtotime($registrationDate) <= strtotime($cutoffDate)) {
                                                            ?>
                                                            <option value="<?= $monthId ?>" <?php
                                                            if ($selectedMonth == $monthId) {
                                                                echo "selected";
                                                            }
                                                            ?>><?php echo $monthName ?></option>
                                                                    <?php
                                                                    break; // Stop the loop after finding the correct month
                                                                }
                                                            }
                                                        }
                                                        ?>
                                            </select>




                                            <div class="text-danger"> <?= @$messages['error_Month']; ?></div>
                                        </div>

                                        <!--                    month ends-->



                                        <div class="form-outline mb-2">
                                            <?php
                                            $memberid = $_SESSION['MemberId'];
                                            $db = dbConn();
                                            $sql4 = "SELECT *, tbl_pricing.Package_Name FROM tbl_pricing INNER JOIN tbl_members ON tbl_pricing.PricingId = tbl_members.PricingId WHERE MemberId='$memberidsession' ";

                                            $results = $db->query($sql4);
                                            ?>

                                            <?php
                                            $rowm = $results->fetch_assoc();
                                            ?>
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

                    </section><?php
                } else {


                    echo 'hello prens';
                }
                ?>
            </div>




        </div>
        <!--Main Navigation-->
    </section>
</main>
<?php ob_end_flush(); ?>