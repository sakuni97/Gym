<?php
include '../header.php';
//include '../menu.php';

extract($_POST);

if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "addtime") {
    date_default_timezone_set('Asia/Colombo');
    echo $memberid;

    echo $time = date("H:i");

    $date = date("Y-m-d");
    $user = $_SESSION['UserId'];

    echo $sql = "INSERT INTO tbl_attendance(attendance_date, attendace_member_id, attendace_status, checkin_time, added_user, added_date) VALUES ('$date','$memberid','1','$time','$user','$date')";

    $db = dbConn();
    $result = $db->query($sql);
    header('location:attendance.php');
}

extract($_POST);

if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "checkout") {
    date_default_timezone_set('Asia/Colombo');
    echo $memberid;

    echo $time = date("H:i");

    $date = date("Y-m-d");
    $user = $_SESSION['UserId'];

    echo $sql = "UPDATE tbl_attendance SET checkout_time ='$time' where attendace_member_id='$memberid' and attendance_date='$date'";

    $db = dbConn();
    $result = $db->query($sql);

   echo $sqlupdate = "UPDATE tbl_attendance SET attendace_status ='2' where attendace_member_id='$memberid' and attendance_date='$date'";
//    $db = dbConn();
//    $result = $db->query($sqlupdate);

    header('location:attendance.php');
}


extract($_POST);

if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "other") {
    date_default_timezone_set('Asia/Colombo');

    echo $attendance_id;

    echo $time = date("H:i");

    $date = date("Y-m-d");
    $user = $_SESSION['UserId'];

    echo $sql = "UPDATE tbl_attendance SET checkout_time ='$time' where attendance_id='$attendance_id'";

    $db = dbConn();
    $result = $db->query($sql);
    $sqlupdate = "UPDATE tbl_attendance SET attendace_status ='2' where attendance_id='$attendance_id'";

    $db = dbConn();
    $result = $db->query($sqlupdate);

    header('location:attendance.php');
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Attendance</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>attendance/member_requsted_dates.php" class="btn btn-sm btn-outline-secondary">View Member Requested Dates </a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Payment</button>
            </div>

        </div>
    </div>

<?php include '../footer.php'; ?>