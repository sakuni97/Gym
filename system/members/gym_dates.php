<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<?php
extract($_POST);

if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET") {
    $MemberIdedit = isset($_GET['MemberId']) ? $_GET['MemberId'] : $_POST['MemberId'];

    $db = dbConn();
    $sql = "SELECT * FROM tbl_members WHERE MemberId='$MemberIdedit'";
    $results = $db->query($sql);
    $row = $results->fetch_assoc();

    $id = $row['MemberId'];
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"> <?php echo $row['First_Name'] . " " . $row['Last_Name'] ?>'s Gym Dates</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>members/members.php" class="btn btn-sm btn-outline-secondary">View All Members</a>

            </div>

        </div>
    </div>


    <div class="container">
        <div class="main-body">
            <div class="row">

                <div class="col-sm-12">
                    <div class="card">

                        <!--  sending form data to requested php -->
                        <form action="requested.php" method="post">
                            <!--  sending memberid to identify whcich member to has to clarify-->
                            <input type="hidden" name="memberidfordate" value="<?= $id ?>">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Requested Dates</h6>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 text-secondary">




                                        <?php
                                        // retrieve and shows the requested days by the member
                                        $sql2 = "SELECT * FROM tbl_member_date WHERE memberid='$id'";
                                        $db = dbConn();
                                        $resultz = $db->query($sql2);
                                        while ($row = $resultz->fetch_assoc()) {
                                            $brands[] = $row['opendayid'];
                                        }
                                        ?>

                                        <?php if ($resultz->num_rows > 0) { ?>
                                            <table class="table">
                                                <thead>
                                                    <th>Session Name</th>
                                                    <th> Booked Count</th>
                                                    <th> Available Count</th>
                                                </thead><?php
                                                        foreach ($resultz as $brandlsit) {
                                                            $checked = [];
                                                            if (isset($_POST['brands'])) {
                                                                $checked = $_POST['brands'];
                                                            }
                                                        ?>


                                                    <?php
                                                            $dayname = $brandlsit['opendayid'];

                                                            $sql3 = "SELECT * FROM tbl_timeslot WHERE slot_id='$dayname'";
                                                            $resultzz = $db->query($sql3);
                                                            $rowzz = $resultzz->fetch_assoc();
                                                            //                                                echo ucwords($rowzz['session_name']) . ' --';
                                                    ?>
                                                    <tbody>
                                                        <td> <?php echo ucwords($rowzz['session_name']) ?></td>
                                                        <?php
                                                            //                                                        $selectingsql = "SELECT * FROM tbl_member_assign_dates WHERE timeslotidforday='$dayname'";
                                                            //                                                        $resultselecting = $db->query($selectingsql);
                                                            //                                                        $roeselecting = $resultselecting->fetch_assoc();
                                                            //
                                                            //                                                        if ($resultselecting->num_rows == null) {
                                                            //                                                            echo $Bookcount = 0;
                                                            //                                                        } else {
                                                            //
                                                            //                                                            echo $Bookcount = $resultselecting->num_rows;
                                                            //                                                        }

                                                            $selectingsql = "SELECT COUNT(tbl_member_assign_dates.membeRID) AS Bookcount, tbl_timeslot.member_count AS defincecount FROM tbl_timeslot LEFT JOIN tbl_member_assign_dates ON tbl_member_assign_dates.timeslotidforday = tbl_timeslot.slot_id INNER JOIN tbl_members ON tbl_members.MemberId = tbl_member_assign_dates.membeRID WHERE tbl_member_assign_dates.timeslotidforday = '$dayname' AND tbl_members.Status = 1;";

                                                            $resultselecting = $db->query($selectingsql);
                                                            $rowselecting = $resultselecting->fetch_assoc();
                                                            $Bookcount = $rowselecting['Bookcount'];
                                                            $defincecount = $rowselecting['defincecount'];
                                                            $availablecount = ($Bookcount == 0) ? $defincecount : ($defincecount - $Bookcount);
                                                        ?>

                                                        <td><?= $Bookcount ?></td>
                                                        <td> <?php echo ($Bookcount == 0) ? $defincecount : $availablecount ?> </td>
                                                    </tbody>



                                            <?php
                                                        }
                                                    } else {
                                                        echo "no date selected";
                                                    }
                                            ?>
                                            </table>



                                    </div>
                                </div>

                                <?php
                                $sqloffered = "SELECT * FROM tbl_member_assign_dates INNER JOIN tbl_timeslot ON tbl_member_assign_dates.timeslotidforday = tbl_timeslot.slot_id WHERE tbl_member_assign_dates.membeRID = '$id';";
                                $resultoffered = $db->query($sqloffered);
                                if ($resultoffered->num_rows == null) {
                                ?>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Offering Dates</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php
                                            // showing the available days session
                                            $sql = "SELECT * FROM tbl_timeslot";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            if ($result->num_rows > 0) {

                                                ///
                                                // $groupedData = [];

                                                // foreach ($result as $item) {
                                                //     $groupId = $item['day_Id'];
                                                //     if (!isset($groupedData[$groupId])) {
                                                //         $groupedData[$groupId] = [];
                                                //     }
                                                //     $groupedData[$groupId][] = $item;
                                                // }
                

                                            // Now $groupedData will contain separate arrays with unique group IDs
                                            // print_r($groupedData);
                                                ///

                                               


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
                                                    $flag = 0;
                                                    if ($availableCount <= 0 || in_array($slotlist['slot_id'], $checked)) {
                                                        $flag = 1;
                                                    }

                                                    

                                            ?>
                                                    <div>
                                                        <?php if ($availableCount > 0) { ?>
                                                            <input class="datemax" id="<?= $slotlist['day_Id']; ?>" onclick="handleCheck(this, <?= $flag; ?>)" type="checkbox" name="slots[]" value="<?= $slotlist['slot_id'] ?>" <?php
                                                                                                                                                                                                                                    if ($availableCount <= 0 || in_array($slotlist['slot_id'], $checked)) {
                                                                                                                                                                                                                                        echo "disabled readonly";
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                    ?> />
                                                            <?= $slotlist['session_name']; ?>
                                                        <?php
                                                            if ($availableCount <= 0) {
                                                                echo "(Fully Booked)";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                            <?php
                                                }
                                            } else {
                                                echo "slot is not selected";
                                            }
                                            ?>
                                            <div class="text-danger"> <?= @$messages['error_mWeight']; ?></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <button type="submit" name="action" value="slot_save" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <!--    <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <p>You have already booked slots. You cannot make additional bookings at this time.</p>
                                            </div>
                                        </div>-->
                                <?php
                                }
                                ?>


                        </form>


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
                                    $sqloffered = "SELECT * FROM tbl_member_assign_dates INNER JOIN tbl_timeslot on tbl_member_assign_dates.timeslotidforday= tbl_timeslot.slot_id WHERE tbl_member_assign_dates.membeRID='$id';";
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
                                                                                                                                                                ?>
                                                </tr>
                                        </tbody>
                                </table>
                            </div>
                        </section>

                        <?php
                        $sqloffered = "SELECT * FROM tbl_member_assign_dates INNER JOIN tbl_timeslot on tbl_member_assign_dates.timeslotidforday= tbl_timeslot.slot_id WHERE tbl_member_assign_dates.membeRID='$id';";
                        $resultoffered = $db->query($sqloffered);
                        if ($resultoffered->num_rows == null) {
                        } else {
                        ?>
                            <section>
                                <form action="gymdates_updates.php" method="POST">
                                    <input type="hidden" name="customerid" value="<?= $id ?>">
                                    <button type="submit" name="action" value="">Update</button>
                                </form>

                            </section><?php
                                    }
                                        ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>


    </div>
</main>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<meta charset=utf-8 />
<script>
    function handleCheck(checkbox, flag) {
        //        console.log(checkbox.checked);
        var checkboxes = document.getElementsByClassName('datemax');
        console.log(checkbox.readOnly);
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

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] !== checkbox) {

                    if (checkboxes[i].id == checkbox.id) {
                        checkboxes[i].disabled = false;
                        //                                                                                           

                    }
                }
            }
        }

    }
    $(".datemax").change(function() {
        var count = $(".datemax:enabled:checked").length; // get count of enabled and checked checkboxes

        if (count > 4) {
            alert("Only 4 dates can be checked..!");
            $(this).prop('checked', false); // turn this one off
        }
    });
</script>




<?php include '../footer.php'; ?>
<?php ob_end_flush(); ?>