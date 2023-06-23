<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New Meal Plans</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>trainer_portal/meal_plans.php" class="btn btn-sm btn-outline-secondary">View Meal Plans</a>
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
        $mealplan_Name = cleanInput($mealplan_Name);
        $content = cleanInput($content);

        //create array variable store validation messages
        $messages = array();
        //validate required fields
        if (empty($mealplan_Name)) {
            $messages['error_mealplan_Name'] = "The Name should not be empty..!";
        }
        if (empty($content)) {
            $messages['error_content'] = "The Content should not be empty..!";
        }
        if (empty($messages)) {

            $insetingtrainerid = $_SESSION['UserId'];
            $sql = "INSERT INTO tbl_mealplans(MealPlan_Name,MealPlan,Mcreated_User) VALUES ('$mealplan_Name','$content','$insetingtrainerid')";
            $db = dbConn();
            $db->query($sql);
            $mealplan_Name = null;
            $content = null;
        }
    }
    ?>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">


        <div class="mb-3">
            <label for="mealplan_Name" class="form-label">Enter Name of the plan</label>
            <input type="text" class="form-control" id="mealplan_Name" name="mealplan_Name" value="<?= @$mealplan_Name; ?>">
            <div class="text-danger"> <?= @$messages['error_mealplan_Name']; ?></div>
        </div>
        <div class="mb-3">
            <label for="tWorkout_Flow" class="form-label">Enter the Plan </label>

            <textarea type="text" class="form-control" id="content" name="content" rows="10" value="<?= @$content; ?>"></textarea>
            <div class="text-danger"> <?= @$messages['error_content']; ?></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>
<?php include '../footer.php'; ?>            