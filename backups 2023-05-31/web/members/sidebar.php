<?php ob_start(); ?>




<main id="main">
    <section id="about" class="side">
<!--        <div class="container" >


            <div class="section-header">
                <h3>Hey <?= @$_SESSION['First_Name'] ?> !!</h3>
                <p>You are in the correct track, We got you...</p>
            </div>
        </div>-->
        <!--Main Navigation-->

        <style>
            body {
                background-color: #fbfbfb;
            }
            @media (min-width: 991.98px) {
                main {
                    padding-left: 240px;
                }
            }

            /* Sidebar */
            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                padding: 58px 0 0; /* Height of navbar */
                box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
                width: 240px;
                z-index: 600;
            }

            @media (max-width: 991.98px) {
                .sidebar {
                    width: 100%;
                }
            }
            .sidebar .active {
                border-radius: 5px;
                box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
            }

            .sidebar-sticky {
                position: relative;
                top: 0;
                height: calc(100vh - 48px);
                padding-top: 0.5rem;
                overflow-x: hidden;
                overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
            }
        </style>
        <header>
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
                <div class="position-sticky">
                    <div class="list-group list-group-flush mx-3 mt-4">
                        <a href="profile.php" class="list-group-item list-group-item-action py-2 ripple <?= $profile ?>" aria-current="true">
                            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                        </a>
                        <a href="details.php" class="list-group-item list-group-item-action py-2 ripple <?= $details ?>">
                            <i class="fas fa-chart-area fa-fw me-3"></i><span>My Details</span>
                        </a>
                        <a href="workout_plan.php" class="list-group-item list-group-item-action py-2 ripple <?= $workouts ?>"><i
                                class="fas fa-lock fa-fw me-3"></i><span>My Workout Plan</span></a>
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                                class="fas fa-lock fa-fw me-3"></i><span>My Trainer</span></a>
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                                class="fas fa-chart-line fa-fw me-3"></i><span>My Analytics</span></a>
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-chart-pie fa-fw me-3"></i><span>My Payments</span>
                        </a>
                        <a href="password_reset.php" class="list-group-item list-group-item-action py-2 ripple <?= $password ?>"><i
                                class="fas fa-chart-bar fa-fw me-3"></i><span>Password Reset</span></a>
<!--                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                                class="fas fa-globe fa-fw me-3"></i><span>International</span></a>
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                                class="fas fa-building fa-fw me-3"></i><span>Partners</span></a>
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                                class="fas fa-calendar fa-fw me-3"></i><span>Calendar</span></a>
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                                class="fas fa-users fa-fw me-3"></i><span>Users</span></a>
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                                class="fas fa-money-bill fa-fw me-3"></i><span>Sales</span></a>-->
                    </div>
                </div>
            </nav>
            <!-- Sidebar -->


        </header>
        <!--Main Navigation-->



        </div>
    </section>
</main>
<?php ob_end_flush(); ?>