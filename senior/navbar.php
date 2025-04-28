<?php
if (session_status() == PHP_SESSION_NONE) {
    ob_start(); // Start output buffering
    session_start();
}
$page = basename($_SERVER['PHP_SELF']);
?>

<!-- External CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Navbar Styles -->
<style>
    .navbar-brand-logo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 8px;
        vertical-align: middle;
    }

    .navbar-brand-text {
        vertical-align: middle;
        font-weight: bold;
        font-size: 15px;
        color: #735ff2;
    }

    .nav-link {
        position: relative;
        color: #333;
        transition: color 0.3s ease;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0;
        height: 2px;
        background-color: #735ff2;
        transition: width 0.3s ease;
    }

    .nav-link:hover {
        color: #735ff2;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .nav-link.active {
        color: #735ff2;
        font-weight: bold;
    }

    .nav-link.active::after {
        width: 100%;
    }

    .dropdown-menu .dropdown-item {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #735ff2;
        color: #fff;
    }
</style>

<!-- Navbar HTML -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="images/logo.png" alt="Logo" class="navbar-brand-logo">
            <span class="navbar-brand-text">CARE SYSTEM</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link px-3 <?= ($page == 'index.php') ? 'active' : '' ?>" href="index.php">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= ($page == 'table.php') ? 'active' : '' ?>" href="table.php">
                        <i class="bi bi-table me-1"></i>Table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= ($page == 'form.php') ? 'active' : '' ?>" href="form.php">
                        <i class="bi bi-person-plus me-1"></i>Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= ($page == 'profile.php') ? 'active' : '' ?>" href="profile.php">
                        <i class="bi bi-person-lines-fill me-1"></i>Profile</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 <?= in_array($page, [
                        'mastery.php', 'educational.php', 'household.php', 'living.php', 'income.php', 'properties.php',
                        'asset.php', 'problem.php', 'social.php', 'hearing.php', 'dental.php', 'optical.php',
                        'area.php', 'medical.php', 'upload.php'
                    ]) ? 'active' : '' ?>" href="#" id="contentDropdown" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-gear me-1"></i>Settings
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="contentDropdown">
                        <li><a class="dropdown-item" href="mastery.php">Mastery</a></li>
                        <li><a class="dropdown-item" href="educational.php">Educational Attainment</a></li>
                        <li><a class="dropdown-item" href="household.php">Household Condition</a></li>
                        <li><a class="dropdown-item" href="living.php">Living Residing</a></li>
                        <li><a class="dropdown-item" href="income.php">Source of Income</a></li>
                        <li><a class="dropdown-item" href="properties.php">Real & Immovable Assets</a></li>
                        <li><a class="dropdown-item" href="asset.php">Real & Movable Assets</a></li>
                        <li><a class="dropdown-item" href="problem.php">Problems & Needs</a></li>
                        <li><a class="dropdown-item" href="social.php">Social Emotional</a></li>
                        <li><a class="dropdown-item" href="hearing.php">Hearing Concern</a></li>
                        <li><a class="dropdown-item" href="dental.php">Dental Concern</a></li>
                        <li><a class="dropdown-item" href="optical.php">Optical Concern</a></li>
                        <li><a class="dropdown-item" href="area.php">Areas Difficulties</a></li>
                        <li><a class="dropdown-item" href="upload.php">Upload</a></li>
                        <li><a class="dropdown-item" href="pension.php">Pension</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger px-3" href="logout.php">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
