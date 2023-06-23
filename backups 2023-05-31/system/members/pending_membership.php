<?php $members="active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Pending Member Requests</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>members/add_members.php" class="btn btn-sm btn-outline-secondary">New Members</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Members</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Members
            </button>
        </div>
    </div>
    <h5><span class="badge bg-primary">

            <?php
            $sql = "SELECT count(*) FROM tbl_members WHERE Approval_Status = 0";
            $db = dbConn();
            $result = $db->query($sql);

            // Display data on web page
            while ($row = mysqli_fetch_array($result)) {
                echo $row['count(*)'];
            }
            ?>
        </span> Requests</h5>
    <div class="table-responsive">
        <?php
       
        $sql = "SELECT * FROM tbl_members WHERE Approval_Status = 0";
        $db = dbConn();
        $result = $db->query($sql);
        
        
        //filter
//        extract($_POST);
//        $where = null;
//        if ($_SERVER['REQUEST_METHOD'] == "POST") {
//            $where = " WHERE Approval_Status='$status'";
//        }
//        echo $sql = "SELECT * FROM tbl_members $where";
//        $db = dbConn();
//        $result = $db->query($sql);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">NIC</th>
                    <th scope="col">Active Status</th>
                    <th scope="col">Update Status</th>
                    <th scope="col">Membership</th>
                    <!-- filter -->
<!--                    <th scope="col">

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                            <select name="status" onchange="form.submit()">
                                <option value="">--</option>
                                <option value="1">Approved</option>
                                <option value="0">Pending</option>
                            </select>
                        </form>
                        Membership
                    </th>-->
                    <th scope="col">Details</th>                    


                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['MemberId'];
                        $status = $row['Status'];
                        ?>
                        <tr>
                            <td><?= $row['Title'] ?> </td>
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