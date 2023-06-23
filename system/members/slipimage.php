<?php 

include '../function.php';
include '../config.php';

extract($_POST);

$db= dbConn();
$sql= "SELECT * FROM tbl_payment WHERE payment_id='$payment_id' AND month_id='$month_id' AND  member_id = '$member_id'";
$result =$db->query($sql);

$row = $result->fetch_assoc();

 $slipname=$row['payment_slip'];
        
 

?>

<img class="rounded img-fluid" width="100%" src="<?= SYSTEM_PATH ?>assets/images/paymentSlips/<?= $slipname ?>" alt="">