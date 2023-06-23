<?php
include '../../config.php';
include '../../function.php';
extract($_POST);

$db = dbConn();
$sql = "Select * from tbl_members   where MemberId='$memberid'";
$result = $db->query($sql);
$row = $result->fetch_assoc()
?>


<div class="mb-3">
    <label for="package" class="form-label">Package</label>
    <input type="text" class="form-control" id="package" name="package" value="<?= $row['Nic'] ?>">
    <div class="text-danger"><?= @$messages['error_sDesc']; ?></div>
</div>

<div class="mb-3">
    <label for="amount" class="form-label">Amount</label>
    <input type="text" class="form-control" id="amount" name="amount" value="<?= $row['Dob'] ?>">
    <div class="text-danger"><?= @$messages['error_sDesc']; ?></div>
</div>



<?php
?>
