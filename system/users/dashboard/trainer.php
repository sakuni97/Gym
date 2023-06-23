<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/trainer_assets/img/favicon.png" rel="icon">
    <link href="assets/trainer_assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/trainer_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/trainer_assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/trainer_assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/trainer_assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/trainer_assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/trainer_assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/trainer_assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/trainer_assets/css/style.css" rel="stylesheet">
</head>


<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">

            Welcome <?= $_SESSION['UserRole'] . " " . $_SESSION['FirstName'] ?> !


        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>





    <div class="pagetitle">
        <h1>Dashboard</h1>

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?= SYSTEM_PATH ?>trainer_portal/gym_members.php" class="text-decoration-none">Assigned Trainees </a>
                                </h5>
              <!--                  <span>| Today</span>-->

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php
                                            $userID = $_SESSION['UserId'];
                                            $sql = "SELECT count(*) FROM tbl_members WHERE UserId='$userID'";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display data on web page
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo $row['count(*)'] . " " . "Members";
                                            }
                                            ?>
                                        </h6>
                <!--                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>-->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?= SYSTEM_PATH ?>trainer_portal/gym_members.php" class="text-decoration-none">All Trainees</a>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-gender-ambiguous"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php
                                            $userID = $_SESSION['UserId'];
                                            $sql = "SELECT count(*) FROM tbl_members";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display data on web page
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo $row['count(*)'] . " " . "Members";
                                            }
                                            ?>

                                        </h6>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?= SYSTEM_PATH ?>trainer_portal/workout_plans.php" class="text-decoration-none">  Workout Plans </a>
                                </h5>
              <!--                  <span>| Today</span>-->

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-medical"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php
                                            $sql = "SELECT count(*) FROM tbl_workouts";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display data on web page
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo $row['count(*)'] . " " . "Plans";
                                            }
                                            ?>
                                        </h6>
                <!--                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>-->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?= SYSTEM_PATH ?>trainer_portal/meal_plans.php" class="text-decoration-none"> Meal Plans </a>
                                </h5>
              <!--                  <span>| Today</span>-->

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-egg-fried"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php
                                            $userID = $_SESSION['UserId'];
                                            $sql = "SELECT count(*) FROM tbl_mealplans";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display data on web page
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo $row['count(*)'] . " " . "Plans";
                                            }
                                            ?>
                                        </h6>
                <!--                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>-->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Customers Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                    name: 'Sales',
                                                    data: [31, 40, 28, 51, 42, 82, 56],
                                                }, {
                                                    name: 'Revenue',
                                                    data: [11, 32, 45, 32, 34, 52, 41]
                                                }, {
                                                    name: 'Customers',
                                                    data: [15, 11, 32, 18, 9, 24, 11]
                                                }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><a href="#">#2457</a></th>
                                            <td>Brandon Jacob</td>
                                            <td><a href="#" class="text-primary">At praesentium minu</a></td>
                                            <td>$64</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2147</a></th>
                                            <td>Bridie Kessler</td>
                                            <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                                            <td>$47</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2049</a></th>
                                            <td>Ashleigh Langosh</td>
                                            <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                                            <td>$147</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2644</a></th>
                                            <td>Angus Grady</td>
                                            <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                                            <td>$67</td>
                                            <td><span class="badge bg-danger">Rejected</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2644</a></th>
                                            <td>Raheem Lehner</td>
                                            <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                                            <td>$165</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    
                    

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Self <span>| <?= $_SESSION['FirstName'] ?></span></h5>
                        <?php
                        $userID = $_SESSION['UserId'];
                        $sql = "SELECT * FROM tbl_users WHERE UserId='$userID'";
                        $db = dbConn();
                        $result = $db->query($sql);
                        $row= $result->fetch_assoc();

                        // Display data on the web page
                       
                        ?>
                        <img src="<?= SYSTEM_PATH ?>web/assets/img/team/<?= $row['Image'] ?>" class="card-img-top" alt="...">
                        
                            <h5 class="card-title"><?= $_SESSION['FirstName']. " " . $_SESSION['LastName'] ?></h5>
                            <p class="card-text"><?= $_SESSION['UserRole'] ?> in Life Fitness Gym </p>
                        </div>
                    </div>
                </div>

                <!-- End Recent Activity -->

                

                

            </div>
    </section>

</main><!-- End #main -->


<!-- Vendor JS Files -->
<script src="trainer_assets/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="trainer_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="trainer_assets/assets/vendor/chart.js/chart.umd.js"></script>
<script src="trainer_assets/assets/vendor/echarts/echarts.min.js"></script>
<script src="trainer_assets/assets/vendor/quill/quill.min.js"></script>
<script src="trainer_assets/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="trainer_assets/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="trainer_assets/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="trainer_assets/assets/js/main.js"></script>