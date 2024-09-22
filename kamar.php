<?php
// Memulai session
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['nama'])) {
    $username = $_SESSION['nama'];
} else {
    // Jika user belum login, alihkan ke halaman login
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Detail</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/modal.css">
</head>

<body>
<div class="modal fade modal-profile" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-between align-items-center">
        <!-- Modal title -->
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
        <!-- Close button -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- User logo and name -->
        <label for="profilePhotoInput" class="user-logo">
          <img src="asset/farros adi .jpg" alt="Profile Photo">
          <div class="change-photo">Change Photo</div>
        </label>
        <input type="file" id="profilePhotoInput" accept="asset">

        <h5>Profile</h5><br>

        <!-- Profile edit form -->
        <form>
        <div class="form-group mb-3">
            <input type="email" class="form-control" id="username" placeholder=" &#xf0e0;   Email" style="margin-bottom: -10px;font-family: 'Arial', FontAwesome;">
          </div>
          <div class="form-group mb-3">
            <input type="text" class="form-control" id="username" placeholder=" &#xf007;   Username" style="margin-bottom: -10px;font-family: 'Arial', FontAwesome;">
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control" id="password" placeholder=" &#xf023;   New Password" style="margin-bottom: -10px;font-family: 'Arial', FontAwesome;">
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control" id="confirmPassword" placeholder=" &#xf023;   Confirm Password" style="margin-bottom: -10px;font-family: 'Arial', FontAwesome;">
          </div>
        </form>
      </div>
      <div class="modal-footer">
    <!-- Icon Logout -->
        <button type="button" class="btn btn-danger me-auto" id="logoutBtn" style="border-radius: 10px;">
          <i class="fas fa-right-to-bracket"></i>
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" style="border-radius: 10px;">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('logoutBtn').addEventListener('click', function() {
    // Arahkan ke halaman logout atau lakukan proses logout
    window.location.href = 'index.html'; // Ganti ini dengan URL atau script logout Anda
  });
