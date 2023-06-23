<?php $package_report = "active" ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Member details according to the Pricing Packages</h1>

    </div>
    <br>

    <?php
    $db = dbConn();

// Retrieve pricing packages
    $pricingSql = "SELECT Package_Name FROM tbl_pricing";
    $pricingResult = $db->query($pricingSql);

// Retrieve member details based on the selected pricing package
    $selectedPackage = isset($_GET['package']) ? $_GET['package'] : '';

    if (!empty($selectedPackage)) {
        $membersSql = "SELECT * FROM tbl_members WHERE PricingId = (SELECT PricingId FROM tbl_pricing WHERE Package_Name = '$selectedPackage') AND Status = 1 AND Approval_Status = 1";
    } else {
        $membersSql = "SELECT * FROM tbl_members WHERE Status = 1 AND Approval_Status = 1";
    }
    $membersResult = $db->query($membersSql);
    ?>



    <div>
        <label>Select the Pricing package</label>
        <form method="get" action="">
            <select class="col-md-3" name="package" onchange="this.form.submit()">
                <option value="">All Packages</option>
                <?php
                while ($row = $pricingResult->fetch_assoc()) {
                    $package_name = $row['Package_Name'];
                    if ($package_name == $selectedPackage) {
                        echo "<option value='$package_name' selected>$package_name</option>";
                    } else {
                        echo "<option value='$package_name'>$package_name</option>";
                    }
                }
                ?>
            </select>
        </form>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">NIC</th>
                    <th scope="col">City</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($membersResult && $membersResult->num_rows > 0) {
                    $count = 1;
                    while ($row = $membersResult->fetch_assoc()) {
                        $first_name = $row['First_Name'];
                        $last_name = $row['Last_Name'];
                        $nic = $row['Nic'];
                        $city = $row['City'];

                        echo "<tr>";
                        echo "<td>$count</td>";
                        echo "<td>$first_name</td>";
                        echo "<td>$last_name</td>";
                        echo "<td>$nic</td>";
                        echo "<td>$city</td>";
                        echo "</tr>";

                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='5'>No members found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-warning" onclick="printPDF()">Print PDF</button>
    </div>
    <div id="content">

        <div id="chartContainer">
            <canvas id="packageChart" style="width:1076px; height:250px;"></canvas>
        </div>

        <?php
        $db = dbConn();
        // Retrieve pricing packages
        $pricingSql = "SELECT Package_Name FROM tbl_pricing";
        $pricingResult = $db->query($pricingSql);

        // Create an array to store the package names and their corresponding member counts
        $packageData = array();

        // Iterate through the pricing packages
        while ($row = $pricingResult->fetch_assoc()) {
            $packageName = $row['Package_Name'];

            // Query the database to get the count of members for the current pricing package
            $countSql = "SELECT COUNT(*) as memberCount FROM tbl_members WHERE PricingId = (SELECT PricingId FROM tbl_pricing WHERE Package_Name = '$packageName')";
            $countResult = $db->query($countSql);

            // Fetch the count and store it in the array
            $countRow = $countResult->fetch_assoc();
            $memberCount = $countRow['memberCount'];
            $packageData[$packageName] = $memberCount;
        }

        // Calculate the total number of members
        $totalMembers = array_sum($packageData);

        // Generate the JavaScript code for the pie chart
        $chartData = "var ctx = document.getElementById('packageChart').getContext('2d');
    var packageChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: " . json_encode(array_keys($packageData)) . ",
            datasets: [{
                data: " . json_encode(array_values($packageData)) . ",
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)'
                    // Add more colors if needed
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Member Distribution by Pricing Package'
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                        return percentage + '%';
                    }
                }
            }
        }
    });";

        // Output the JavaScript code
        echo "<script>
        var chartContainer = document.getElementById('chartContainer');
        var chartCanvas = document.createElement('canvas');
        chartCanvas.id = 'packageChart';
        chartContainer.innerHTML = '';
        chartContainer.appendChild(chartCanvas);

        $chartData
    </script>";

        // Close the database connection
        $db->close();
        ?>

    </div>

    






</main>

<?php include '../../footer.php'; ?>