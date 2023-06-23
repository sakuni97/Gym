    </div>
</div>
<script src="<?= SYSTEM_PATH ?>assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="<?= SYSTEM_PATH ?>assets/js/feather.min.js" type="text/javascript"></script>
<script src="<?= SYSTEM_PATH ?>assets/js/Chart.min.js" type="text/javascript"></script>

<?php 
 $db = dbConn();
 $sql = "SELECT COUNT(MemberId) AS mem_total, MONTHNAME(Joined_Date) AS reg_month FROM `tbl_members` GROUP BY MONTHNAME(Joined_Date)";
 $result = $db->query($sql);
 
 $data_label = array();
 $data_value = array();
 
 while($row=$result->fetch_assoc()){
     $data_label[]=$row['reg_month'];
     $data_value[]=$row['mem_total'];
 }
// echo "'".implode("','",$data_label)."'";
// echo implode(",",$data_value);
 
?>
<script>
    /* globals Chart:false, feather:false */

(() => {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  const ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  const myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        <?= "'".implode("','",$data_label)."'" ?>
      ],
      datasets: [{
        data: [
          <?= implode(",",$data_value) ?>
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
})()


</script>

    </body>
</html>