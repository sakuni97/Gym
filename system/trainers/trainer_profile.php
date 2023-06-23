<?php ob_start(); ?>

<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Trainer Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>trainers/trainers.php" class="btn btn-sm btn-outline-secondary">View All Trainers</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Trainers</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Trainers
            </button>
        </div>
    </div>

    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'edit') {

        $db = dbConn();
        $sql = "SELECT * FROM tbl_users WHERE UserRole ='trainer' AND UserId='$UserId'";
        $results = $db->query($sql);
        $row = $results->fetch_assoc();

        $fName = $row['FirstName'];
        $lName = $row['LastName'];
        $uAddress = $row['Address'];
        $uEmail = $row['Email'];
        $uUserName = $row['UserName'];
        // $uPassWord = $row['Password'];
        $image = $row['Image'];
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'update') {

        //seperate variables and values from the form
        //data clean
        $fName = cleanInput($fName);
        $lName = cleanInput($lName);
        $uAddress = cleanInput($uAddress);
        $uEmail = cleanInput($uEmail);
        $uUserName = cleanInput($uUserName);
        //$uPassWord = cleanInput($uPassWord);
        //create array variable store validation messages
        $messages = array();

        //validate required fields

        if (empty($fName)) {
            $messages['error_fName'] = "The first name should not be empty..!";
        }

        if (empty($lName)) {
            $messages['error_lName'] = "The last name should not be empty..!";
        }

        if (empty($uAddress)) {
            $messages['error_uAddress'] = "The Address should not be empty..!";
        }
        if (empty($uEmail)) {
            $messages['error_uEmail'] = "The User Email should not be empty..!";
        }
        if (empty($uUserName)) {
            $messages['error_uUserName'] = "The User Name should not be empty..!";
        }
//        if (empty($uPassWord)) {
//            $messages['error_uPassWord'] = "The Password should not be empty..!";
//        }
        //adavanced validations
//        if (!empty($uPassWord)) {
//            if ($uPassWord < 5) {
//                $messages['error_uPassWord'] = "The Password should be less than 5 characters!";
//            }
//        }

        if (!empty($uUserName)) {
            $sql = "SELECT * FROM tbl_users WHERE UserName='$uUserName' AND UserId <> '$UserId'";
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


        if (empty($messages) && !empty($_FILES['uImage']['name'])) {
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
        } else {
            $file_name_new = $prv_image;
        }

        //print_r($messages);

        if (empty($messages)) {

            $AddUser = $_SESSION['UserId'];

            $AddDate = date('y-m-d');
            $sql = "UPDATE tbl_users SET Image='$file_name_new',FirstName='$fName',LastName='$lName',Address='$uAddress',Email='$uEmail',UserName='$uUserName',UpdateDate='$AddDate',UpdateUser='$AddUser' WHERE UserId='$UserId'";
            // echo $sql = "UPDATE tbl_users SET Address='$uAddress' WHERE UserId='$UserId'";
            // $sql="UPDATE tbl_users SET  Address='$uAddress' WHERE UserId='$UserId' ";
            //print_r($sql);
            $db = dbConn();
            $db->query($sql);
            header("Location: trainers.php?success=true");
            //print_r($db);
        }
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <form class="form-horizontal " method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                            <fieldset class="fieldset">
                                <!--                            <h3 class="fieldset-title">Personal Info</h3>-->
                                <div class="d-flex flex-column align-items-center text-center"  >
                                    <figure class="figure col-md-2 col-sm-3 col-xs-12">
                                        <img class="rounded img-fluid" width="175" src="../../web/assets/img/team/<?= @$image ?>" alt="">
                                    </figure>
                                    <!--                                    <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                                                            <input type="file" class="file-uploader pull-left">
                                                                            <button type="submit" class="btn btn-secondary btn-sm">Update Image</button>
                                                                        </div>-->
                                </div>

                                <div class="mb-3">
                                    <label for="Image" class="form-label">User Image</label>
                                    <input class="form-control" type="file" id="Image" name="uImage">
                                    <div class="text-danger"> <?= @$messages['file_error']; ?></div>
                                    <input type="hidden" name="prv_image" value="<?= @$image ?>">
                                </div>


                                <div class="form-group">
                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">First Name</label>
                                    <div class="col-md-12 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" name="fName" value="<?= @$fName ?>">
                                        <div class="text-danger"> <?= @$messages['error_fName']; ?></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Last Name</label>
                                    <div class="col-md-12 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" name="lName" value="<?= @$lName ?>">
                                        <div class="text-danger"> <?= @$messages['error_lName']; ?></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Address</label>
                                    <div class="col-md-12 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" name="uAddress" value="<?= @$uAddress ?>">
                                        <div class="text-danger"><?= @$messages['error_uAddress']; ?></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Email</label>
                                    <div class="col-md-12 col-sm-9 col-xs-12">
                                        <input type="email" class="form-control" name="uEmail" value="<?= @$uEmail ?>">
                                        <div class="text-danger"><?= @$messages['error_uEmail']; ?></div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">User Name</label>
                                    <div class="col-md-12 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" name="uUserName" value="<?= @$uUserName ?>">
                                        <div class="text-danger"><?= @$messages['error_uUserName']; ?></div>

                                    </div>
                                </div>


                                <input type="hidden" name="UserId" value="<?= $UserId ?>">

                            </fieldset>
                            <br><!-- comment -->
                            <div class="form-group">
                                <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                    <button type="submit" name="action" value="update" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- comment -->
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="d-flex align-items-center mb-3">Assigned Gym Members</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'edit') {
                                    extract($_GET);
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_members WHERE UserId='$UserId'";
                                    $results = $db->query($sql);
                                    ?>

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">View</th>
                                                <th scope="col">Account Status</th>
                                                <th scope="col">Membership Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($results->num_rows > 0) {
                                                while ($row = $results->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $row['First_Name'] ?> </td>
                                                        <td><a href="../members/member_profile.php?MemberId=<?= $row['MemberId'] ?>">View</a></td>
                                                        <td>
                                                            <span style=" width: 100px;" class="badge <?php echo $row['Status'] ? 'bg-success' : 'bg-danger' ?>"><?php echo $row['Status'] == 1 ? 'Activated' : 'Deactivated' ?></span>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($row['Approval_Status'] == 1) {
                                                                echo '<p class="text-success">Approved</p>';
                                                            } else {
                                                                echo'<p class="text-danger">Pending</p>';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr> 

                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </li>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>
<?php include '../footer.php'; ?> 
<?php ob_end_flush(); ?>