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
    <title>Kontak</title>
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
    <link rel="stylesheet" href="css/booking.css">

</head>

<body>
        <!-- Modal -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">Pesan Kost</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body " >
                        <!-- Carousel -->
                        <div id="hotelCarousel" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="asset/Kamar 77.png" alt="Hotel Image 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="asset/image 5...png" alt="Hotel Image 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="asset/image 6.png" alt="Hotel Image 3">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">kembali</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">selanjutnya</span>
                            </button>
                        </div>
    
                        <form action="php/save_booking.php" method="post">
                            <!-- Check-in Date -->
                            <div class="mb-3">
                                <label for="checkInDate" class="form-label">Tanggal masuk</label>
                                <input type="date" class="form-control" id="checkInDate" name="tgl_masuk">
                            </div>
    
                            <!-- Check-out Date -->
                            <div class="mb-3">
                                <label for="checkOutDate" class="form-label">Tanggal keluar</label>
                                <input type="date" class="form-control" id="checkOutDate" name="tgl_keluar">
                            </div>
    
                            <!-- Special Requests -->
                            <div class="mb-3">
                                <label for="requests" class="form-label">permintaan khusus</label>
                                <textarea class="form-control" name="permintaan_khusus" id="requests" rows="3" placeholder="tap untuk mengetik"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <input type="submit" class="btn btn-success" style="border-radius: 4px;" value="Lanjut ke Pembayaran"></input>
                            <!-- <a href="pembayaran.html" class="btn btn-success" style="border-radius: 4px;">Lanjut ke Pembayaran</a> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>


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
                <div class="navbar-nav ms-auto py-0">
                    <a href="landing_page.php" class="nav-item nav-link">Beranda</a>
                    <!-- <a href="#tentang-kami" class="nav-item nav-link">Tentang Kami</a> -->
                    <a href="kamar.php" class="nav-item nav-link">Kamar</a>
                    <!-- <a href="#paket" class="nav-item nav-link">Paket</a> -->
                    <a href="pesanan.php" class="nav-item nav-link">Pesanan</a>
                    <a href="kontak.php" class="nav-item nav-link active">Kontak</a>
                    <a href="" style="font-size: large" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="fas fa-user me-2" ></i><?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Guest'; ?></a>
                </div>
            </div> 
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">Hubungi Kami</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->


    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-success px-3">Hubungi kami</h6>
                <h1 class="mb-5">Hubungi Untuk Pertanyaan Apa Pun</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5>Menghubungi</h5>
                    <p class="mb-4">Hubungi kami untuk informasi lebih lanjut.</p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-success" style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-success">Kantor</h5>
                            <p class="mb-0">Kasin, Malang, Indonesia</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-success" style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-success">Nomor HP</h5>
                            <p class="mb-0">+62 345 67890</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-success" style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-success">Email</h5>
                            <p class="mb-0">Anjai@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.138033933654!2d112.61452527500823!3d-8.087402591941075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e789e00fe4e738f%3A0x3094805dc97ad38b!2sGg.%20Pos%2C%20Ngebyongan%2C%20Wonokerso%2C%20Kec.%20Pakisaji%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur%2065162!5e0!3m2!1sid!2sid!4v1725542041464!5m2!1sid!2sid" 
                        width="600" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name">
                                    <label for="name">Nama</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject">
                                    <label for="subject">Subjek</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 100px"></textarea>
                                    <label for="message">Pesan..</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success w-100 py-3" type="submit">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->



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
                        Designed By <a class="border-bottom" href="">Lebah Ganteng</a>
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