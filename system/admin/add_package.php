<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New Pricing Packages</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>admin/pricing_packages.php" class="btn btn-sm btn-outline-secondary">View Packages</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Packages</button>
            </div>
<!--            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Packages
            </button>-->
        </div>
    </div>
    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $pName = cleanInput($pName);
        $pPrice = cleanInput($pPrice);
        $pMonths = cleanInput($pMonths);
        $pDesc1 = cleanInput($pDesc1);
        $pDesc2 = cleanInput($pDesc2);
        $pDesc3 = cleanInput($pDesc3);

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($pName)) {
            $messages['error_pName'] = "The Name should not be empty..!";
        }

        if (empty($pPrice)) {
            $messages['error_pPrice'] = "The Price should not be empty..!";
        }

        if (empty($pMonths)) {
            $messages['error_pMonths'] = "The Months should not be empty..!";
        }

        if (empty($pDesc1)) {
            $messages['error_pDesc1'] = "The Description 1 should not be empty..!";
        }
        if (empty($pDesc2)) {
            $messages['error_pDesc2'] = "The Description 2 should not be empty..!";
        }
        if (empty($pDesc3)) {
            $messages['error_pDesc3'] = "The Description 3 should not be empty..!";
        }
         if (!empty($pName)) {
//             $caplock=ucwords($pName);
             
            $sql = "SELECT * FROM tbl_pricing WHERE Package_Name='$pName'";
            $db = dbConn();

            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $messages['error_pName'] = "This name is already taken..!";
            }
        }




        if (empty($messages)) {

            $sql = "INSERT INTO tbl_pricing(Package_Name,Price,Months,Desc1,Desc2,Desc3) VALUES ('$pName','$pPrice','$pMonths','$pDesc1','$pDesc2','$pDesc3')";
            $db = dbConn();
            $db->query($sql);

            $pName =  null;
            $pPrice =  null;
            $pMonths =  null;
            $pDesc1 =  null;
            $pDesc2 =  null;
            $pDesc3 =  null;
        }
    }
    ?>

    <!-- <?php echo $_SESSION['project_title']; ?> -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">


        <div class="mb-3">
            <label for="pName" class="form-label">Enter Name of the package</label>
            <input type="text" class="form-control" id="pName" name="pName" value="<?= @$pName; ?>">
            <div class="text-danger"> <?= @$messages['error_pName']; ?></div>
        </div>
        <div class="mb-3">
            <label for="pPrice" class="form-label">Enter Price of the package</label>
            <input type="text" class="form-control" id="pPrice" name="pPrice" value="<?= @$pPrice; ?>">
            <div class="text-danger"> <?= @$messages['error_pPrice']; ?></div>
        </div>

        <div class="mb-3">
            <label for="pMonths" class="form-label">Enter the Months of the package</label>
            <input type="text" class="form-control" id="pMonths" name="pMonths" value="<?= @$pMonths ?>">
            <div class="text-danger"><?= @$messages['error_pMonths']; ?></div>
        </div>

        <div class="mb-3">
            <label for="pDesc1" class="form-label">Enter the Description</label>
            <input type="text" class="form-control" id="pDesc1" name="pDesc1" value="<?= @$pDesc1; ?>">
            <div class="text-danger"><?= @$messages['error_pDesc1']; ?></div>
        </div>

        <div class="mb-3">
            <label for="pDesc2" class="form-label">Enter the Second Description</label>
            <input type="text" class="form-control" id="pDesc2" name="pDesc2" value="<?= @$pDesc2; ?>">
            <div class="text-danger"><?= @$messages['error_pDesc2']; ?></div>
        </div>

        <div class="mb-3">
            <label for="pDesc3" class="form-label">Enter the Third Description</label>
            <input type="text" class="form-control" id="pDesc3" name="pDesc3" value="<?= @$pDesc3; ?>">
            <div class="text-danger"><?= @$messages['error_pDesc3']; ?></div>
        </div>







        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>
<?php include '../footer.php'; ?>            