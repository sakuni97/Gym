<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">New Members</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>members/members.php"class="btn btn-sm btn-outline-secondary">View Members</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Members</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Members
            </button>
        </div>
    </div>
    <?php
    //check form submit method
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
            $messages['error_mDob'] = "The DOB should not be empty..!";
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
        if (empty($mPackage)) {
            $messages['error_mPackage'] = "The Package should be selected..!";
        }
        if (empty($mEmail)) {
            $messages['error_mEmail'] = "The Email Address should not be empty..!";
        }
        if (empty($mPassword)) {
            $messages['error_mPassword'] = "The Password should not be empty..!";
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
        if (!empty($mEmail)) {
            if (!filter_var($mEmail, FILTER_VALIDATE_EMAIL)) {
                $messages['error_mEmail'] = "The email is not well formatted..!";
            }
        }

        if (empty($messages)) {
            $cdate = date('Y-m-d');
            $sql = "INSERT INTO tbl_members(Title,First_Name,Last_Name,Nic,Dob,Height,Weight,Address,Contact,Emergency_Contact,Joined_Date,Email,Password,PricingId) VALUES ('$mTitle','$fName','$lName','$mNic','$mDob','$mHeight','$mWeight','$mAddress','$mContact','$mEmergency','$cdate','$mEmail','$mPassword','$mPackage')";
            $db = dbConn();
            $db->query($sql);

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
        }
    }
    ?>

    <!-- <?php echo $_SESSION['project_title']; ?> -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="title" class="form-label">Enter the Title</label>
<!--            <input type="text" class="form-control" id="title" name="uTitle" value="<?= @$mTitle; ?>">-->
            <select id="title" name="mTitle" class="form-control">
                <option value="">-Select-</option>
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
            <input type="date" id="Test_DatetimeLocal" name="mDob" value="<?= @$mDob; ?>" class="form-control form-control-lg" />

            <div class="text-danger"> <?= @$messages['error_mDob']; ?></div>
        </div>

        <div class="mb-3">
            <label for="height" class="form-label">Enter the Height in cm</label>
            <input type="text" class="form-control" id="height" name="mHeight" value="<?= @$mHeight; ?>">
            <div class="text-danger"> <?= @$messages['error_mHeight']; ?></div>
        </div>
        <div class="mb-3">
            <label for="weight" class="form-label">Enter the Weight in kg</label>
            <input type="text" class="form-control" id="weight" name="mWeight" value="<?= @$mWeight; ?>">
            <div class="text-danger"> <?= @$messages['error_mWeight']; ?></div>
        </div>


        <div class="mb-3">
            <label for="address" class="form-label">Enter the Address</label>
            <input type="text" class="form-control" id="address" name="mAddress" value="<?= @$mAddress; ?>">
            <div class="text-danger"><?= @$messages['error_mAddress']; ?></div>
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Enter the Contact Number</label>
            <input type="text" class="form-control" id="contact" name="mContact" value="<?= @$mContact; ?>">
            <div class="text-danger"><?= @$messages['error_mContact']; ?></div>
        </div>

        <div class="mb-3">
            <label for="emergency_contact" class="form-label">Enter the Emergency Contact Number</label>
            <input type="text" class="form-control" id="emergency_contact" name="mEmergency" value="<?= @$mEmergency; ?>">
            <div class="text-danger"><?= @$messages['error_mEmergency']; ?></div>
        </div>



        <div class="mb-3">
            <label for="email" class="form-label">Enter your Email Address</label>
            <input type="text" class="form-control" id="email" name="mEmail" value="<?= @$mEmail; ?>">
            <div class="text-danger"> <?= @$messages['error_mEmail']; ?></div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Enter Password</label>
            <input type="text" class="form-control" id="password" name="mPassword" value="<?= @$mPassword; ?>">
            <div class="text-danger"> <?= @$messages['error_mPassword']; ?></div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Pricing Package</label>
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
                         {
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


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>
<?php include '../footer.php'; ?>            