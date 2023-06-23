<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php';     ?>

<?php
extract($_POST);
echo $customerid;

$db = dbConn();
$sql = "SELECT * FROM tbl_members WHERE MemberId='$customerid'";
$results = $db->query($sql);
$row = $results->fetch_assoc();

$id = $row['MemberId'];

if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'update') {

    $messages = array();

    if (!isset($slots)) {
        $messages['error_slots'] = "You should select maximum 4 slots!";
    }

    if (empty($messages)) {
        $sqldelete = "DELETE FROM tbl_member_assign_dates WHERE membeRID='$customerid'";
            $db->query($sqldelete);
            
            foreach ($slots as $value) {
                $sqlinsert = "INSERT INTO tbl_member_assign_dates(membeRID,timeslotidforday) VALUES ('$customerid','$value')";
                $db->query($sqlinsert);
            }
    }
}
?>



<?php
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"> <?php echo $row['First_Name'] . " " . $row['Last_Name'] ?>'s Gym Dates Update</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>members/members.php" class="btn btn-sm btn-outline-secondary">View All Members</a>

            </div>
            
        </div>
    </div>

    <div class="row mb-3">


        <div class="col-sm-3">
            <h6 class="mb-0">Offering Dates</h6>


        </div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="col-sm-9 text-secondary">
                <?php
                                            // showing the available days session
                                            $sql = "SELECT * FROM tbl_timeslot";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            if ($result->num_rows > 0) {
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
                                                    <div>
                                                        <input class="datemax" id="datemax" type="checkbox" name="slots[]" value="<?= $slotlist['slot_id'] ?>" <?php
                                                        if ($availableCount <= 0 || in_array($slotlist['slot_id'], $checked)) {
                                                            echo "disabled";
                                                        }
                                                        ?> />
                                                               <?= $slotlist['session_name']; ?>
                                                               <?php
                                                               if ($availableCount <= 0) {
                                                                   echo "(Fully Booked)";
                                                               }
                                                               ?>
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
    <div class="row">

        <div class="col-sm-3"></div>
        <div class="col-sm-9 text-secondary">
            <input type="hidden" name="customerid" value="<?= $customerid ?>">
            <button type="submit" name="action" value="update" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
</main>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
    $(".datemax").change(function () {
        var count = $(".datemax:checked").length; //get count of checked checkboxes

        if (count > 4) {
            alert("Only 4 date can be checked..!");
            $(this).prop('checked', false); // turn this one off
        }
    });
</script>

<?php include '../footer.php'; ?> 
<?php ob_end_flush(); ?>