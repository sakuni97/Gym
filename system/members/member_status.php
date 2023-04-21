<?php
include '../function.php';

$id=$_GET['MemberId'];
$status = $_GET['Status'];

$sql="UPDATE tbl_members SET Status=$status WHERE MemberId=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:members.php');

?>


