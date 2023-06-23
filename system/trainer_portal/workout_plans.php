<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Workout Plans</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>trainer_portal/add_workouts.php" class="btn btn-sm btn-outline-secondary">Add Workout Plans</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Plans</button>
            </div>

        </div>
    </div>

    <h5><span class="badge bg-primary">

            <?php
            $sql = "SELECT count(*) FROM tbl_workouts";
            $db = dbConn();
            $result = $db->query($sql);

            // Display data on web page
            while ($row = mysqli_fetch_array($result)) {
                echo $row['count(*)'];
            }
            ?>
        </span> Workout Plans</h5>
    <div class="table-responsive">
        <?php
        $sql = "SELECT * FROM tbl_workouts INNER JOIN tbl_users ON tbl_workouts.Created_User = tbl_users.UserId";
        $db = dbConn();
        $result = $db->query($sql);
//        if($result){
//            while($row= mysqli_fetch_assoc($result))
//        }
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Workout Name</th>
                    <th scope="col">Workout Flow</th>
                    <th scope="col">Created User</th>
                    <th scope="col">Updated User</th>
                    <th scope="col">Details</th>                    


                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $row['Workout_Name'] ?> </td>
                            <td><?= $row['Workout_Flow'] ?> </td>
                            <td><?= $row["FirstName"] ?></td> 

                            <td><?php
                                if ($row["Wupdate_User"] == 0) {
                                    echo "Not Yet updated";
                                } else {
                                    $wupdateduser = $row["Wupdate_User"];
                                    $sqlw = "SELECT * FROM tbl_users WHERE  UserId=$wupdateduser";
                                    $db = dbConn();
                                    $resultD = $db->query($sqlw);
                                    $rowUPDATE = $resultD->fetch_assoc();
                                }
                                ?>   <?= @$rowUPDATE['FirstName'] ?></td>
                            
                            
                            <td>
                                <form method="post" action="edit_workouts.php">
                                    <input type="hidden" name="WorkoutId" value="<?= $row['WorkoutId'] ?>" >
                                    <button type="submit" name="action" value="edit">View</button>

                                </form>
                            </td>
                            
                        </tr>
                        <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>


</main>


<?php include '../footer.php'; ?>    