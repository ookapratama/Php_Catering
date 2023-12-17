<!doctype html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title ?></title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/media/image/favicon.png" />

        <!-- Main css -->
        <link rel="stylesheet" href="vendors/bundle.css" type="text/css">

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Daterangepicker -->
        <link rel="stylesheet" href="vendors/datepicker/daterangepicker.css" type="text/css">

        <!-- DataTable -->
        <link rel="stylesheet" href="vendors/dataTable/datatables.min.css" type="text/css">

        <!-- Style -->
        <link rel="stylesheet" href="vendors/select2/css/select2.min.css" type="text/css">

        <!-- Prism -->
        <link rel="stylesheet" href="vendors/prism/prism.css" type="text/css">

        <!-- App css -->
        <link rel="stylesheet" href="assets/css/app.min.css" type="text/css">

        <?php if ($title == "Pesanan | Catering") { ?>
                <link href='https://cdn.jsdelivr.net/npm/froala-editor@4.0.8/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
        <?php } ?>

        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="horizontal-navigation">
        <!-- Preloader -->
        <!-- <div class="preloader">
                <div class="preloader-icon"></div>
                <span>Loading...</span>
        </div> -->
        <!-- ./ Preloader -->

        <!-- Sidebar group -->
        <div class="sidebar-group">

        </div>
        <!-- ./ Sidebar group -->

        <!-- Layout wrapper -->
        <div class="layout-wrapper">

                <!-- Header -->
                <div class="header d-print-none">
                        <div class="header-container">
                                <div class="header-left">
                                        <div class="navigation-toggler">
                                                <a href="#" data-action="navigation-toggler">
                                                        <i data-feather="menu"></i>
                                                </a>
                                        </div>

                                        <div class="header-logo">
                                                <!-- <a href=index.php>
                                                        <img class="logo" src="assets/media/image/logo.png" alt="logo">
                                                </a> -->
                                        </div>
                                </div>

                                <div class="header-body">
                                        <div class="header-body-left">
                                                <ul class="navbar-nav">
                                                        <li class="nav-item mr-3">
                                                                <!-- <div class="header-search-form">
                                                                        <form>
                                                                                <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                                <button class="btn">
                                                                                                        <i data-feather="search"></i>
                                                                                                </button>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Search">
                                                                                        <div class="input-group-append">
                                                                                                <button class="btn header-search-close-btn">
                                                                                                        <i data-feather="x"></i>
                                                                                                </button>
                                                                                        </div>
                                                                                </div>
                                                                        </form>
                                                                </div> -->
                                                        </li>
                                                </ul>
                                        </div>

                                        <div class="header-body-right">
                                                <ul class="navbar-nav">
                                                        <li class="nav-item">
                                                                <a href="#" class="nav-link mobile-header-search-btn" title="Search">
                                                                        <i data-feather="search"></i>
                                                                </a>
                                                        </li>

                                                        <li class="nav-item dropdown d-none d-md-block">
                                                                <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                                                                        <i class="maximize" data-feather="maximize"></i>
                                                                        <i class="minimize" data-feather="minimize"></i>
                                                                </a>

                                                        </li>
                                                        <?php
                                                        if (isset($_SESSION['username'])) { ?>
                                                                <li class="nav-item dropdown">
                                                                        <a href="#" class="nav-link dropdown-toggle" title="User menu" data-toggle="dropdown">
                                                                                <span class="ml-2 d-sm-inline d-none"><?= $_SESSION['username'] ?></span>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                                                                <div class="text-center py-4">
                                                                                        <h5 class="text-center"><?= $_SESSION['username'] ?></h5>
                                                                                        <div class="mb-3 small text-center text-muted">@<?= $_SESSION['username'] ?></div>
                                                                                        <a href="settings.php" class="btn btn-outline-light btn-rounded">Manage Your Account</a>
                                                                                </div>
                                                                                <div class="list-group">
                                                                                        <a href="settings.php" class="list-group-item">View Profile</a>
                                                                                        <a href="logout.php" class="list-group-item text-danger">Sign Out!</a>

                                                                                </div>
                                                                        </div>
                                                                </li>
                                                        <?php } else { ?>
                                                                <a href="login.php" class="list-group-item text-primary">Login</a>
                                                        <?php } ?>
                                                </ul>
                                        </div>
                                </div>

                                <ul class="navbar-nav ml-auto">
                                        <li class="nav-item header-toggler">
                                                <a href="#" class="nav-link">
                                                        <i data-feather="arrow-down"></i>
                                                </a>
                                        </li>
                                </ul>
                        </div>
                </div>
                <!-- ./ Header -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                        <!-- begin::navigation -->
                        <div class="navigation">
                                <div class="navigation-header">
                                        <span>Navigation</span>
                                        <a href="#">
                                                <i class="ti-close"></i>
                                        </a>
                                </div>
                                <div class="navigation-menu-body">
                                        <ul>
                                                <?php if (isset($_SESSION['l']))
                                                        if ($_SESSION['l'] == 1) { ?>
                                                        <li>
                                                                <a <?php if ($title == "Home | Catering") echo "class='active'" ?> href=index.php>
                                                                        <span class="nav-link-icon">
                                                                                <i data-feather="pie-chart"></i>
                                                                        </span>
                                                                        <span>Dashboard</span>
                                                                </a>
                                                        </li>
                                                <?php } ?>
                                                <li>
                                                        <a <?php if ($title == "Menu | Catering") echo "class='active'" ?> href="menu.php">
                                                                <span class="nav-link-icon">
                                                                        <i data-feather="shopping-bag"></i>
                                                                </span>
                                                                <span>Menu</span>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a <?php if ($title == "Menu | Cart") echo "class='active'" ?> href="cart.php">
                                                                <span class="nav-link-icon">
                                                                        <i data-feather="shopping-cart"></i>
                                                                </span>
                                                                <span>Cart</span>
                                                        </a>
                                                </li>
                                                <!-- <li>
                                                        <a <?php if ($title == "Menu | Rating") echo "class='active'" ?> href="rating.php">
                                                                <span class="nav-link-icon">
                                                                        <i data-feather="star"></i>
                                                                </span>
                                                                <span>Rating</span>
                                                        </a>
                                                </li> -->
                                                <?php if (isset($_SESSION['username']))
                                                        if (!isset($_SESSION['l'])) if ($_SESSION['l']) { ?>
                                                        <li>
                                                                <a <?php if ($title == "History | Catering") echo "class='active'" ?> href="history.php">
                                                                        <span class="nav-link-icon">
                                                                                <i data-feather="shopping-cart"></i>
                                                                        </span>
                                                                        <span>History</span>
                                                                </a>
                                                        </li>
                                                <?php } ?>
                                                <?php if (isset($_SESSION['l']))
                                                        if ($_SESSION['l'] == 1) { ?>
                                                        <li>
                                                                <a <?php if ($title == "Admin | Catering" || $title == "User | Catering" || $title == "Paket Admin | Catering" || $title == "Pesanan | Catering") echo "class='active'" ?> href="#">
                                                                        <span class="nav-link-icon">
                                                                                <i data-feather="copy"></i>
                                                                        </span>
                                                                        <span>Admin</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <a href="admins.php">Admins</a>
                                                                        </li>
                                                                        <li>
                                                                                <a href="users.php">Users</a>
                                                                        </li>
                                                                        <li>
                                                                                <a href="paket.php">Paket</a>
                                                                        </li>
                                                                        <li>
                                                                                <a href="pesanan.php">Pesanan</a>
                                                                        </li>
                                                                </ul>
                                                        </li>
                                                <?php } ?>
                                        </ul>
                                </div>
                        </div>
                        <!-- end::navigation -->