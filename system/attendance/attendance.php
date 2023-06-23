<?php $attendance = "active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Attendance</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>attendance/member_requsted_dates.php" class="btn btn-sm btn-outline-secondary">View Member Requested Dates </a>

            </div>

        </div>
    </div>

    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        date_default_timezone_set('Asia/Colombo');

        $messages = array();
        if (empty($memberid)) {
            $messages['error_sName'] = "The Name should not be empty..!";
        }


        if (empty($messages)) {
            $time = date("H:i");
            $date = date("Y-m-d");
            $user = $_SESSION['UserId'];

            $sqlattendace = "INSERT INTO tbl_attendance(attendance_date, attendace_member_id, attendace_status, checkin_time, added_user, added_date) VALUES ('$date','$memberid','1','$time','$user','$date')";
            $db = dbConn();
            $db->query($sqlattendace);
        }
    }
    ?>



    <section>
        <div class="table-responsive">
            <?php
            $weekdayNumber = date('N');
            if ($weekdayNumber == 1 || $weekdayNumber == 2 || $weekdayNumber == 3) {
                $weekdayNumber = $weekdayNumber + 1;
            } else {
                $weekdayNumber = $weekdayNumber;
            }

            $sql = "SELECT * FROM tbl_members LEFT JOIN tbl_member_assign_dates on tbl_members.MemberId=tbl_member_assign_dates.membeRID LEFT JOIN tbl_timeslot on tbl_member_assign_dates.timeslotidforday = tbl_timeslot.slot_id LEFT JOIN tbl_attendance on tbl_members.MemberId = tbl_attendance.attendace_member_id WHERE day_Id='$weekdayNumber';";
            $db = dbConn();
            $result = $db->query($sql);
            ?>

            <table class="table table-striped table-sm">
                <thead>
                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">Name</th>
    <!--                    <th scope="col">Appointment Time</th>-->
                        <th scope="col">Time Slot Start</th>
                        <th scope="col">Time Slot End</th>
                        <th scope="col">Session Name</th>
                        <th scope="col">Checking time</th>
                        <th scope="col">CheckOut time</th>
                        <th scope="col">Attendance</th>
                        <th scope="col">Date</th>
