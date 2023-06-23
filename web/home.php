<section id="hero-animated" class="hero-animated d-flex align-items-center">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
        <img src="assets/img/hero-carousel/go.png" class="img-fluid animated">
        <h2>Welcome to <span>Life Fitness Gym</span></h2>
        <p>Make Fitness Your Priority, because Sweat in the gym is the guarantee stamp for your health</p>

    </div>
</section>

<main id="main">
    
    <style>
    .wrapper2 {
        position: relative;
        height: 1px;
        padding: 0px;
    }

    /* Styling for the open form button */
    #open-form-btn {
        position: fixed;
        bottom: 150px;
        right: 20px;
        background-color: #0ea2bd;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 8%;
        z-index: 10;
        font-size: 18px;
        font-weight: bold;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease;
    }

    #open-form-btn:hover {
        background-color: #0f4c2a;
    }

    
</style>

<div class="wrapper2">
    <span class="border border-secondary">
    <button id="open-form-btn" onclick="navigateToPricing()">Explore Our Pricing Packages</button>
    </span>
</div>

<script>
    function navigateToPricing() {
        window.location.href = "pricing.php";
    }
</script>


    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
        <div class="container">

            <div class="row gy-4">

                <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-activity icon"></i></div>
                        <h4><a href="" class="stretched-link">Convenient. Affordable.</a></h4>

                    </div>
                </div><!-- End Service Item -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                        <h4><a href="" class="stretched-link">Crunch. No judgments.</a></h4>

                    </div>
                </div><!-- End Service Item -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="400">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
                        <h4><a href="" class="stretched-link">Everyone in life needs balance.</a></h4>

                    </div>
                </div><!-- End Service Item -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="600">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-broadcast icon"></i></div>
                        <h4><a href="" class="stretched-link">Do it because they said you couldn’t</a></h4>

                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>
    </section><!-- End Featured Services Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>About Us</h2>
                <p>Take a look at how the Life Fitness Gym has grown so far</p>
            </div>

            <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

                <div class="col-lg-5">
                    <div class="about-img">
                        <img src="assets/img/about_us.jpg" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-lg-7">
                    <h3 class="pt-0 pt-lg-5">WE ARE Helping people live longer, happier and healthier lives for over 20 years.</h3>

                    <!-- Tabs -->
                    <ul class="nav nav-pills mb-3">
                        <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">OUR STORY</a></li>
                        <li><a class="nav-link" data-bs-toggle="pill" href="#tab2">OUR VALUES</a></li>
                        <li><a class="nav-link" data-bs-toggle="pill" href="#tab3">OUR CULTURE</a></li>
                    </ul><!-- End Tabs -->

                    <!-- Tab Content -->
                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="tab1">

                            <p class="fst-italic">Life Fitness Gym was founded in 2002 as a family owned and operated business specialising in supplying high-quality gym equipment at great prices.

                                Instead of being just another gym equipment retailer, our founders wanted to be the best in the industry and set their minds to doing so! Over the last two decades Gym and Fitness has grown into one of Australia’s largest online fitness equipment retailers, helping thousands of customers live longer, happier and healthier lives.</p>



                        </div><!-- End Tab 1 Content -->

                        <div class="tab-pane fade show" id="tab2">

                            <p class="fst-italic">For 20 years helping customers reach their fitness goals has been at the heart of what we do and why we do it! We live and breathe our six core values and four brand promises  — which speak of our commitment to our customers, staff, the industry and our business as a whole.</p>

                            <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2"></i>
                                <h4>Customer Service</h4>
                            </div>
                            <p>Customers are why we exist and we’re passionate about delivering exceptional, personalised customer service to all.</p>

                            <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2"></i>
                                <h4>Teamwork</h4>
                            </div>
                            <p>We’re committed to common goals, with effective communication and accountability making our team achieve greater results.</p>

                            <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2"></i>
                                <h4>Be the change you seek</h4>
                            </div>
                            <p>We believe we should all take ownership and have the courage to lead change, creating a better experience for our people and the customers we serve.</p>

                        </div><!-- End Tab 2 Content -->

                        <div class="tab-pane fade show" id="tab3">

                            <p class="fst-italic">We know that building a positive culture is incredibly important. We believe in encouraging, supporting, challenging, learning and growing to be the best! Our flexible working solutions, gym rebates and educational opportunities create a positive work/life balance for all our employees.</p>


                        </div><!-- End Tab 3 Content -->

                    </div>

                </div>

            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Features Section ======= -->
