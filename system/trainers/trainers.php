<?php $trainers = "active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Trainers</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>/admin/add_users.php" class="btn btn-sm btn-outline-secondary">New Trainers</a>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" class="btn-group">
                    <input type="text" name="search" class="form-control" placeholder="Search By Name">
                    <button type="submit" class="btn btn-sm btn-outline-secondary">Search</button>
                </form>
            </div>
            
        </div>
    </div>
    <?php
    if ((isset($_GET['success'])) && $_GET['success'] == true) {

        $message = "Trainers updated successfully";
        echo"<script>window.alert('$message');</script>";
    }
    ?>
    <h5><span class="badge bg-primary">

            <?php
            $sql = "SELECT count(*) FROM tbl_users WHERE UserRole ='trainer'";
            $db = dbConn();
            $result = $db->query($sql);

            // Display data on web page
            while ($row = mysqli_fetch_array($result)) {
                echo $row['count(*)'];
            }
            ?>
        </span> Trainers</h5>
    <div class="table-responsive">
        <?php
        $sql = "SELECT * FROM tbl_users WHERE UserRole ='trainer'";
        $db = dbConn();
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $sql = "SELECT * FROM tbl_users WHERE UserRole ='trainer' AND FirstName LIKE '%$search%' OR LastName LIKE '%$search%'";
        } else {
            $sql = "SELECT * FROM tbl_users WHERE UserRole ='trainer'";
        }
        $result = $db->query($sql);
//        if($result){
//            while($row= mysqli_fetch_assoc($result))
//        }
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Active Status</th>
                    <th scope="col">Update Status</th>
                    <th scope="col">Details</th>
                    <th scope="col">Assigned Members</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $UserId = $row['UserId'];
                        ?>
                        <tr>
                            <td><?= $row['Title'] ?> </td>
                            <td><?= $row['FirstName'] ?> </td>
                            <td><?= $row['LastName'] ?></td>
                            <td><?= $row['Address'] ?></td>



                            <td>
                                <span style=" width: 100px;" class="badge <?php echo $row['Status'] ? 'bg-success' : 'bg-danger' ?>"><?php echo $row['Status'] == 1 ? 'Activated' : 'Deactivated' ?></span>
                            </td>

                            <td>
                                <a style=" width: 100px;" class="btn btn-secondary btn-sm" href="<?php echo $row['Status'] == 1 ? 'trainer_status.php?UserId=' . $row['UserId'] . '&Status=0' : 'trainer_status.php?UserId=' . $row['UserId'] . '&Status=1'; ?>"><?php echo $row['Status'] == 1 ? 'Deactivate' : 'Activate' ?></a>
                            </td>

                            <td>       
                                <form method="post" action="trainer_profile.php?UserId=<?= $row['UserId'] ?>">
                                    <input type="hidden" name="UserId" value="<?= $row['UserId'] ?>" >
                                    <button type="submit" name="action" value="edit">View</button>

                                </form>
                            </td>

                            <td>
                                <?php
                                $db = dbConn();
                               $sql = "SELECT count(*) FROM tbl_members WHERE UserId='$UserId' AND Status=1 AND Approval_Status=1";

                                $results = $db->query($sql);
                                while ($row = mysqli_fetch_array($results)) {
                                    echo $row['count(*)'];
                                }
                                ?>
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
