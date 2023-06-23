<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<?php
extract($_POST);
//check form submit method
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'nav' || $_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'track' || $_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'weight' || $_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'heart' || $_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'pressure' || $_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'waist') {
    $db = dbConn();
  $sql = "SELECT * FROM tbl_members WHERE MemberId='$MemberId'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $pMember = $row['First_Name'];
    $pTrainer = $row['UserId'];

    if ($pTrainer == 0) {
        
    } else {
        $sqltrainer = "SELECT * FROM tbl_users WHERE UserId='$pTrainer'";
        $resulttrainer = $db->query($sqltrainer);
        $rowtrainers = $resulttrainer->fetch_assoc();
    }
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"> <?php echo $pMember ?>'s Progress Tracker - Assigned to  <?php
            if ($pTrainer == 0) {
                echo "No One Yet";
            } else {
                echo $rowtrainers ['FirstName'];
            }
            ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>trainer_portal/gym_members.php" class="btn btn-sm btn-outline-secondary">View All Members</a>
                
            </div>

        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'weight') {
        $db = dbConn();
        $sql2 = "SELECT * FROM tbl_members WHERE MemberId='$MemberId'";
        $result = $db->query($sql2);
        $row2 = $result->fetch_assoc();
        $insetingtrainerid = $_SESSION['UserId'];

        $pWeight = cleanInput($pWeight);

        $messages = array();

        if (empty($pWeight)) {
            $messages['error_pWeight'] = "The weight should not be empty..!";
        }
        if (!empty($pWeight)) {
            if ($pWeight < 0) {
                $messages['error_pWeight'] = "The Height should not be less than 0!";
            }
        }
        if (empty($messages)) {
            $cdate = date('Y-m-d');

            $sql = "INSERT INTO tbl_progress(member_id,trainer_id,measurment_id,value,date) VALUES ('$MemberId','$insetingtrainerid','1','$pWeight','$cdate')";
            $db = dbConn();
            $db->query($sql);
        }
    }

    // for heart rate 

    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'heart') {
        $db = dbConn();
        $sql2 = "SELECT * FROM tbl_members WHERE MemberId='$MemberId'";
        $result = $db->query($sql2);
        $row2 = $result->fetch_assoc();
        $insetingtrainerid = $_SESSION['UserId'];

        $pHeartrate = cleanInput($pHeartrate);
        $messages = array();

        if (empty($pHeartrate)) {
            $messages['error_pHeartrate'] = "The Heart Rate should not be empty..!";
        }
        if (!empty($pHeartrate)) {
            if ($pHeartrate < 0) {
                $messages['error_pHeartrate'] = "The Heart rate should not be less than 0!";
            }
        }
        if (empty($messages)) {
            $cdate = date('Y-m-d');

            $sql = "INSERT INTO tbl_progress(member_id,trainer_id,measurment_id,value,date) VALUES ('$MemberId','$insetingtrainerid','2','$pHeartrate','$cdate')";
            $db = dbConn();
            $db->query($sql);
        }
    }

//for pressure
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'pressure') {
        $db = dbConn();
        $sql2 = "SELECT * FROM tbl_members WHERE MemberId='$MemberId'";
        $result = $db->query($sql2);
        $row2 = $result->fetch_assoc();
        $insetingtrainerid = $_SESSION['UserId'];

        @$pPressure = cleanInput($pPressure);
        $messages = array();

        if (empty($pPressure)) {
            $messages['error_pPressure'] = "The Pressure should not be empty..!";
        }
        if (!empty($pPressure)) {
            if ($pPressure < 0) {
                $messages['error_pPressure'] = "The Pressure should not be less than 0!";
            }
        }
        if (empty($messages)) {
            $cdate = date('Y-m-d');

            $sql = "INSERT INTO tbl_progress(member_id,trainer_id,measurment_id,value,date) VALUES ('$MemberId','$insetingtrainerid','3','$pPressure','$cdate')";
            $db = dbConn();
            $db->query($sql);
        }
    }

    //for waist
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'waist') {
        $db = dbConn();
        $sql2 = "SELECT * FROM tbl_members WHERE MemberId='$MemberId'";
        $result = $db->query($sql2);
        $row2 = $result->fetch_assoc();
        $insetingtrainerid = $_SESSION['UserId'];

        @$pWaist = cleanInput($pWaist);
        $messages = array();

        if (empty($pWaist)) {
            $messages['error_pWaist'] = "The Waist should not be empty..!";
        }
        if (!empty($pWaist)) {
            if ($pWaist < 0) {
                $messages['error_pWaist'] = "The Waist should not be less than 0!";
            }
        }
        if (empty($messages)) {
            $cdate = date('Y-m-d');

            $sql = "INSERT INTO tbl_progress(member_id,trainer_id,measurment_id,value,date) VALUES ('$MemberId','$insetingtrainerid','4','$pWaist','$cdate')";
            $db = dbConn();
            $db->query($sql);
        }
    }

    
    ?>

    <div class="container">
        <div class="main-body">
            <div class="row">

                <!-- for weight -->
                <div class="col-sm-6">
                    <div class="card">

                        <div class="card-header">
                            Weight Update
                        </div>
                        <div class="card-body">

                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="weight" class="form-label">Enter Weight </label>
                                    <input type="text" class="form-control" id="weight" name="pWeight" value="<?= @$pWeight; ?>">
                                    <div class="text-danger"> <?= @$messages['error_pWeight']; ?></div>
                                </div>

                                <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >
                                <button name="action" value="weight" type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- for heart rate -->
                <div class="col-sm-6">
                    <div class="card">

                        <div class="card-header">
                            Heart Rate Update
                        </div>
                        <div class="card-body">


                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">



                                <div class="mb-3">
                                    <label for="heartrate" class="form-label">Enter Heart Rate </label>
                                    <input type="text" class="form-control" id="heartrate" name="pHeartrate" value="<?= @$pHeartrate; ?>">
                                    <div class="text-danger"> <?= @$messages['error_pHeartrate']; ?></div>
                                </div>

                                <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >
                                <button name="action" value="heart" type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">

                <!-- for pressure -->
                <div class="col-sm-6">
                    <div class="card">

                        <div class="card-header">
                            Pressure Update
                        </div>
                        <div class="card-body">


                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="pressure" class="form-label">Enter Pressure</label>
                                    <input type="text" class="form-control" id="pressure" name="pPressure" value="<?= @$pPressure; ?>">
                                    <div class="text-danger"> <?= @$messages['error_pPressure']; ?></div>
                                </div>
                                <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >
                                <button name="action" value="pressure" type="submit" class="btn btn-primary">Submit</button>
                            </form>


                        </div>
                    </div>
                </div>

                <!-- for waist -->
                <div class="col-sm-6">
                    <div class="card">

                        <div class="card-header">
                            Waist Update
                        </div>
                        <div class="card-body">


                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="waist" class="form-label">Enter Waist </label>
                                    <input type="text" class="form-control" id="waist" name="pWaist" value="<?= @$pWaist; ?>">
                                    <div class="text-danger"> <?= @$messages['error_pWaist']; ?></div>
                                </div>
                                <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >
                                <button name="action" value="waist" type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>


<?php include '../footer.php'; ?>    