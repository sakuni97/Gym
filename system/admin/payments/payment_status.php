<?php

ob_start();
include '../../function.php';

echo $memberId = $_GET['memberId'];
echo "<br>";
echo $monthId = $_GET['monthId'];
echo "<br>";
echo $year = $_GET['year'];
echo "<br>";
echo $changestatus = $_GET['changestatus'];
echo "<br>";
$paymentId = $_GET['paymentId'];

if ($changestatus === "--") {
    echo "can not updated";
} else {

    if ($changestatus == 2) {
        header("location:reasons.php?MemberId=$memberId&Month=$monthId&Year=$year&paymentId=$paymentId");
    } else {
        $sql = "UPDATE tbl_payment SET payment_status = '$changestatus' WHERE  payment_id= '$paymentId'";
        $db = dbConn();
        $results = $db->query($sql);
        header("location:payments.php?MemberId=$memberId");
    }
}
?>


<?php ob_end_flush(); ?>