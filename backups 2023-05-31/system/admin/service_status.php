<?php
include '../function.php';


$id=$_GET['ServiceId'];
$status = $_GET['Status'];
 
$sql="UPDATE tbl_service SET Status=$status WHERE ServiceId=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:services.php');




?>