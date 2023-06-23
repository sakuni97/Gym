<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Member Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>members/members.php" class="btn btn-sm btn-outline-secondary">View All Members</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Members</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Members
            </button>
        </div>
    </div>


<?php
// getting data from the member member profile page
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action = 'slot_save') {
   extract($_POST); 
    
   echo  $memberid=$memberidfordate;
    $db = dbConn();
    
//    sending each record to  database which means assign the days to the customers to come to gym
//    
     foreach ($slots as $value) {
             echo    $sql = "INSERT INTO tbl_member_assign_dates(membeRID,opendaYID) VALUES ('$memberid','$value')";
                $db->query($sql);
            }
            
            header("Location:member_profile.php?MemberId=$memberid");
    
    
    
    
}
?>





<?php include '../footer.php'; ?> 
<?php ob_end_flush(); ?>