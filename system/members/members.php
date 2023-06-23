<?php $members = "active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Members</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>members/add_members.php" class="btn btn-sm btn-outline-secondary">New Members</a>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" class="btn-group">
                    <input type="text" name="search" class="form-control" placeholder="Search By Name/NIC">
                    <button type="submit" class="btn btn-sm btn-outline-secondary">Search</button>
                </form>
            </div>

        </div>
    </div>
    <h5><span class="badge bg-primary">

            <?php
            $sql = "SELECT count(*) FROM tbl_members ";
            $db = dbConn();
            $result = $db->query($sql);

            // Display data on web page
            while ($row = mysqli_fetch_array($result)) {
                echo $row['count(*)'];
            }
            ?>
        </span> Total Members</h5>
    <div class="table-responsive">

        <?php
        $sql = "SELECT * FROM tbl_members";
        $db = dbConn();

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $sql = "SELECT * FROM tbl_members WHERE First_Name LIKE '%$search%' OR Nic LIKE '%$search%'";
        } else {
            $sql = "SELECT * FROM tbl_members ORDER BY Joined_Date DESC";
        }
        $result = $db->query($sql);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">NIC</th>
                    <th scope="col">Active Status</th>
                    <th scope="col">Update Status</th>
                    <th scope="col">Membership</th>                   
                    <th scope="col">General Details</th>
                    <th scope="col">Gym Dates</th> 
                    <th scope="col">Payments</th> 


                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['MemberId'];
                        $status = $row['Status'];
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['First_Name'] ?> </td>
                            <td><?= $row['Last_Name'] ?></td>
                            <td><?= $row['Nic'] ?></td>


                            <td>

                                <span style=" width: 100px;" class="badge <?php echo $row['Status'] ? 'bg-success' : 'bg-danger' ?>"><?php echo $row['Status'] == 1 ? 'Activated' : 'Deactivated' ?></span>

                            </td>

                            <td><a style=" width: 100px;" class="btn btn-secondary btn-sm" href="<?php echo $row['Status'] == 1 ? 'member_status.php?MemberId=' . $row['MemberId'] . '&Status=0' : 'member_status.php?MemberId=' . $row['MemberId'] . '&Status=1'; ?>"><?php echo $row['Status'] == 1 ? 'Deactivate' : 'Activate' ?></a></td>

                            <td ><?php
                                if ($row['Approval_Status'] == 1) {
                                    echo '<p class="text-success">Approved</p>';
                                } else {
                                    echo'<p class="text-danger">Pending</p>';
                                }
                                ?></td>


                            <td>       
                                <form method="post" action="member_profile.php?MemberId=<?= $row['MemberId'] ?>">

                                    <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >

                                    <button type="submit" name="action" value="edit">View</button>

                                </form>
                            </td>

                            <td>       
                                <form method="post" action="gym_dates.php?MemberId=<?= $row['MemberId'] ?>">

                                    <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >

                                    <button type="submit" name="action" value="edit">View</button>

                                </form>
                            </td>

                            <td>       
                                <form method="post" action="member_payments.php?MemberId=<?= $row['MemberId'] ?>">

                                    <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >

                                    <button type="submit" name="action" value="edit">Verify</button>

                                </form>
                            </td>

                        </tr>
                        <?php
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='5'>No member found.</td></tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

</main>


<?php include '../footer.php'; ?>       