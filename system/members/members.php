<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<style>
    .toggle-switch {
        display: inline-block;
        position: relative;
        width: 45px;
        height: 15px;
        margin: 10px;
    }

    .toggle-switch-input {
        display: none;
    }

    .toggle-switch-label {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 50px;
        height: 25px;
        background-color: #ccc;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .toggle-switch-handle {
        display: block;
        position: absolute;
        top: 2px;
        left: 2px;
        width: 21px;
        height: 21px;
        background-color: white;
        border-radius: 50%;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .toggle-switch-input:checked + .toggle-switch-label {
        background-color: #7fc242;
    }

    .toggle-switch-input:checked + .toggle-switch-label + .toggle-switch-handle {
        transform: translateX(25px);
    }

    .toggle-switch-link {
        position: absolute;
        top: -10px;
        left: 60px;
        font-size: 12px;
        color: #999;
        text-decoration: none;
        transition: color 0.3s;
    }

    .toggle-switch-input:checked + .toggle-switch-label + .toggle-switch-handle + .toggle-switch-link {
        color: #7fc242;
    }

</style>




<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Members</h1>
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
            $sql = "SELECT count(*) FROM tbl_members ";
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
        $sql = "SELECT * FROM tbl_members";
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
                    <th scope="col">Update Status</th>
                    <th scope="col">Membership</th>
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