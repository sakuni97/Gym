<?php $contact = "active" ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<main id="main">
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

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form">
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
    </section>
</main>
<?php include 'footer.php'; ?>