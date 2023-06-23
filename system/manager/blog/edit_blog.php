<?php ob_start(); ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Edit Blog Post</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>manager/blog/view_blog.php" class="btn btn-sm btn-outline-secondary">View Blog Posts</a>
                
            </div>
            <!--            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar" class="align-text-bottom"></span>
                            Update Packages
                        </button>-->
        </div>
    </div>
    <?php
    extract($_POST);
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'edit') {
        $db = dbConn();
        $sql = "SELECT * FROM tbl_blog WHERE Id='$Id'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $sTitle = $row['Title'];
        $sDesc = $row['Description'];
        $image = $row['Image'];
    }
    //seperate variables and values from the form

    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'update') {
        //data clean
        $sTitle = cleanInput($sTitle);
        $sDesc = cleanInput($sDesc);

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($sTitle)) {
            $messages['error_sTitle'] = "The Title should not be empty..!";
        }

        if (empty($sDesc)) {
            $messages['error_sDesc'] = "The Description  should not be empty..!";
        }

        if (empty($messages) && !empty($_FILES['image']['name'])) {
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
        } else {
            $file_name_new = $prv_image;
        }




        if (empty($messages)) {

            $sql = "UPDATE tbl_service SET Image='$file_name_new',Title='$sTitle',Description='$sDesc' WHERE Id='$Id'";
            $db = dbConn();
            $db->query($sql);
            header("Location: view_blog.php?success=true");
        }
    }
    ?>

    

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">


        <div class="mb-3">
            <label for="sTitle" class="form-label">Enter Name of the package</label>
            <input type="text" class="form-control" id="sTitle" name="sTitle" value="<?= @$sTitle; ?>">
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
            <input type="hidden" name="prv_image" value="<?= @$image ?>">
        </div>
        <div class="col-md-4">
            <img  style="width: 100px; height: 50px;" class="img-fluid"  src="../../assets/images/blog/<?= @$image ?>">
        </div>

        <input type="hidden" name="ServiceId" value="<?= $Id ?>">


        <button type="submit" name="action" value="update" class="btn btn-primary">Update</button>
    </form>

</main>
<?php include '../../footer.php'; ?>   
<?php ob_end_flush(); ?>