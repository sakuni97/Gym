<?php $trainers="active" ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">BLog Posts</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>/manager/blog/add_blog.php" class="btn btn-sm btn-outline-secondary">New Blog Post</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Post</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update BLog Post
            </button>
        </div>
    </div>

        <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $Title = cleanInput($Title);  
        $status = cleanInput($status);  
        $tags = cleanInput($tags);  
        $sDesc = cleanInput($sDesc);  
        
        
       

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($Title)) {
            $messages['error_Title'] = "The Name should not be empty..!";
        }

        if (empty($status)) {
            $messages['error_status'] = "The Description  should not be empty..!";
        }
         if (empty($tags)) {
            $messages['error_tags'] = "The Description  should not be empty..!";
        }
         if (empty($sDesc)) {
            $messages['error_sDesc'] = "The Description  should not be empty..!";
        }
        
        
        
    if ($_FILES['image']['name'] == "") {
        $messages['error_image'] = "The Images should not be empty..!";
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
                        $file_path = "../../assets/images/blog/" . $file_name_new;
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

          
            $db = dbConn();
            $blogcreateduser= $_SESSION['UserId'];
           echo $sql="INSERT INTO tbl_blog(Author, Title, Description, Image, Status, Tags) VALUES ('$blogcreateduser','$Title','$sDesc','$file_name_new','$status','$tags')";
            
            $db->query($sql);

           
          
            
        }
    }
    ?>

    <!-- <?php echo $_SESSION['project_title']; ?> -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">


        <div class="mb-3">
            <label for="sName" class="form-label">Title of the Blog</label>
            <input type="text" class="form-control" id="sName" name="Title" value="<?= @$Title; ?>">
            <div class="text-danger"> <?= @$messages['error_Title']; ?></div>
        </div>
        
         <div class="mb-3">
            <label for="sName" class="form-label">Status</label>
             <select id="mYear" name="status" class="form-control">
                <option value="">-Select-</option>
                <option value="1" <?php if(@$status == 1){echo "selected"; } ?> >Published</option>
                <option value="2" <?php if(@$status == 2){echo "selected"; } ?> >Drafted</option>
             </select>
            <div class="text-danger"> <?= @$messages['error_status']; ?></div>
        </div>
        
         <div class="mb-3">
            <label for="sName" class="form-label">Tags</label>
            <input type="text" class="form-control" id="sName" name="tags" value="<?= @$tags; ?>">
            <div class="text-danger"> <?= @$messages['error_tags']; ?></div>
        </div>

        <div class="mb-3">
            <label for="sDesc" class="form-label">Enter the Description</label>
            <textarea class="form-control" id="sDesc" name="sDesc" ><?= @$sDesc; ?></textarea>
            <div class="text-danger"><?= @$messages['error_sDesc']; ?></div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Select Image</label>
            <input class="form-control" type="file" id="image" name="image">
            <div class="text-danger"> <?= @$messages['file_error']; ?></div>
            <div class="text-danger"> <?= @$messages['error_image']; ?></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
   
</main>

<?php include '../../footer.php'; ?>   
