<?php $attendance = "active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Member Requested Dates</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>attendance/attendance.php" class="btn btn-sm btn-outline-secondary">Attendance</a>
                <!--                <button type="button" class="btn btn-sm btn-outline-secondary">Search Members</button>-->
            </div>

        </div>
    </div>
    <section>
        <div class="container">
            <div class="main-body">
                <div class="row">


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column ">

                                    <div class="table-responsive">
                                        <?php
                                        $sql = "SELECT MemberId FROM tbl_members";
                                        //getting memeber id to get the name list to requested table
                                        $db = dbConn();
                                        $results = $db->query($sql);
                                        ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Member Name</th>
                                                    <th scope="col">Requested Date Slots</th>
                                                    <th scope="col">Offered Date Slots</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($results->num_rows > 0) {
                                                    $i = 1;
                                                    while ($row = $results->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $i ?></td>
                                                            <td><?php
                                                            // create a varibale to assign the memberid 
                                                                $mem = $row['MemberId'];
                                                                // getting full deatils from the member table where the varibale is equal
                                                                $sql22 = "SELECT First_Name, Last_Name  FROM tbl_members WHERE MemberId= '$mem'";
                                                                $db = dbConn();
                                                                $resultzzzz = $db->query($sql22);
                                                                $rowabc = $resultzzzz->fetch_assoc();
                                                                    // eching the all members 
                                                                echo  $rowabc['First_Name'] . " " . $rowabc['Last_Name'];
                                                                // creating a href for  visitng each customer profile 
                                                                ?> <a href="<?= SYSTEM_PATH ?>members/member_profile.php?MemberId=<?= $mem ?>"> View Profile</a>
                                                           
                                                            </td>
                                                            
                                                            <td style="align-items:start ">

                                                                        <?php
                                                                        //creating mvaribale to to assign the member id
                                                                        $membersid = $row['MemberId'];
                                                                        //getting each membres results where in the table memberdate
                                                                        $sql2 = "SELECT * FROM tbl_member_date WHERE memberid='$membersid'";
                                                                        $db = dbConn();
                                                                        $resultz = $db->query($sql2);
                                                                        
                                                                        while ($row = $resultz->fetch_assoc()) {
                                                                            // cretaing empty array to catch the cehckbox id
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
                                                                                // getting data from the foreach and 
                                                                                $dayname = $brandlsit['opendayid'];
                                                                                
                                                                                // getting the data from the open time table where time id equal day nemae
                                                                                // to view the each customers preffere or requested day range
                                                                                $sql3 = "SELECT * FROM tbl_timeslot WHERE slot_id='$dayname'";
                                                                                $resultzz = $db->query($sql3);
                                                                                $rowzz = $resultzz->fetch_assoc();
                                                                                echo ucwords($rowzz['session_name']) . ' --';
                                                                                ?>

                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            echo "no brand selected";
                                                                        }
                                                                        ?> 


                                                            </td>

<!--                                                            <td style="align-items:start ">

                                                                        <?php
                                                                        //creating mvaribale to to assign the member id
                                                                         $membersid;
                                                                        //getting each membres results where in the table memberdate
                                                                        $sql2 = "SELECT * FROM tbl_member_assign_dates WHERE membeRID='$membersid'";
                                                                        $db = dbConn();
                                                                        $resultz = $db->query($sql2);
                                                                        
                                                                        while ($row = $resultz->fetch_assoc()) {
                                                                            // cretaing empty array to catch the cehckbox id
                                                                            $brands[] = $row['timeslotidforday'];
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
                                                                                // getting data from the foreach and 
                                                                                $dayname = $brandlsit['timeslotidforday'];
                                                                                
                                                                                // getting the data from the open time table where time id equal day nemae
                                                                                // to view the each customers preffere or requested day range
                                                                                $sql3 = "SELECT * FROM tbl_member_assign_dates WHERE membeRID='$dayname'";
                                                                                $resultzz = $db->query($sql3);
                                                                                $rowzz = $resultzz->fetch_assoc();
                                                                                echo ucwords($rowzz['timeslotidforday']) . ' --';
                                                                                ?>

                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            echo "Not Yet Assigned";
                                                                        }
                                                                        ?> 


                                                            </td>-->
                                                            <td>
                                                                <?php
//                           $sqloffered="SELECT * FROM tbl_member_assign_dates WHERE membeRID= '$id'";
                           $sqloffered="SELECT * FROM tbl_member_assign_dates INNER JOIN tbl_timeslot on tbl_member_assign_dates.timeslotidforday= tbl_timeslot.slot_id WHERE tbl_member_assign_dates.membeRID='$membersid';";
                           $resultoffered = $db->query($sqloffered);                 
                           if($resultoffered->num_rows == null){
                              echo  $assign="Still Did not assign sessions";
                           }else{?>
                                <?php
                                 while ($rowaa = $resultoffered->fetch_assoc()) {?>
                                    
                               <?= $rowaa['session_name'] ?><?php
                                 }
                                   
                               
                           }
                          
                           ?>
                                                            </td>






                                                        </tr>
                                                        <?php
                                                         $i++;
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div></div></div></div></div></div></div>
    </section>

    
    
        </main>


        <?php include '../footer.php'; ?>       