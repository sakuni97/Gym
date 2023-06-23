<?php ob_start(); ?>
<?php $details = "active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<?php include 'sidebar.php'; ?>

<?php
$db = dbConn();
$memberidsession = $_SESSION['MemberId'];
//echo $memberidsession;
$sql9 = "SELECT * FROM tbl_members WHERE MemberId= '$memberidsession' AND Approval_Status='1'";
$results = $db->query($sql9);

if ($results->num_rows == null) {
    header("Location:profile.php");
}
?>





<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">My Details</h1>

    </div>
    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'update') {
//        print_r(@$action);die();
        //seperate variables and values from the form
        //data clean
        $mContact = cleanInput($mContact);
        $mEmergency = cleanInput($mEmergency);
        $mAddressline1 = cleanInput($mAddressline1);
        $mAddressline2 = cleanInput($mAddressline2);

              
        //create array variable store validation messages
        $messages = array();

        //validate required fields
        
        if (empty($mAddressline1)) {
            $messages['error_mAddress1'] = "The Address line 1 should not be empty..!";
        }
        if (empty($mAddressline2)) {
            $messages['error_mAddress2'] = "The Address line 2 should not be empty..!";
        }

        if (empty($mContact)) {
            $messages['error_mContact'] = "The contact number should not be empty..!";
        }
        if (empty($mEmergency)) {
            $messages['error_mEmergency'] = "The Emergency contact number should not be empty..!";
        }
        
        //print_r($messages);
        if (empty($messages)) {


            $sql5 = "UPDATE tbl_members SET Contact='$mContact',Emergency_Contact='$mEmergency',Address_Line1='$mAddressline1',Address_Line2='$mAddressline2' WHERE MemberId='$memberidsession'";
            
            $db = dbConn();
            $db->query($sql5);

        }

        if (true) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'success',
                    text: 'Member details changed successfully'
                })
            </script>
            <?php
            ?>
            <?php
        }
    }
    
    
if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET") {
        //$MemberIdedit = isset($_GET['MemberId']) ? $_GET['MemberId'] : $_POST['MemberId'];
    $db = dbConn();
    $memberidsession = $_SESSION['MemberId'];
    $sql = "SELECT * FROM tbl_members WHERE MemberId= '$memberidsession' AND Approval_Status='1'";
    $results = $db->query($sql);
    $row = $results->fetch_assoc();

    $mContactz = $row['Contact'];
    $mEmergencyz = $row['Emergency_Contact'];
    $mAddressline11z = $row['Address_Line1'];
    $mAddressline2z = $row['Address_Line2'];

//    echo $memberidsession;
}
    ?>



    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                <div class="mt-3">
                                    <h4><?= $row['First_Name'] . " " . $row['Last_Name'] ?></h4>
                                    <p class="text-secondary mb-1">Joined on <?= $row['Joined_Date'] ?> </p>

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
                                    <h6 class="mb-0">Email</h6>
                                    <span class="text-secondary"><?= $row['Email'] ?></span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Date of Birth </h6>
                                    <span class="text-secondary"><?= $row['Dob'] ?></span>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Package</h6>
                                </div>
                                <?php
                                $memberid = $_SESSION['MemberId'];
                                $db = dbConn();
                                $sql4 = "SELECT * FROM tbl_pricing INNER JOIN tbl_members ON tbl_pricing.PricingId = tbl_members.PricingId WHERE MemberId='$memberid' ";

                                $results = $db->query($sql4);
                                ?>

                                <?php
                                $rowm = $results->fetch_assoc();
                                ?>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="<?= $rowm['Package_Name'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">

                                    <?php
                                    $getmemberid = $_SESSION['MemberId'];
                                    $db = dbConn();
                                    $sqlj = "SELECT * FROM tbl_users INNER JOIN tbl_members ON tbl_users.UserId = tbl_members.UserId WHERE MemberId='$getmemberid' ";

                                    $results = $db->query($sqlj);
                                    ?>
                                    <?php
                                    $rowx = $results->fetch_assoc();
                                    ?>


                                    <h6 class="mb-0">Trainer</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">


                                    <input type="text" class="form-control" value="<?php
                                    if ($results->num_rows <= 0) {
                                        echo 'Not Yet assigned';
                                    } else {
                                        $trainer = $rowx["UserId"];
                                        $sqlw = "SELECT * FROM tbl_users WHERE  UserId=$trainer";
                                        $db = dbConn();
                                        $resultD = $db->query($sqlw);
                                        $rowUPDATE = $resultD->fetch_assoc();
                                        echo $rowUPDATE['FirstName'] . " " . $rowUPDATE['LastName'];
                                    }
                                    ?>  ">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Joined Height</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="<?= $row['Height'] ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Joined Weight</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="<?= $row['Weight'] ?>"creadonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal " method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Contact Number</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mContact" value="<?= @$mContactz ?>" ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Emergency Contact</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mEmergency" value="<?= @$mEmergencyz ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address line 1 </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mAddressline1" value="<?= $mAddressline11z ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address line 2 </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mAddressline2" value="<?= $mAddressline2z ?>">
                                    </div>
                                </div>


                                <input type="hidden" name="MemberId" value="<?= $memberidsession ?>">
                                <div class="row">

                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <button type="submit" name="action" value="update" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</main>

<?php
?>

<?php ob_end_flush(); ?>