<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Login - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

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
    <link href="<?= base_url(); ?>/assetsadmin/vendor/simple-datatables/style.css" rel="stylesheet">

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

<?php $session = \Config\Services::session(); ?>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="<?= base_url(); ?>/assetsadmin/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">MasjidMuhammadiyah</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <?php if ($session->getFlashdata('gagal')) {  ?>
                                            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show small" role="alert">
                                                <?= $session->getFlashdata('gagal'); ?>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?= form_open("/auth/proses-login", ['class' => 'row g-3 needs-validation formlogin']);
                                    csrf_field(); ?>
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                                            <input type="text" name="username" class="form-control invalid-form" id="yourUsername" value="<?= old('username'); ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" value="<?= old('password'); ?>" required>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit" name="loginformmasjid">Login</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

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

    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>/assetsadmin/js/main.js"></script>

</body>

</html>