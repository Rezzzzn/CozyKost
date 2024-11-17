<?php
session_start();
include '../../../php/koneksi.php';
require_once '../../../midtrans_config.php';

// Query untuk mengambil data booking dengan order_id
$query = "SELECT b.id_booking AS order_id, b.nama, b.email, b.no_telp, k.nama_kost, b.created_at, k.durasi, b.status_pembayaran, b.metode_pembayaran
          FROM booking b
          JOIN kamar k ON b.id_kamar = k.id";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Mengecek apakah ada data booking
if ($result->num_rows > 0) {
  while ($booking = $result->fetch_assoc()) {
    $order_id = $booking['order_id']; // Ambil order_id dari database

    try {
      // Ambil status pembayaran dan metode pembayaran dari Midtrans
      $transaction = \Midtrans\Transaction::status($order_id);
      $new_status = $transaction->transaction_status; // Status pembayaran dari Midtrans
      $payment_method = $transaction->payment_type; // Metode pembayaran dari Midtrans

      // Konversi status Midtrans ke format status yang Anda gunakan
      switch ($new_status) {
        case 'settlement':
          $status_pembayaran = 'Lunas';
          break;
        case 'capture':
          $status_pembayaran = 'Lunas';
          break;
        case 'pending':
          $status_pembayaran = 'Menunggu Pembayaran';
          break;
        case 'cancel':
        case 'deny':
        case 'expire':
          $status_pembayaran = 'Dibatalkan';
          break;
        default:
          $status_pembayaran = 'Tidak Diketahui';
      }

      // Update status pembayaran dan metode pembayaran di database
      $update_query = "UPDATE booking SET status_pembayaran = ?, metode_pembayaran = ? WHERE id_booking = ?";
      $update_stmt = $conn->prepare($update_query);
      $update_stmt->bind_param('ssi', $status_pembayaran, $payment_method, $booking['id_booking']);
      $update_stmt->execute();

      // Tambahkan data ke array untuk digunakan di tabel HTML
      $booking['status_pembayaran'] = $status_pembayaran;
      $booking['metode_pembayaran'] = $payment_method;
    } catch (Exception $e) {
      // Abaikan error jika order_id tidak ditemukan di Midtrans
      error_log("Error for Order ID $order_id: " . $e->getMessage());
    }
    $bookings[] = $booking; // Simpan setiap data booking dengan nilai terbaru
  }
} else {
  echo "Tidak ada data booking yang tersedia.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Booking</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo cozykost1.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="../assets/css/kamar.css  ">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include 'sidebar.php'; ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="javascript:void(0)">
                <iconify-icon icon="solar:bell-linear" class="fs-6" style="color: #000000;"></iconify-icon>
                <div class="notification bg-success rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->

      <!-- Main Content -->
      <div class="container mt-5">
        <h1>Kelola Booking</h1>
        <p>Selamat datang, <?php echo $_SESSION['nama']; ?>!</p>    <h2>Detail Booking</h2>

      <?php if (!empty($bookings)): ?>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID Booking</th>
              <th>Nama</th>
              <th>Email</th>
              <th>No. Telepon</th>
              <th>Nama Kamar</th>
              <th>Tanggal Masuk</th>
              <th>Tanggal Keluar</th>
              <th>Status Pembayaran</th>
              <th>Metode Pembayaran</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($bookings as $booking): ?>
              <?php
              $nama = $booking['nama'];
              $email = $booking['email'];
              $no_telp = $booking['no_telp'];
              $nama_kamar = $booking['nama_kost'];
              $tgl_masuk = $booking['created_at'];
              $durasi = $booking['durasi'];

              if ($tgl_masuk && $durasi) {
                $datetime = new DateTime($tgl_masuk);
                $datetime->add(new DateInterval('P' . $durasi . 'M'));
                $tgl_keluar = $datetime->format('Y-m-d');
              } else {
                $tgl_keluar = null;
              }
              ?>
              <tr>
                <td><?= htmlspecialchars($booking['order_id']) ?></td>
                <td><?= htmlspecialchars($nama) ?></td>
                <td><?= htmlspecialchars($email) ?></td>
                <td><?= htmlspecialchars($no_telp) ?></td>
                <td><?= htmlspecialchars($nama_kamar) ?></td>
                <td><?= htmlspecialchars($tgl_masuk) ?></td>
                <td><?= htmlspecialchars($tgl_keluar) ?></td>
                <td><?= htmlspecialchars($booking['status_pembayaran']) ?></td>
                <td><?= htmlspecialchars($booking['metode_pembayaran']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>Tidak ada data booking yang tersedia.</p>
      <?php endif; ?>
</body>

</html>