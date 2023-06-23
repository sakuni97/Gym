<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New Services</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>admin/services.php" class="btn btn-sm btn-outline-secondary">View Services</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Services</button>
            </div>
            <!--            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar" class="align-text-bottom"></span>
                            Update Services
                        </button>-->
        </div>
    </div>
    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $sName = cleanInput($sName);
        $sDesc = cleanInput($sDesc);

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($sName)) {
            $messages['error_sName'] = "The Name should not be empty..!";
        }

        if (empty($sDesc)) {
            $messages['error_sDesc'] = "The Description  should not be empty..!";
        }
        if ($_FILES['image']['name'] == "") {
            $messages['error_cimage'] = "The Images should not be empty..!";
        }
        //advanced validations
        if (empty($messages)) {
            $image = $_FILES['image'];
            $filename = $image['name'];
            $filetmpname = $image['tmp_name'];
            $filesize = $image['size'];
            $fileerror = $image['error'];

            $file_ext = explode(".", $filename);
            $file_ext = strtolower(end($file_ext));

            $allowed = array("jpg", "jpeg", "png", "gif");

            if (in_array($file_ext, $allowed)) {
                if ($fileerror === 0) {
                    if ($filesize <= 2097152) {
                        $file_name_new = uniqid("", true) . "." . $file_ext;
                        $file_path = "../../web/assets/img/" . $file_name_new;
                        if (move_uploaded_file($filetmpname, $file_path)) {
                            echo "The file was uploaded successfully";
                        } else {
                            $messages['file_error'] = "File not uploaded";
                        }
                    } else {
                        $messages['file_error'] = "File size is invalid";
                    }
                } else {
                    $messages['file_error'] = "File has an error";
                }
            } else {
                $messages['file_error'] = "Invalid file type";
            }
        }




        if (empty($messages)) {

            $sql = "INSERT INTO tbl_service(Name,Description,Image) VALUES ('$sName','$sDesc','$file_name_new')";
            $db = dbConn();
            $db->query($sql);

            $sName = null;
            $sDesc = null;
//            $image =  null;
        }
    }
    ?>

    <!-- <?php echo $_SESSION['project_title']; ?> -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">


        <div class="mb-3">
            <label for="sName" class="form-label">Enter Name of the package</label>
            <input type="text" class="form-control" id="sName" name="sName" value="<?= @$sName; ?>">
            <div class="text-danger"> <?= @$messages['error_sName']; ?></div>
        </div>


        <div class="mb-3">
            <label for="sDesc" class="form-label">Enter the Description</label>
            <input type="text" class="form-control" id="sDesc" name="sDesc" value="<?= @$sDesc; ?>">
            <div class="text-danger"><?= @$messages['error_sDesc']; ?></div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Select Image</label>
            <input class="form-control" type="file" id="image" name="image">
            <div class="text-danger"> <?= @$messages['file_error']; ?></div>
            <div class="text-danger"> <?= @$messages['error_cimage']; ?></div>
            
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>
<?php include '../footer.php'; ?>            