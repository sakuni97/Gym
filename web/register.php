<?php ob_start(); ?>
<?php $login = "active" ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<?php include 'assets/phpmail/mail.php'; ?>


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
                        $mGender = cleanInput($mGender);
                        $fName = cleanInput($fName);
                        $lName = cleanInput($lName);
                        $mNic = cleanInput($mNic);
                        $mDob = cleanInput($mDob);
                        $mHeight = cleanInput($mHeight);
                        $mWeight = cleanInput($mWeight);
                        $mAddressline1 = cleanInput($mAddressline1);
                        $mAddressline2 = cleanInput($mAddressline2);
                        $mDistrict = cleanInput($mDistrict);
                        $mCity = cleanInput($mCity);
                        $mContact = cleanInput($mContact);
                        $mEmergency = cleanInput($mEmergency);
                        $mEmail = cleanInput($mEmail);
                        $mPassword = cleanInput($mPassword);
                        $mPackage = cleanInput($mPackage);
                        //$mhealth == cleanInput($mhealth);
                        //$medicine == cleanInput($medicine);
                        //create array variable store validation messages
                        $messages = array();

                        //validate required fields
                        if (empty($mGender)) {
                            $messages['error_mGender'] = "The Gender should not be empty..!";
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

                        if (empty($mAddressline1)) {
                            $messages['error_mAddress1'] = "The Address line 1 should not be empty..!";
                        }
                        if (empty($mAddressline2)) {
                            $messages['error_mAddress2'] = "The Address line 2 should not be empty..!";
                        }
                        if (empty($mDistrict)) {
                            $messages['error_mDistrct'] = "The District should be selected..!";
                        }
                        if (empty($mCity)) {
                            $messages['error_mCity'] = "The City should be selected..!";
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

                        if (!isset($slots)) {
                            $messages['error_slots'] = "You should select maximum 4 slots!";
                        }
                        //adavanced validations
                        if (!empty($mContact)) {
                            $contactLength = strlen($mContact);
                            if ($contactLength == 10 || $contactLength == 9) {
                                if (!preg_match('/^[0-9]+$/', $mContact)) {
                                    $messages['error_mContact'] = "The contact number should only contain numbers!";
                                }
                            } else {
                                $messages['error_mContact'] = "The contact number length should be 9 or 10!";
                            }
                        }
                        if (!empty($mEmergency)) {
                            $contactLength = strlen($mEmergency);
                            if ($contactLength == 10 || $contactLength == 9) {
                                if (!preg_match('/^[0-9]+$/', $mEmergency)) {
                                    $messages['error_mEmergency'] = "The Emergency contact number should only contain numbers!";
                                }
                            } else {
                                $messages['error_mEmergency'] = "The Emergency contact number length should be 9 or 10!";
                            }
                        }


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
                        if (!empty($mNic)) {

                            $niclength = strlen($mNic);
                            if ($niclength == 10 || $niclength == 12) {
                                
                            } else {
                                $messages['error_mNic'] = "The NIC  length should 10 or 12!";
                            }
                        }
                        //email advanced validation 

                        if (!empty($mEmail)) {
                            $sql = "SELECT * FROM tbl_members WHERE Email='$mEmail'";
                            $db = dbConn();
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                $messages['error_mEmail'] = "This member is already exsist..!";
                            }
                        }

                        if (!empty($mEmail)) {
                            $file_ext = explode("@", $mEmail);
                            $file_ext = strtolower(end($file_ext));

                            $allowed = array("gmail.com", "yahoo.com");

                            if (in_array($file_ext, $allowed)) {
                                
                            } else {
                                $messages['error_mEmail'] = "The Email Address Not formatted well..!";
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
                            $mPassword = sha1($mPassword);
                            $contactNumber = "(+94) " . $mContact;
                            $emergencyNumber = "(+94) " . $mEmergency;

                            // Convert weight to kg
                            $weightValue = floatval($mWeight);
                            if ($weightUnit === "lbs") {
                                $weightValue = $weightValue * 0.453592; // Convert lbs to kg
                            }
                            $mWeight = $weightValue;

                            // Convert height to cm
                            $heightValue = floatval($mHeight);
                            if ($heightUnit === "ft") {
                                $heightValue = $heightValue * 30.48; // Convert feet to cm
                            }
                            $mHeight = $heightValue;

                            $sql = "INSERT INTO tbl_members(Gender,First_Name,Last_Name,Nic,Dob,Height,Weight,Address_Line1,Address_Line2,District,City,Contact,Emergency_Contact,Email,Password,PricingId,Joined_Date,Status) VALUES ('$mGender','$fName','$lName','$mNic','$mDob','$mHeight','$mWeight','$mAddressline1','$mAddressline2','$mDistrict','$mCity','$contactNumber','$emergencyNumber','$mEmail','$mPassword','$mPackage','$cdate',1)";

                            $db = dbConn();
                            $db->query($sql);

                            //send a mail when adding a product to below email address
                            $to = $mEmail;
                            $toname = $fName . '' . $lName;
                            $subject = "Successfull Member Registration";
                            $body = "<h1>Successfully Registred To Life Fitness Gym</h1><p>You have successfully registered to our gym. Please login to you account and do the payments to get the membership approved !!</p>";
                            $alt = "Member Registration";
                            send_email($to, $toname, $subject, $body, $alt);

                            $memberid = $db->insert_id;
                            $memberCode = date('Y') . date('m') . date('d') . $memberid;

                            //update query
                            echo $sql = "UPDATE tbl_members SET memberCode = '$memberCode' WHERE MemberId='$memberid'";
                            $db->query($sql);

                            foreach ($slots as $value) {
                                // $sql = "INSERT INTO tbl_product_size(ProductId,Size) VALUES ('$product_id','$value')";
                                echo $sql = "INSERT INTO tbl_member_date(memberid, opendayid) VALUES ('$memberid','$value')";
                                $db->query($sql);
                            }

                            foreach ($medicine as $values) {
                                echo $sql1 = "INSERT INTO tbl_member_medicine(member_id,medicine,memberCode) VALUES ('$memberid','$values','$memberCode')";
                                $db->query($sql1);
                            }




                            $mGender = null;
                            $fName = null;
                            $lName = null;
                            $mNic = null;
                            $mDob = null;
                            $mHeight = null;
                            $mWeight = null;
                            $mAddressline1 = null;
                            $mAddressline2 = null;
                            $mDistrict = null;
                            $mCity = null;
                            $mContact = null;
                            $mEmergency = null;
                            $mEmail = null;
                            $mPassword = null;
                            $mPackage = null;
                            $mConfirmPassword = null;
                            //$mhealth = null;
                            //$medicine =null;



                            header("Location:login.php?success=true&membership=$memberCode");
                        }
                    }
                    ?>

                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                                    <div class="card-body p-0">
                                        <div class="row g-0">

                                            <!-- first 4 div column section start here -->
                                            <div class="col-lg-6">
                                                <div class="p-5">
                                                    <h3 class="fw-normal mb-5" style="color: #0ea2bd;">General Information</h3>

                                                    <div class="mb-4 pb-2">
                                                        <label class="form-label" for="form3Examplev2">Gender</label>
                                                        <select class="form-control" id="gender" name="mGender">

                                                            <option></option>
                                                            <option value="Male" <?php
                                                            if (@$mGender == "Male") {
                                                                echo "selected";
                                                            }
                                                            ?> >Male</option>
                                                            <option value="Female" <?php
                                                            if (@$mGender == "Female") {
                                                                echo "selected";
                                                            }
                                                            ?> >Female</option>

                                                            <option value="others" <?php
                                                            if (@$mGender == "others") {
                                                                echo "selected";
                                                            }
                                                            ?> >Other</option>
                                                        </select>
                                                        <div class="text-danger"> <?= @$messages['error_mGender']; ?></div>
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
                                                            <input type="text" id="address1" name="mAddressline1" value="<?= @$mAddressline1; ?>" class="form-control form-control-lg" />
                                                            <label class="form-label" for="form3Examplev4">Address Line 1 </label>
                                                            <div class="text-danger"><?= @$messages['error_mAddress1']; ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 pb-2">
                                                        <div class="form-outline">
                                                            <input type="text" id="address2" name="mAddressline2" value="<?= @$mAddressline2; ?>" class="form-control form-control-lg" />
                                                            <label class="form-label" for="form3Examplev4">Address Line 2 </label>
                                                            <div class="text-danger"><?= @$messages['error_mAddress2']; ?></div>
                                                        </div>
                                                    </div>



                                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-4 pb-2">
                                                            <div class="form-outline">
                                                                <select id="district" name="mDistrict" class="form-control form-control-lg">
                                                                    <option value="">Select District</option>
                                                                    <!-- Populate dropdown options dynamically from the JSON data -->
                                                                    <?php
                                                                    // Read the JSON file and parse the data
                                                                    $jsonString = file_get_contents('lk.json');
                                                                    $data = json_decode($jsonString, true);

                                                                    // Loop through the districts in the JSON data and create dropdown options
                                                                    foreach ($data as $district => $cities) {
                                                                        echo '<option value="' . $district . '">' . $district . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <label class="form-label" for="form3Examplev4">District</label>
                                                                <div class="text-danger"><?= @$messages['error_mDistrct']; ?></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-4 pb-2">
                                                            <div class="form-outline">
                                                                <select id="city" name="mCity" class="form-control form-control-lg">
                                                                    <option value="">Select City</option>
                                                                </select>
                                                                <label class="form-label" for="form3Examplev4">City</label>
                                                                <div class="text-danger"><?= @$messages['error_mCity']; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        $(document).ready(function () {
                                                            // Triggered when the district selection changes
                                                            $('#district').change(function () {
                                                                var selectedDistrict = $(this).val();
                                                                var cityDropdown = $('#city');

                                                                // Clear existing city options
                                                                cityDropdown.empty();

                                                                // If a district is selected, fetch the corresponding cities from the JSON data
                                                                if (selectedDistrict) {
                                                                    var cities = <?= $jsonString ?>; // Get the JSON data directly from the PHP variable

                                                                    // Find the selected district in the JSON data and retrieve its cities
                                                                    if (cities[selectedDistrict] && cities[selectedDistrict].cities) {
                                                                        var districtCities = cities[selectedDistrict].cities;

                                                                        // Populate the city dropdown options
                                                                        $.each(districtCities, function (index, city) {
                                                                            cityDropdown.append('<option value="' + city + '">' + city + '</option>');
                                                                        });
                                                                    }
                                                                }
                                                            });
                                                        });
                                                    </script>


                                                    <div class="row">
                                                        <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                                                            <div class="form-outline">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">(+94)</span>
                                                                    <input type="text" id="contact" name="mContact" value="<?= @$mContact; ?>" class="form-control form-control-lg" placeholder="7xxxxxxxx"/>
                                                                </div>
                                                                <label class="form-label" for="form3Examplev5">Contact Number</label>
                                                                <div class="text-danger"><?= @$messages['error_mContact']; ?></div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                                                            <div class="form-outline">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">(+94)</span>
                                                                    <input type="text" id="emergency_contact" name="mEmergency" value="<?= @$mEmergency; ?>" class="form-control form-control-lg" placeholder="1xxxxxxxx" />
                                                                </div>
                                                                <label class="form-label" for="form3Examplev5">Emergency Contact Number</label>
                                                                <div class="text-danger"><?= @$messages['error_mEmergency']; ?></div>
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="mb-4 pb-2">

                                                        <label class="form-label" for="form3Examplev5">Pricing Package</label>

                                                        <?php
                                                        $sql = "SELECT * FROM tbl_pricing";
                                                        $db = dbConn();
                                                        $result = $db->query($sql);
                                                        ?>
                                                        <select class="form-control" id="title" name="mPackage">
                                                            <?php
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                    <option value="<?= $row['PricingId'] ?>" <?php
                                                                    if ((isset($_GET['packageId'])) && $_GET['packageId'] == $row['PricingId']) {
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
                                                            $class = null;
                                                            while ($row = $result->fetch_assoc()) {
                                                                if ($row['PricingId'] == @$_GET['packageId']) {
                                                                    $class = "bg-success text-white";
                                                                } else {
                                                                    $class = null;
                                                                }
                                                                ?>
                                                                <div class="col-md-4 <?= @$class ?>" style="box-shadow: 2px 2px 2px 2px #888888;"><div class="pricing-header">
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

                                            <!-- first 4 div column section End here -->

                                            <!-- Second 4 div column section start here -->
                                            <div class="col-lg-6  text-white" style="background-color:#0ea2bd;">
                                                <div class="p-5">
                                                    <h3 class="fw-normal mb-5">Personal Details</h3>

                                                    <div class="mb-4 pb-2">
                                                        <div class="form-outline form-white">
                                                            <?php
                                                            $maxyearz = 365 * 15;
                                                            $minyearz = 365 * 60;
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


                                                    <!--   Start of height and weight and BMI -->
                                                    <div class="row">
                                                        <div class="col-md-9 mb-4 pb-2">
                                                            <div class="form-outline form-white d-flex align-items-center">
                                                                <label class="form-label" for="weight">Current Weight</label>
                                                                <div class="text-danger"><?= @$messages['error_mWeight']; ?></div>
                                                                <input type="number" id="weight" name="mWeight" value="<?= @$mWeight; ?>" class="form-control form-control-lg" min="30" max="660" />
                                                            </div>
                                                            <span id="weightError" class="error-message text-danger"></span>
                                                        </div>
                                                        <div class="col-md-3 mb-4 pb-2">
                                                            <select id="weightUnit" name="weightUnit" class="form-control form-control-lg" onchange="updateWeightRange()">
                                                                <option value="kg">kg</option>
                                                                <option value="lbs">lbs</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-9 mb-4 pb-2">
                                                            <div class="form-outline form-white d-flex align-items-center">
                                                                <label class="form-label" for="height">Current Height</label>
                                                                <div class="text-danger"><?= @$messages['error_mHeight']; ?></div>
                                                                <input type="number" id="height" name="mHeight" value="<?= @$mHeight; ?>" class="form-control form-control-lg" min="100" max="250" step="1" onchange="calBmi()" />
                                                            </div>
                                                            <span id="heightError" class="error-message text-danger"></span>
                                                        </div>
                                                        <div class="col-md-3 mb-4 pb-2">
                                                            <select id="heightUnit" name="heightUnit" class="form-control form-control-lg" onchange="updateHeightRange()">
                                                                <option value="cm">cm</option>
                                                                <option value="ft">ft</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col" id="bmi"></div>

                                                    <script>
                                                        function updateWeightRange() {
                                                            var weightUnit = $("#weightUnit").val();
                                                            var weightInput = $("#weight");

                                                            if (weightUnit === "kg") {
                                                                weightInput.attr("min", 30);
                                                                weightInput.attr("max", 300);
                                                            } else if (weightUnit === "lbs") {
                                                                weightInput.attr("min", 66);
                                                                weightInput.attr("max", 660);
                                                            }
                                                        }

                                                        function updateHeightRange() {
                                                            var heightUnit = $("#heightUnit").val();
                                                            var heightInput = $("#height");

                                                            if (heightUnit === "cm") {
                                                                heightInput.attr("min", 100);
                                                                heightInput.attr("max", 250);
                                                                heightInput.attr("step", 1);
                                                            } else if (heightUnit === "ft") {
                                                                heightInput.attr("min", 3);
                                                                heightInput.attr("max", 8);
                                                                heightInput.attr("step", 0.1);
                                                            }
                                                        }


                                                    </script>


                                                    <div class="col" id="bmi"></div>

                                                    <!--   end of height and weight -->
                                                    <br><br>
                                                    <!--                                                    <div class="mb-4">
                                                                                                            <div class="form-outline form-white">
                                                                                                                <textarea type="text" id="health" name="mhealth" rows="5" value="<?= @$mhealth; ?>" class="form-control form-control-lg" ></textarea>
                                                    
                                                                                                                <label class="form-label" for="form3Examplea9">Special Health Concerns</label>
                                                    
                                                                                                            </div>
                                                                                                        </div>    -->

                                                    <div class="mb-4">
                                                        <label>Select Any medicine you take </label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="pressure" id="pressure" name="medicine[]" <?php
                                                            if (isset($medicine)) {
                                                                if (in_array('pressure', $medicine,)) {
                                                                    echo "checked";
                                                                }
                                                            }
                                                            ?>>
                                                            <label class="form-check-label" for="pressure">
                                                                Pressure Tablets
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="cholesterol" id="cholesterol" name="medicine[]" <?php
                                                            if (isset($medicine)) {
                                                                if (in_array('cholesterol', $medicine,)) {
                                                                    echo "checked";
                                                                }
                                                            }
                                                            ?>>
                                                            <label class="form-check-label" for="cholesterol">
                                                                Cholesterol
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="thyroxine" id="thyroxine" name="medicine[]" <?php
                                                            if (isset($medicine)) {
                                                                if (in_array('thyroxine', $medicine,)) {
                                                                    echo "checked";
                                                                }
                                                            }
                                                            ?>>
                                                            <label class="form-check-label" for="thyroxine">
                                                                Thyroxine
                                                            </label>
                                                        </div>


                                                    </div>




                                                    <div class="mb-4">
                                                        <div class="form-outline form-white">
                                                            <input type="text" id="email" name="mEmail" value="<?= @$mEmail; ?>" class="form-control form-control-lg" />
                                                            <label class="form-label" for="form3Examplea9">Your Email</label>
                                                            <div class="text-danger"> <?= @$messages['error_mEmail']; ?></div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-11 mb-4 pb-2">

                                                            <div class="form-outline form-white">
                                                                <input type="password" id="password" name="mPassword" value="<?= @$mPassword; ?>" class="form-control form-control-lg" />
                                                                <label class="form-label" for="form3Examplea9">Create a Password</label>
                                                                <div class="text-danger"><?= @$messages['error_mPassword']; ?></div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 mb-4 pb-2">
                                                            <br>
                                                            <span class="toggle-password bi bi-eye" onclick="togglePasswordVisibility()"></span>

                                                        </div>
                                                    </div>
                                                    <script>
                                                        function togglePasswordVisibility() {
                                                            var passwordInput = document.getElementById("password");
                                                            var eyeIcon = document.querySelector(".toggle-password");
                                                            if (passwordInput.type === "password") {
                                                                passwordInput.type = "text";
                                                                eyeIcon.classList.remove("bi-eye");
                                                                eyeIcon.classList.add("bi-eye-slash");
                                                            } else {
                                                                passwordInput.type = "password";
                                                                eyeIcon.classList.remove("bi-eye-slash");
                                                                eyeIcon.classList.add("bi-eye");
                                                            }
                                                        }
                                                    </script>


                                                    <div class="row">
                                                        <div class="col-md-11 mb-4 pb-2">

                                                            <div class="form-outline form-white">
                                                                <input type="password" id="cpassword" name="mConfirmPassword" value="<?= @$mConfirmPassword; ?>" class="form-control form-control-lg" />
                                                                <label class="form-label" for="form3Examplea9">Confirm the Password</label>
                                                                <div class="text-danger"> <?= @$messages['error_mConPassword']; ?></div>
                                                                <div class="text-danger"> <?= @$messages['error_password']; ?></div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 mb-4 pb-2">
                                                            <br>
                                                            <span class="toggle-cpassword bi bi-eye" onclick="togglecPasswordVisibility()"></span>

                                                        </div>
                                                    </div>
                                                    <script>
                                                        function togglecPasswordVisibility() {
                                                            var passwordInput = document.getElementById("cpassword");
                                                            var eyeIcon = document.querySelector(".toggle-cpassword");
                                                            if (passwordInput.type === "password") {
                                                                passwordInput.type = "text";
                                                                eyeIcon.classList.remove("bi-eye");
                                                                eyeIcon.classList.add("bi-eye-slash");
                                                            } else {
                                                                passwordInput.type = "password";
                                                                eyeIcon.classList.remove("bi-eye-slash");
                                                                eyeIcon.classList.add("bi-eye");
                                                            }
                                                        }
                                                    </script>
                                                </div>



                                            </div>
                                        </div>
                                        <!-- second 4 div column section End here -->
                                    </div>
                                    <div class="row g-0">
                                        <!-- Third 4 div column section start here -->
                                        <div class="col-lg-12">
                                            <div class="p-5">
                                                <h3 class="fw-normal mb-5" style="color: #0ea2bd;">Pick Time Slots</h3>


                                                <div class="mb-4">
                                                    <label class="form-label" for="form3Examplev5">Select 4 Preferred Days</label>
                                                    <div class="form-outline form-white">
                                                        <div class="row">
                                                            <?php
                                                            // showing the available days session
                                                            $sql = "SELECT * FROM tbl_timeslot";
                                                            $db = dbConn();
                                                            $result = $db->query($sql);

                                                            if ($result->num_rows > 0) {
                                                                $columnCount = 0; // Counter for columns
                                                                foreach ($result as $slotlist) {
                                                                    $checked = [];
                                                                    if (isset($_POST['slots'])) {
                                                                        $checked = $_POST['slots'];
                                                                    }
                                                                    $defincecount = $slotlist['member_count'];
                                                                    $slot_id = $slotlist['slot_id'];

                                                                    $checkBoxId = 'checkbox_' . $slotlist['day_Id'];

                                                                    // Check if the slot count has exceeded the defined count
                                                                    $sqlCount = "SELECT COUNT(*) AS booked_count FROM tbl_member_assign_dates AS mad JOIN tbl_members AS m ON mad.membeRID = m.MemberId WHERE mad.timeslotidforday = '$slot_id' AND m.Status = 1";
                                                                    $resultCount = $db->query($sqlCount);
                                                                    $rowCount = $resultCount->fetch_assoc();
                                                                    $bookedCount = $rowCount['booked_count'];
                                                                    $availableCount = $defincecount - $bookedCount;
                                                                    ?>
                                                                    <div class="col-md-4">
                                                                        <!-- Creating and foreaching the checkbox according to the data -->
                                                                        <div class="border border-1 border-dark">
                                                                            <input class="datemax" id="<?= $slotlist['day_Id']; ?>" 
                                                                                   onclick="handleCheck(this)"
                                                                                   type="checkbox" name="slots[]" value="<?= $slotlist['slot_id'] ?>" <?php
                                                                                   if ($availableCount <= 0 || in_array($slotlist['slot_id'], $checked)) {
                                                                                       echo "disabled";
                                                                                   }
                                                                                   ?> />
                                                                                   <?= '<span style="font-weight: bold; color: black;">' . $slotlist['session_name'] . '</span>'; ?>

                                                                            <?php
                                                                            if ($availableCount <= 0) {
                                                                                echo "(Fully Booked)";
                                                                            }
                                                                            ?>
                                                                            <br>
                                                                            <?php echo '<span style="font-style: italic; font-size: small;">Start Time ' . $slotlist['slot_start_time'] . ' End Time ' . $slotlist['slot_end_time'] . '</span>'; ?>

                                                                        </div>
                                                                    </div>

                                                                    <?php
                                                                    $columnCount++;
                                                                    // Close the row div tag for every 3 columns or at the end of the loop
                                                                    if ($columnCount % 3 == 0 || $columnCount == $result->num_rows) {
                                                                        echo '</div><div class="row">';
                                                                    }
                                                                }
                                                            } else {
                                                                echo "Slot is not selected";
                                                            }
                                                            ?>
                                                        </div>

                                                        <div class="text-danger"><?= @$messages['error_slots']; ?></div>
                                                    </div>
                                                </div>



                                                <style>
                                                    .popup-overlay {
                                                        position: fixed;
                                                        top: 0;
                                                        left: 0;
                                                        width: 100%;
                                                        height: 100%;
                                                        background-color: rgba(0, 0, 0, 0.5);
                                                        display: flex;
                                                        justify-content: center;
                                                        align-items: center;
                                                        z-index: 9999;
                                                    }

                                                    .popup-content {
                                                        position: relative;
                                                        max-width: 80%;
                                                        max-height: 80%;
                                                        overflow: auto;
                                                        background-color: #fff;
                                                        padding: 20px;
                                                    }

                                                    .popup-close {
                                                        position: absolute;
                                                        top: 10px;
                                                        right: 10px;
                                                        cursor: pointer;
                                                    }
                                                </style>

                                                <div class="form-check d-flex justify-content-center mb-4 pb-3">
                                                    <input class="form-check-input me-3" type="checkbox" value="" id="form2Example3c" name="terms" />
                                                    <label class="form-check-label text-black" for="form2Example3">
                                                        I do accept the <a href="#!" class="text-black" onclick="openTermsPopup()"><u>Terms and Conditions</u></a> of your site.
                                                    </label>
                                                </div>

                                                <div id="termsPopup" class="popup-overlay" style="display: none;">
                                                    <div class="popup-content">
                                                        <span class="popup-close" onclick="closeTermsPopup()">&times;</span>
                                                        <!-- Insert your terms and conditions content here -->
                                                        <h2>Terms and Conditions</h2>
                                                        <p> By registering for a gym membership, you agree to abide by the terms and conditions outlined in this agreement.</p>
                                                        <p>Membership fees are payable according to the selected membership plan. Failure to pay the required fees may result in the termination of your membership.</p>
                                                        <p>Members are expected to conduct themselves in a respectful and courteous manner towards staff and fellow members. Any behavior that is deemed inappropriate or disruptive may result in the suspension or termination of membership.</p>
                                                        <p>The gym is not liable for any injuries, accidents, or health-related issues that may occur during your participation in gym activities. It is your responsibility to exercise caution and use equipment properly.</p>
                                                        <p>The gym reserves the right to modify or update these terms and conditions at any time. Notice of any changes will be communicated through appropriate means.</p>
                                                    </div>
                                                </div>

                                                <script>
                                                    function openTermsPopup() {
                                                        var popup = document.getElementById("termsPopup");
                                                        popup.style.display = "flex";
                                                    }

                                                    function closeTermsPopup() {
                                                        var popup = document.getElementById("termsPopup");
                                                        popup.style.display = "none";
                                                    }
                                                </script>

                                                <div class="text-center">
                                                    <button style="background-color: #0ea2bd; color: white"; type="submit" class="btn  btn-lg justify-content-center"
                                                            >Register</button>
                                                </div>

                                                <div class="text-danger"> <?= @$messages['error_terms']; ?></div>




                                            </div>
                                        </div>
                                        <!-- second 4 div column section End here -->
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

                                                    function handleCheck(checkbox) {
                                                        //        console.log(checkbox.checked);
                                                        var checkboxes = document.getElementsByClassName('datemax');

                                                        if (checkbox.checked) {
                                                            console.log(checkboxes.length);
                                                            for (var i = 0; i < checkboxes.length; i++) {
                                                                if (checkboxes[i] !== checkbox) {
                                                                    if (checkboxes[i].id == checkbox.id) {
                                                                        checkboxes[i].disabled = true;
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            console.log(checkboxes.length);
                                                            for (var i = 0; i < checkboxes.length; i++) {
                                                                if (checkboxes[i] !== checkbox) {
                                                                    if (checkboxes[i].id == checkbox.id) {
                                                                        checkboxes[i].disabled = false;
                                                                    }
                                                                }
                                                            }
                                                        }

                                                    }
                                                    $(".datemax").change(function () {
                                                        var count = $(".datemax:enabled:checked").length; // get count of enabled and checked checkboxes

                                                        if (count > 4) {
                                                            alert("Only 4 dates can be checked..!");
                                                            $(this).prop('checked', false); // turn this one off
                                                        }
                                                    });
</script>


<?php include 'footer.php'; ?>

<script>
    function calBmi() {
        var weightInput = $("#weight");
        var heightInput = $("#height");
        var weight = weightInput.val();
        var height = heightInput.val();

        // Reset error messages
        $("#weightError").text("");
        $("#heightError").text("");

        // Check for valid weight
        var weightUnit = $("#weightUnit").val();
        var weightMin = (weightUnit === "kg") ? 30 : 66;
        var weightMax = (weightUnit === "kg") ? 300 : 660;
        if (weight === "" || weight === null || isNaN(weight) || weight < weightMin || weight > weightMax) {
            $("#weightError").text("Please enter a valid weight (between " + weightMin + " and " + weightMax + ").");
            return;
        }

        // Check for valid height
        var heightUnit = $("#heightUnit").val();
        var heightMin = (heightUnit === "cm") ? 100 : 3;
        var heightMax = (heightUnit === "cm") ? 250 : 8;
        if (height === "" || height === null || isNaN(height) || height < heightMin || height > heightMax) {
            $("#heightError").text("Please enter a valid height (between " + heightMin + " and " + heightMax + ").");
            return;
        }

        // Convert weight to kg
        var weightValue = parseFloat(weight);
        if (weightUnit === "lbs") {
            weightValue = weightValue * 0.453592; // Convert lbs to kg
        }
        weight = weightValue;

        // Convert height to cm
        var heightValue = parseFloat(height);
        if (heightUnit === "ft") {
            heightValue = heightValue * 30.48; // Convert feet to cm
        }
        height = heightValue;

        var bmi = weight / ((height / 100) * (height / 100)); // Calculate BMI in kg and cm
        $("#bmi").html("Your BMI is: " + bmi.toFixed(2));
    }
</script>



<?php ob_end_flush(); ?>