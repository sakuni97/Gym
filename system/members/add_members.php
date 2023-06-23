<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">New Members</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>members/members.php"class="btn btn-sm btn-outline-secondary">View Members</a>
               
            </div>
            
        </div>
    </div>
    <?php
    //check form submit method
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
        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($mGender)) {
            $messages['error_mGender'] = "The Gender should be selected..!";
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

        if (empty($mPackage)) {
            $messages['error_mPackage'] = "The Package should be selected..!";
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
        }
    }
    ?>



    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="title" class="form-label">Select the Gender</label>
<!--            <input type="text" class="form-control" id="title" name="uTitle" value="<?= @$mTitle; ?>">-->
            <select class="select" id="gender" name="mGender">

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
            <label for="nic" class="form-label">Enter Identity Card Number</label>
            <input type="text" class="form-control" id="nic" name="mNic" value="<?= @$mNic; ?>">
            <div class="text-danger"> <?= @$messages['error_mNic']; ?></div>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Date Of Birth</label>
            <?php
            $maxyearz = 365 * 15;
            $minyearz = 365 * 60;
            ?>
            <input type="date" id="Test_DatetimeLocal" name="mDob" value="<?= @$mDob; ?>"  min="<?php echo date("Y-m-d", strtotime("-$minyearz days")); ?>"   max='<?php echo date("Y-m-d", strtotime("-$maxyearz days")); ?>' class="form-control form-control-lg" />

            <div class="text-danger"> <?= @$messages['error_mDob']; ?></div>
        </div>
        <div class="row">
            <label for="height" class="form-label">Enter the Height</label>
            <div class="col-md-9 mb-4 pb-2">               
                <input type="number" id="height" name="mHeight" value="<?= @$mHeight; ?>" class="form-control" min="100" max="250" step="1" />
                <div class="text-danger"> <?= @$messages['error_mHeight']; ?></div>
            </div>
            <div class="col-md-3 mb-4 pb-2">
                <select id="heightUnit" name="heightUnit" class="form-control" onchange="updateHeightRange()">
                    <option value="cm">cm</option>
                    <option value="ft">ft</option>
                </select>
            </div>
        </div>

        <div class="row">
            <label for="weight" class="form-label">Enter the Weight</label>
            <div class="col-md-9 mb-4 pb-2">
                <input type="number" id="weight" name="mWeight" value="<?= @$mWeight; ?>" class="form-control" min="30" max="660" />
                <div class="text-danger"> <?= @$messages['error_mWeight']; ?></div>
            </div>
            <div class="col-md-3 mb-4 pb-2">
                <select id="weightUnit" name="weightUnit" class="form-control" onchange="updateWeightRange()">
                    <option value="kg">kg</option>
                    <option value="lbs">lbs</option>
                </select>
            </div>
        </div>
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

        <div class="mb-3">
            <label for="address" class="form-label">Enter the Address Line 1 </label>  
            <input type="text" id="address1" name="mAddressline1" value="<?= @$mAddressline1; ?>" class="form-control" />
            <div class="text-danger"><?= @$messages['error_mAddress1']; ?></div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Enter the Address Line 2 </label>  
            <input type="text" id="address2" name="mAddressline2" value="<?= @$mAddressline2; ?>" class="form-control" />
            <div class="text-danger"><?= @$messages['error_mAddress1']; ?></div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <div class="row">
            <div class="col-md-6 mb-4 pb-2">
                <div class="form-outline">
                    <select id="district" name="mDistrict" class="form-control ">
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
                    <select id="city" name="mCity" class="form-control ">
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

        <div class="mb-3">
            <label for="contact" class="form-label">Enter the Contact Number</label>
            <div class="input-group">
                <span class="input-group-text">(+94)</span>
                <input type="text" class="form-control" id="contact" name="mContact" value="<?= @$mContact; ?>">
            </div>
            <div class="text-danger"><?= @$messages['error_mContact']; ?></div>
        </div>

        <div class="mb-3">
            <label for="emergency_contact" class="form-label">Enter the Emergency Contact Number</label>
            <div class="input-group">
                <span class="input-group-text">(+94)</span>
                <input type="text" class="form-control" id="emergency_contact" name="mEmergency" value="<?= @$mEmergency; ?>">
            </div>
            <div class="text-danger"><?= @$messages['error_mEmergency']; ?></div>
        </div>

        <div class="mb-3">
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

        <div class="mb-3">
            <label for="email" class="form-label">Enter your Email Address</label>
            <input type="text" class="form-control" id="email" name="mEmail" value="<?= @$mEmail; ?>">
            <div class="text-danger"> <?= @$messages['error_mEmail']; ?></div>
        </div>


        <div class="mb-3">

            <label for="password" class="form-label">Enter Password</label>
            <input type="password" class="form-control" id="password" name="mPassword" value="<?= @$mPassword; ?>">
            <div class="text-danger"> <?= @$messages['error_mPassword']; ?></div>

        </div>

        <span class="toggle-password bi bi-eye" onclick="togglePasswordVisibility()"></span>


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

        <div class="mb-3">
            <label for="pricing" class="form-label">Pricing Package</label>
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
                        <option value="<?= $row['PricingId'] ?>" <?php {
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
                                                <input class="datemax" id="datemax" type="checkbox" name="slots[]" value="<?= $slotlist['slot_id'] ?>" <?php
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




                    <div class="text-center">
                        <button style="background-color: #0ea2bd; color: white"; type="submit" class="btn  btn-lg justify-content-center"
                                >Register</button>
                    </div>






                </div>
            </div>
            <!-- second 4 div column section End here -->
        </div>



    </form>

</main>

<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<meta charset=utf-8 />
<!--to prevent the customer selecting more than 4 checkboxs jquery-->
<script>
            $(".datemax").change(function () {
                var count = $(".datemax:checked").length; //get count of checked checkboxes

                if (count > 4) {
                    alert("Only 4 slots can be checked..!");
                    $(this).prop('checked', false); // turn this one off
                }
            });
</script>
<?php include '../footer.php'; ?>            