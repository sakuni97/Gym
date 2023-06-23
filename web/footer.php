

<footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Life Fitness Gymnasium</h3>
              <p>
                Aturugiriya <br>
                Sri Lanka<br><br>
                <strong>Phone:</strong> +9477 787 2742<br>
                <strong>Email:</strong> lifefitnessgym97@gmail.com<br>
              </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right <?= @$home ?>"></i> <a href="<?= SYSTEM_PATH ?>index.php">Home</a></li>
              <li><i class="bi bi-chevron-right<?= @$about ?>"></i> <a  href="<?= SYSTEM_PATH ?>about.php">About us</a></li>
              <li><i class="bi bi-chevron-right<?= @$services ?>"></i> <a href="<?= SYSTEM_PATH ?>services.php">Services</a></li>
              <li><i class="bi bi-chevron-right<?= @$pricing ?>"></i> <a  href="<?= SYSTEM_PATH ?>pricing.php">Pricing Packages</a></li>
              <li><i class="bi bi-chevron-right<?= @$blog ?>"></i> <a  href="<?= SYSTEM_PATH ?>blog.php">Blog</a></li>
            </ul>
          </div>

          

          <div class="col-lg-6 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Enter your email and subscribe to get the latest updates</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="footer-legal text-center">
      <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

        <div class="d-flex flex-column align-items-center align-items-lg-start">
          <div class="copyright">
            &copy; Copyright <strong><span>lifefitnessgym</span></strong>. All Rights Reserved
          </div>
          
        </div>

       

      </div>
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= SYSTEM_PATH ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= SYSTEM_PATH ?>assets/vendor/aos/aos.js"></script>
  <script src="<?= SYSTEM_PATH ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= SYSTEM_PATH ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= SYSTEM_PATH ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= SYSTEM_PATH ?>assets/vendor/php-email-form/validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Template Main JS File -->
  <script src="<?= SYSTEM_PATH ?>assets/js/main.js"></script>

</body>

</html>