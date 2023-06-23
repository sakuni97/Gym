<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Edit Workout Plans</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>trainer_portal/workout_plans.php" class="btn btn-sm btn-outline-secondary">View Workout Plans</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Plans</button>
            </div>
        </div>
    </div>
    <?php
    extract($_POST);
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'edit') {
        $db = dbConn();
        $sql = "SELECT * FROM tbl_workouts WHERE WorkoutId='$WorkoutId'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $tWorkout_Name = $row['Workout_Name'];
        $tWorkout_Flow = $row['Workout_Flow'];
    }
        
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'update') {

        //data clean
        $tWorkout_Name = cleanInput($tWorkout_Name);
        $tWorkout_Flow = cleanInput($tWorkout_Flow);
        

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($tWorkout_Name)) {
            $messages['error_tWorkout_Name'] = "The Name should not be empty..!";
        }

        if (empty($tWorkout_Flow)) {
            $messages['error_tWorkout_Flow'] = "The Flow should not be empty..!";
        }

        

        if (empty($messages)) {
            
            $insetingtrainerid = $_SESSION['UserId'];
            $wDate = date('Y-m-d');
            $sql = "UPDATE tbl_workouts SET Workout_Name='$tWorkout_Name',Workout_Flow='$tWorkout_Flow',Wupdate_User='$insetingtrainerid',Wupdate_Date='$wDate' WHERE WorkoutId='$WorkoutId'";
            
            $db = dbConn();
            $db->query($sql);

            $tWorkout_Name =  null;
            $tWorkout_Flow =  null;
            
        }
    }
    ?>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">


        <div class="mb-3">
            <label for="tWorkout_Name" class="form-label">Enter Name of the plan</label>
            <input type="text" class="form-control" id="tWorkout_Name" name="tWorkout_Name" value="<?= @$tWorkout_Name; ?>">
            <div class="text-danger"> <?= @$messages['error_tWorkout_Name']; ?></div>
        </div>
        <div class="mb-3">
            <label for="tWorkout_Flow" class="form-label">Enter the flow </label>
            
            <textarea type="text" class="form-control" id="tWorkout_Flow" name="tWorkout_Flow" rows="10"><?= @$tWorkout_Flow; ?></textarea>
            <div class="text-danger"> <?= @$messages['error_tWorkout_Flow']; ?></div>
        </div>

        <input type="hidden" name="WorkoutId" value="<?= $WorkoutId ?>">

        <button type="submit" name="action" value="update" class="btn btn-primary">Update</button>
    </form>

</main>
<?php include '../footer.php'; ?>     
<?php ob_end_flush(); ?>       