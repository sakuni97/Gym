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
                    <span data-feather="users" class="align-text-bottom"></span>
                    Members
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= @$attendance ?>" href="<?= SYSTEM_PATH ?>attendance/attendance.php">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Members Attendance
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= @$slot_management ?>" href="<?= SYSTEM_PATH ?>attendance/slot_management.php">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Slot Management
                </a>
            </li>
         

            <li class="nav-item">
                <a class="nav-link <?= @$trainers ?>" href="<?= SYSTEM_PATH ?>trainers/trainers.php">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Trainers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$payments ?>" href="<?= SYSTEM_PATH ?>admin/payments/payments.php">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Payments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$services ?>" href="<?= SYSTEM_PATH ?>admin/services.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Services
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$packages ?>" href="<?= SYSTEM_PATH ?>admin/pricing_packages.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Packages
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= @$equipments ?>" href="#">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Gym Equipments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$reports ?>" href="#">
                    <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                    Reports
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

