<?php $payments = "active" ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Payments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>admin/payments/add_payments.php" class="btn btn-sm btn-outline-secondary">Add Payments</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Payment</button>
            </div>

        </div>
    </div>
    <?php
    if ((isset($_GET['success'])) && $_GET['success'] == true) {

        $message = "Payments updated successfully";
        echo"<script>window.alert('$message');</script>";
    }
    ?>
<!--    <h5><span class="badge bg-primary">

            //<?php
//            $sql = "SELECT count(*) FROM tbl_payments ";
//            $db = dbConn();
//            $result = $db->query($sql);
//
//            // Display data on web page
//            while ($row = mysqli_fetch_array($result)) {
//                echo $row['count(*)'];
//            }
//            
    ?>
        </span> Payments</h5>-->

    <div class="table-responsive">
        <?php
//        $sql = "SELECT * FROM tbl_payments";
//        $db = dbConn();
//        $result = $db->query($sql);
//        ?>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Package</th>
                    <th scope="col">Month</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
//                if ($result->num_rows > 0) {
//                    $i = 1;
//                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="PaymentId" value="" >
                                    <button type="submit" name="action" value="edit">View</button>

                                </form>
                            </td>

                        </tr>
                        <?php
//                        $i++;
//                    }
//                }
                ?>

            </tbody>
        </table>
    </div>
</main>

<?php include '../../footer.php'; ?>       