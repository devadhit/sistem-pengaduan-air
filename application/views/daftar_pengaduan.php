<?php
//  validasi untuk mengakses form ini harus login
if ($this->session->userdata('id_user_level') == null) {
    redirect('login?belum-login');
}
?>
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

<body>

    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div style="margin-left: 10px;" class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:contact@example.com">perumda_am@tirtarangga.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+0260412052</span></i>
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="<?= base_url('home') ?>">
                    <img src="<?= base_url('assets/') ?>img/logo1.png" alt=""><span>.</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="<?= base_url('home'); ?>">Beranda</a></li>

                    <?php if ($this->session->userdata('id_user_level') == '2') { ?>
                        <li>
                            <a class="nav-link scrollto active" style="color: #5D6EEA;"
                                href="<?= base_url('daftar_pengaduan'); ?>">Daftar Pengaduan</a>
                        </li>
                    <?php } ?>

                    <?php if ($this->session->userdata('id_user_level') == null) { ?>
                        <li><a class="nav-link scrollto" style="color: #5D6EEA;" href="<?= base_url('login'); ?>">Masuk</a>
                        </li>
                        <li>
                            <a class="nav-link scrollto" href="<?= base_url('register'); ?>"><button class="btn btn-primary"
                                    style="padding-top: 3px; padding-bottom: 3px; padding-left: 15px; padding-right: 15px; margin-left: -20px;">Daftar</button>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ($this->session->userdata('id_user_level') == '2') { ?>
                        <li>
                            <a class="nav-link scrollto" style="color: #5D6EEA;"
                                href="<?= base_url('Login/logout'); ?>">Logout</a>
                        </li>
                    <?php } ?>

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->


    <div class="container mt-5">
        <div class="row table-responsive">
            <div class="col-12 mb-5">
                <div class="container" data-aos="zoom-out" data-aos-delay="100" style="text-align: center; ">
                    <h1 style="line-height: 30px;"> DAFTAR PENGADUAN ANDA</h1>
                    <h1> <span style="font-size:14px;">Sampaikan laporan masalah Anda kepada kami, Kami akan
                            memprosesnya dengan
                            cepat.</span></h1>

                    <a href="<?= base_url('form_aduan/buat_laporan') ?>"
                        style="border-radius:10px; background-color:orange; padding-left:15px; padding-top:3px; padding-bottom:5px; padding-right:15px; color:white;"><span
                            style="font-size:14px;">Buat Pengaduan Baru</span> </a>


                </div>
            </div>
            <div class="col-12">
                <div class="card-body">
                    <div class="">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-success text-white">
                                <tr align="center">
                                    <th width="5%">No</th>
                                    <th>Tanggal</th>
                                    <!-- <th>Jenis Pengaduan</th> -->
                                    <!-- <th>Tingkat Keparahan</th> -->
                                    <!-- <th>Peluang Kejadian</th> -->
                                    <th>Detail Masalah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($list as $data => $value) {
                                    ?>
                                    <tr align="center">
                                        <td>
                                            <?= $no ?>
                                        </td>
                                        <td>
                                            <?php echo date('d M Y H:i:s', strtotime($value->tanggal_dibuat)) ?>
                                        </td>
                                        <!-- <td>
                                            <?php //echo $value->jenis_pengaduan ?>
                                        </td> -->
                                        <!-- <td>
                                            <?php //echo $value->tingkat_keparahan ?>
                                        </td> -->
                                        <!-- <td>
                                            <?php //echo $value->peluang_kejadian ?>
                                        </td> -->
                                        <td>
                                            <?php echo $value->detail_masalah ?>
                                        </td>
                                        <td>
                                            <?=  ($value->status == 'BELUM_DITANGANI' ) ? "Belum Ditangani" : (($value->status == 'SEDANG_DITANGANI')  ? "Sedang Ditangani" : "Sudah Ditangani") ?>
                                        </td>

                                    </tr>
                                    <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- ======= Footer ======= -->
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
                            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('home'); ?>">Beranda</a></li>
                            <?php if ($this->session->userdata('id_user_level') == '2') { ?>
                                <li>
                                    <i class="bx bx-chevron-right"></i>
                                    <a href="<?= base_url('daftar_pengaduan'); ?>">Daftar Pengaduan</a>
                                </li>
                            <?php } ?>
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
<?php $this->load->view('layouts/footer_admin'); ?>