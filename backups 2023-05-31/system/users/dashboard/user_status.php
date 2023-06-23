<?php
ob_start();
include '../../function.php';


$id=$_GET['UserId'];
$status = $_GET['Status'];
 
$sql="UPDATE tbl_users SET Status=$status WHERE UserId=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:../../index.php');


        ob_end_flush();
?>
