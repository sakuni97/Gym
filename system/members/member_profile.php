<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Member Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>members/members.php" class="btn btn-sm btn-outline-secondary">View All Members</a>

            </div>

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
        $mAddressline1 = cleanInput($mAddressline1);
        $mAddressline2 = cleanInput($mAddressline2);

        $mHeight = cleanInput($mHeight);
        $mWeight = cleanInput($mWeight);
        $mPackage = cleanInput($mPackage);
        $mTrainer = cleanInput($mTrainer);

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

        if (empty($mAddressline1)) {
            $messages['error_mAddress1'] = "The Address line 1 should not be empty..!";
        }
        if (empty($mAddressline2)) {
            $messages['error_mAddress2'] = "The Address line 2 should not be empty..!";
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
        if (empty($mTrainer)) {
            $messages['error_mTrainer'] = "The Trainer should be selected..!";
        }
        //print_r($messages);
        if (empty($messages)) {


            $sql5 = "UPDATE tbl_members SET Contact='$mContact',Emergency_Contact='$mEmergency',Address_Line1='$mAddressline1',Address_Line2='$mAddressline2',Height='$mHeight',Weight='$mWeight',PricingId='$mPackage',UserId='$mTrainer' WHERE MemberId='$MemberId'";

            $db = dbConn();
            $db->query($sql5);
        }

        if (true) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'success',
                    text: 'Member details changed successfully'
                })
            </script>
        <?php ?>
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
        $mAddressline11z = $row['Address_Line1'];
        $mAddressline2z = $row['Address_Line2'];

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
                                    <h6 class="mb-0">Gender</h6>
                                    <span class="text-secondary"><?= $row['Gender'] ?></span>
                                </li>
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

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Workout Plan</h6>

<?php
$db = dbConn();
$sql = "SELECT * FROM tbl_members INNER JOIN tbl_workouts ON tbl_members.WorkoutId = tbl_workouts.WorkoutId WHERE MemberId='$MemberIdedit' ";
//$sql2 = "SELECT * FROM tbl_workouts";
//$sql = "SELECT * FROM tbl_members, tbl_workouts.WorkoutId as WorkoutIds, tbl_workouts.Workout_Name as Workout_Name  FROM tbl_workouts ON tbl_members.WorkoutId = tbl_workouts.WorkoutId WHERE MemberId='$MemberIdedit' ";
//echo $sql = "SELECT tbl_members.MemberId AS MemberId, tbl_members.Title AS Title,tbl_members.First_Name AS First_Name,tbl_members.Last_Name AS Last_Name,tbl_members.Nic AS Nic,tbl_members.Dob AS Dob,tbl_members.Height AS Height,tbl_members.Weight AS Weight,tbl_members.Address AS Address,tbl_members.Contact AS Contact,tbl_members.Emergency_Contact AS Emergency_Contact,tbl_members.Joined_Date AS Joined_Date,tbl_members.Status AS Status,tbl_members.Email AS Email,tbl_members.Approval_Status AS Approval_Status,tbl_members.UserId AS UserId,tbl_members.PricingId AS PricingId,tbl_members.WorkoutId AS WorkoutId,tbl_workouts.WorkoutId AS WorksID,tbl_workouts.Workout_Name AS Workout_Name FROM tbl_members,tbl_workouts WHERE tbl_members.WorkoutId = tbl_workouts.WorkoutId AND MemberId='$MemberIdedit'";

$results = $db->query($sql);
//$results2 = $db->query($sql2);
//$joined_data = $results->fetch_assoc();
//                            print_r($t['WorkoutId']);
//                            die();
//                                    
?>

                                    <?php
                                    $rowx = $results->fetch_assoc();
                                    ?>


                                    <span class="text-secondary">
<?php
if ($rowx != null) {
    echo $rowx['Workout_Name'];
} else {
    echo "Not yet assigned";
}
?>
                                    </span>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <br>



                    <!--                    <br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        
                                                        <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Requested Dates</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="text" class="form-control" name="mContact" value="<?= @$mContactz ?>">
                                                            <div class="text-danger"><?= @$messages['error_mContact']; ?></div>
                                                        </div>
                                                    </div>
                                                            
                                                    </div>
                                                </div>
                    
                                            </div>
                                        </div>-->
                </div>

                <!-- Start of the data changable form  -->
                <div class="col-lg-8">

                    <!-- php code in form php filr -->
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
                                        <h6 class="mb-0">Address Line 1 </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mAddressline1" value="<?= $mAddressline11z ?>">
                                        <div class="text-danger"><?= @$messages['error_mAddress1']; ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address Line 2 </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mAddressline2" value="<?= $mAddressline2z ?>">
                                        <div class="text-danger"><?= @$messages['error_mAddress2']; ?></div>

                                        <br>

<!--                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div class="form-outline">
                                                    <select id="district" name="mDistrict" class="form-control">
                                                        <option value="<?= $row['District'] ?>"></option>
                                                         Populate dropdown options dynamically from the JSON data 
