<?php

include '../function.php';
extract($_GET);
if ($_SERVER['REQUEST_METHOD'] == "GET") {


    $id = $_GET['MemberId'];
    $status = $_GET['Status'];

    $sql = "UPDATE tbl_members SET Status=$status WHERE MemberId=$id";
    $db = dbConn();
    $results = $db->query($sql);

    header('location:members.php');
}
?>


<?php

extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'update') {

    echo $month;
    echo "<br>";
    echo $amount;
    echo $memberidupdate;

    if (empty($month)) {
        header("location:member_payments.php?MemberId=$memberidupdate&error=month");
    } else {

        $pricingid;
        $cdate = date("Y-m-d");
        $cyear = date("Y");

        echo $sqlinsert = "INSERT INTO tbl_payment(member_id, month_id, payment_date, package_id, payment_amount, payment_year,payment_status, payment_type) VALUES ('$memberidupdate','$month','$cdate','$pricingid','$amount','$cyear','1','Cash')";

        $db = dbConn();
        $result = $db->query($sqlinsert);
        header("location:member_payments.php?MemberId=$memberidupdate&success=true");
    }
}
?>