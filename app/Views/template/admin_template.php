<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title[1]; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="c-token" content="{!! csrf_token() !!}">

    <!-- Favicons -->

    <link href="<?= base_url(); ?>/assetsadmin/img/favicon.png" rel="icon">
    <link href="<?= base_url(); ?>/assetsadmin/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url(); ?>/assetsadmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assetsadmin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assetsadmin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assetsadmin/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assetsadmin/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assetsadmin/vendor/remixicon/remixicon.css" rel="stylesheet">
    <!-- <link href="<?= base_url(); ?>/assetsadmin/vendor/simple-datatables/style.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url(); ?>/node_modules/izitoast/dist/css/iziToast.min.css">

    <!-- Template Main CSS File -->
    <link href="<?= base_url(); ?>/assetsadmin/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="<?= base_url(); ?>/assetsadmin/img/logo.png" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->


                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url(); ?>/assetsadmin/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link <?= $title[1] == 'Dahsboard Admin' ? 'active' : 'collapsed'; ?>" href="/admin/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link <?= $title[1] == 'Master Masjid' ? 'active' : 'collapsed'; ?>" href="/admin/master-masjid">
                    <i class="bi bi-grid"></i>
                    <span>Master Masjid</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $title[1] == 'Kategori Masjid' ? 'active' : 'collapsed'; ?>" href="/admin/kategori-masjid">
                    <i class="bi bi-grid"></i>
                    <span>Kategori Masjid</span>
                </a>
            </li>
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <?= $this->renderSection("konten"); ?>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url(); ?>/assetsadmin/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url(); ?>/assetsadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assetsadmin/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= base_url(); ?>/assetsadmin/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url(); ?>/assetsadmin/vendor/quill/quill.js"></script>
    <script src="<?= base_url(); ?>/assetsadmin/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url(); ?>/assetsadmin/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url(); ?>/assetsadmin/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url(); ?>/node_modules/izitoast/dist/js/iziToast.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <script src="iziToast.min.js" type="text/javascript"></script> -->

    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>/assetsadmin/js/main.js"></script>

</body>

</html>