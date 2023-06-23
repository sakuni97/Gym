<?php $services = "active" ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<main id="main">
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Our Services</h2>
                <p>Explore our services and get to know what we give you!</p>
            </div>

            <?php
            $db = dbConn();
            $sql = "SELECT * FROM tbl_service WHERE Status=1";
            $result = $db->query($sql);
            ?>

            <div class="row gy-5">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>

                        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                            <div class="service-item">
                                <div class="img">
                                    <img src="assets/img/<?= $row['Image'] ?>" class="img-fluid" alt="">
                                </div>
                                <div class="details position-relative">
                                    <div class="icon">
                                        <i class="bi bi-activity"></i>
                                    </div>
                                    <a href="service_details.php?ServiceId=<?= $row['ServiceId'] ?>" class="stretched-link">
                                        <h3><?= $row['Name'] ?></h3>
                                    </a>
                                    <p><?= $row['Description'] ?></p>
                                </div>
                            </div>

                        </div><!-- End Service Item -->
                    <?php }
                } ?>
                

            </div>

        </div>
    </section>
</main>
<?php include 'footer.php'; ?>