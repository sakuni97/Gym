<?php $services="active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Services</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>admin/add_services.php" class="btn btn-sm btn-outline-secondary">Add Services</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Service</button>
            </div>
            <!--            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar" class="align-text-bottom"></span>
                            Update Service
                        </button>-->
        </div>
    </div>
    <?php
    if ((isset($_GET['success'])) && $_GET['success'] == true) {

        $message = "Services updated successfully";
        echo"<script>window.alert('$message');</script>";
    }
    ?>
    <h5><span class="badge bg-primary">

            <?php
            $sql = "SELECT count(*) FROM tbl_service ";
            $db = dbConn();
            $result = $db->query($sql);

            // Display data on web page
            while ($row = mysqli_fetch_array($result)) {
                echo $row['count(*)'];
            }
            ?>
        </span> Services</h5>
    <div class="table-responsive">
        <?php
        $sql = "SELECT * FROM tbl_service";
        $db = dbConn();
        $result = $db->query($sql);
        ?>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Active Status</th>
                    <th scope="col">Update Status</th>
                    <th scope="col">Details</th>
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

                            <td><?= $row['Name'] ?></td>
                            <td><?= $row['Description'] ?></td>
                            <td><img class="img-fluid" width="75" src="../../web/assets/img/<?= $row['Image'] ?>"></td>

                            <td>
                                <span style=" width: 100px;" class="badge <?php echo $row['Status'] ? 'bg-success' : 'bg-danger' ?>"><?php echo $row['Status'] == 1 ? 'Activated' : 'Deactivated' ?></span>
                            </td>

                            <td>
                                <a style=" width: 100px;" class="btn btn-secondary btn-sm" href="<?php echo $row['Status'] == 1 ? 'service_status.php?ServiceId=' . $row['ServiceId'] . '&Status=0' : 'service_status.php?ServiceId=' . $row['ServiceId'] . '&Status=1'; ?>"><?php echo $row['Status'] == 1 ? 'Deactivate' : 'Activate' ?></a>
                            </td>
                            <td>
                                <form method="post" action="edit_services.php">
                                    <input type="hidden" name="ServiceId" value="<?= $row['ServiceId'] ?>" >
                                    <button type="submit" name="action" value="edit">View</button>

                                </form>
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

<?php include '../footer.php'; ?>       