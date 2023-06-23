<?php $slot_management = "active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Slot Management</h1>
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
                                        $sqlaa = "SELECT * FROM tbl_timeslot";
                                        $db = dbConn();
                                        $resultsa = $db->query($sqlaa);
                                        ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Slot Name</th>
                                                    <th scope="col">Slot Start Time</th>
                                                    <th scope="col">Slot Start End</th>
                                                    <th scope="col">Booked Counts</th>
                                                    <th scope="col">Available Counts</th>




                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php
                                                    if ($resultsa->num_rows > 0) {
                                                         $i = 1;
                                                        while ($rowaa = $resultsa->fetch_assoc()) {
                                                            
                                                            ?>
                                                            
                                                            <td style="align-items:start "> <?= $i ?> </td>
                                                            <td><?php $dayname=$rowaa['open_day_id'];
                                                            //getting the time slots id to show the starting time and end time
                                                             $sqlee="SELECT * FROM tbl_open_time WHERE time_id='$dayname' ";
                                                             $resultssss = $db->query($sqlee);
                                                             $rowzza = $resultssss->fetch_assoc();
                                                             
                                                             echo ucwords( $rowzza['time_name']);
                                                             
                                                           
                                                            ?> </td>
                                                           
                                                            <td> <?=  $rowaa['slot_start_time'] ?></td>
                                                            <td> <?=  $rowaa['slot_end_time'] ?></td>



                                                        </tr>
                                                    <?php
                                                    $i++;
                                                    
                                                        }}?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div></div></div></div></div></div></div>
            </section>
   
        </main>


        <?php include '../footer.php'; ?>       