<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New Users</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>admin/users.php" class="btn btn-sm btn-outline-secondary">View Users</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Users</button>
            </div>
<!--            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Users
            </button>-->
        </div>
    </div>
    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $uTitle = cleanInput($uTitle);
        $fName = cleanInput($fName);
        $lName = cleanInput($lName);
        $uAddress = cleanInput($uAddress);
        $uDesignation = cleanInput($uDesignation);
        $uEmail = cleanInput($uEmail);
        $uUserName = cleanInput($uUserName);
        $uPassWord = cleanInput($uPassWord);
        $uUserRole = cleanInput($uUserRole);

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($uTitle)) {
            $messages['error_uTitle'] = "The Title should not be empty..!";
        }

        if (empty($fName)) {
            $messages['error_fName'] = "The first name should not be empty..!";
        }

        if (empty($lName)) {
            $messages['error_lName'] = "The last name should not be empty..!";
        }

        if (empty($uAddress)) {
            $messages['error_uAddress'] = "The Address should not be empty..!";
        }
        if (empty($uDesignation)) {
            $messages['error_uDesignation'] = "The User Designation should not be empty..!";
        }
        if (empty($uEmail)) {
            $messages['error_uEmail'] = "The User Email should not be empty..!";
        }
        if (empty($uUserName)) {
            $messages['error_uUserName'] = "The User Name should not be empty..!";
        }
        if (empty($uPassWord)) {
            $messages['error_uPassWord'] = "The Password should not be empty..!";
        }
        if (empty($uUserRole)) {
            $messages['error_uUserRole'] = "The User Role should not be empty..!";
        }
        //adavanced validations
        if (!empty($uPassWord)) {
            if ($uPassWord < 5) {
                $messages['error_uPassWord'] = "The Password should be less than 5 characters!";
            }
        }

        if (!empty($uUserName)) {
            $sql = "SELECT * FROM tbl_users WHERE UserName='$uUserName'";
            $db = dbConn();
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $messages['error_uUserName'] = "This username is already taken..!";
            }
        }
        if (!empty($uEmail)) {
            if (!filter_var($uEmail, FILTER_VALIDATE_EMAIL)) {
                $messages['error_uEmail'] = "The email is not well formatted..!";
            }
        }

        if (empty($messages)) {
            $userimage = $_FILES['uImage'];
            $filename = $userimage['name'];
            $filetmpname = $userimage['tmp_name'];
            $filesize = $userimage['size'];
            $fileerror = $userimage['error'];

            $file_ext = explode(".", $filename);
            $file_ext = strtolower(end($file_ext));

            $allowed = array("jpg", "jpeg", "png", "gif");

            if (in_array($file_ext, $allowed)) {
                if ($fileerror === 0) {
                    if ($filesize <= 2097152) {
                        $file_name_new = uniqid("", true) . "." . $file_ext;
                        $file_path = "../../web/assets/img/team/" . $file_name_new;
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

            $uPassWord = sha1($uPassWord);
            $sql = "INSERT INTO tbl_users(Title,FirstName,LastName,Address,Designation,Email,UserName,Password,UserRole,Image) VALUES ('$uTitle','$fName','$lName','$uAddress','$uDesignation','$uEmail','$uUserName','$uPassWord','$uUserRole','$file_name_new')";
            $db = dbConn();
            $db->query($sql);

            $uTitle = null;
            $fName = null;
            $lName = null;
            $uAddress = null;
            $uDesignation = null;
            $uEmail = null;
            $uUserName = null;
            $uPassWord = null;
            $uUserRole = null;
        }
    }
    ?>



    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="title" class="form-label">Enter the Title</label>
<!--            <input type="text" class="form-control" id="title" name="uTitle" value="<?= @$uTitle; ?>">-->
            <select id="title" name="uTitle" class="form-control">
                <option value="">-Select-</option>
                <option value="Mr" <?php
                if (@$uTitle == "Mr") {
                    echo "selected";
                }
                ?> >Mr.</option>
                <option value="Mrs" <?php
                if (@$uTitle == "Mrs") {
                    echo "selected";
                }
                ?> >Mrs.</option>
                <option value="Miss" <?php
                if (@$uTitle == "Miss") {
                    echo "selected";
                }
                ?> >Miss.</option>
                <option value="others" <?php
                if (@$uTitle == "others") {
                    echo "selected";
                }
                ?> >Other</option>
            </select>
            <div class="text-danger"> <?= @$messages['error_uTitle']; ?></div>
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">Enter First Name</label>
            <input type="text" class="form-control" id="first_name" name="fName" value="<?= @$fName; ?>">
            <div class="text-danger"> <?= @$messages['error_fName']; ?></div>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Enter Last Name</label>
            <input type="text" class="form-control" id="last_name" name="lName" value="<?= @$lName; ?>">
            <div class="text-danger"> <?= @$messages['error_lName']; ?></div>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Enter the Address</label>
            <input type="text" class="form-control" id="address" name="uAddress" value="<?= @$uAddress; ?>">
            <div class="text-danger"><?= @$messages['error_uAddress']; ?></div>
        </div>

        <div class="mb-3">
            <label for="designation" class="form-label">Enter the Designation</label>
            <input type="text" class="form-control" id="designation" name="uDesignation" value="<?= @$uDesignation; ?>">
            <div class="text-danger"><?= @$messages['error_uDesignation']; ?></div>
        </div>

        <div class="mb-3">
            <label for="designation" class="form-label">Enter the Email</label>
            <input type="text" class="form-control" id="email" name="uEmail" value="<?= @$uEmail; ?>">
            <div class="text-danger"><?= @$messages['error_uEmail']; ?></div>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Enter the User Name</label>
            <input type="text" class="form-control" id="username" name="uUserName" value="<?= @$uUserName; ?>">
            <div class="text-danger"><?= @$messages['error_uUserName']; ?></div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Enter the Password</label>
            <input type="text" class="form-control" id="password" name="uPassWord" value="<?= @$uPassWord; ?>">
            <div class="text-danger"> <?= @$messages['error_uPassWord']; ?></div>
        </div>

        <div class="mb-3">
            <label for="userrole" class="form-label">Enter the User Role</label>
<!--            <input type="text" class="form-control" id="userrole" name="uUserRole" value="<?= @$uUserRole; ?>">-->
            <select id="userrole" name="uUserRole" class="form-control">
                <option value="">-Select-</option>
                <option value="trainer" <?php
                if (@$uUserRole == "trainer") {
                    echo "selected";
                }
                ?> >trainer</option>
                <option value="admin" <?php
                if (@$uUserRole == "admin") {
                    echo "selected";
                }
                ?> >admin</option>
            </select>
            <div class="text-danger"> <?= @$messages['error_uUserRole']; ?></div>
        </div>

        <div class="mb-3">
            <label for="Image" class="form-label">Select User Image</label>
            <input class="form-control" type="file" id="Image" name="uImage">
            <div class="text-danger"> <?= @$messages['file_error']; ?></div>
        </div>




        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>
<?php include '../footer.php'; ?>            