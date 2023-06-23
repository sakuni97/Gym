<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Member Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>trainer_portal/gym_members.php" class="btn btn-sm btn-outline-secondary">View All Members</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Members</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Members
            </button>
        </div>
    </div>

    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'update') {
//        print_r(@$action);die();
        //seperate variables and values from the form
        //data clean
        $mContact = cleanInput($mContact);
        $mEmergency = cleanInput($mEmergency);
        $mAddress = cleanInput($mAddress);

        $mHeight = cleanInput($mHeight);
        $mWeight = cleanInput($mWeight);

        //$uPassWord = cleanInput($uPassWord);
        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($mHeight)) {
            $messages['error_mHeight'] = "The Height should not be empty..!";
        }
        if (empty($mWeight)) {
            $messages['error_mWeight'] = "The Weight should not be empty..!";
        }

        if (empty($mAddress)) {
            $messages['error_mAddress'] = "The Address should not be empty..!";
        }
        if (empty($mContact)) {
            $messages['error_mContact'] = "The contact number should not be empty..!";
        }
        if (empty($mEmergency)) {
            $messages['error_mEmergency'] = "The Emergency contact number should not be empty..!";
        }


        if (empty($mPlan)) {
            $messages['error_mPlan'] = "The Workout Plan should be selected..!";
        }
        //print_r($messages);
        if (empty($messages)) {


            $sql5 = "UPDATE tbl_members SET Contact='$mContact',Emergency_Contact='$mEmergency',Address='$mAddress',Height='$mHeight',Weight='$mWeight',WorkoutId='$mPlan' WHERE MemberId='$MemberId'";
            // echo $sql = "UPDATE tbl_users SET Address='$uAddress' WHERE UserId='$UserId'";
            // $sql="UPDATE tbl_users SET  Address='$uAddress' WHERE UserId='$UserId' ";
            //print_r($sql5);
            $db = dbConn();
            $db->query($sql5);

//            header("Location: member_profile.php?MemberId=$MemberIdedit");
            //print_r($db);
        }

        if (empty($messages)) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'success',
                    text: 'Member details changed successfully'
                })
            </script>
            <?php
            ?>
            <?php
        }
    }


    if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET") {
        $MemberIdedit = isset($_GET['MemberId']) ? $_GET['MemberId'] : $_POST['MemberId'];

        $db = dbConn();
        $sql = "SELECT * FROM tbl_members WHERE MemberId='$MemberIdedit'";
        $results = $db->query($sql);
        $row = $results->fetch_assoc();

        $mContactz = $row['Contact'];
        $mEmergencyz = $row['Emergency_Contact'];
        $mAddressz = $row['Address'];
        $mDobz = $row['Dob'];
        $mHeightz = $row['Height'];
        $mWeightz = $row['Weight'];
    }

//    echo $MemberId;
    ?>





    <div class="container">
        <div class="main-body">
            <div class="row">

                <!-- Start of the unchangable details card -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                <div class="mt-3">
                                    <h4><?= $row['First_Name'] . " " . $row['Last_Name'] ?></h4>
                                    <p class="text-secondary mb-1">Joined on <?= $row['Joined_Date'] ?> </p>
