<?php
include 'config.php';
include 'function.php';
extract($_POST);

$db = dbConn();
$sql = "Select * from tbl_members   where MemberId='$pCategory'";
$result = $db->query($sql);
$row = $result->fetch_assoc()
?>


<input type="text" name="namesmember" value="<?= $row['PricingId']?>">


<?php

?>
