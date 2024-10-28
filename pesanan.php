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
                            <a href="landing_page.php" class="nav-item nav-link">Beranda</a>
                            <!-- <a href="" class="nav-item nav-link">Tentang Kami</a> -->
                            <a href="kamar.php" class="nav-item nav-link">Kamar</a>
                            <a href="#paket" class="nav-item nav-link">Paket</a>
                            <a href="pesanan.php" class="nav-item nav-link active">Pesanan</a>
                            <a href="kontak.php" class="nav-item nav-link">Kontak</a>
                            <a href="" style="font-size: large" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="fas fa-user me-2" ></i><?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Guest'; ?></a>
                        </div>
                        </div> 
                </nav>

            </div>
            <!-- Navbar & Hero End -->

            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-success px-3">Pesan Kost</h6>
                <h1 class="mb-5">Pesanan Anda</h1>
            </div>

            <div class="main-content">
                <!-- Data Penghuni -->
                <div class="data-penghuni">
                    <h5>Data Penghuni</h5>
                    <p class="mb-1"><strong>Purwono</strong></p>
                    <p class="mb-1">purwonoadi@gmail.com</p>
                    <p class="text-muted">Kartu identitas asli (KTP/KITAS) dan Surat Nikah (untuk pasangan) dibutuhkan saat check-in</p>
                </div>
            
                <!-- Pesanan -->
                <div class="pesanan">
                    <div class="p-2 bg-light rounded">
                        <h6>Pesanan</h6>
                        <p class="mb-1"><?php echo date('j F Y', strtotime($tgl_masuk)); ?> - <?php echo date('j F Y', strtotime($tgl_keluar)); ?></p>
                        <hr>
                        <div class="mb-2 text-start">
                    <img src="asset/image 2.png" alt="Kamar" class="img-fluid kamar">
                    <img src="asset/image 3.png" alt="Kamar" class="img-fluid kamar">

                </div>
                        <p class="mb-1 mt-2">Kamar kamu</p>
                        <p class="mb-1"><strong>Farros Stay House</strong></p>
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#facilitiesModal">Lihat Fasilitas</a>
                        <hr>
                        <p><strong>Rp.1.500.000 / Bulan</strong></p>
                    </div>
                </div>
            </div>
            
            <!-- Rincian Pembayaran -->
            <div class="rincian-pembayaran mt-4">
                <div class="d-flex justify-content-end mt-4">
                    <a href="landing_page.php" class="btn btn-secondary" style="border-radius: 7px;">Kembali Ke Dashboard</a>
                </div>
            </div>
            
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