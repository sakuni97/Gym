<?php ob_start(); ?>
<?php $workouts = "active" ?>
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
        <h1 class="h3">My Workout Plan</h1>
    </div>



    <!-- Card with an image on left -->
    <div class="card mb-12">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= SYSTEM_PATH ?>assets/img/wo.jpg"  class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">

                    <?php
                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_members WHERE MemberId= '$memberidsession' AND Approval_Status='1'";
                    $result = $db->query($sql);
                    ?>

                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                                <?php
                                
                                    $workouts = $row["WorkoutId"];
                                    $sqlE = "SELECT * FROM tbl_workouts WHERE  WorkoutId=$workouts";
                                    $db = dbConn();
                                    $resultE = $db->query($sqlE);
                                    $rowUPDATES = $resultE->fetch_assoc();
                                    
                                
                                ?>  

                            <h5 class="card-title"><?php echo @$rowUPDATES['Workout_Name']; ?> </h5>

                            <textarea type="text" class="form-control" id="tWorkout_Flow" name="tWorkout_Flow" rows="13" style="background-color:#264972 ;color:#fff;"  readonly>
<?php
                                if ($row["WorkoutId"] == 0) {
                                    echo 'Not Yet assigned';
                                } else {
                                    $workout = $row["WorkoutId"];
                                    $sqlw = "SELECT * FROM tbl_workouts WHERE  WorkoutId=$workout";
                                    $db = dbConn();
                                    $resultD = $db->query($sqlw);
                                    $rowUPDATE = $resultD->fetch_assoc();
                                    echo $rowUPDATE['Workout_Flow'];
                                }
                                ?>  
                            
                            </textarea>

                        </div>

                    <?php }
                }
                ?>
            </div>
        </div>
    </div>
</div><!-- End Card with an image on left -->
</main>

<?php ?>

<?php ob_end_flush(); ?>