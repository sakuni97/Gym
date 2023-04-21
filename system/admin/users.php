<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Users</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>admin/add_users.php" class="btn btn-sm btn-outline-secondary">New Users</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Users</button>
            </div>
<!--            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Users
            </button>-->
        </div>
    </div>
    <h5><span class="badge bg-primary">

            <?php
            $sql = "SELECT count(*) FROM tbl_users ";
            $db = dbConn();
            $result = $db->query($sql);

            // Display data on web page
            while ($row = mysqli_fetch_array($result)) {
                echo $row['count(*)'];
            }
            ?>
        </span> Users</h5>
    <div class="table-responsive">
        <?php
                        $sql="SELECT * FROM tbl_users";
                        $db= dbConn();
                        $result=$db->query($sql);
                        
                        ?>
                        
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($result->num_rows>0) {
                                    $i=1;
                                    while($row=$result->fetch_assoc()){
                                 ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row['Title']." ".$row['FirstName']." ".$row['LastName'] ?></td>
                                    <td><?= $row['Address'] ?></td>
                                    <td><?= $row['Designation'] ?></td>
                                    <td><?= $row['UserRole'] ?></td>
                                </tr>
                                <?php 
                                $i++;
                                    }
                                    } ?>

            </tbody>
        </table>
    </div>
</main>

<?php include '../footer.php'; ?>       