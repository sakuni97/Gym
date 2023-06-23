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
                                <div class="d-flex flex-column">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-column">
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
                                                                    <th scope="col">Defined Count</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if ($resultsa->num_rows > 0) {
                                                                    $i = 1;
                                                                    while ($rowaa = $resultsa->fetch_assoc()) {
                                                                        $idslot = $rowaa['slot_id'];
                                                                        $selectingsql = "SELECT COUNT(tbl_member_assign_dates.membeRID) AS Bookcount, tbl_timeslot.member_count AS definecount FROM tbl_timeslot LEFT JOIN tbl_member_assign_dates ON tbl_member_assign_dates.timeslotidforday = tbl_timeslot.slot_id INNER JOIN tbl_members ON tbl_members.MemberId = tbl_member_assign_dates.membeRID WHERE tbl_member_assign_dates.timeslotidforday = '$idslot' AND tbl_members.Status = 1;";
                                                                        $definecountsql = "SELECT member_count AS definecount FROM tbl_timeslot WHERE slot_id='$idslot'";

                                                                        $resultdefinetimeslot = $db->query($definecountsql);
                                                                        $resultselecting = $db->query($selectingsql);

                                                                        $rowselecting = $resultselecting->fetch_assoc();
                                                                        $rowdefinetimeslot = $resultdefinetimeslot->fetch_assoc();

                                                                        if (!empty($rowselecting['Bookcount'])) {
                                                                            $bookCount = $rowselecting['Bookcount'];
                                                                        } else {
                                                                            $bookCount = 0;
                                                                        }

                                                                        $definedCount = $rowdefinetimeslot['definecount'];
                                                                        $availableCount = ($bookCount == 0) ? $definedCount : ($definedCount - $bookCount);
                                                                        ?>
                                                                        <tr>
                                                                            <td style="align-items:start "><?= $i ?></td>
                                                                            <td><?= $rowaa['session_name'] ?></td>
                                                                            <td><?= $rowaa['slot_start_time'] ?></td>
                                                                            <td><?= $rowaa['slot_end_time'] ?></td>
                                                                            <td><?= $bookCount ?></td>
                                                                            <td><?= $availableCount ?></td>
                                                                            <td>
                                                                                <form method="POST" action="update_defined_count.php">
                                                                                    <input type="hidden" name="slot_id" value="<?= $rowaa['slot_id'] ?>">
                                                                                    <input type="number" name="defined_count" id="defined_count" value="<?= $definedCount ?>" min="0">
                                                                                    <button type="submit">Update</button>
                                                                                </form>

                                                                                <script>
                                                                                    // Add event listener to the defined_count input
                                                                                    document.getElementById("defined_count").addEventListener("input", function () {
                                                                                        var input = this;
                                                                                        var value = parseFloat(input.value);

                                                                                        // Check if the entered value is negative
                                                                                        if (value < 0) {
                                                                                            // Set the value to 0
                                                                                            input.value = 0;
                                                                                        }
                                                                                    });
                                                                                </script>

                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $i++;
                                                                        $definedCount = 0;
                                                                    }
                                                                } else {
                                                                    // Handle the case when there are no results
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="6">No data available</td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</main>


<?php include '../footer.php'; ?>       