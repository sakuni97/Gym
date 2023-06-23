<?php ob_start(); ?>
<?php $password = "active" ?>
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
        <h1 class="h3">Change My Password</h1>
    </div>

    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $databasepassword=$_SESSION['memberpassword'];
         $resetmembercustomerid=$_SESSION['MemberId'];
        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $oPassword = cleanInput($oPassword);
        $nPassword = cleanInput($nPassword);
        $cPassword = cleanInput($cPassword);
        

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($oPassword)) {
            $messages['error_oPassword'] = "The Password should not be empty..!";
        }

        if (empty($nPassword)) {
            $messages['error_nPassword'] = "The New Password should not be empty..!";
        }

        if (empty($cPassword)) {
            $messages['error_cPassword'] = "The Confirm Password should not be empty..!";
        }
         if (!empty($nPassword)) {
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $nPassword);
        $lowercase = preg_match('@[a-z]@', $nPassword);
        $number = preg_match('@[0-9]@', $nPassword);
        $specialChars = preg_match('@[^\w]@', $nPassword);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($nPassword) < 8) {
            $messages['error_nPassword'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.!";
        }
    }



    if ((!empty($nPassword)) && (!empty($cPassword))) {

        if ($nPassword != $cPassword) {
            $messages['error_nPassword'] = " Passwords are not match";
        }
    }
    
    
     if (!empty($oPassword)) {
         $oPasswordz= sha1($oPassword);
            if ($databasepassword != $oPasswordz) {
            $messages['error_oPassword'] = " Entered current password is invalid";
        }
         
        }
    

        
        if (empty($messages)) {
        $nPasswordz= sha1($nPassword);
            echo $sql = "UPDATE tbl_members SET Password='$nPasswordz'  WHERE MemberId='$resetmembercustomerid' ";
            $db = dbConn();
            $db->query($sql);
            
            header("Location:../logout.php");
            
        }
    }
    ?>


    <!-- Card with an image on left -->
    <div class="card mb-12">
        <div class="row g-0">


            <div class="card-body">

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">


                    <div class="mb-3">
                        <label for="oPassword" class="form-label">Enter the Old Password</label>
                        <input type="password" class="form-control" id="oPassword" name="oPassword" value="<?= @$oPassword; ?>">
                        <div class="text-danger"> <?= @$messages['error_oPassword']; ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="nPassword" class="form-label">Enter the New Password</label>
                        <input type="password" class="form-control" id="nPassword" name="nPassword" value="<?= @$nPassword; ?>">
                        <div class="text-danger"> <?= @$messages['error_nPassword']; ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="cPassword" class="form-label">Confirm the New Password</label>
                        <input type="password" class="form-control" id="cPassword" name="cPassword" value="<?= @$cPassword ?>">
                        <div class="text-danger"><?= @$messages['error_cPassword']; ?></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>

        </div>
    </div><!-- End Card with an image on left -->
</main>

<?php ?>

<?php ob_end_flush(); ?>