<!--									<p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                                    <button class="btn btn-primary">Follow</button>
                                    <button class="btn btn-outline-primary">Message</button>-->
                                </div>
                            </div>
                            <hr class="my-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">First Name</h6>
                                    <span class="text-secondary"><?= $row['First_Name'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Last Name</h6>
                                    <span class="text-secondary"><?= $row['Last_Name'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">NIC Number</h6>
                                    <span class="text-secondary"><?= $row['Nic'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Email</h6>
                                    <span class="text-secondary"><?= $row['Email'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Date Of Birth</h6>
                                    <span class="text-secondary"><?= $row['Dob'] ?></span>
                                </li>


                                <?php
                                $db = dbConn();
                                $sqlj = "SELECT * FROM tbl_users INNER JOIN tbl_members ON tbl_users.UserId = tbl_members.UserId WHERE MemberId='$MemberIdedit' ";

                                $results = $db->query($sqlj);
                                ?>
                                <?php
                                $rowx = $results->fetch_assoc();
                                ?>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Trainer</h6>
                                    <span class="text-secondary">
                                          
                                        <?php
                                        if ($rowx != null) {
                                            $trainer = $rowx["UserId"];
                                            $sqlw = "SELECT * FROM tbl_users WHERE  UserId=$trainer";
                                            $db = dbConn();
                                            $resultD = $db->query($sqlw);
                                            $rowUPDATE = $resultD->fetch_assoc();
                                            echo $rowUPDATE['FirstName'];
                                        } else {
                                            echo "Not yet assigned";
                                        }
                                        ?>
                                    </span>
                                </li>

                                <?php
                                $db = dbConn();
                                $sql4 = "SELECT * FROM tbl_pricing INNER JOIN tbl_members ON tbl_pricing.PricingId = tbl_members.PricingId WHERE MemberId='$MemberIdedit' ";

                                $results = $db->query($sql4);
                                ?>

                                <?php
                                $rowm = $results->fetch_assoc();
                                ?>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Package</h6>
                                    <span class="text-secondary"><?= $rowm['Package_Name'] ?></span>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <br>


                </div>

                <!-- Start of the data changable form  -->
                <div class="col-lg-8">

                    <!-- php code in form php file -->
                    <form class="form-horizontal " method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Contact Number</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mContact" value="<?= @$mContactz ?>">
                                        <div class="text-danger"><?= @$messages['error_mContact']; ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Emergency Contact</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mEmergency" value="<?= @$mEmergencyz ?>">
                                        <div class="text-danger"><?= @$messages['error_mEmergency']; ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mAddress" value="<?= @$mAddressz ?>">
                                        <div class="text-danger"><?= @$messages['error_mAddress']; ?></div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Joined day Height</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mHeight" value="<?= @$mHeightz ?>">
                                        <div class="text-danger"> <?= @$messages['error_mHeight']; ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Joined day Weight</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mWeight" value="<?= @$mWeightz ?>">
                                        <div class="text-danger"> <?= @$messages['error_mWeight']; ?></div>
                                    </div>
                                </div>

                                <?php
                                $db = dbConn();
                                $sql = "SELECT * FROM tbl_members INNER JOIN tbl_workouts ON tbl_members.WorkoutId = tbl_workouts.WorkoutId WHERE MemberId='$MemberIdedit' ";
                                $sql3 = "SELECT * FROM tbl_workouts";

                                $results = $db->query($sql);
                                $results3 = $db->query($sql3);
                                $joined_data = $results->fetch_assoc();
//                            print_r($t['PricingId']);
//                            die();
                                ?>

                                <div class="row mb-3">                             
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Workout Plan</h6>
                                    </div>                             


                                    <div class="col-sm-9 text-secondary">
                                        <select class="select" id="title" name="mPlan">
                                            <?php if ($results3->num_rows > 0) { ?>
                                                <option value="0" >--Select Workout Plan--</option>
                                                <?php while ($row = $results3->fetch_assoc()) { ?>


                                                    <option value="<?= $row['WorkoutId'] ?>" 

                                                            <?php echo (($joined_data ) && $joined_data['WorkoutId'] == $row['WorkoutId']) ? 'selected="selected"' : ''; ?>
                                                            ><?= $row['Workout_Name'] ?></option>



                                                    <?php
                                                }
                                            }
                                            ?>


                                        </select>

                                        <div class="text-danger"><?= @$messages['error_mPlan']; ?></div>


                                    </div>

                                </div>


                            </div>
                            <input type="hidden" name="MemberId" value="<?= $MemberIdedit ?>">
                            <div class="row">

                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <button type="submit" name="action" value="update" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                            <br>
                        </div>

                    </form>
                    <br>



                    <!-- Start of the progress  -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                    <p style="color: #DD4A68; font-weight: bold";  >  Want to Update the Health  Progress ? </p>


                                    <form method="post" action="progress.php?MemberId=<?= $row['MemberId'] ?>">

                                        <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>" >
                                        <button class="btn btn-warning" type="submit" name="action" value="nav">Click Here to Navigate to Health Tracker</button>

                                    </form>


                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


</div>
</main>

<?php include '../footer.php'; ?> 
<?php ob_end_flush(); ?>