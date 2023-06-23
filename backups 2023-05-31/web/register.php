<?php ob_start(); ?>
<?php $login = "active" ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>


<main id="main">
    <section id="login" class="login">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Please Register to Continue..</h2>
                <p>If you want something you’ve never had, you must be willing to do something you’ve never done.</p>
            </div>


            <!-- Section: Design Block -->
            <section class=" text-center text-lg-start">

                <style>
                    @media (min-width: 1025px) {
                        .h-custom {
                            height: 100vh !important;
                        }
                    }
                    .card-registration .select-input.form-control[readonly]:not([disabled]) {
                        font-size: 1rem;
                        line-height: 2.15;
                        padding-left: .75em;
                        padding-right: .75em;
                    }
                    .card-registration .select-arrow {
                        top: 13px;
                    }

                    .gradient-custom-2 {
                        /* fallback for old browsers */
                        background: #a1c4fd;

                        /* Chrome 10-25, Safari 5.1-6 */
                        background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

                        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                        background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
                    }

                    .bg-indigo {
                        background-color: #0ea2bd;
                    }
                    @media (min-width: 992px) {
                        .card-registration-2 .bg-indigo {
                            border-top-right-radius: 15px;
                            border-bottom-right-radius: 15px;
                        }
                    }
                    @media (max-width: 991px) {
                        .card-registration-2 .bg-indigo {
                            border-bottom-left-radius: 15px;
                            border-bottom-right-radius: 15px;
                        }
                    }
                </style>

