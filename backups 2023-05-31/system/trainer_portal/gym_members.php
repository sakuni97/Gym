<?php $gym_members = "active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Assigned Trainees To Me</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
<!--                <a href="<?= SYSTEM_PATH ?>admin/add_services.php" class="btn btn-sm btn-outline-secondary">Add Services</a>-->
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Members</button>
            </div>

        </div>
    </div>

    <h5><span class="badge bg-primary">

            <?php
            $useridsession = $_SESSION['UserId'];

            $sql = "SELECT count(*) FROM tbl_members WHERE UserId='$useridsession'";
            $db = dbConn();
            $result = $db->query($sql);

            // Display data on web page
            while ($row = mysqli_fetch_array($result)) {
                echo $row['count(*)'];
            }
            ?>
        </span> Members</h5>
    <div class="table-responsive">
        <?php
        $sql = "SELECT * FROM tbl_members WHERE UserId='$useridsession'";
        $db = dbConn();
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
                    <th scope="col">NIC</th>
                    <th scope="col">Active Status</th>

                    <th scope="col">Membership</th>
                    <th scope="col">Details</th> 
                    <th scope="col">Health</th> 


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



                            <td ><?php
                                if ($row['Approval_Status'] == 1) {
                                    echo '<p class="text-success">Approved</p>';
                                } else {
                                    echo'<p class="text-danger">Pending</p>';
                                    $disablebuttom= 'disabled';
                                }
                                ?></td>


                            <td>       
                                <form method="post" action="member_profile.php?MemberId=<?= $row['MemberId'] ?>">

                                    <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >

                                    <button type="submit" name="action" value="edit" <?= @$disablebuttom ?>>View</button>

                                </form>
                            </td>

                            <td>       
                                <form method="post" action="progress.php?MemberId=<?= $row['MemberId'] ?>">

                                    <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >

                                    <button type="submit" name="action" value="track" <?=@$disablebuttom ?>>Track</button>

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


    <!-- Other trainees -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">All Trainees</h1>
    </div>


    <h5><span class="badge bg-primary">

            <?php
            $sql = "SELECT count(*) FROM tbl_members WHERE Status='1' AND Approval_Status='1' ";
            $db = dbConn();
            $result = $db->query($sql);

            // Display data on web page
            while ($row = mysqli_fetch_array($result)) {
                echo $row['count(*)'];
            }
            ?>
        </span> Members</h5>
    <div class="table-responsive">
        <?php
        $sql = "SELECT * FROM tbl_members WHERE Status='1' AND Approval_Status='1'";
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
                    <th scope="col">Membership</th>
                    <th scope="col">Trainer</th>
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
                    <th scope="col">Health</th>                    


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



                            <td ><?php
                                if ($row['Approval_Status'] == 1) {
                                    echo '<p class="text-success">Approved</p>';
                                } else {
                                    echo'<p class="text-danger">Pending</p>';
                                }
                                ?>
                            </td>

                            <td>
                                <?php
                                if ($row["UserId"] == 0) {
                                    echo 'Not Yet assigned';
                                } else {
                                    $trainer = $row["UserId"];
                                    $sqlw = "SELECT * FROM tbl_users WHERE  UserId=$trainer";
                                    $db = dbConn();
                                    $resultD = $db->query($sqlw);
                                    $rowUPDATE = $resultD->fetch_assoc();
                                   echo $rowUPDATE['FirstName'];
                                }
                                ?>   </td>


                            <td>       
                                <form method="post" action="member_profile.php?MemberId=<?= $row['MemberId'] ?>">

                                    <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >

                                    <button type="submit" name="action" value="edit">View</button>

                                </form>
                            </td>
                            <td>       
                                <form method="post" action="progress.php?MemberId=<?= $row['MemberId'] ?>">

                                    <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >

                                    <button type="submit" name="action" value="track">Track</button>

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