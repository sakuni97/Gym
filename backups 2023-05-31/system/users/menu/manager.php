<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3 sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?= @$dashboard ?>" aria-current="page" href="<?= SYSTEM_PATH ?>">
                                    <span data-feather="home" class="align-text-bottom"></span>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= @$members ?>" href="<?= SYSTEM_PATH ?>members/members.php">
                                    <span data-feather="file" class="align-text-bottom"></span>
                                    Members
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= @$trainers ?>" href="<?= SYSTEM_PATH ?>trainers/trainers.php">
                                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                                    Trainers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="users" class="align-text-bottom"></span>
                                    Payments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                                    Reports
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= @$blog ?>" href="<?= SYSTEM_PATH ?>manager/blog/view_blog.php">
                                    <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                                    Blog
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link <?= @$comments ?>" href="<?= SYSTEM_PATH ?>manager/blog/comments.php">
                                    <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                                    Blog Comments
                                </a>
                            </li>
                            
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text" class="align-text-bottom"></span>
                                    Current month
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text" class="align-text-bottom"></span>
                                    Last quarter
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text" class="align-text-bottom"></span>
                                    Social engagement
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text" class="align-text-bottom"></span>
                                    Year-end sale
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

