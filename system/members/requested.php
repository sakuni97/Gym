<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<?php
// getting data from the member member profile page
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action = 'slot_save') {
    extract($_POST);

    $memberid = $memberidfordate;
    $db = dbConn();

    $sql6 = "SELECT * FROM tbl_members WHERE MemberId='$memberid'";

    $results = $db->query($sql6);
    $row6 = $results->fetch_assoc();
    ?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Offered Gym Dates for <?= $row6['First_Name'] . " " . $row6['Last_Name'] ?></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>members/members.php" class="btn btn-sm btn-outline-secondary">View All Members</a>

                </div>

            </div>
        </div>
    <?php } ?>

    <?php
// getting data from the member member profile page
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action = 'slot_save') {
        extract($_POST);

        $memberid = $memberidfordate;
        $db = dbConn();

//    sending each record to  database which means assign the days to the customers to come to gym
//    
        foreach ($slots as $value) {
            $messages = array();
            $sqlslot = "SELECT * FROM tbl_timeslot WHERE slot_id='$value'";
//            echo "<br>";
            $resultslot = $db->query($sqlslot);
            $row = $resultslot->fetch_assoc();
//            echo "<br>";
            $definecount = $row['member_count'];
//            echo "<br>";
            $sqlcheck = "SELECT * FROM tbl_member_assign_dates WHERE timeslotidforday='$value'";
//            echo "<br>";
            $checkresult = $db->query($sqlcheck);
            $count = $checkresult->num_rows;

//             echo    $sql = "INSERT INTO tbl_member_assign_dates(membeRID,timeslotidforday) VALUES ('$memberid','$value')";
//                $db->query($sql);

            if ($count > $definecount) {
                $_SESSION['checkcount'] = 1;
            }
        }



//            header("Location:member_profile.php?MemberId=$memberid");
    }
    
//    $slotsarray[]= $slots;
//    
//    print_r($slotsarray);
//    
//    die();
    
    
//    foreach ($slots as $value) {
//        $sqldates="SELECT * FROM tbl_timeslot WHERE slot_id='$value'";
//    }
//    
//    die();
//echo "<br>";
    if (isset($_SESSION['checkcount'])) {
        ?>
        <h1>Slot has been already filled</h6><?php
//        echo"55555";
//        echo "<br>";
        } else {
            foreach ($slots as $value) {
//            echo "<br>";
                $sql = "INSERT INTO tbl_member_assign_dates(membeRID,timeslotidforday) VALUES ('$memberid','$value')";
                $db->query($sql);
            }
            ?>


            <section>
                <div class="card mb-12">

                    <div class="col-sm-3">
                        <h6 class="mb-0" style="color: #00f; font-weight: bold;">Offered Sessions</h6>
                        <br>

                    </div>
                    <table class="table">

                        <thead>
    <!--                                    <tr>
                                <th style="color:#012970 ">Offered Sessions</th>
                            </tr>-->
                        </thead>
                        <?php
//                           $sqloffered="SELECT * FROM tbl_member_assign_dates WHERE membeRID= '$id'";
                        $sqloffered = "SELECT * FROM tbl_member_assign_dates INNER JOIN tbl_timeslot on tbl_member_assign_dates.timeslotidforday= tbl_timeslot.slot_id WHERE tbl_member_assign_dates.membeRID='$memberid';";
                        $resultoffered = $db->query($sqloffered);
                        if ($resultoffered->num_rows == null) {
                            echo $assign = "Still Did not assign sessions";
                        } else {
                            ?>
                            <tbody><?php while ($rowaa = $resultoffered->fetch_assoc()) { ?>
                                    <tr>
                                        <td style="background-color:#01a156 ; color:white; font-weight: bold;"><?= $rowaa['session_name'] ?></td><?php
                                    }
                                }
                                ?></tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <?php
        }
        ?>
        <?php
        if (isset($_SESSION['checkcount'])) {
            unset($_SESSION['checkcount']);
        }
        ?>

        <div class="text-danger"> <?= @$messages['error_slots']; ?></div>





        <?php //print_r($_SESSION);  ?>
        <?php include '../footer.php'; ?> 
        <?php ob_end_flush(); ?>