<!--    <section id="features" class="features">
        <div class="container" data-aos="fade-up">

            <ul class="nav nav-tabs row gy-4 d-flex">

                <li class="nav-item col-6 col-md-4 col-lg-2">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                        <i class="bi bi-binoculars color-cyan"></i>
                        <h4>Modinest</h4>
                    </a>
                </li> End Tab 1 Nav 

                <li class="nav-item col-6 col-md-4 col-lg-2">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                        <i class="bi bi-box-seam color-indigo"></i>
                        <h4>Undaesenti</h4>
                    </a>
                </li> End Tab 2 Nav 

                <li class="nav-item col-6 col-md-4 col-lg-2">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                        <i class="bi bi-brightness-high color-teal"></i>
                        <h4>Pariatur</h4>
                    </a>
                </li> End Tab 3 Nav 

                <li class="nav-item col-6 col-md-4 col-lg-2">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                        <i class="bi bi-command color-red"></i>
                        <h4>Nostrum</h4>
                    </a>
                </li> End Tab 4 Nav 

                <li class="nav-item col-6 col-md-4 col-lg-2">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-5">
                        <i class="bi bi-easel color-blue"></i>
                        <h4>Adipiscing</h4>
                    </a>
                </li> End Tab 5 Nav 

                <li class="nav-item col-6 col-md-4 col-lg-2">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-6">
                        <i class="bi bi-map color-orange"></i>
                        <h4>Reprehit</h4>
                    </a>
                </li> End Tab 6 Nav 

            </ul>

            <div class="tab-content">

                <div class="tab-pane active show" id="tab-1">
                    <div class="row gy-4">
                        <div class="col-lg-8 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                            <h3>Modinest</h3>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                            </ul>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                culpa qui officia deserunt mollit anim id est laborum
                            </p>
                        </div>
                        <div class="col-lg-4 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                            <img src="assets/img/features-1.svg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div> End Tab Content 1 

                <div class="tab-pane" id="tab-2">
                    <div class="row gy-4">
                        <div class="col-lg-8 order-2 order-lg-1">
                            <h3>Undaesenti</h3>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                culpa qui officia deserunt mollit anim id est laborum
                            </p>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Provident mollitia neque rerum asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                            </ul>
                        </div>
                        <div class="col-lg-4 order-1 order-lg-2 text-center">
                            <img src="assets/img/features-2.svg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div> End Tab Content 2 

                <div class="tab-pane" id="tab-3">
                    <div class="row gy-4">
                        <div class="col-lg-8 order-2 order-lg-1">
                            <h3>Pariatur</h3>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                culpa qui officia deserunt mollit anim id est laborum
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Provident mollitia neque rerum asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</li>
                            </ul>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                        </div>
                        <div class="col-lg-4 order-1 order-lg-2 text-center">
                            <img src="assets/img/features-3.svg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div> End Tab Content 3 

                <div class="tab-pane" id="tab-4">
                    <div class="row gy-4">
                        <div class="col-lg-8 order-2 order-lg-1">
                            <h3>Nostrum</h3>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                culpa qui officia deserunt mollit anim id est laborum
                            </p>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                            </ul>
                        </div>
                        <div class="col-lg-4 order-1 order-lg-2 text-center">
                            <img src="assets/img/features-4.svg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div> End Tab Content 4 

                <div class="tab-pane" id="tab-5">
                    <div class="row gy-4">
                        <div class="col-lg-8 order-2 order-lg-1">
                            <h3>Adipiscing</h3>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                culpa qui officia deserunt mollit anim id est laborum
                            </p>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                            </ul>
                        </div>
                        <div class="col-lg-4 order-1 order-lg-2 text-center">
                            <img src="assets/img/features-5.svg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div> End Tab Content 5 

                <div class="tab-pane" id="tab-6">
                    <div class="row gy-4">
                        <div class="col-lg-8 order-2 order-lg-1">
                            <h3>Reprehit</h3>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                culpa qui officia deserunt mollit anim id est laborum
                            </p>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                            </ul>
                        </div>
                        <div class="col-lg-4 order-1 order-lg-2 text-center">
                            <img src="assets/img/features-6.svg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div> End Tab Content 6 

            </div>

        </div>
    </section> End Features Section -->

    <!-- ======= Services Section ======= -->
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
                }
                ?>



            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">

            <div class="testimonials-slider swiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                            <h3>Saul Goodman</h3>
                            <h4>Ceo &amp; Founder</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                            <h3>Sara Wilsson</h3>
                            <h4>Designer</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                            <h3>Jena Karlis</h3>
                            <h4>Store Owner</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                            <h3>Matt Brandon</h3>
                            <h4>Freelancer</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                            <h3>John Larson</h3>
                            <h4>Entrepreneur</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Our Pricing</h2>
                <p>Every member gets a free, personalized Get Started Plan when they join. Our friendly, professional staff is trained to help you along your fitness journey, no matter how much support you need.</p>
            </div>

            <?Php
            $db = dbConn();
            $sql = "SELECT * FROM tbl_pricing WHERE Status=1";
            $result = $db->query($sql);
            ?>

            <div class="row gy-4">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>

                        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="400">
                            <div class="pricing-item featured">

                                <div class="pricing-header">
                                    <h3><?= $row['Package_Name'] ?></h3>
                                    <h4><sup>LKR</sup><?= number_format($row['Price']) ?></h4>
                                    <h5> <span> <?= $row['Months'] ?> Month</span></h5>
                                </div>

                                <ul>
                                    <li><i class="bi bi-dot"></i> <span><?= $row['Desc1'] ?></span></li>
                                    <li><i class="bi bi-dot"></i> <span><?= $row['Desc2'] ?></span></li>
                                    <li><i class="bi bi-dot"></i> <span><?= $row['Desc3'] ?></span></li>
                    <!--                <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span></li>
                                    <li class="na"><i class="bi bi-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>-->
                                </ul>

                                <div class="text-center mt-auto">
                                    <a href="register.php?membership=<?php echo $row['PricingId'] ?>" class="buy-btn">Enroll Now</a>
                                </div>

                            </div>
                        </div><!-- End Pricing Item -->
                        <?php
                    }
                }
                ?>



            </div>

        </div>
    </section><!-- End Pricing Section -->



    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Team</h2>
          <p>You’re not just joining a gym. You’re joining a supportive community of like-minded people who are here to give you the encouragement you need.</p>
        </div>

        <div class="row gy-5">

          <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
