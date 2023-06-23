<?php $dashboard="active" ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">

 Welcome <?php echo $_SESSION['UserRole'] == "admin" ? 'Front Desk Officer' . ' ' . $_SESSION['FirstName'] . '!' : ''; ?>


        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>admin/add_users.php" class="btn btn-sm btn-outline-secondary">Add New Users</a>
                <a href="<?= SYSTEM_PATH ?>members/add_members.php" class="btn btn-sm btn-outline-secondary">Add New Gym Members</a>

            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <a href="<?= SYSTEM_PATH ?>members/members.php"> Total Gym Members</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $sql = "SELECT count(*) FROM tbl_members ";
                                $db = dbConn();
                                $result = $db->query($sql);

                                // Display data on web page
                                while ($row = mysqli_fetch_array($result)) {
                                    echo $row['count(*)'] . " " . "Members";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <a href="<?= SYSTEM_PATH ?>members/pending_membership.php"> Pending Member Requests</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $sql = "SELECT count(*) FROM tbl_members WHERE Approval_Status = 0";
                                $db = dbConn();
                                $result = $db->query($sql);

                                // Display data on web page
                                while ($row = mysqli_fetch_array($result)) {
                                    echo $row['count(*)'] . " " . "Requests";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                             style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Due Payments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1 Payment</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <h2>Current Users</h2>
    <div class="table-responsive">
        <?php
        $sql = "SELECT * FROM tbl_users";
        $db = dbConn();
        $result = $db->query($sql);
        ?>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['Title'] . " " . $row['FirstName'] . " " . $row['LastName'] ?></td>
                            <td><?= $row['Address'] ?></td>
                            <td><?= $row['Designation'] ?></td>
                            <td>
                            <?php echo $row['UserRole'] == "admin" ? 'Front Desk Officer' :  $row['UserRole'] ?>
                            </td>

        <!--                            <td ><?php
//                                if($row['Status']== 1){echo '<p><a href="users/dashboard/user_status.php?UserId='.$row['UserId'].'&Status=0" class="text-success">Active</a></p>';}
//                                else{
//                                    echo'<p><a href="users/dashboard/user_status.php?UserId='.$row['UserId'].'&Status=1" class="text-danger">Deactive</a></p>';
//                                }
                            ?></td>-->
                            <td>
                                <span style=" width: 100px;" class="badge <?php echo $row['Status'] ? 'bg-success' : 'bg-danger' ?>"><?php echo $row['Status'] == 1 ? 'Activated' : 'Deactivated' ?></span>
                            </td>

                            <td>
                                <a style=" width: 100px;" class="btn btn-secondary btn-sm" href="<?php echo $row['Status'] == 1 ? 'users/dashboard/user_status.php?UserId=' . $row['UserId'] . '&Status=0' : 'users/dashboard/user_status.php?UserId=' . $row['UserId'] . '&Status=1'; ?>"><?php echo $row['Status'] == 1 ? 'Deactivate' : 'Activate' ?></a>
                            </td>

                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
</main>