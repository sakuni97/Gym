<?php include '../header.php'; ?>


<?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'edit') {

        $db = dbConn();
        $sql = "SELECT * FROM tbl_members WHERE MemberId='$MemberId'";
        $results = $db->query($sql);
        $row = $results->fetch_assoc();

        $mContact = $row['Contact'];
        $mEmergency = $row['Emergency_Contact'];
        $mAddress = $row['Address'];
        $mDob = $row['Dob'];
        $mHeight = $row['Height'];
        $mWeight = $row['Weight'];
//    echo $MemberId;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'update') {

        //seperate variables and values from the form
        //data clean
        $mContact = cleanInput($mContact);
        $mEmergency = cleanInput($mEmergency);
        $mAddress = cleanInput($mAddress);
       
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
        if (empty($mTrainer)) {
            $messages['error_mTrainer'] = "The Trainer should be selected..!";
        }
        print_r($messages);
        if (empty($messages)) {


            $sql5 = "UPDATE tbl_members SET Contact='$mContact',Emergency_Contact='$mEmergency',Address='$mAddress',Height='$mHeight',Weight='$mWeight',PricingId='$mPackage',UserId='$mTrainer' WHERE MemberId='$MemberId'";
            // echo $sql = "UPDATE tbl_users SET Address='$uAddress' WHERE UserId='$UserId'";
            // $sql="UPDATE tbl_users SET  Address='$uAddress' WHERE UserId='$UserId' ";
            print_r($sql5);
            $db = dbConn();
            $db->query($sql5);
           // header("Location: members.php");
            //print_r($db);
        }
    }
    ?>
<form class="form-horizontal " method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Contact Number</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mContact" value="<?= @$mContact ?>">
                                        <div class="text-danger"><?= @$messages['error_mContact']; ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Emergency Contact</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mEmergency" value="<?= @$mEmergency ?>">
                                        <div class="text-danger"><?= @$messages['error_mEmergency']; ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mAddress" value="<?= @$mAddress ?>">
                                        <div class="text-danger"><?= @$messages['error_mAddress']; ?></div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Height</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mHeight" value="<?= @$mHeight ?>">
                                        <div class="text-danger"> <?= @$messages['error_mHeight']; ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Weight</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="mWeight" value="<?= @$mWeight ?>">
                                        <div class="text-danger"> <?= @$messages['error_mWeight']; ?></div>
                                    </div>
                                </div>


                                <?php
                                $db = dbConn();
                                $sql1 = "SELECT * FROM tbl_pricing INNER JOIN tbl_members ON tbl_pricing.PricingId = tbl_members.PricingId WHERE MemberId='$MemberId' ";
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
                                $sql = "SELECT * FROM tbl_users INNER JOIN tbl_members ON tbl_users.UserId = tbl_members.UserId WHERE MemberId='$MemberId' ";
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
                                <input type="text" name="MemberId" value="<?= $MemberId ?>">
                                <div class="row">
                                    
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <button type="submit" name="action" value="update" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>