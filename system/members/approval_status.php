<?php
include '../function.php';

$memberid=$_GET['MemberId'];
$approval_status = $_GET['Approval_Status'];
 
$sql="UPDATE tbl_members SET Approval_Status=$approval_status WHERE MemberId=$memberid";
$db=dbConn();
$results=$db->query($sql);

        header('location: member_payments.php?MemberId='.$memberid);

?>

