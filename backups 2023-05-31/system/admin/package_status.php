<?php
include '../function.php';


$id=$_GET['PricingId'];
$status = $_GET['Status'];
 
$sql="UPDATE tbl_pricing SET Status=$status WHERE PricingId=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:pricing_packages.php');




?>