<!--                        <th scope="col">Edit</th>-->

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {

                            $idmember = $row['MemberId'];
                            $currentdate = date("Y-m-d");
                            $sqlattend = "SELECT * FROM tbl_attendance WHERE attendace_member_id='$idmember' and attendance_date ='$currentdate' ";
                            $resulpart = $db->query($sqlattend);

                            $rowpart = $resulpart->fetch_assoc();

                            @$timechecking = $rowpart['checkin_time'];

                            if ($resulpart->num_rows > 0) {
                                if ($rowpart['checkout_time'] == null) {
                                    $outtime = "00:00:00";
                                } else {
                                    $outtime = $rowpart['checkout_time'];
                                }
                            }
                            ?>
                            <tr>
                                <td><?= $i ?></td>

                                <td><?= $row ['First_Name'] . " " . $row ['Last_Name'] ?></td>
                                <td><?= $row ['slot_start_time'] ?> </td>
                                <td><?= $row ['slot_end_time'] ?> </td>
                                <td><?= $row ['session_name'] ?> </td>
                                <td>
                                    <?php
                                    if (@$timechecking) {
                                        echo $timechecking;
                                    } else {
                                        $timechecking = false;
                                        ?>
                                        <form action="checkout.php" method="POST">
                                            <input type="hidden" name="memberid" value="<?= $row ['MemberId'] ?>">

                                            <button type="submit" name="action" value="addtime"> Add Checking time</button> </form><?php }
                                    ?>

                                </td>
                                <td>
                                    <?php
                                    if (@$outtime != "00:00:00") {
                                        echo $outtimenew = $outtime;
                                    } else {
                                        $outtimenew = false;
                                        ?>
                                        <form action="checkout.php" method="POST">
                                            <input type="hidden" name="memberid" value="<?= $row ['MemberId'] ?>">

                                            <button type="submit" name="action" value="checkout"> Add Check out time</button> </form><?php }
                                    ?>

                                </td>
                                <td><?php
                                    if (@$timechecking == true && @$outtimenew == true) {
                                        echo "Done For Today";
                                    } elseif (@$timechecking == true && @$outtimenew == false) {
                                        echo "Playing";
                                    } elseif (@$timechecking == false && @$outtimenew == false) {
                                        echo "Not Yet Participate";
                                    }
                                    ?></td>
                                <td><?php echo date("Y-m-d"); ?> </td>

                                <td><?php //                    if($row ['checkout_time']== "00:00:00"){      ?>
                                    <!--                        <form action="checkout.php" method="POST">
                                                                <input type="hidden" name="attendance_id" value="//<?= $row['attendance_id'] ?>">
                                                                <input type="hidden" name="attendance_date" value="//<?= $row['attendance_date'] ?>">
                                                                <input type="hidden" name="attendace_member_id" value="//<?= $row['attendace_member_id'] ?>"> 
                                                                
                                                                <button type="submit"> Checking out</button>
                                                            </form>-->
                                    <?php
//                    }else{
//                       echo  $row ['checkout_time'];
//                    }
                                    ?>
                                    <?php ?></td>
<!--                                <td>
                                    <form method="post" action="edit_checkout.php">
                                        <input type="hidden" name="MemberId" value="<?= $row['MemberId'] ?>">
                                        <button type="submit" name="action" value="edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </form>
                                </td>-->




                            </tr>
                            <?php
                            $i++;
                            $outtime = "00:00:00";
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </section>    


    <section>
        <form action="" method="POST">

            <div class="row">

                <div class="col-md-6">

                    <div class="mb-4 pb-2">

                        <label class="form-label" for="form3Examplev5">Select Member</label>

                        <?php
                        $sql = "SELECT * FROM tbl_members";
                        $db = dbConn();
                        $result = $db->query($sql);
                        ?>
                        <select class="form-control" id="title" name="memberid" onchange="loadmember()">
                            <option value=""> Select Name </option>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>

                                    <option value="<?= $row['MemberId'] ?>" <?php
                                    if (@$mPackage == $row['MemberId']) {
                                        echo "selected";
                                    }
                                    ?> ><?= $row['First_Name'] . " " . $row['Last_Name'] . " " . $row['Nic'] ?></option>

                                    <?php
                                }
                            }
                            ?>


                        </select>
                        <div class="text-danger"> <?= @$messages['error_mPackage']; ?></div>
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="mb-4 ">
                        <label class="form-label" for="form3Examplev5"></label>

                        <button type="submit" name="action" value="addattendance" class="p-1 m-4"> Add </button>
                    </div>
                </div>

            </div>
        </form>
    </section>

    <div class="table-responsive">
        <?php
        $sql = "SELECT * FROM tbl_attendance LEFT JOIN tbl_members ON tbl_attendance.attendace_member_id=tbl_members.MemberId; ";
        $db = dbConn();
        $result = $db->query($sql);
        ?>

        <table class="table table-striped table-sm">
            <thead>
                <tr>

                    <th scope="col">#</th>
                    <th scope="col">Name</th>
<!--                    <th scope="col">Appointment Time</th>-->
                    <th scope="col">Checkin Time</th>
                    <th scope="col">Checkout Time</th>
                    <th scope="col">Date</th>

                </tr>
            </thead>
            <tbody>

                <?php
                ?>


                <?php
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        $idmember = $row['MemberId'];
                        $currentdate = date("Y-m-d");
                        $sqlattend = "SELECT * FROM tbl_attendance WHERE attendace_member_id='$idmember' and attendance_date ='$currentdate' ";
                        ?>
                        <tr>
                            <td><?= $i ?></td>

                            <td><?= $row ['First_Name'] . " " . $row ['Last_Name'] ?></td>
                            <td><?= $row ['checkin_time'] ?> </td>
                            <td><?php if ($row ['checkout_time'] == "00:00:00") { ?>
                                    <form action="checkout.php" method="POST">
                                        <input type="hidden" name="attendance_id" value="<?= $row['attendance_id'] ?>">
                                        <input type="hidden" name="attendance_date" value="<?= $row['attendance_date'] ?>">
                                        <input type="hidden" name="attendace_member_id" value="<?= $row['attendace_member_id'] ?>"> 

                                        <button type="submit" name="action" value="other"> Checking out</button>
                                    </form><?php
                                } else {
                                    echo $row ['checkout_time'];
                                }
                                ?>
                                <?php
                                ?></td>
                            <td> <?= $row['attendance_date'] ?></td>



                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>

            </tbody>
        </table>
    </div>


</main>

<?php include '../footer.php'; ?>       