<!--        <section class="h-100 h-custom gradient-custom-2">-->
                <div class="container py-5 h-100">

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {


                        //seperate variables and values from the form
                        extract($_POST);

                        //data clean
                        $mTitle = cleanInput($mTitle);
                        $fName = cleanInput($fName);
                        $lName = cleanInput($lName);
                        $mNic = cleanInput($mNic);
                        $mDob = cleanInput($mDob);
                        $mHeight = cleanInput($mHeight);
                        $mWeight = cleanInput($mWeight);
                        $mAddress = cleanInput($mAddress);
                        $mContact = cleanInput($mContact);
                        $mEmergency = cleanInput($mEmergency);
//        $mDate = cleanInput($mDate);
                        $mEmail = cleanInput($mEmail);
                        $mPassword = cleanInput($mPassword);
                        $mPackage = cleanInput($mPackage);
                        //create array variable store validation messages
                        $messages = array();

                        //validate required fields
                        if (empty($mTitle)) {
                            $messages['error_mTitle'] = "The title should not be empty..!";
                        }
                        if (empty($fName)) {
                            $messages['error_fName'] = "The first name should not be empty..!";
                        }

                        if (empty($lName)) {
                            $messages['error_lName'] = "The last name should not be empty..!";
                        }

                        if (empty($mNic)) {
                            $messages['error_mNic'] = "The NIC should not be empty..!";
                        }

                        if (empty($mDob)) {
                            $messages['error_mDob'] = "The Date of Birth should not be empty..!";
                        }

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

                        if (empty($mEmail)) {
                            $messages['error_mEmail'] = "The Email Address should not be empty..!";
                        }
                        if (empty($mPassword)) {
                            $messages['error_mPassword'] = "The Password should not be empty..!";
                        }
                        if (empty($mConfirmPassword)) {
                            $messages['error_mConPassword'] = "This field should not be empty..!";
                        }
                        if (empty($mPackage)) {
                            $messages['error_mPackage'] = "The Package should be selected..!";
                        }
                        if (!isset($terms)) {
                            $messages['error_terms'] = "You should agree to terms and conditions..!";
                        }
                        if (!isset($terms)) {
                            $messages['error_terms'] = "You should agree to terms and conditions..!";
                        }
                        if (!isset($slots)) {
                            $messages['error_slots'] = "You should select maximum 4 slots!";
                        }
                        //adavanced validations

                        if (!empty($mHeight)) {
                            if ($mHeight < 0) {
                                $messages['error_mHeight'] = "The Height should not be less than 0!";
                            }
                        }
                        if (!empty($mWeight)) {
                            if ($mWeight < 0) {
                                $messages['error_mWeight'] = "The Weight should not be less than 0!";
                            }
                        }
                        if (!empty($mNic)) {
                            $sql = "SELECT * FROM tbl_members WHERE Nic='$mNic'";
                            $db = dbConn();
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                $messages['error_mNic'] = "This member is already exsist..!";
                            }
                        }
                        if (!empty($mPassword)) {
                            // Validate password strength
                            $uppercase = preg_match('@[A-Z]@', $mPassword);
                            $lowercase = preg_match('@[a-z]@', $mPassword);
                            $number = preg_match('@[0-9]@', $mPassword);
                            $specialChars = preg_match('@[^\w]@', $mPassword);
                            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($mPassword) < 8) {
                                $messages['error_mPassword'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.!";
                            }
                        }

                        if ((!empty($mPassword)) && (!empty($mConfirmPassword))) {

                            if ($mPassword != $mConfirmPassword) {
                                $messages['error_password'] = " Passwords are not match";
                            }
                        }

                        if (!empty($mEmail)) {
                            if (!filter_var($mEmail, FILTER_VALIDATE_EMAIL)) {
                                $messages['error_mEmail'] = "The email is not well formatted..!";
                            }
                        }
                        //print_r($messages);
                        if (empty($messages)) {
                            $cdate = date('Y-m-d');
                            $sql = "INSERT INTO tbl_members(Title,First_Name,Last_Name,Nic,Dob,Height,Weight,Address,Contact,Emergency_Contact,Email,Password,PricingId,Joined_Date) VALUES ('$mTitle','$fName','$lName','$mNic','$mDob','$mHeight','$mWeight','$mAddress','$mContact','$mEmergency','$mEmail','$mPassword','$mPackage','$cdate')";

                            $db = dbConn();
                            $db->query($sql);

                            $memberid = $db->insert_id;

                            foreach ($slots as $value) {
                                // $sql = "INSERT INTO tbl_product_size(ProductId,Size) VALUES ('$product_id','$value')";
                                echo $sql = "INSERT INTO tbl_member_date(memberid, opendayid) VALUES ('$memberid','$value')";
                                $db->query($sql);
                            }



                            $mTitle = null;
                            $fName = null;
                            $lName = null;
                            $mNic = null;
                            $mDob = null;
                            $mHeight = null;
                            $mWeight = null;
                            $mAddress = null;
                            $mContact = null;
                            $mEmergency = null;
                            $mEmail = null;
                            $mPassword = null;
                            $mPackage = null;
                            $mConfirmPassword = null;

                            header("Location: login.php?success=true");
                        }
                    }
                    ?>

                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-lg-6">
                                                <div class="p-5">
                                                    <h3 class="fw-normal mb-5" style="color: #0ea2bd;">General Information</h3>

                                                    <div class="mb-4 pb-2">
                                                        <label class="form-label" for="form3Examplev2">Title</label>
                                                        <select class="select" id="title" name="mTitle">

                                                            <option>--</option>
                                                            <option value="Mr" <?php
                                                            if (@$mTitle == "Mr") {
                                                                echo "selected";
                                                            }
                                                            ?> >Mr.</option>
                                                            <option value="Mrs" <?php
                                                            if (@$mTitle == "Mrs") {
                                                                echo "selected";
                                                            }
                                                            ?> >Mrs.</option>
                                                            <option value="Miss" <?php
                                                            if (@$mTitle == "Miss") {
                                                                echo "selected";
                                                            }
                                                            ?> >Miss.</option>
                                                            <option value="others" <?php
                                                            if (@$mTitle == "others") {
                                                                echo "selected";
                                                            }
                                                            ?> >Other</option>
                                                        </select>
                                                        <div class="text-danger"> <?= @$messages['error_mTitle']; ?></div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-4 pb-2">

                                                            <div class="form-outline">
                                                                <input type="text" id="first_name" name="fName" value="<?= @$fName; ?>" class="form-control form-control-lg" />
                                                                <label class="form-label" for="form3Examplev2">First name</label>
                                                                <div class="text-danger"> <?= @$messages['error_fName']; ?></div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6 mb-4 pb-2">

                                                            <div class="form-outline">
                                                                <input type="text" id="last_name" name="lName" value="<?= @$lName; ?>" class="form-control form-control-lg" />
                                                                <label class="form-label" for="form3Examplev3">Last name</label>
                                                                <div class="text-danger"> <?= @$messages['error_lName']; ?></div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <!--                                                <div class="mb-4 pb-2">
                                                                                                        <select class="select">
                                                                                                            <option value="1">Position</option>
                                                                                                            <option value="2">Two</option>
                                                                                                            <option value="3">Three</option>
                                                                                                            <option value="4">Four</option>
                                                                                                        </select>
                                                                                                    </div>-->

                                                    <div class="mb-4 pb-2">
                                                        <div class="form-outline">
                                                            <input type="text" id="nic" name="mNic" value="<?= @$mNic; ?>" class="form-control form-control-lg" />
                                                            <label class="form-label" for="form3Examplev4">NIC</label>
                                                            <div class="text-danger"> <?= @$messages['error_mNic']; ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 pb-2">
                                                        <div class="form-outline">
                                                            <input type="text" id="address" name="mAddress" value="<?= @$mAddress; ?>" class="form-control form-control-lg" />
                                                            <label class="form-label" for="form3Examplev4">Address</label>
                                                            <div class="text-danger"><?= @$messages['error_mAddress']; ?></div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                                                            <div class="form-outline">
                                                                <input type="text" id="contact" name="mContact" value="<?= @$mContact; ?>" class="form-control form-control-lg" />
                                                                <label class="form-label" for="form3Examplev5">Contact Number</label>
                                                                <div class="text-danger"><?= @$messages['error_mContact']; ?></div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                                                            <div class="form-outline">
                                                                <input type="text" id="emergency_contact" name="mEmergency" value="<?= @$mEmergency; ?>" class="form-control form-control-lg" />
                                                                <label class="form-label" for="form3Examplev5">Emergency Contact Number</label>
                                                                <div class="text-danger"><?= @$messages['error_mEmergency']; ?></div>
                                                            </div>

                                                        </div>


                                                        <div class="mb-4 pb-2">
                                                            <label class="form-label" for="form3Examplev5">Pricing Package</label>

                                                            <?php
                                                            $sql = "SELECT * FROM tbl_pricing";
                                                            $db = dbConn();
                                                            $result = $db->query($sql);
                                                            ?>
                                                            <select class="select" id="title" name="mPackage">
                                                                <?php
                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        ?>
                                                                        <option value="<?= $row['PricingId'] ?>" <?php
                                                                        if ((isset($_GET['membership'])) && $_GET['membership'] == $row['PricingId']) {
                                                                            echo "selected";
                                                                        }
                                                                        ?> ><?= $row['Package_Name'] ?></option>

                                                                        <?php
                                                                    }
                                                                }
                                                                ?>


                                                            </select>
                                                            <div class="text-danger"> <?= @$messages['error_mPackage']; ?></div>
                                                        </div>
                                                        <?php
                                                        $sql = "SELECT * FROM tbl_pricing WHERE Status=1";
                                                        $db = dbConn();
                                                        $result = $db->query($sql);
                                                        ?>

                                                        <div class="row">
                                                            <?php
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                    <div class="col-md-4" style="box-shadow: 2px 2px 2px 2px #888888;"><div class="pricing-header">
                                                                            <h5><?= $row['Package_Name'] ?></h5>
                                                                            <h6>LKR <?= number_format($row['Price']) ?></h6>
                                                                            <h7> <span> <?= $row['Months'] ?> Month/s</span></h7>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6  text-white" style="background-color:#0ea2bd;">
                                                <div class="p-5">
                                                    <h3 class="fw-normal mb-5">Personal Details</h3>

                                                    <div class="mb-4 pb-2">
                                                        <div class="form-outline form-white">
                                                            <?php 
                                                           
                                                            $maxyearz= 365*15;
                                                            $minyearz=365*60;
                                                            ?>
                                                            <input type="date" id="Test_DatetimeLocal" name="mDob" value="<?= @$mDob; ?>"  min="<?php echo date("Y-m-d", strtotime("-$minyearz days")); ?>"   max='<?php echo date("Y-m-d", strtotime("-$maxyearz days")); ?>' class="form-control form-control-lg" />
                                                            <label class="form-label" for="form3Examplea2">Date Of Birth</label>
                                                            <div class="text-danger"> <?= @$messages['error_mDob']; ?></div>
                                                        </div>
                                                    </div>

                                                    <!--                                                <div class="mb-4 pb-2">
                                                                                                        <div class="form-outline form-white">
                                                                                                            <input type="text" id="form3Examplea3" class="form-control form-control-lg" />
                                                                                                            <label class="form-label" for="form3Examplea3">Additional Information</label>
                                                                                                        </div>
                                                                                                    </div>-->

                                                    <div class="row">
                                                        <div class="col-md-5 mb-4 pb-2">

                                                            <div class="form-outline form-white">
                                                                <input type="text" id="weight" name="mWeight" value="<?= @$mWeight; ?>" class="form-control form-control-lg" />
                                                                <label class="form-label" for="form3Examplea4">Current Weight</label>
                                                                <div class="text-danger"> <?= @$messages['error_mWeight']; ?></div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-7 mb-4 pb-2">

                                                            <div class="form-outline form-white">
                                                                <input type="text" id="height" name="mHeight" value="<?= @$mHeight; ?>" class="form-control form-control-lg" />
                                                                <label class="form-label" for="form3Examplea5">Current Height</label>
                                                                <div class="text-danger"> <?= @$messages['error_mHeight']; ?></div>
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="mb-4">
                                                        <label class="form-label" for="form3Examplev5">Select 4 Preferred Days</label>
                                                        <div class="form-outline form-white">
                                                            <?php
                                                            $sql = "SELECT * FROM tbl_open_time";
                                                            $db = dbConn();
                                                            $result = $db->query($sql);
                                                            ?>