<!--                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>-->
                <h4>Walter White</h4>
                <span>Coach</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
<!--                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>-->
                <h4>Sarah Jhonson</h4>
                <span>Coach</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="600">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
<!--                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>-->
                <h4>William Anderson</h4>
                <span>Coach</span>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>
    </section><!-- End Team Section -->

    
    

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-header">
                <h2>Contact Us</h2>
                <p>Don't Hesitate To Connect With us.</p>
            </div>

        </div>

        <!--      <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
                <iframe src="https://www.google.com/maps/place/Life+Fitness+Gymnasium/@6.8338736,79.9281318,13z/data=!4m21!1m14!4m13!1m4!2m2!1d79.9304626!2d6.7836058!4e1!1m6!1m2!1s0x3ae2516bc88de841:0xac5ebc19da2651c6!2slife+fitness+gym+athurugiriya!2m2!1d79.9907982!2d6.8768103!5i2!3m5!1s0x3ae2516bc88de841:0xac5ebc19da2651c6!8m2!3d6.8768103!4d79.9907982!16s%2Fg%2F11btrrf_2h?entry=ttu" frameborder="0" allowfullscreen></iframe>
              </div> -->
        <div class="map"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="10" scrolling="no" marginheight="0" marginwidth="5px" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=Life Fitness Gymnasium, athurugiriya ,Sri lanka&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://capcuttemplate.org/"></a></div><style></style></div>
        <!-- End Google Maps -->

        <div class="container">

            <div class="row gy-5 gx-lg-5">

                <div class="col-lg-4">

                    <div class="info">
                        <h3>Get in touch</h3>
                        <p>We're here to help and answer any question you might have. We look forward to hearing from you.</p>

                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>Location:</h4>
                                <p>Life Fitness Gymnasium, Aturugiriya, Sri Lanka.</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <p>lifefitnessgym97@gmail.com</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-phone flex-shrink-0"></i>
                            <div>
                                <h4>Call:</h4>
                                <p>+9477 787 2742</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                </div>

                <div class="col-lg-8">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Get data from form
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $subject = $_POST['subject'];
                        $message = $_POST['message'];

                        // Create the email content
                        $to = "lifefitnessgym97@gmail.com";
                        $txt = "Name: $name\r\nEmail: $email\r\nMessage: $message";
                        $headers = "From: $email";

                        // Send the email
                        if (mail($to, $subject, $txt, $headers)) {
                            echo '<div class="sent-message">Your message has been sent. Thank you!</div>';
                        } else {
                            echo '<div class="error-message">Sorry, something went wrong. Please try again later.</div>';
                        }
                    }
                    ?>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
<!--                            <div class="loading">Loading</div>-->
                            <div class="error-message">Can you try again!</div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>


                </div>

            </div>
    </section><!-- End Contact Section -->

</main>