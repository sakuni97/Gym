<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New Workout Plans</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>trainer_portal/workout_plans.php" class="btn btn-sm btn-outline-secondary">View Workout Plans</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Plans</button>
            </div>
        </div>
    </div>
    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);

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
            $sql = "INSERT INTO tbl_workouts(Workout_Name,Workout_Flow,Created_User) VALUES ('$tWorkout_Name','$tWorkout_Flow','$insetingtrainerid')";
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
            
            <textarea type="text" class="form-control" id="tWorkout_Flow" name="tWorkout_Flow" rows="10" value="<?= @$tWorkout_Flow; ?>"></textarea>
            <div class="text-danger"> <?= @$messages['error_tWorkout_Flow']; ?></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>
<?php include '../footer.php'; ?>            