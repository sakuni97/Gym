<?php $gender_report = "active" ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Gender Report</h1>
    </div>

    <?php
    $db = dbConn();
    $genderSql = "SELECT Gender, COUNT(*) as count FROM tbl_members WHERE Status = 1 AND Approval_Status = 1 GROUP BY Gender";
    $genderResult = $db->query($genderSql);

    // Store gender and count data in separate arrays
    $genders = [];
    $counts = [];

    while ($row = $genderResult->fetch_assoc()) {
        $gender = $row['Gender'];
        $count = $row['count'];

        $genders[] = $gender;
        $counts[] = $count;
    }

    // Close the database connection
    $db->close();
    ?>

    <div id="chartContainer" style="width: 800px; height: 400px; margin: 0 auto;">
        <canvas id="genderChart"></canvas>
    </div>

    <div id="countContainer" style="text-align: center; margin-top: 20px;">
        <h3>Gender Count:</h3>
        <p>Male: <span id="maleCount"></span></p>
        <p>Female: <span id="femaleCount"></span></p>
    </div>


   <script>
    // Create a pie chart using Chart.js
    var genders = <?php echo json_encode($genders); ?>;
    var counts = <?php echo json_encode($counts); ?>;
    var maleCountElement = document.getElementById('maleCount');
    var femaleCountElement = document.getElementById('femaleCount');
    var ctx = document.getElementById('genderChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: genders,
            datasets: [{
                data: counts,
                backgroundColor: ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Gender Distribution'
            },
            legend: {
                display: true,
                position: 'bottom'
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
                        return genders[tooltipItem.index] + ': ' + currentValue + ' (' + percentage + '%)';
                    }
                }
            },
            plugins: {
                datalabels: {
                    color: '#fff',
                    anchor: 'end',
                    align: 'start',
                    formatter: function (value, context) {
                        var dataset = context.dataset;
                        var label = context.chart.data.labels[context.dataIndex];
                        var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var percentage = Math.floor(((value / total) * 100) + 0.5);
                        return label + ': ' + value + ' (' + percentage + '%)';
                    }
                }
            }
        }
    });

    // Update the count values
    maleCountElement.textContent = counts[0];
    femaleCountElement.textContent = counts[1];
</script>



    <?php include '../../footer.php'; ?>
</main>