</script>

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <small class="me-3 text-light"><i class="fa fa-map-marker-alt me-2"></i>Bantaran</small>
                    <small class="me-3 text-light"><i class="fa fa-phone-alt me-2"></i>+012 345 6789</small>
                    <small class="text-light"><i class="fa fa-envelope-open me-2"></i>Anjai@gmail.com</small>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-twitter fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i class="fab fa-youtube fw-normal"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <img src="asset/COZYKOST LOGO.png" alt="Logo"> 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="landing_page.php" class="nav-item nav-link">Beranda</a>
                    <a href="#tentang-kami" class="nav-item nav-link">Tentang Kami</a>
                    <a href="kamar.php" class="nav-item nav-link active">Kamar</a>
                    <!-- <a href="#paket" class="nav-item nav-link">Paket</a> -->
                    <a href="pesanan.php" class="nav-item nav-link">Pesanan</a>
                    <a href="contact.html" class="nav-item nav-link">Kontak</a>
                    <a href="" style="font-size: large" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="fas fa-user me-2" ></i><?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Guest'; ?></a>
                </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <p class="fs-4 text-white mb-4 animated slideInDown">Hidup Nyaman di Kost Pilihanmu! Dapatkan Berbagai Pilihan Kost Sesuai Kebutuhanmu di Sini.</p>
                        <div class="position-relative w-75 mx-auto animated slideInDown">
                            <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="&#xf3c5; Kota Malang" style="font-family:Arial, FontAwesome;">
                            <button type="button" class="btn btn-success rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 7px; width: 100px;">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Destination Start -->
    <!-- <div class="container-xxl py-5 destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-success px-3">Kost</h6>
                <h1 class="mb-5">Detail</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">
                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="asset/tengah.webp" alt="" style="width: 1000px;">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="asset/meja.webp" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                            <a class="position-relative d-block overflow-hidden" href="asset/balkon.webp">
                                <img class="img-fluid" src="asset/balkon.webp" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    <a class="position-relative d-block h-100 overflow-hidden" href="">
                        <img class="img-fluid position-absolute w-100 h-100" src="asset/luar.webp" alt="" style="object-fit: cover;">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-lg-start " data-wow-delay="0.1s">
        <h1 class="mb-1" style="padding-left: 5rem;">Farros Stay <span style="color: #198754;"> House </span> </h1>
        <p class="mb-1" style="padding-left: 5rem; padding-right: 4rem;">Kamar kost nyaman dan modern dengan fasilitas lengkap, termasuk AC, Wi-Fi, dan kamar mandi dalam. Terletak di lokasi strategis, dekat dengan pusat perbelanjaan, kampus, dan transportasi umum. Ideal untuk mahasiswa atau pekerja yang mencari hunian praktis dan tenang dengan lingkungan yang bersih dan aman.</p>

        <div class="row gy-2 gx-4 mb-4" style="padding-left: 5rem;">
            <div class="col-sm-6">
                <p class="mb-0"><i class="fa fa-arrow-right text-success me-2"></i>Kamar mandi dalam</p>
            </div>
            <div class="col-sm-6">
                <p class="mb-0"><i class="fa fa-arrow-right text-success me-2"></i>WiFi</p>
            </div>
            <div class="col-sm-6">
                <p class="mb-0"><i class="fa fa-arrow-right text-success me-2"></i>AC</p>
            </div>
            <div class="col-sm-6">
                <p class="mb-0"><i class="fa fa-arrow-right text-success me-2"></i>Dapur</p>
            </div>
            <div class="col-sm-6">
                <p class="mb-0"><i class="fa fa-arrow-right text-success me-2"></i>TV</p>
            </div>
            <div class="col-sm-6">
                <p class="mb-0"><i class="fa fa-arrow-right text-success me-2"></i>Kulkas</p>
            </div>
        </div>
    </div>
    <div class="ms-4 ps-5" data-wow-delay="0.1s">
        <a class="btn btn-success py-3 px-5 mt-2" style=" border-radius: 17px;" href="">Booking Sekarang</a>

    </div> -->


        <!-- Destination Start -->



    <!-- Package Start -->
    <div class="container-xxl py-5" id="paket">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-success px-3">Kost</h6>
                <h1 class="mb-5">Kamar</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="asset/image 4.png" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Indonesia</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>1 Bulan</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>1 Orang</small>
                        </div>
                        <div class="text-center p-4">
                            <h4>Hanif Stay House</h4>
                            <h3 class="mb-0">Rp.1.200.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>Kamar mandi dalam  | AC  |  TV </p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail_user.php" class="btn btn-md btn-success px-3 border-end" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-success px-3" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="asset/image 9.png" alt="">
                            <!-- Label Diskon -->
                            <div class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1" style="border-radius: 0 0 5px 0;">Diskon 20%</div>
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Malang</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>1 Tahun</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>1 Orang</small>
                        </div>
                        <div class="text-center p-4">
                            <h4>Purnama Stay House</h4>
                            <h3 class="mb-0"><del>Rp.12.000.000</del> <span class="text-success">Rp.9.600.000</span></h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>AC  |  TV  |  WiFi  |  Parkiran</p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail user.html" class="btn btn-md btn-success px-3 border-end" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-success px-3" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="asset/image 5...png" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Indonesia</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>3 Bulan</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>2 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h4>Putri Farros House</h4>
                            <h3 class="mb-0">Rp.4.500.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>Kamar mandi dalam  |  WiFi  |  AC  |  TV  </p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail user.html" class="btn btn-md btn-success px-3 border-end" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-success px-3" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="asset/image 9.png" alt="">
                            <!-- Label Diskon -->
                            <div class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1" style="border-radius: 0 0 5px 0;">Diskon 20%</div>
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Malang</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>1 Tahun</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>1 Orang</small>
                        </div>
                        <div class="text-center p-4">
                            <h4>Purnama Stay House</h4>
                            <h3 class="mb-0"><del>Rp.12.000.000</del> <span class="text-success">Rp.9.600.000</span></h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>AC  |  TV  |  WiFi  |  Parkiran</p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail user.html" class="btn btn-md btn-success px-3 border-end" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-success px-3" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="package-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="asset/image 5...png" alt="">
                            <!-- Status Kamar Tidak Tersedia -->
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-flex align-items-center justify-content-center">
                                <h3 class="text-white">Kamar Tidak Tersedia</h3>
                            </div>
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Indonesia</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>3 Bulan</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>2 Orang</small>
                        </div>
                        <div class="text-center p-4">
                            <h4>Putri Farros House</h4>
                            <h3 class="mb-0">Rp.4.500.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>Kamar mandi dalam  |  WiFi  |  AC  |  TV  </p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail user.html" class="btn btn-md btn-dark disabled px-3 border-end" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-dark px-3 disabled " style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="asset/image 9.png" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Malang</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>1 Tahun</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>1 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h4 >Purnama Stay House</h4>
                            <h3 class="mb-0">Rp.12.000.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>AC  |  TV  |  WiFi  |  Parkiran</p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail user.html" class="btn btn-md btn-success px-3 border-end" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-success px-3" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>                
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="asset/image 9.png" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Malang</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>1 Tahun</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>1 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h4 >Purnama Stay House</h4>
                            <h3 class="mb-0">Rp.12.000.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>AC  |  TV  |  WiFi  |  Parkiran</p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail user.html" class="btn btn-md btn-success px-3 border-end" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-success px-3" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>     
                
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="asset/image 9.png" alt="">
                            <!-- Label Diskon -->
                            <div class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1" style="border-radius: 0 0 5px 0;">Diskon 20%</div>
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Malang</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>1 Tahun</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>1 Orang</small>
                        </div>
                        <div class="text-center p-4">
                            <h4>Purnama Stay House</h4>
                            <h3 class="mb-0"><del>Rp.12.000.000</del> <span class="text-success">Rp.9.600.000</span></h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>AC  |  TV  |  WiFi  |  Parkiran</p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail user.html" class="btn btn-md btn-success px-3 border-end" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-success px-3" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="asset/image 9.png" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Malang</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>1 Tahun</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>1 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h4 >Purnama Stay House</h4>
                            <h3 class="mb-0">Rp.12.000.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>AC  |  TV  |  WiFi  |  Parkiran</p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail user.html" class="btn btn-md btn-success px-3 border-end" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-success px-3" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="package-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="asset/image 5...png" alt="">
                            <!-- Status Kamar Tidak Tersedia -->
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-flex align-items-center justify-content-center">
                                <h3 class="text-white">Kamar Tidak Tersedia</h3>
                            </div>
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Indonesia</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>3 Bulan</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>2 Orang</small>
                        </div>
                        <div class="text-center p-4">
                            <h4>Putri Farros House</h4>
                            <h3 class="mb-0">Rp.4.500.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>Kamar mandi dalam  |  WiFi  |  AC  |  TV  </p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail user.html" class="btn btn-md btn-dark px-3 border-end disabled" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-dark px-3 disabled" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="asset/image 9.png" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Malang</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>1 Tahun</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>1 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h4 >farros Stay House</h4>
                            <h3 class="mb-0">Rp.12.000.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>AC  |  TV  |  WiFi  |  Parkiran</p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail user.html" class="btn btn-md btn-success px-3 border-end" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-success px-3" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="asset/image 9.png" alt="">
                            <!-- Label Diskon -->
                            <div class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1" style="border-radius: 0 0 5px 0;">Diskon 20%</div>
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-success me-2"></i>Malang</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>1 Tahun</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>1 Orang</small>
                        </div>
                        <div class="text-center p-4">
                            <h4>Purnama Stay House</h4>
                            <h3 class="mb-0"><del>Rp.12.000.000</del> <span class="text-success">Rp.9.600.000</span></h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                                <small class="fa fa-star text-success"></small>
                            </div>
                            <p>AC  |  TV  |  WiFi  |  Parkiran</p>
                            <div class="d-flex justify-content-center mb-2">
                            <a href="detail user.html" class="btn btn-md btn-success px-3 border-end" style="border-radius: 30px 0 0 30px;">Pelajari Selengkapnya</a>
                            <a href="booking.html" class="btn btn-md btn-success px-3" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#bookingModal">Booking Sekarang</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Package End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Company</h4>
                    <a class="btn btn-link" href="">Tentang Kami</a>
                    <a class="btn btn-link" href="">Kontak</a>
                    <a class="btn btn-link" href="">Beranda</a>
                    <a class="btn btn-link" href="">FAQ</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Kontak</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Mendit, Malang, Indonesia</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>anjai@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Galeri</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="asset/Image 20.png" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="asset/Kamar 77.png" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="asset/image 5...png" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="asset/image 9.png" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="asset/image 6.png" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="asset/image 3.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">CozyKost</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">Lebah Ganteng</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Beranda</a>
                            <a href="">FAQ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-success btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>