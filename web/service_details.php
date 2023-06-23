<?php $services="active" ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<main id="main">
    <?php 
    if($_SERVER['REQUEST_METHOD']=="GET") {
        extract($_GET);
        $db= dbConn();
        $sql = "SELECT * FROM tbl_service WHERE ServiceId='$ServiceId'";
        $result=$db->query($sql);
        $row=$result->fetch_assoc();
    }
    ?>
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

<!--        <div class="section-header">
          <h2>About Us</h2>
          <p>Architecto nobis eos vel nam quidem vitae temporibus voluptates qui hic deserunt iusto omnis nam voluptas asperiores sequi tenetur dolores incidunt enim voluptatem magnam cumque fuga.</p>
        </div>-->

        <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-5">
            <div class="about-img">
              <img src="assets/img/<?= $row['Image'] ?>" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-7">
            <h3 class="pt-0 pt-lg-5"><?= $row['Name'] ?></h3>

<!--             Tabs 
            <ul class="nav nav-pills mb-3">
              <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">Saepe fuga</a></li>
              <li><a class="nav-link" data-bs-toggle="pill" href="#tab2">Voluptates</a></li>
              <li><a class="nav-link" data-bs-toggle="pill" href="#tab3">Corrupti</a></li>
            </ul> End Tabs -->

            <!-- Tab Content -->
            <div class="tab-content">

              <div class="tab-pane fade show active" id="tab1">

                <p class="fst-italic"><?= $row['Description'] ?></p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Training</h4>
                </div>
                <p>One-to-One Training is a personalized approach to fitness that focuses on individualized attention and guidance within a gym setting. It involves working closely with a qualified personal trainer who tailors workouts and exercises to meet the unique goals and needs of each client. </p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Fitness</h4>
                </div>
                <p>Fitness checkup is a comprehensive evaluation conducted to assess an individual's overall physical fitness and health status. It typically involves a series of tests, measurements, and assessments that provide valuable insights into one's cardiovascular endurance, strength</p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Crossfit</h4>
                </div>
                <p>CrossFit is a high-intensity fitness program that combines elements of weightlifting, cardio, and functional movements. It emphasizes varied workouts that challenge individuals both physically and mentally. </p>

              </div><!-- End Tab 1 Content -->

              

            </div>

          </div>

        </div>

      </div>
    </section>
</main>
<?php include 'footer.php'; ?>