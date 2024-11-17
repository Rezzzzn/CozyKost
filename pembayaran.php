<?php
// Memulai session
session_start();

include 'php/koneksi.php';

// Cek apakah user sudah login
if (isset($_SESSION['nama'])) {
    $username = $_SESSION['nama'];
} else {
    header("location:login.php");
    exit;
}

// Ambil ID booking dari session atau URL
$id_booking = $_SESSION['id_booking'] ?? $_GET['id_booking'] ?? null;

// Cek apakah ID booking ada
if ($id_booking) {
    $query = "SELECT nama, email, status_pembayaran FROM booking WHERE id_booking = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_booking);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    if ($booking) {
        $nama = $booking['nama'];
        $email = $booking['email'];
        $status_pembayaran = $booking['status_pembayaran']; // Ambil status pembayaran
    } else {
        echo "Data booking tidak ditemukan.";
        $nama = $email = $status_pembayaran = "";
    }

    // Query untuk mengambil data kamar
    $query = "SELECT b.id_booking, b.nama, b.email, b.no_telp, b.id_kamar, b.created_at, k.durasi, k.nama_kost, k.harga, k.fasilitas, k.gambar1, k.gambar2
              FROM booking b
              JOIN kamar k ON b.id_kamar = k.id
              WHERE b.id_booking = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_booking);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tgl_masuk = $row['created_at'];
        $durasi = $row['durasi'];
        $nama_kamar = $row['nama_kost'];
        $harga = $row['harga'];
        $fasilitas = $row['fasilitas'];
        $gambar_1 = $row['gambar1'];
        $gambar_2 = $row['gambar2'];

        // Hitung tanggal keluar berdasarkan durasi (dalam bulan)
        if ($tgl_masuk && $durasi) {
            $datetime = new DateTime($tgl_masuk);
            $datetime->add(new DateInterval('P' . $durasi . 'M'));
            $tgl_keluar = $datetime->format('Y-m-d');
        } else {
            $tgl_keluar = null;
        }
    } else {
        echo "Pesanan tidak ditemukan.";
        $tgl_masuk = $tgl_keluar = $nama_kamar = $harga = $fasilitas = $gambar_1 = $gambar_2 = "";
    }
} else {
    echo "ID booking tidak ditemukan.";
    $nama = $email = $tgl_masuk = $tgl_keluar = $nama_kamar = $harga = $fasilitas = $gambar_1 = $gambar_2 = "";
}

// Mendefinisikan harga awal
$harga_awal = $harga;

// Tentukan persentase diskon berdasarkan durasi
if ($durasi == 12) {
    $diskon_persen = 20; // 20% untuk durasi 12 bulan
} else if ($durasi == 6) {
    $diskon_persen = 10; // 10% untuk durasi 6 bulan
} else {
    $diskon_persen = 0; // Tanpa diskon jika durasi kurang dari 6 bulan
}

// Hitung jumlah diskon dan harga setelah diskon
$diskon = ($harga_awal * $diskon_persen) / 100;
$harga_setelah_diskon = $harga_awal - $diskon;

