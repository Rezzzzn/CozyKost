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

        <?php
        include 'get_booking.php'; // Ambil data booking dari database
        $tgl_masuk = $row['tgl_masuk'];
        $tgl_keluar = $row['tgl_keluar'];
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <title>Pembayaran</title>
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
            <link href="css/pembayaran.css" rel="stylesheet">
            <link rel="stylesheet" href="css/modal.css">
            <link rel="stylesheet" href="css/pb.css">

        </head>

        <body>

        <style>
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            width: 900px;
            justify-content: center;
        }

        .card-body {
            padding: 2rem;
        }

        .booking-section {
            margin-top: 0px;
        }

        .booking-card {
            border-radius: 15px; /* Border radius pada form */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .booking-card .card-body {
            padding: 2rem;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 15px; /* Border radius pada gambar kamar */
        }

        .booking-card img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .carousel-item img {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .booking-card .card-body {
            padding: 2rem;
        }

        .booking-card ul {
            padding-left: 1.5rem;
        }

        .booking-card ul li {
            margin-bottom: 10px;
        }

        .booking-card ul li i {
            color: #28a745; /* Warna ikon sesuai dengan tema */
            margin-right: 10px;
        }

        .carousel-item img {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .facilities ul {
            padding-left: 1.5rem;
        }

        .facilities ul li {
            margin-bottom: 10px;
        }

        .facilities ul li i {
            color: #000000; /* Warna ikon sesuai dengan tema */
            margin-right: 10px;
        }

        .booking-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        hr {
            margin: 30px 0;
        }


</style>


            <div class="modal fade modal-profile" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
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
                        <input type="text" class="form-control" id="username" placeholder=" &#xf007;   Username" style="margin-bottom: -10px;font-family: 'Arial', FontAwesome;">
                        </div>
                        <div class="form-group mb-3">
                        <input type="password" class="form-control" id="password" placeholder=" &#xf023;   New Password" style="margin-bottom: -10px;font-family: 'Arial', FontAwesome;">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" id="password" placeholder=" &#xf023;   New Password" style="margin-bottom: -10px;font-family: 'Arial', FontAwesome;">
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Save changes</button>
                    </div>
                </div>
                </div>
            </div>
        
            <!-- Spinner End -->



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
                            <a href="landing_page.php" class="nav-item nav-link active">Beranda</a>
                            <a href="#tentang-kami" class="nav-item nav-link">Tentang Kami</a>
                            <a href="#service" class="nav-item nav-link">Kamar</a>
                            <a href="#paket" class="nav-item nav-link">Paket</a>
                            <a href="#paket" class="nav-item nav-link">Pesanan</a>
                            <a href="contact.html" class="nav-item nav-link">Kontak</a>
                            <a href="" style="font-size: large" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="fas fa-user me-2" ></i><?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Guest'; ?></a>
                        </div>
                        </div> 
                </nav>

            </div>
            <!-- Navbar & Hero End -->

            <section class="booking-section pb-5">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h6 class="section-title bg-white text-center text-success px-3">Kost</h6>
        <h1 class="mb-4">Booking</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card booking-card">
                    <div class="card-body">
                        <!-- Gambar Kost dan Fasilitas -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <!-- Carousel Gambar Kost -->
                                <div id="kostCarousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="asset/Image 20.png" class="d-block w-100" alt="Foto Kost 1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="asset/image 5...png" class="d-block w-100" alt="Foto Kost 2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="asset/image 6.png" class="d-block w-100" alt="Foto Kost 3">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#kostCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#kostCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Fasilitas Kost -->
                                <div class="facilities">
                                    <h5 class="mb-3">Fasilitas Kost</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fa-solid fa-bath"></i> Kamar Mandi Dalam</li>
                                        <li><i class="fa-solid fa-car"></i> Parkiran</li>
                                        <li><i class="fa-solid fa-wifi"></i> WiFi</li>
                                        <li><i class="fa-solid fa-utensils"></i> Dapur</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr> <!-- Garis pembeda -->
                        <!-- Form Booking -->
                        <form action="php/save_booking.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" style="border-radius: 8px;" placeholder="Masukkan nama lengkap Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" style="border-radius: 8px;" placeholder="Masukkan email Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">No. Telepon</label>
                                <input type="tel" class="form-control" id="phone" name="phone" style="border-radius: 8px;" placeholder="Masukkan no. telepon Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="start-date" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start-date" name="start-date" style="border-radius: 8px;" required>
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Durasi (bulan)</label>
                                <input type="number" class="form-control" id="duration" name="duration" style="border-radius: 8px;" placeholder="Masukkan durasi kost (dalam bulan)" required>
                            </div>
                            <div class="text-end btn-submit">
                                <button type="submit" class="btn btn-success" style="border-radius: 6px;">Lanjutkan</button>
                                <a href="landing_page.php" class="btn btn-secondary" style="border-radius: 6px;">Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



            
                <!-- Modal untuk Pilihan Pembayaran -->
                
            
            <!-- Modal untuk Fasilitas -->
            <div class="modal fade modal-dialog-scrollable" id="facilitiesModal" tabindex="-1" aria-labelledby="facilitiesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="facilitiesModalLabel">Fasilitas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled">
                            <li><i class="fa-solid fa-bath"></i> Kamar Mandi Dalam</li>
                            <li><i class="fa-solid fa-car"></i> Parkiran</li>
                            <li><i class="fa-solid fa-wifi"></i> WiFi</li>
                            <li><i class="fa-solid fa-utensils"></i> Dapur</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
            </div>
            
            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-success btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

            <!-- Bootstrap JS and Popper.js -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
            
            <script>
                function showPaymentModal() {
                    var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'), {
                        keyboard: false
                    });
                    paymentModal.show();
                }
            
                function savePaymentMethod() {
                    var selectedOption = document.querySelector('input[name="paymentOptions"]:checked').value;
                    document.getElementById('selectedPayment').textContent = selectedOption;
                }
            
            
                function toggleSubOptions(show) {
                        var subOptions = document.getElementById('ewalletOptions');
                        if (show) {
                            subOptions.style.display = 'block'; // Tampilkan dropdown
                        } else {
                            subOptions.style.display = 'none'; // Sembunyikan dropdown
                        }
                    }
            
                    // Menyembunyikan sub-pilihan jika metode lain dipilih
                    document.querySelectorAll('input[name="paymentOptions"]').forEach(function(radio) {
                        radio.addEventListener('change', function() {
                            if (this.id !== 'ewallet') {
                                toggleSubOptions(false);
                            }
                        });
                    });
            
            </script>
            
        

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