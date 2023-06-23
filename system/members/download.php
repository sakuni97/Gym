<?php

include '../function.php';

$memberid = $_GET['memberid'];

        $month_name = $_GET['month_name'];
$db = dbConn();
// fetch file to download from database
$sql = "SELECT * FROM tbl_payment WHERE member_id = '$memberid' and month_id='$month_name'";

$result = $db->query($sql);

$file = mysqli_fetch_assoc($result);
print_r($file);

$filename=$row['payment_slip'];



header("Content-type: ".$file['payment_slip']);
header("Content-length: ".$file['payment_slip']);
header("Content-Disposition: attachment; filename=".$file['payment_slip']);





?>