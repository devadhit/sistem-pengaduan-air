<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>BizLand Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('assets2/') ?> img/favicon.png" rel="icon">
    <link href="<?= base_url('assets2/') ?> img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets2/') ?> vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url('assets2/') ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets2/') ?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets2/') ?>vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('assets2/') ?>vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('assets2/') ?>vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets2/') ?>css/style.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="<?= base_url('home') ?>">
                    <img src="<?= base_url('assets/') ?>img/logo1.png" alt=""><span>.</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" style="color: #5D6EEA;" href="<?= base_url('home'); ?>"
                            href="<?= base_url('home'); ?>">Beranda</a></li>
                    <li><a class="nav-link scrollto active" style="color: #5D6EEA;"
                            href="<?= base_url('login'); ?>">Masuk</a>
                    </li>
                    <li><a class="nav-link scrollto" href="<?= base_url('register'); ?>"><button class="btn btn-primary"
                                style="padding-top: 3px; padding-bottom: 3px; padding-left: 15px; padding-right: 15px; margin-left: -20px;">Daftar</button>
                        </a></li>

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center mt-5">
                <div class="col-xl-5 col-lg-5 col-md-5 mt-5">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <?php if (isset($_GET['belum-login'])) { ?>
                                        <div class="alert alert-danger" role="alert">
                                        Anda harus login atau daftar sebelum mengakses halaman ini!
                                    </div>
                                    <?php } ?>
                                   
                                    <div class="text-center">
                                        <h3 class="h4 text-gray-900 mb-4" style="font-weight:bold;"> LOGIN </h3>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="logo"><a href="<?= base_url('home') ?>">
                                                <img style="width:20%;" src="<?= base_url('assets/') ?>img/xaz.jpg"
                                                    alt=""><span>.</span></a></h1>
                                    </div> <br>
                                    <?php $error = $this->session->flashdata('message');
                                    if ($error) { ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">×</button>
                                            <?php echo $error; ?>
                                        </div>
                                    <?php } ?>

                                    <form class="user" action="<?php echo site_url('Login/login'); ?>" method="post">
                                        <div class="form-group">
                                            <input
                                                style="box-shadow: 3px 2px 4px 0px grey; font-size:14px; color:grey; font-weight:600;"
                                                required autocomplete="off" type="text"
                                                class="form-control form-control-user" id="exampleInputUser"
                                                placeholder="Username" name="username" />
                                        </div> <br>

                                        <div class="form-group">
                                            <input
                                                style="box-shadow: 3px 2px 4px 0px grey; font-size:14px; color:grey; font-weight:600;"
                                                required autocomplete="off" type="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                name="password" placeholder="Password" />
                                        </div>
                                        <button type="submit" name="submit"
                                            style="border-radius:10px; background-color:orange; padding-left:15px; padding-top:3px; padding-bottom:5px; padding-right:15px; color:white; border-color:orange; margin-top:10px;">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-plex justify-content-between mt-5">
                <div class="col-xl-6 col-lg-6 col-md-6 mt-5">
                    <div class="" style="background: none;">

                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Hero -->


    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h1 class="logo"><a href="<?= base_url('home'); ?>">
                                <img style="width:100%;" src="<?= base_url('assets/') ?>img/logo1.png"
                                    alt=""><span>.</span></a></h1>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Beranda</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Daftar Pengaduan</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul></ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Daftar Pengaduan</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Social Networks</h4>
                        <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Perumda</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets2/') ?>vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= base_url('assets2/') ?>vendor/aos/aos.js"></script>
    <script src="<?= base_url('assets2/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets2/') ?>vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url('assets2/') ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url('assets2/') ?>vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url('assets2/') ?>vendor/waypoints/noframework.waypoints.js"></script>
    <script src="<?= base_url('assets2/') ?>vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('assets2/') ?>js/main.js"></script>
</body>

</html>