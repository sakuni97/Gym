<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET") {
        $MemberIdedit = isset($_GET['MemberId']) ? $_GET['MemberId'] : $_POST['MemberId'];

        $db = dbConn();
        $sql = "SELECT * FROM tbl_members WHERE MemberId='$MemberIdedit'";
        $results = $db->query($sql);
        $row = $results->fetch_assoc();

        $id = $row['MemberId'];
    }
 ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"> <?php echo  $row['First_Name'] . " " . $row['Last_Name'] ?>'s Gym Dates</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>members/members.php" class="btn btn-sm btn-outline-secondary">View All Members</a>

            </div>
            <!--            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar" class="align-text-bottom"></span>
                            Update Members
                        </button>-->
        </div>
    </div>

    


   

    <div class="container">
        <div class="main-body">
            <div class="row">
             
                        <div class="col-sm-12">
                            <div class="card">
                                
<!--                                sending form data to requested php -->
                                <form action="requested.php" method="post">
<!--                                    sending memberid to identify whcich member to has to clarify-->
                                    <input type="hiiden" name="memberidfordate" value="<?= $id ?>">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Requested Dates</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">


                                         
                                            
                                            <?php
                                            // requested dates retrive krla pennanwawa mthana
                                            $sql2 = "SELECT * FROM tbl_member_date WHERE memberid='$id'";
                                            $db = dbConn();
                                            $resultz = $db->query($sql2);
                                            while ($row = $resultz->fetch_assoc()) {
                                                $brands[] = $row['opendayid'];
                                            }
                                            ?>

                                            <?php
                                            if ($resultz->num_rows > 0) {
                                                foreach ($resultz as $brandlsit) {
                                                    $checked = [];
                                                    if (isset($_POST['brands'])) {
                                                        $checked = $_POST['brands'];
                                                    }
                                                    ?>


                                                    <?php
                                                    $dayname = $brandlsit['opendayid'];

                                                    $sql3 = "SELECT * FROM tbl_open_time WHERE time_id='$dayname'";
                                                    $resultzz = $db->query($sql3);
                                                    $rowzz = $resultzz->fetch_assoc();
                                                    echo ucwords($rowzz['time_name']) . ' --';
                                                    ?>

                                                    <?php
                                                }
                                            } else {
                                                echo "no date selected";
                                            }
                                            ?> 



                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Offering Dates</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php
//                                            showing the available days session
                                            $sql = "SELECT * FROM tbl_open_time";
                                            $db = dbConn();
                                            $result = $db->query($sql);
                                            ?>

                                            <?php
                                            if ($result->num_rows > 0) {
                                                foreach ($result as $slotlist) {
                                                    $checked = [];
                                                    if (isset($_POST['slots'])) {
                                                        $checked = $_POST['slots'];
                                                    }
                                                    ?>
                                                    <div>
                                                        <input class="datemax" id="datemax" type="checkbox" name="slots[]" value="<?= $slotlist['time_id'] ?>" <?php
                                            if (in_array($slotlist['time_id'], $checked)) {
                                                echo "checked";
                                            }
                                                    ?> />
                                                               <?= $slotlist['time_name']; ?>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                echo "slot is not selected";
                                            }
                                            ?> 
                                            <div class="text-danger"> <?= @$messages['error_mWeight']; ?></div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <button type="submit" name="action" value="slot_save" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                    </form>
        
                                
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>


    </div>
</main>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<meta charset=utf-8 />
<script>
    $(".datemax").change(function () {
        var count = $(".datemax:checked").length; //get count of checked checkboxes

        if (count > 4) {
            alert("Only 4 date can be checked..!");
            $(this).prop('checked', false); // turn this one off
        }
    });
</script>



<?php include '../footer.php'; ?> 
<?php ob_end_flush(); ?>