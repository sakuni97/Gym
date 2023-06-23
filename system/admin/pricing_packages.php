<?php $packages = "active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Pricing Packages</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>admin/add_package.php" class="btn btn-sm btn-outline-secondary">Add Packages</a>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" class="btn-group">
                    <input type="text" name="search" class="form-control" placeholder="Search Packages">
                    <button type="submit" class="btn btn-sm btn-outline-secondary">Search</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    if ((isset($_GET['success'])) && $_GET['success'] == true) {
        $message = "Package updated successfully";
        echo "<script>window.alert('$message');</script>";
    }
    ?>
    <h5><span class="badge bg-primary">
            <?php
            $db = dbConn();

            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $countSql = "SELECT count(*) AS count FROM tbl_pricing WHERE Package_Name LIKE '%$search%'";
            } else {
                $countSql = "SELECT count(*) AS count FROM tbl_pricing";
            }

            $countResult = $db->query($countSql);

            if ($countResult) {
                $countRow = $countResult->fetch_assoc();
                echo $countRow['count'];
            } else {
                echo "0";
            }
            ?>
        </span> Pricing Packages</h5>

    <div class="table-responsive">
        <?php
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $sql = "SELECT * FROM tbl_pricing WHERE Package_Name LIKE '%$search%'";
        } else {
            $sql = "SELECT * FROM tbl_pricing";
        }
        $result = $db->query($sql);
        ?>


        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Months</th>
                    <th scope="col">Description</th>
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

                            <td><?= $row['Package_Name'] ?></td>
                            <td><?= $row['Price'] ?></td>
                            <td><?= $row['Months'] ?></td>
                            <td><?= $row['Desc1'] ?></td>

                                <!--                            <td ><?php
//                                if ($row['Status'] == 1) {
//                                    echo '<p><a href="package_status.php?PricingId=' . $row['PricingId'] . '&Status=0" class="text-success">Active</a></p>';
//                                } else {
//                                    echo'<p><a href="package_status.php?PricingId=' . $row['PricingId'] . '&Status=1" class="text-danger">Deactive</a></p>';
//                                }
//                                
                            ?>
                                </td>-->

                            <td>
                                <span style=" width: 100px;" class="badge <?php echo $row['Status'] ? 'bg-success' : 'bg-danger' ?>"><?php echo $row['Status'] == 1 ? 'Activated' : 'Deactivated' ?></span>
                            </td>

                            <td>
                                <a style=" width: 100px;" class="btn btn-secondary btn-sm" href="<?php echo $row['Status'] == 1 ? 'package_status.php?PricingId=' . $row['PricingId'] . '&Status=0' : 'package_status.php?PricingId=' . $row['PricingId'] . '&Status=1'; ?>"><?php echo $row['Status'] == 1 ? 'Deactivate' : 'Activate' ?></a>
                            </td>

                            <td>
                                <form method="post" action="edit_packages.php">
                                    <input type="hidden" name="PricingId" value="<?= $row['PricingId'] ?>" >
                                    <button type="submit" name="action" value="edit">View</button>

                                </form>

                                <!--                                <a href="edit_packages.php?PricingId=<?//= $row['PricingId'] ?>">View</a>-->
                            </td>

                        </tr>
                        <?php
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='5'>No packages found.</td></tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
</main>

<?php include '../footer.php'; ?>       