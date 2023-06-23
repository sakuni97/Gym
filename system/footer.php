    </div>
</div>

<script src="<?= SYSTEM_PATH ?>assets/js/jquery.min.js.js" type="text/javascript"></script>
<script src="<?= SYSTEM_PATH ?>assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="<?= SYSTEM_PATH ?>assets/js/feather.min.js" type="text/javascript"></script>
<script src="<?= SYSTEM_PATH ?>assets/js/Chart.min.js" type="text/javascript"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

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

<script>
var xValues = ["Samsung", "Nokia", "Huawei", "Xiamoi", "Apple"];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChartpie", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Category wise Sales",
      
    }
  }
});
</script>

<script>

/* globals Chart:false, feather:false */

(() => {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  const ctx = document.getElementById('myCharta')
  // eslint-disable-next-line no-unused-vars
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
      ],
      datasets: [{
        data: [
          
          
          234890,
          240030,
          184830,
          213450,
          153390,
          240920,
          120340
        ],
        lineTension: 0,
             backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
        borderColor: '#007bff',
        borderWidth: 2,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      },title: {
      display: true,
      text: "Last 7 days Sales",
      
    }
    }
  })
})()



</script>

<script>
var xValues = ["Good", "Bad"];
var yValues = [55, 10];
var barColors = [
 
  "#00aba9",
   "#b91d47"
  
];

new Chart("myChartqq", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Reviews Report"
    }
  }
});
</script>


<!-- shopowner reports starts -->
<script>

/* globals Chart:false, feather:false */

(() => {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  const ctx = document.getElementById('myChart1')
  // eslint-disable-next-line no-unused-vars
  const myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'January',
        'February',
        'March',
        'Aprill',
        'May',
        'June',
        
      ],
      datasets: [{
        data: [
          3,
          12,
          10,
          0,
          2,
          1
          
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
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      },title: {
      display: true,
      text: "Monthly Registrations",
      
    }
    }
  })
})()



</script>

<script>
var xValues = ["Present", "Absent"];
var yValues = [05, 08];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart2", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Summery of Today Attendace",
      
    }
  }
});
</script>

<script>

/* globals Chart:false, feather:false */

(() => {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  const ctx = document.getElementById('myChart3')
  // eslint-disable-next-line no-unused-vars
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
      'January',
        'February',
        'March',
        'Aprill',
        'May',
        'June',
      ],
      datasets: [{
        data: [
          
          
          234890,
          240030,
          184830,
          213450,
          153390,
          240920,
          120340
        ],
        lineTension: 0,
             backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
        borderColor: '#007bff',
        borderWidth: 2,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      },title: {
      display: true,
      text: "Monthly Income Report",
      
    }
    }
  })
})()



</script>


<script>

/* globals Chart:false, feather:false */

(() => {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  const ctx = document.getElementById('myChart5')
  // eslint-disable-next-line no-unused-vars
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
       'January',
        'February',
        'March',
        'Aprill',
        'May',
        'June',
      ],
      datasets: [{
        data: [
          
          
          150000,
          160000,
          80000,
          140000,
          60000,
          200000,
          50000
        ],
        lineTension: 0,
             backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
        borderColor: '#007bff',
        borderWidth: 2,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      },title: {
      display: true,
      text: "Monthly Expenses Report",
      
    }
    }
  })
})()



</script>

<script>

/* globals Chart:false, feather:false */

(() => {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  const ctx = document.getElementById('myChart6')
  // eslint-disable-next-line no-unused-vars
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        'January',
        'February',
        'March',
        'Aprill',
        'May',
        'June',
      ],
      datasets: [{
        data: [
          
          
          80000,
          90000,
          100000,
          70000,
          90000,
          40000,
          70000
        ],
        lineTension: 0,
             backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
        borderColor: '#007bff',
        borderWidth: 2,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      },title: {
      display: true,
      text: "Monthly Profit Report",
      
    }
    }
  })
})()



</script>

<script>
var xValues = ["Men", "Women"];
var yValues = [55, 40];
var barColors = [
 
  "#00aba9",
   "#b91d47"
  
];

new Chart("myChart4", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Reviews Report"
    }
  }
});
</script>

<script>
var xValues = ["Colombo", "Gampaha", "Kelaniya", "Horana", "Kottawa"];
var yValues = [20,35, 54, 44, 35];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart7", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "City wise Sales",
      
    }
  }
});
</script>



    </body>
</html>