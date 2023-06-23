<!DOCTYPE html>
<html>

    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'update') {

        $db = dbConn();
        $sql = "SELECT * FROM tbl_members WHERE MemberId='$MemberId'";
        $results = $db->query($sql);
        $row = $results->fetch_assoc();

//    echo $MemberId;
    }
    ?>



    <?php $sql = "SELECT tbl_reservations.QueryNo AS queryno, tbl_reservations.ResDate AS rdate, tbl_reservations.ResTime AS rtime,
        tbl_reservations.Status AS stus, tbl_reservations.CounselID AS cid, osms_tbl_counsels.CounselID AS conid,
        osms_tbl_counsels.FirstName AS fn, osms_tbl_counsels.LastName AS ln, tbl_clients.FirstName AS fcnm, tbl_clients.LastName AS lcnm
        FROM tbl_reservations, osms_tbl_counsels,tbl_clients 
        WHERE tbl_reservations.CounselID = osms_tbl_counsels.CounselID AND tbl_clients.ClientID = tbl_reservations.ClientID AND tbl_reservations.Status='3'"; ?>




    <td>
        <?php
        if ($row["UserId"] == 0) {
            echo 'Not Yet assigned';
        } else {
            $trainer = $row["UserId"];
            $sqlw = "SELECT * FROM tbl_users WHERE  UserId=$trainer";
            $db = dbConn();
            $resultD = $db->query($sqlw);
            $rowUPDATE = $resultD->fetch_assoc();
        }
        ?>   <?php if ($row["UserId"] != 0) {
            echo $rowUPDATE['FirstName'];
        } ?></td>


    <!-- filter for members -->
    <?php
// Check if filters are set
    $filter_status = isset($_POST['filter_status']) ? $_POST['filter_status'] : '';

// Build the SQL query
    $db = dbConn();
    $sql = "SELECT * FROM tbl_members";

// Add the filter conditions if filter_status is provided
    if ($filter_status !== '') {
        // Escape the input to prevent SQL injection
        $filter_status = mysqli_real_escape_string($db, $filter_status);

        // Append the filter condition to the SQL query
        if ($filter_status === '0') {
            $sql .= " WHERE (Approval_Status = '$filter_status' OR Approval_Status IS NULL)";
        } else {
            $sql .= " WHERE Approval_Status = '$filter_status'";
        }
    }

    $result = $db->query($sql);
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <label for="filter_status">Filter by Status:</label>
        <select name="filter_status" id="filter_status">
            <option value="">--</option>
            <option value="0"<?php echo ($filter_status === '0') ? " selected" : ""; ?>>Pending</option>
            <option value="1"<?php echo ($filter_status === '1') ? " selected" : ""; ?>>Approved</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <!--sir filter-->
    <?php
    $sql = "SELECT * FROM tbl_members";
    $db = dbConn();

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $sql = "SELECT * FROM tbl_members WHERE First_Name LIKE '%$search%' OR Nic LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM tbl_members";
    }
    $result = $db->query($sql);
    //filter
    extract($_POST);
    $where = null;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $where = " WHERE Approval_Status='$status'";
    }
    echo $sql = "SELECT * FROM tbl_members $where";
    $db = dbConn();

    $result = $db->query($sql);
    ?>

    <!-- filter -->
    <th scope="col">

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <select name="status" onchange="form.submit()">
                <option value="">--</option>
                <option value="1">Approved</option>
                <option value="0">Pending</option>
            </select>
        </form>
        Membership
    </th>