<?php
// Read the JSON file and parse the data
//                                                        $jsonString = file_get_contents('lk.json');
//                                                        $data = json_decode($jsonString, true);
//
//                                                        // Loop through the districts in the JSON data and create dropdown options
//                                                        foreach ($data as $district => $cities) {
//                                                            echo '<option value="' . $district . '">' . $district . '</option>';
//                                                        }
?>
                                                    </select>
                                                    <label class="form-label" for="form3Examplev4">District</label>
                                                    <div class="text-danger"><?= @$messages['error_mDistrct']; ?></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4 pb-2">
                                                <div class="form-outline">
                                                    <select id="city" name="mCity" class="form-control">
                                                        <option value="<?= $row['City'] ?>"></option>
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
//                cityDropdown.empty();

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
                                        </script> -->
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
$sql1 = "SELECT * FROM tbl_pricing INNER JOIN tbl_members ON tbl_pricing.PricingId = tbl_members.PricingId WHERE MemberId='$MemberIdedit' ";
$sql2 = "SELECT * FROM tbl_pricing ";

$results = $db->query($sql1);
$results2 = $db->query($sql2);
$joined_data = $results->fetch_assoc();
//                            print_r($t['PricingId']);
//                            die();
?>
                                <div class="row mb-3">                             
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Package</h6>
                                    </div>                             


                                    <div class="col-sm-9 text-secondary">
                                        <select class="select" id="title" name="mPackage">
<?php
if ($results2->num_rows > 0) {
    while ($row = $results2->fetch_assoc()) {
        ?>
                                                    <option value="<?= $row['PricingId'] ?>" 
                                                    <?php echo ($joined_data['PricingId'] == $row['PricingId']) ? 'selected="selected"' : ''; ?>
                                                            ><?= $row['Package_Name'] ?></option>



        <?php
    }
}
?>


                                        </select>

                                        <div class="text-danger"><?= @$messages['error_mPackage']; ?></div>


                                    </div>

                                </div>

<?php
$db = dbConn();
$sql = "SELECT * FROM tbl_users INNER JOIN tbl_members ON tbl_users.UserId = tbl_members.UserId WHERE MemberId='$MemberIdedit' ";
$sql2 = "SELECT * FROM tbl_users WHERE UserRole='trainer' AND Status='1' ";

$results = $db->query($sql);
$results2 = $db->query($sql2);
$joined_data = $results->fetch_assoc();
//                            print_r($t['PricingId']);
//                            die();
?>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Trainer</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">

                                        <select class="select" id="title" name="mTrainer">
<?php if ($results2->num_rows > 0) { ?>
                                                <option value="0" >--Select Trainer--</option>
                                                <?php while ($row = $results2->fetch_assoc()) { ?>


                                                    <option value="<?= $row['UserId'] ?>" 

        <?php echo (($joined_data ) && $joined_data['UserId'] == $row['UserId']) ? 'selected="selected"' : ''; ?>
                                                            ><?= $row['FirstName'] ?></option>



        <?php
    }
}
?>


                                        </select>
                                        <div class="text-danger"><?= @$messages['error_mTrainer']; ?></div>
                                    </div>
                                </div>
                                <input type="hidden" name="MemberId" value="<?= $MemberIdedit ?>">
                                <div class="row">

                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <button type="submit" name="action" value="update" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive" id="trainersDetails" style="display: none;">
                                        <table class="table table-striped table-hover table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Trainers</th>
                                                    <th scope="col">Assigned Count of Active & Approved Members</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$sql = "SELECT * FROM tbl_users WHERE UserRole ='trainer' AND Status=1";
$db = dbConn();
$result = $db->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $UserId = $row['UserId'];
        ?>
                                                        <tr>
                                                            <td><?= $row['FirstName'] . " " . $row['LastName'] ?></td>
                                                            <td>
        <?php
        $db = dbConn();
        $sql = "SELECT count(*) FROM tbl_members WHERE UserId='$UserId' AND Status=1 AND Approval_Status=1";
        $results = $db->query($sql);
        while ($row = mysqli_fetch_array($results)) {
            echo $row['count(*)'];
        }
        ?>
                                                            </td>
                                                        </tr>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                    <tr>
                                                        <td colspan="2" class="text-center">No trainers found.</td>
                                                    </tr>
    <?php
}
?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="javascript:void(0);" class="btn btn-link" onclick="toggleTable()">
                                        <i class="fas fa-plus" id="expandIcon"></i> View Trainers Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function toggleTable() {
                            var trainersDetails = document.getElementById("trainersDetails");
                            var expandIcon = document.getElementById("expandIcon");

                            if (trainersDetails.style.display === "none") {
                                trainersDetails.style.display = "block";
                                expandIcon.classList.remove("fa-plus");
                                expandIcon.classList.add("fa-minus");
                            } else {
                                trainersDetails.style.display = "none";
                                expandIcon.classList.remove("fa-minus");
                                expandIcon.classList.add("fa-plus");
                            }
                        }
                    </script>


                </div>
            </div>
        </div>
    </div>


</div>
</main>




<?php include '../footer.php'; ?> 
<?php ob_end_flush(); ?>