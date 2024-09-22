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
                    <a href="landing page.html" class="nav-item nav-link active">Beranda</a>
                    <a href="#tentang-kami" class="nav-item nav-link">Tentang Kami</a>
                    <a href="#service" class="nav-item nav-link">Rooms</a>
                    <a href="#paket" class="nav-item nav-link">Paket</a>
                    <a href="#paket" class="nav-item nav-link">Pesanan</a>
                    <a href="contact.html" class="nav-item nav-link">Kontak</a>
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
    
            <!-- Tombol Pilih Pembayaran -->
            <h6>Pilih Cara Pembayaran</h6>
            <div class="form-group">
                <select class="form-select" id="paymentSelect" onclick="showPaymentModal()" readonly>
                    <option selected disabled id="selectedPayment">Pilih Metode Pembayaran</option>
                </select>
            </div>
        </div>
    
        <!-- Pesanan -->
        <div class="pesanan">
            <div class="p-3 bg-light rounded">
                <h6>Pesanan</h6>
                <p class="mb-1"><?php echo date('j F Y', strtotime($tgl_masuk)); ?> - <?php echo date('j F Y', strtotime($tgl_keluar)); ?></p>
                <hr>
                <div class="mb-2 text-start">
                    <img src="asset/image 2.png" alt="Kamar" class="img-fluid">
                    <img src="asset/image 3.png" alt="Kamar" class="img-fluid">

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
        <h5>Rincian Pembayaran</h5>
        <div class="d-flex justify-content-between">
            <p>Kost</p>
            <p>Rp.1.500.000</p>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <p><strong>Total</strong></p>
            <p><strong>Rp.1.500.000</strong></p>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <button class="btn btn-success me-2" style="border-radius: 7px;">Konfirmasi Pesanan</button>
            <a href="landing_page.php" class="btn btn-secondary" style="border-radius: 7px;">Kembali Ke Dashboard</a>
        </div>
    </div>
    
        <!-- Modal untuk Pilihan Pembayaran -->
        <div class="modal fade modal-dialog-scrollable" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="paymentModalLabel">Pilih Cara Pembayaran</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="paymentOptions" id="ewallet" value="E-Wallet" onclick="toggleSubOptions(true)">
                              <label class="form-check-label" for="ewallet">
                                  <i class="fa-solid fa-mobile-screen-button"></i> E-Wallet
                              </label>
                          </div>
                          <div class="sub-options" id="ewalletOptions">
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="ewalletOptions" id="ovo" value="OVO">
                                  <label class="form-check-label" for="ovo">
                                      <img src="asset/ovo-removebg-preview.png" alt="OVO" class="payment-icon">
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="ewalletOptions" id="gopay" value="GoPay">
                                  <label class="form-check-label" for="gopay">
                                      <img src="asset/gope_rev-removebg-preview.png" alt="GoPay" class="payment-icon"> 
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="ewalletOptions" id="dana" value="DANA">
                                  <label class="form-check-label" for="dana">
                                      <img src="asset/dana-removebg-preview.png" alt="DANA" class="payment-icon"> 
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="ewalletOptions" id="gofood" value="GoFood">
                                  <label class="form-check-label" for="gofood">
                                      <img src="asset/download-removebg-preview (1).png" alt="GoFood" class="payment-icon"> 
                                  </label>
                              </div>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="paymentOptions" id="bankTransfer" value="Bank Transfer" onclick="toggleSubOptions(false)">
                              <label class="form-check-label" for="bankTransfer">
                                  <i class="fa-solid fa-university"></i> Bank Transfer
                              </label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="paymentOptions" id="creditCard" value="Credit Card" onclick="toggleSubOptions(false)">
                              <label class="form-check-label" for="creditCard">
                                  <i class="fa-solid fa-credit-card"></i> Credit Card
                              </label>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="savePaymentMethod()">Simpan Pilihan</button>
                  </div>
              </div>
          </div>
      </div>
    
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
    
    <!-- Footer Start -->
    <!-- <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container pt-5">
            <div class="row g-5 mb-5">
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
                <div class="footer-gallery">
                    <h4 class="text-white mb-3">Galeri</h4>
                        <div class="gallery-container">
                            <img src="asset/image15.jpg" alt="Gallery Image 1" class="img-thumbnail">
                            <img src="asset/image 3.png" alt="Gallery Image 2" class="img-thumbnail">
                            <img src="asset/image 4.png" alt="Gallery Image 2" class="img-thumbnail">
                            <img src="asset/image 5...png" alt="Gallery Image 2" class="img-thumbnail">
                            <img src="asset/Kamar 77.png" alt="Gallery Image 2" class="img-thumbnail">
                            <img src="asset/Image 20.png" alt="Gallery Image 3" class="img-thumbnail">
                        </div>
                    </div>
                    </div> -->
                                  <!-- Tambahkan gambar lainnya sesuai kebutuhan -->
        <!-- <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">CozyKost</a>, All Right Reserved. -->

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        <!-- Designed By <a class="border-bottom" href="#">Lebah Ganteng</a>
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
                
            </div>
    </div> -->
    <!-- Footer End -->


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