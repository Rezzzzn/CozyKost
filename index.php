<?php
// Memulai session
session_start();
include 'php/koneksi.php';

// Cek apakah user sudah login
if (isset($_SESSION['nama'])) {
    $username = $_SESSION['nama'];
} else {
    // Jika user belum login, alihkan ke halaman login
    header("location:login.php");
}

$query = "SELECT * FROM kamar LIMIT 3";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Landing Page</title>
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
</head>

<body>
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
                    <a href="index.html" class="nav-item nav-link active">Beranda</a>
                    <a href="#tentang-kami" class="nav-item nav-link">Tentang Kami</a>
                    <a href="#service" class="nav-item nav-link">Layanan</a>
                    <a href="#paket" class="nav-item nav-link">Paket</a>
                    <a href="kontak.php" class="nav-item nav-link">Kontak</a>
                </div>
                <a href="login.php" class="btn btn-success rounded-pill py-2 px-4">Register</a>
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


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="asset/image15.jpg" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" id="tentang-kami" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-success pe-3">Tentang Kami</h6>
                    <h1 class="mb-4">Welcome to <span class="text-success">Cost</span></h1>
                    <p class="mb-4">Temukan kenyamanan sejati dengan menyewa kamar melalui website kami. Kami memahami bahwa kenyamanan adalah prioritas utama bagi Anda, dan itulah sebabnya kami hanya menawarkan kamar-kamar yang telah terjamin kualitasnya. </p>
                    <p class="mb-4">Setiap kamar dilengkapi dengan fasilitas lengkap dan dirancang untuk memberikan kenyamanan maksimal. Dengan lokasi strategis dan lingkungan yang tenang, Anda bisa merasa seperti di rumah sendiri. Percayakan kebutuhan tempat tinggal Anda kepada kami dan nikmati pengalaman tinggal yang menyenangkan dan bebas dari kekhawatiran.</p>
                    <div class="row gy-2 gx-4 mb-4">
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
                    <a class="btn btn-success py-3 px-5 mt-2" href="">Pelajari Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-xxl py-5" id="service">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-success px-3">Services</h6>
                <h1 class="mb-5">Layanan Kami</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-success mb-4"></i>
                            <h5>Website Akses</h5>
                            <p>Website ini mudah di akses dimanapun dan kapanpun</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-hotel text-success mb-4"></i>
                            <h5>Booking Kost</h5>
                            <p>Kami akan membantu agar booking kost idamanmu lebih mudah dan cepat</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-user text-success mb-4"></i>
                            <h5>Layanan</h5>
                            <p>Kami akan memberi pelayanan yang terbaik agar customer merasa nyaman dan aman</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-cog text-success mb-4"></i>
                            <h5>Menejemen Complaint</h5>
                            <p>Kami akan mengatur jam dan mengatur segala complaint dari penyewa</p>
                        </div>
                    </div>
                </div>
                <!-- Service End -->


                <!-- Destination Start -->
                <div class="container-xxl py-5 destination">
                    <div class="container">
                        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                            <h6 class="section-title bg-white text-center text-success px-3">Kost</h6>
                            <h1 class="mb-5">Kost Terpopuler</h1>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-7 col-md-6">
                                <div class="row g-3">
                                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                                        <a class="position-relative d-block overflow-hidden" href="">
                                            <img class="img-fluid" src="asset/image 5...png" alt="" style="width: 1000px;">
                                            <div class="bg-white text-success fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Soekarno-Hatta</div>
                                        </a>
                                    </div>
                                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                                        <a class="position-relative d-block overflow-hidden" href="">
                                            <img class="img-fluid" src="asset/Image12.png" alt="">
                                            <div class="bg-white text-success fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Bantaran</div>
                                        </a>
                                    </div>
                                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                                        <a class="position-relative d-block overflow-hidden" href="">
                                            <img class="img-fluid" src="asset/Image 20.png" alt="">
                                            <div class="bg-white text-success fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Tidar</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                                <a class="position-relative d-block h-100 overflow-hidden" href="">
                                    <img class="img-fluid position-absolute w-100 h-100" src="asset/Kamar 77.png" alt="" style="object-fit: cover;">
                                    <div class="bg-white text-success fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Lawang</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Destination Start -->


                <!-- Package Start -->
                <div class="container-xxl py-5" id="paket">
                    <div class="container">
                        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                            <h6 class="section-title bg-white text-center text-success px-3">Paket</h6>
                            <h1 class="mb-5">Paket Murah</h1>
                            <div class="row g-4 justify-content-center">
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <?php
                                        $harga = $row['harga'];
                                        $diskon = intval(rtrim($row['diskon'], '%'));
                                        $hargaSetelahDiskon = $harga - ($harga * ($diskon / 100));
                                        ?>
                                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="package-item d-flex flex-column">
                                                <div class="overflow-hidden position-relative">
                                                    <img class="img-fluid" src="uploads/<?php echo htmlspecialchars($row['gambar1']); ?>" alt="Gambar Kamar" style="width: 100%; height: 250px; object-fit: cover;">

                                                    <?php if ($row['status'] == 'Tidak Tersedia'): ?>
                                                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-flex align-items-center justify-content-center">
                                                            <h4 class="text-white">Kamar Tidak Tersedia</h4>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($diskon > 0): ?>
                                                        <div class="position-absolute top-0 start-0 bg-success text-white px-3 py-1 mt-1" style="border-radius: 0px 0 8px 0px;">
                                                            <p class="mb-0">Rp. <?php echo number_format($hargaSetelahDiskon, 0, ',', '.'); ?></p>
                                                        </div>
                                                        <div class="position-absolute top-0 start-0 bg-danger text-dark px-3 py-1 mt-5" style="border-radius: 0 0 8px 0;">
                                                            Diskon <?php echo htmlspecialchars($row['diskon']); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="d-flex border-bottom">
                                                    <small class="flex-fill text-center border-end py-2">
                                                        <i class="fa fa-map-marker-alt text-success me-2"></i><?php echo htmlspecialchars($row['alamat']); ?>
                                                    </small>
                                                    <small class="flex-fill text-center border-end py-2">
                                                        <i class="fa fa-calendar-alt text-success me-2"></i><?php echo htmlspecialchars($row['durasi']); ?> Bulan
                                                    </small>
                                                    <small class="flex-fill text-center py-2">
                                                        <i class="fa fa-user text-success me-2"></i><?php echo htmlspecialchars($row['kapasitas']); ?> Orang
                                                    </small>
                                                </div>

                                                <div class="text-center p-4 flex-grow-1">
                                                    <h4><?php echo htmlspecialchars($row['nama_kost']); ?></h4>

                                                    <?php if ($diskon > 0): ?>
                                                        <!-- Hanya tampilkan harga coret jika ada diskon -->
                                                        <h3 class="mb-0"><del>Rp. <?php echo number_format($harga, 0, ',', '.'); ?></del></h3>
                                                    <?php else: ?>
                                                        <!-- Tampilkan harga biasa jika tidak ada diskon -->
                                                        <h3 class="mb-0">Rp. <?php echo number_format($harga, 0, ',', '.'); ?></h3>
                                                    <?php endif; ?>

                                                    <div class="mb-3">
                                                        <?php for ($i = 0; $i < 4; $i++): ?>
                                                            <small class="fa fa-star text-success"></small>
                                                        <?php endfor; ?>
                                                    </div>

                                                    <p><?php echo htmlspecialchars($row['fasilitas']); ?></p>

                                                    <div class="d-flex justify-content-center mb-2">
                                                        <a href="detail_user.php?id=<?php echo $row['id']; ?>" class="btn btn-md btn-success px-3 border-end" style="border-radius: 30px 0 0 30px;">
                                                            Pelajari Selengkapnya
                                                        </a>
                                                        <a href="booking.php?id=<?php echo $row['id']; ?>" class="btn btn-md btn-success px-3" style="border-radius: 0 30px 30px 0;">
                                                            Booking Sekarang
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <div class="col-12 text-center">
                                        <p class="text-muted">Tidak ada kamar tersedia saat ini.</p>
                                    </div>
                                <?php endif; ?>
                            </div>



                        </div>
                    </div>
                    <!-- Package End -->


                    <!-- Booking Start -->
                    <!-- <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="booking p-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-6 text-white">
                        <h6 class="text-white text-uppercase">Booking</h6>
                        <h1 class="text-white mb-4">Online Booking</h1>
                        <p class="mb-4">Kami memahami bahwa mencari kost yang tepat bisa menjadi tugas yang melelahkan. Oleh karena itu, kami hadir dengan sistem booking online yang inovatif dan user-friendly. Dengan beberapa klik saja, Anda dapat menemukan, membandingkan, dan memesan kost impian Anda dari mana saja dan kapan saja. </p>
                        <p class="mb-4">Nikmati kenyamanan dan kemudahan dalam mencari tempat tinggal yang sesuai dengan kebutuhan Anda tanpa harus keluar rumah.</p>
                        <a class="btn btn-outline-light py-3 px-5 mt-2" href="">Baca Selengkapnya</a>
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-white mb-4">Pesan Kost</h1>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-transparent" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control bg-transparent datetimepicker-input" id="datetime" placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" />
                                        <label for="datetime">Date & Time</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="name" placeholder="Your rooms">
                                        <label for="name">Your Room</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-transparent" placeholder="Special Request" id="message" style="height: 100px"></textarea>
                                        <label for="message">Special Request</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-outline-light w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
                    <!-- Booking Start -->



                    <!-- Process Start -->

                    <!-- Testimonial Start -->
                    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s" id="testimonial">
                        <div class="container">
                            <div class="text-center">
                                <h6 class="section-title bg-white text-center text-success px-3">Testimonial</h6>
                                <h1 class="mb-5">Komentar</h1>
                            </div>
                            <div class="owl-carousel testimonial-carousel position-relative">
                                <div class="testimonial-item bg-white text-center border p-4">
                                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="asset/farros adi .jpg" style="width: 80px; height: 80px;">
                                    <h5 class="mb-0">Farros Adi</h5>
                                    <p>Mendit, Indonesia</p>
                                    <p class="mb-0">Allah maha besar. YaAllah aku capek tolong berikan aku jalan keluar dan kemudahan yaallah. Al-Fatihah...</p>
                                </div>
                                <div class="testimonial-item bg-white text-center border p-4">
                                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="asset/Purnama.jpg" style="width: 80px; height: 80px;">
                                    <h5 class="mb-0">Purnama</h5>
                                    <p>Tidar, Indonesia</p>
                                    <p class="mt-2 mb-0">Top laptop selesaiin tugas dan penderitaanku SEKARANG!!!!!.</p>
                                </div>
                                <div class="testimonial-item bg-white text-center border p-4">
                                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="asset/Malik.jpg" style="width: 80px; height: 80px;">
                                    <h5 class="mb-0">Malik</h5>
                                    <p>Bantaran, Indonesia</p>
                                    <p class="mt-2 mb-0"><b>AKU CAPE.</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial End -->


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