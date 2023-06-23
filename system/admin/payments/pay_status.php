<?php
include '../../function.php';


echo $memberId=$_GET['memberId'];
echo "<br>";
echo $monthId=$_GET['monthId'];
echo "<br>";
echo $year = $_GET['year'];
echo "<br>";
echo $changestatus = $_GET['changestatus'];

$paymentId = $_GET['paymentId'];
echo "<br>";


$sql="UPDATE tbl_payment SET payment_status = '$changestatus' WHERE  payment_id= '$paymentId'";
$db=dbConn();
$results=$db->query($sql);


        header("location:payments.php");




?>