<!--                                                            creating and foreaching open time table data  assign that is to checkbox-->
                                                            <?php
                                                            if ($result->num_rows > 0) {
                                                                foreach ($result as $slotlist) {
                                                                    $checked = [];
                                                                    if (isset($_POST['slots'])) {
                                                                        
                                                                        //assign the post data of slots to varibale chekced
                                                                        $checked = $_POST['slots'];
                                                                    }
                                                                    ?>
                                                                    <div>
<!--                                                                        creating and foreaching the check box according to the above data coming-->
                                                                        <input class="datemax" type="checkbox" name="slots[]" value="<?= $slotlist['time_id'] ?>" <?php
                                                                        if (in_array($slotlist['time_id'], $checked)) {
                                                                            echo "checked";
                                                                            //selected check keep thiyena checked wela
                                                                        }
                                                                        ?> />
<!--                                                                        showing the ech day session-->
                                                                               <?= $slotlist['time_name']; ?>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            } else {
                                                                echo "slot is not selected";
                                                            }
                                                            ?> 
                                                            <div class="text-danger"> <?= @$messages['error_slots']; ?></div>


                                                        </div>
                                                    </div>



                                                    <!--                                                <div class="mb-4 pb-2">
                                                                                                        <div class="form-outline form-white">
                                                                                                            <input type="text" id="form3Examplea6" class="form-control form-control-lg" />
                                                                                                            <label class="form-label" for="form3Examplea6">Country</label>
                                                                                                        </div>
                                                                                                    </div>-->

                                                    <!--                                                <div class="row">
                                                                                                        <div class="col-md-5 mb-4 pb-2">
                                                    
                                                                                                            <div class="form-outline form-white">
                                                                                                                <input type="text" id="form3Examplea7" class="form-control form-control-lg" />
                                                                                                                <label class="form-label" for="form3Examplea7">Code +</label>
                                                                                                            </div>
                                                    
                                                                                                        </div>
                                                                                                        <div class="col-md-7 mb-4 pb-2">
                                                    
                                                                                                            <div class="form-outline form-white">
                                                                                                                <input type="text" id="form3Examplea8" class="form-control form-control-lg" />
                                                                                                                <label class="form-label" for="form3Examplea8">Phone Number</label>
                                                                                                            </div>
                                                    
                                                                                                        </div>
                                                                                                    </div>-->

                                                    <div class="mb-4">
                                                        <div class="form-outline form-white">
                                                            <input type="text" id="email" name="mEmail" value="<?= @$mEmail; ?>" class="form-control form-control-lg" />
                                                            <label class="form-label" for="form3Examplea9">Your Email</label>
                                                            <div class="text-danger"> <?= @$messages['error_mEmail']; ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="form-outline form-white">
                                                            <input type="password" id="password" name="mPassword" value="<?= @$mPassword; ?>" class="form-control form-control-lg" />
                                                            <label class="form-label" for="form3Examplea9">Create a Password</label>
                                                            <div class="text-danger"> <?= @$messages['error_mPassword']; ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="form-outline form-white">
                                                            <input type="password" id="password" name="mConfirmPassword" value="<?= @$mConfirmPassword; ?>" class="form-control form-control-lg" />
                                                            <label class="form-label" for="form3Examplea9">Confirm the Password</label>
                                                            <div class="text-danger"> <?= @$messages['error_mConPassword']; ?></div>
                                                            <div class="text-danger"> <?= @$messages['error_password']; ?></div>

                                                        </div>
                                                    </div>

                                                    <div class="form-check d-flex justify-content-start mb-4 pb-3">
                                                        <input class="form-check-input me-3" type="checkbox" value="" id="form2Example3c" name="terms" />
                                                        <label class="form-check-label text-white" for="form2Example3">
                                                            I do accept the <a href="#!" class="text-white"><u>Terms and Conditions</u></a> of your
                                                            site.
                                                        </label>

                                                    </div>
                                                    <div class="text-danger"> <?= @$messages['error_terms']; ?></div>
                                                    <button type="submit" class="btn btn-light btn-lg"
                                                            data-mdb-ripple-color="dark">Register</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </section>
            </main>

            <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
            <meta charset=utf-8 />
                <!--to prevent the customer selecting more than 4 checkboxs jquery-->
            <script>
                $(".datemax").change(function () {
                    var count = $(".datemax:checked").length; //get count of checked checkboxes

                    if (count > 4) {
                        alert("Only 4 date can be checked..!");
                        $(this).prop('checked', false); // turn this one off
                    }
                });
            </script>


            <?php include 'footer.php'; ?>
            <?php ob_end_flush(); ?>