// Jika status pembayaran belum ada (Belum Dibayar), tambahkan opsi pembayaran
if ($status_pembayaran == 'Belum Dibayar') {
    // Simulasi pembayaran berhasil (untuk demonstrasi)
    // Anda dapat mengganti bagian ini dengan metode pembayaran yang sesungguhnya (misalnya, menggunakan gateway pembayaran)
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_method'])) {
        $status_pembayaran = 'Dibayar'; // Pembayaran sukses
        $payment_method = $_POST['payment_method']; // Metode pembayaran yang dipilih

        // Update status pembayaran di database
        $update_query = "UPDATE booking SET status_pembayaran = ?, metode_pembayaran = ? WHERE id_booking = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssi", $status_pembayaran, $payment_method, $id_booking);
        $stmt->execute();

        // Redirect ke halaman sukses pembayaran
        header("Location: pembayaran_sukses.php?status=success");
        exit;
    }
}
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
        .pesanan {
            display: flex;
            flex-direction: column;
            /* Menata elemen secara vertikal */
            align-items: flex-start;
            /* Menyusun elemen ke kiri (atau bisa menggunakan center) */
            height: auto;
            /* Membiarkan kontainer menyesuaikan dengan kontennya */
        }

        .pesanan .mb-1 {
            margin-bottom: 10px;
            /* Menambahkan jarak antara elemen-elemen */
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
                    <a href="#service" class="nav-item nav-link">Rooms</a>
                    <a href="#paket" class="nav-item nav-link">Paket</a>
                    <a href="#paket" class="nav-item nav-link">Pesanan</a>
                    <a href="contact.html" class="nav-item nav-link">Kontak</a>
                    <a href="" style="font-size: large" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="fas fa-user me-2"></i><?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Guest'; ?></a>
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
            <p class="mb-1"><?php echo htmlspecialchars($nama); ?></p>
            <p class="mb-1"><?php echo htmlspecialchars($email); ?></p>
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
                <!-- Tampilkan Tanggal Masuk dan Tanggal Keluar -->
                <p class="mb-1"><?php echo date('j F Y', strtotime($tgl_masuk)); ?> - <?php echo date('j F Y', strtotime($tgl_keluar)); ?></p>
                <hr>
                <div class="mb-2 text-start">
                    <img src="uploads/<?php echo htmlspecialchars($gambar_1); ?>" alt="Kamar 1" class="img-fluid kamar">
                    <img src="uploads/<?php echo htmlspecialchars($gambar_2); ?>" alt="Kamar 2" class="img-fluid kamar">
                </div>
                <p class="mb-1 mt-2">Kamar kamu</p>
                <p class="mb-1"><strong><?php echo htmlspecialchars($nama_kamar); ?></strong></p>
                <p class="mb-1">Fasilitas: <?php echo htmlspecialchars($fasilitas); ?></p>
                <p class="mb-1">Harga: Rp<?php echo number_format($harga, 0, ',', '.'); ?></p>
            </div>
        </div>
    </div>

    <!-- Rincian Pembayaran -->
    <div class="rincian-pembayaran mt-4">
        <h5>Rincian Pembayaran</h5>
        <div class="d-flex justify-content-between">
            <p>Kost</p>
            <h4> Rp<?php echo number_format($harga_awal, 0, ',', '.'); ?></h4>
        </div>
        <div class="d-flex justify-content-between">
            <p>Diskon (<?php echo $diskon_persen; ?>%)</p>
            <h5>Rp<?php echo number_format($diskon, 0, ',', '.'); ?></h5>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <h4><strong>Total</strong></h4>
            <h4><strong>Rp <span id="hargaKamar"><?php echo number_format($harga_setelah_diskon, 0, ',', '.'); ?></span></strong></h4>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <button class="btn btn-success me-2" style="border-radius: 7px;" onclick="openPaymentModal()">Konfirmasi Pesanan</button>
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
                        <div class="sub-options" id="ewalletOptions" style="display:none;">
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
                    <button type="button" class="btn btn-success" onclick="savePaymentMethod()">Simpan Pilihan</button>
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
                        <!-- Fasilitas 1: Kamar Mandi Dalam -->
                        <li class="fasilitas d-flex flex-wrap align-items-center">
                            <a class="text-dark" data-bs-toggle="collapse" href="#collapseBathroom" role="button" aria-expanded="false" aria-controls="collapseBathroom">
                                <i class="fa-solid fa-bath me-2"></i> Kamar Mandi Dalam
                            </a>
                            <div class="collapse" id="collapseBathroom">
                                <div class="d-flex justify-content-center mt-2">
                                    <img src="asset/jedhing2.png" class="fasilitas-img" alt="Kamar Mandi Dalam" style="width:400px; border-radius:3px;">
                                </div>
                            </div>
                        </li>
                        <!-- Fasilitas 2: Parkiran -->
                        <li class="fasilitas d-flex flex-wrap align-items-center">
                            <a class="text-dark" data-bs-toggle="collapse" href="#collapseParking" role="button" aria-expanded="false" aria-controls="collapseParking">
                                <i class="fa-solid fa-car me-2"></i> Parkiran
                            </a>
                            <div class="collapse" id="collapseParking">
                                <div class="d-flex justify-content-center mt-2">
                                    <img src="asset/parkiran2.jpg" class="fasilitas-img" alt="Parkiran" style="width:400px; border-radius:3px;">
                                </div>
                            </div>
                        </li>
                        <!-- Fasilitas 3: WiFi -->
                        <li class="fasilitas d-flex flex-wrap align-items-center">
                            <a class="text-dark" data-bs-toggle="collapse" href="#collapseWifi" role="button" aria-expanded="false" aria-controls="collapseWifi">
                                <i class="fa-solid fa-wifi me-2"></i> WiFi
                            </a>
                            <div class="collapse" id="collapseWifi">
                                <div class="d-flex justify-content-center mt-2">
                                    <img src="asset/wifi2.jpg" class="fasilitas-img" alt="WiFi" style="width:400px; border-radius:3px;">
                                </div>
                            </div>
                        </li>
                        <!-- Fasilitas 4: Dapur -->
                        <li class="fasilitas d-flex flex-wrap align-items-center">
                            <a class="text-dark" data-bs-toggle="collapse" href="#collapseKitchen" role="button" aria-expanded="false" aria-controls="collapseKitchen">
                                <i class="fa-solid fa-utensils me-2"></i> Dapur
                            </a>
                            <div class="collapse" id="collapseKitchen">
                                <div class="d-flex justify-content-center mt-2">
                                    <img src="asset/pawon2.jpg" class="fasilitas-img" alt="Dapur" style="width:400px; border-radius:3px;">
                                </div>
                            </div>
                        </li>
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
        let selectedPaymentMethod = null;
        let selectedEwalletOption = null;

        // Mengambil harga dari elemen HTML
        let hargaText = document.getElementById('hargaKamar').textContent;
        let harga = hargaText.replace('Rp', '').replace('.', '').trim(); // Menghapus 'Rp' dan titik, serta mengonversi ke angka
        harga = parseInt(harga) * 1000;

        // Mendapatkan id_booking dari PHP
        let idBooking = <?php echo json_encode($id_booking); ?>;

        function showPaymentModal() {
            const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'), {
                keyboard: false
            });
            paymentModal.show();
        }

        function toggleSubOptions(show) {
            document.getElementById("ewalletOptions").style.display = show ? "block" : "none";
        }

        // Menyembunyikan sub-pilihan jika metode lain dipilih
        document.querySelectorAll('input[name="paymentOptions"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                toggleSubOptions(this.id === 'ewallet');
            });
        });

        function savePaymentMethod() {
            // Menyimpan pilihan metode pembayaran utama
            const paymentOptions = document.getElementsByName('paymentOptions');
            for (let option of paymentOptions) {
                if (option.checked) {
                    selectedPaymentMethod = option.value;
                    break;
                }
            }

            // Jika metode adalah E-Wallet, simpan sub-pilihannya
            if (selectedPaymentMethod === "E-Wallet") {
                const ewalletOptions = document.getElementsByName('ewalletOptions');
                for (let option of ewalletOptions) {
                    if (option.checked) {
                        selectedEwalletOption = option.value;
                        break;
                    }
                }
            }

            // Menampilkan metode pembayaran yang dipilih
            document.getElementById('selectedPayment').textContent = selectedPaymentMethod;

            // Tutup modal dan hapus backdrop
            const paymentModal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
            paymentModal.hide();
        }

        function openPaymentModal() {
            // Kirim data pembayaran ke process_payment.php dan ambil snap token dari Midtrans
            fetch('payment_process.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        paymentMethod: selectedPaymentMethod,
                        ewalletOption: selectedEwalletOption,
                        harga: harga,
                        id_booking: idBooking // Mengirim id_booking
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        // Panggil Midtrans Snap untuk melakukan pembayaran
                        window.snap.pay(data.token, {
                            onSuccess: function(result) {
                                alert("Pembayaran berhasil!");
                                window.location.href = "success_page.php"; // Arahkan ke halaman sukses setelah pembayaran berhasil
                            },
                            onPending: function(result) {
                                alert("Menunggu pembayaran...");
                            },
                            onError: function(result) {
                                alert("Pembayaran gagal!");
                            },
                            onClose: function() {
                                alert("Anda menutup popup pembayaran.");
                            }
                        });
                    } else {
                        alert("Gagal mendapatkan token pembayaran: " + data.error);
                    }
                })
                .catch(error => {
                    alert("Terjadi kesalahan: " + error);
                });
        }


        // Menambahkan event listener untuk link collapse
        const collapseLink = document.querySelector('.fasilitas a');
        const collapseElement = document.querySelector('#collapseBathroom');

        collapseLink.addEventListener('click', function() {
            collapseLink.setAttribute('aria-expanded', !collapseElement.classList.contains('show'));
        });
    </script>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-zk0KqiwrCAgqgUlo"></script>




    <!-- JavaScript Libraries -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>


    <!-- CSS Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">


    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>