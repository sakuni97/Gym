


<header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a href="<?= SYSTEM_PATH ?>index.php" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1>Life Fitness<span>.</span></h1>
        </a>

        <nav id="navbar" class="navbar" ">
            <ul>

                <li><a class="nav-link scrollto <?= @$home ?>" href="<?= SYSTEM_PATH ?>index.php">Home</a></li>

                <li><a class="nav-link scrollto <?= @$about ?>" href="<?= SYSTEM_PATH ?>about.php">About</a></li>
                <li><a class="nav-link scrollto <?= @$services ?>" href="<?= SYSTEM_PATH ?>services.php">Services</a></li>
                <li><a class="nav-link scrollto <?= @$pricing ?>" href="<?= SYSTEM_PATH ?>pricing.php">Pricing</a></li>
                <li><a class="nav-link scrollto <?= @$team ?>" href="<?= SYSTEM_PATH ?>team.php">Team</a></li>
                <li><a class="nav-link scrollto <?= @$blog ?>" href="<?= SYSTEM_PATH ?>blog.php">Blog</a></li>
                <li><a class="nav-link scrollto <?= @$contact ?>" href="<?= SYSTEM_PATH ?>contact.php">Contact Us</a></li>
                
                <li> <?php
                    if (isset($_SESSION['MemberId'])) {
                        ?> <div class="nav-item text-end ">
                            <a class="nav-link scrollto <?= @$profile ?>"href="<?= SYSTEM_PATH ?>members/profile.php">My Profile</a>
                        </div><?php
                    }
                    ?></li>

<!--                <li><a class="nav-link scrollto" href=""><?= @$_SESSION['First_Name'] ?></a></li>-->

                <li>  <?php
                    if (isset($_SESSION['MemberId'])) {
                        ?> 
                        <a class="btn btn-info scrollto " href="<?= SYSTEM_PATH ?>logout.php">Sign out</a>
                        <?php
                    }
                    ?></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle d-none"></i>
        </nav><!-- .navbar -->

        <!--        <a class="btn-getstarted scrollto" href="login.php">Get Started</a>-->
        <?php
        if (!isset($_SESSION['MemberId'])) {
            ?> 
            <a class="btn-getstarted scrollto" href="login.php">Get Started</a>
            <?php
        }
        ?>

    </div>
</header>
