<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Edit Meal Plans</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>trainer_portal/meal_plans.php" class="btn btn-sm btn-outline-secondary">View Meal Plans</a>

            </div>
        </div>
    </div>
    <?php
    extract($_POST);
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'edit') {
        $db = dbConn();
        $sql = "SELECT * FROM tbl_mealplans WHERE MealPlanId='$MealPlanId'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $mealplan_Name = $row['MealPlan_Name'];
        $content = $row['MealPlan'];
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'update') {

        //data clean
        $mealplan_Name = cleanInput($mealplan_Name);
        $content = cleanInput($content);

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($mealplan_Name)) {
            $messages['error_mealplan_Name'] = "The Name should not be empty..!";
            ?>
     <script>
Swal.fire({
  position: 'top',
  icon: 'error',
  title: 'something went wrong!',
  showConfirmButton: false,
  timer: 1500
})
</script><?php
        }

        if (empty($content)) {
            $messages['error_content'] = "The Flow should not be empty..!";
            ?>
    <script>
Swal.fire({
  position: 'top',
  icon: 'error',
  title: 'something went wrong!',
  showConfirmButton: false,
  timer: 1500
})
</script><?php
        }



        if (empty($messages)) {

            $insetingtrainerid = $_SESSION['UserId'];
            $wDate = date('Y-m-d');
            $sql = "UPDATE tbl_mealplans SET MealPlan_Name='$mealplan_Name',MealPlan='$content',Mupdate_User='$insetingtrainerid',Mupdate_Date='$wDate' WHERE MealPlanId='$MealPlanId'";

            $db = dbConn();
            $db->query($sql);

            $mealplan_Name = null;
            $content = null;
            ?>
               title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script><script>
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script><?php
    }
}
    ?>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">


        <div class="mb-3">
            <label for="mealplan_Name" class="form-label">Edit the Name of the plan</label>
            <input type="text" class="form-control" id="mealplan_Name" name="mealplan_Name" value="<?= @$mealplan_Name; ?>">
            <div class="text-danger"> <?= @$messages['error_mealplan_Name']; ?></div>
        </div>
        <div class="mb-3">
            <label for="tWorkout_Flow" class="form-label">Edit the Plan </label>
            <textarea  class="form-control" id="content" rows="5" name="content"><?= @$content; ?></textarea>

            <div class="text-danger"> <?= @$messages['error_content']; ?></div>
        </div>

        <input type="hidden" name="MealPlanId" value="<?= $MealPlanId ?>">

        <button type="submit" name="action" value="update" class="btn btn-primary">Update</button>
    </form>

</main>
<?php include '../footer.php'; ?>     
<?php ob_end_flush(); ?>       