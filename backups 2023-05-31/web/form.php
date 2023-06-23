<!DOCTYPE html>
<html>
<head>
	<title>BMI Calculator</title>
	<style>
		/* Styles for popup form */
		.popup {
			display: none;
			position: fixed;
			z-index: 1;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgba(0, 0, 0, 0.4);
		}

		.popup-content {
			background-color: #fefefe;
			margin: 15% auto;
			padding: 20px;
			border: 1px solid #888;
			width: 30%;
			text-align: center;
			border-radius: 10px;
			box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
		}

		.close {
			color: #aaa;
			float: right;
			font-size: 28px;
			font-weight: bold;
			margin-top: -10px;
			margin-right: -10px;
			cursor: pointer;
		}

		.close:hover,
		.close:focus {
			color: black;
			text-decoration: none;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<button onclick="openPopup()">Calculate BMI</button>

	<!-- Popup form for BMI calculator -->
	<div id="popup-form" class="popup">
		<div class="popup-content">
			<span class="close" onclick="closePopup()">&times;</span>
			<h2>BMI Calculator</h2>
			<form action="bmi.php" method="POST">
				<label for="weight">Weight (kg):</label><br>
				<input type="number" id="weight" name="weight"><br><br>
				<label for="height">Height (cm):</label><br>
				<input type="number" id="height" name="height"><br><br>
				<input type="button" value="Calculate" onclick="calculateBMI()">
				<div id="result"></div>
			</form>
		</div>
	</div>

	<script>
		// Open the popup form
		function openPopup() {
			document.getElementById("popup-form").style.display = "block";
		}

		// Close the popup form
		function closePopup() {
			document.getElementById("popup-form").style.display = "none";
		}

		// Calculate the BMI and display the result
		function calculateBMI() {
			var weight = document.getElementById("weight").value;
			var height = document.getElementById("height").value / 100; // convert cm to m
			var bmi = weight / (height * height);
			document.getElementById("result").innerHTML = "<h2>Your BMI is: " + bmi.toFixed(2) + "</h2>";
		}
	</script>
</body>
</html>
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



<?php $sql="SELECT tbl_reservations.QueryNo AS queryno, tbl_reservations.ResDate AS rdate, tbl_reservations.ResTime AS rtime,
        tbl_reservations.Status AS stus, tbl_reservations.CounselID AS cid, osms_tbl_counsels.CounselID AS conid,
        osms_tbl_counsels.FirstName AS fn, osms_tbl_counsels.LastName AS ln, tbl_clients.FirstName AS fcnm, tbl_clients.LastName AS lcnm
        FROM tbl_reservations, osms_tbl_counsels,tbl_clients 
        WHERE tbl_reservations.CounselID = osms_tbl_counsels.CounselID AND tbl_clients.ClientID = tbl_reservations.ClientID AND tbl_reservations.Status='3'"; ?>




<?php
                                                
                                                ?>

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
                                ?>   <?php if($row["UserId"] != 0){ echo $rowUPDATE['FirstName']; }?></td>