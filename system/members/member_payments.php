<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<?php
extract($_POST);

if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET") {
    $MemberIdedit = isset($_GET['MemberId']) ? $_GET['MemberId'] : $_POST['MemberId'];

    $db = dbConn();
    $sql = "SELECT * FROM tbl_members WHERE MemberId='$MemberIdedit'";
    $results = $db->query($sql);
    $row = $results->fetch_assoc();

    $id = $row['MemberId'];
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"> <?php echo $row['First_Name'] . " " . $row['Last_Name'] ?>'s Payment History</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>members/members.php" class="btn btn-sm btn-outline-secondary">View All Members</a>

            </div>

        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET") {
        $MemberIdedit = isset($_GET['MemberId']) ? $_GET['MemberId'] : $_POST['MemberId'];

        $db = dbConn();
        $sql = "SELECT * FROM tbl_members WHERE MemberId='$MemberIdedit'";
        $results = $db->query($sql);
        $row = $results->fetch_assoc();

        $mContactz = $row['Contact'];
        $mEmergencyz = $row['Emergency_Contact'];

        $mDobz = $row['Dob'];
        $mHeightz = $row['Height'];
        $mWeightz = $row['Weight'];
    }

//    echo $MemberId;
    ?>
    <!--    error message starting-->
    <?php if ((isset($_GET['error'])) && $_GET['error'] == true) { ?>
        <div class="alert alert-danger" role="alert">
            Please Select the Month before proceed !


        </div>
    <?php }; ?>

    <!--    error message end-->

    <!--    Success message starting-->

    <?php if ((isset($_GET['success'])) && $_GET['success'] == true) { ?>
        <div class="alert alert-success" role="alert">
            Payment done successfully !


        </div>
    <?php }; ?>

    <!--    Success message end-->


    <div class="container">
        <div class="main-body">
            <div class="row">

                <!-- Start of the unchangable details card -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                <div class="mt-3">
                                    <h4><?= $row['First_Name'] . " " . $row['Last_Name'] ?></h4>
                                    <p class="text-secondary mb-1">Joined on <?php
                                        echo $joineddate = $row['Joined_Date'];
                                        $_SESSION['joineddate'] = $joineddate;
                                        ?> </p>

                                </div>
                            </div>
                            <hr class="my-4">
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">First Name</h6>
                                    <span class="text-secondary"><?= $row['First_Name'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Last Name</h6>
                                    <span class="text-secondary"><?= $row['Last_Name'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">NIC Number</h6>
                                    <span class="text-secondary"><?= $row['Nic'] ?></span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Date Of Birth</h6>
                                    <span class="text-secondary"><?= $row['Dob'] ?></span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Pricing Package</h6>

                                    <?php
                                    $db = dbConn();
                                    $sql1 = "SELECT * FROM tbl_members LEFT JOIN tbl_pricing on tbl_members.PricingId = tbl_pricing.PricingId WHERE tbl_members.MemberId='$MemberIdedit';";

                                    $results = $db->query($sql1);
                                    $row = $results->fetch_assoc();
                                    echo $row['Package_Name'];
                                    $_SESSION['PricingId'] = $row['PricingId']
                                    ?>

                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Package Price</h6>
                                    <span class="text-secondary"><?= $row['Price'] ?></span>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <br>



                </div>

                <!--table of payments -->
                <div class="col-lg-8">
                    <?php
                    $sqlfirst = "SELECT * FROM tbl_payment where member_id = '$MemberIdedit'";
                    $resultfirst = $db->query($sqlfirst);
                    if ($resultfirst->num_rows > 1) {
                        
                    } elseif ($resultfirst->num_rows == 1) {
                        $row = $resultfirst->fetch_assoc();
                       if($row['payment_status'] == 1 || $row['payment_status']== 2 ){
                           //echo "approved komlek";
                       }
  
                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <?php
                                        extract($_POST);
                                        if (true) {
                                            $db = dbConn();
                                            $sql3 = "SELECT * FROM tbl_members WHERE MemberId='$MemberIdedit'";
                                            $result = $db->query($sql3);
                                            ?>
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Membership Status</th>
                                                        <th scope="col">Update Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $id = $row['MemberId'];
                                                            $status = $row['Status'];
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <span style=" width: 100px;" class="badge <?php echo $row['Approval_Status'] ? 'bg-success' : 'bg-danger' ?>"><?php echo $row['Approval_Status'] == 1 ? 'Approved' : 'Pending' ?></span>
                                                                </td>

                                                                <td>
                                                                    <a style=" width: 100px; height: 30px;" class="btn btn-secondary btn-sm" href="<?php echo $row['Approval_Status'] == 1 ? 'approval_status.php?MemberId=' . $row['MemberId'] . '&Approval_Status=0' : 'approval_status.php?MemberId=' . $row['MemberId'] . '&Approval_Status=1'; ?>"><?php echo $row['Approval_Status'] == 1 ? 'Reject' : 'Approve' ?></a>
                                                                </td>

                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div><?php
                    }
                    ?>
                    <!-- Start of the status grid -->

                    <br>
                    <br>


                    <div class="card">
                        <div class="card-body">
                            <?php
                            $sqlpaid = "SELECT * FROM tbl_payment LEFT JOIN tbl_paymonths on tbl_payment.month_id = tbl_paymonths.month_id WHERE member_id= '$MemberIdedit';";
                            $resultpaid = $db->query($sqlpaid);
                            ?>

                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Slip Image</th>
                                        <th scope="col">Update Status</th>
                                        <th scope="col">Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($resultpaid->num_rows > 0) {
                                        $i = 1;
                                        while ($rowpaid = $resultpaid->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $rowpaid['month_name'] ?></td>         
                                                <td><?php
                                                    echo $yearof = $rowpaid['payment_year'];
                                                    $idmonth = $rowpaid['month_id'];
                                                    ?></td>
                                                <?php $idmember = $rowpaid ['member_id']; ?>



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
                                                            
                                                            <?php $sta=$rowpaid['payment_status'];
                                                            
                                                            if ($sta == 1 ||$sta == 2 ){
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
                                                        echo "Payement Received";
                                                    } elseif ($statspayement == 1) {
                                                        echo "Approved";
                                                    } elseif ($statspayement == 2) {
                                                        echo "Rejected";
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                            $disable='';
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <h5>Do a new Payment</h5>
                            <form  method="POST"  action="member_status.php" >
                                <div class="form-outline mb-2">


                                    <!--month start's-->


                                    <div class="form-outline mb-2">
                                        <?php
                                        $currentYear = date('Y');

// Find the last paid month
                                        $sqlLastPaidMonth = "SELECT MAX(month_id) AS last_paid_month FROM tbl_payment WHERE payment_year = {$currentYear} AND payment_status = 1 AND member_id = '$id'";
                                        $db = dbConn();
                                        $resultLastPaidMonth = $db->query($sqlLastPaidMonth);
                                        $row = $resultLastPaidMonth->fetch_assoc();
                                        $lastPaidMonth = $row['last_paid_month'];

                                        if ($lastPaidMonth == null) {
                                            $joineddate = $_SESSION['joineddate'];
                                            $month = substr($joineddate, 5, 2);

                                            $date = substr($joineddate, 8, 2);

                                            if ($date > 20) {
                                                $lastPaidMonth = $month;
                                            } else {
                                                $lastPaidMonth = $month - 1;
                                            }
                                        } else {
                                            $lastPaidMonth = $lastPaidMonth;
                                        }
                                        ?>



                                        <?php
                                        $nextMonth = ($lastPaidMonth + 1) % 13;
                                        if ($nextMonth === 0) {
                                            $nextMonth = 1;
                                            $currentYear++;
                                        }



                                        $sqlMonth = "SELECT * FROM tbl_paymonths WHERE month_id >= {$nextMonth} AND month_id <= 12 AND month_id > {$lastPaidMonth} limit 1";
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

                                    <?php
                                    $db = dbConn();
                                    $sql1 = "SELECT * FROM tbl_members LEFT JOIN tbl_pricing on tbl_members.PricingId = tbl_pricing.PricingId WHERE tbl_members.MemberId='$id';";

                                    $results = $db->query($sql1);
                                    $rowl = $results->fetch_assoc();
                                    ?>

                                    <div class="form-outline mb-2">
                                        <label class="form-label" for="form1Example13">Amount</label>
                                        <input type="number" placeholder="" class="form-control form-control-sm" id="amount" value="<?= $rowl['Price']; ?>" disabled>
                                        <input type="hidden" placeholder="" class="form-control form-control-sm" id="amount" name="amount" value="<?= $rowl['Price'] ?>" >
                                        <div class="text-danger"> <?= @$messages['error_Amount']; ?></div>
                                    </div>



                                </div>

                                <input type="hidden" name="memberidupdate" value="<?= $_GET['MemberId'] ?>">
                                <input type="hidden" name="pricingid" value="<?= $_SESSION['PricingId'] ?>">
                                <button type="submit"  name="action" value="update" class="btn btn-primary btn-sm btn-block">Submit </button>
                            </form>
                        </div>
                    </div>

                </div>

                <br>



            </div>
        </div>
    </div>
</div>


</div>
</main>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<meta charset=utf-8 />
<script>
    $(".datemax").change(function () {
        var count = $(".datemax:checked").length; //get count of checked checkboxes

        if (count > 4) {
            alert("Only 4 date can be checked..!");
            $(this).prop('checked', false); // turn this one off
        }
    });
</script>



<?php include '../footer.php'; ?> 




<?php //print_r($_SESSION);    ?>
<?php ob_end_flush(); ?>


<?php include '../footer.php'; ?> 


<?php ob_end_flush(); ?>