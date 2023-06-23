<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<?php
// update_defined_count.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted using POST method

    // Retrieve the slot ID and defined count from the form
    $slotId = $_POST['slot_id'];
    $definedCount = $_POST['defined_count'];

    // Perform any necessary validations on the input values

    // Update the defined count in the database
    $db = dbConn();
    $definedCount = mysqli_real_escape_string($db, $definedCount);
    $updateSql = "UPDATE tbl_timeslot SET member_count = '$definedCount' WHERE slot_id = '$slotId'";
    $db->query($updateSql);

    // Redirect the user back to the page where the table is displayed
    header("Location: slot_management.php");
    exit();
}
?>

<?php include '../footer.php'; ?>   
<?php ob_end_flush(); ?>
