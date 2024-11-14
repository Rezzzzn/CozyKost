<?php
session_start();
include("../../../php/koneksi.php");

if (!isset($_SESSION['id_user']) || ($_SESSION['level'] != '1' && $_SESSION['level'] != '2')) {
  header("Location: ../../landing_page.php");
  exit();
}

$query = "SELECT * FROM kamar";
$result = $conn->query($query);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CozyKost</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo cozykost1.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/kamar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php include 'sidebar.php'; ?>
    <div class="body-wrapper">
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)">
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
                    <a href="../../../index.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <div class="container py-3">
        <h2 class="mb-4">Daftar Kamar</h2>
        <div class="d-flex justify-content-between my-2">
          <input type="text" id="searchInput" class="form-control rounded-pill h-50 w-25" placeholder="Cari kamar...">
          <a href="proses_create_kamar.php" class="btn btn-outline-success rounded-pill mb-4">+ Tambah Kamar</a>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered" id="kamarTable">
            <thead>
              <tr>
                <th scope="col">Gambar</th>
                <th scope="col">Nama Kost</th>
                <th scope="col">Alamat</th>
                <th scope="col">Durasi</th>
                <th scope="col">Kapasitas</th>
                <th scope="col">Harga Sebelum Diskon</th>
                <th scope="col">Diskon</th>
                <th scope="col">Harga Setelah Diskon</th>
                <th scope="col">Status</th>
                <th scope="col">Fasilitas</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $harga = $row['harga'];
                  $diskon = intval(rtrim($row['diskon'], '%')); // Mengambil nilai diskon dari database
                  $hargaSetelahDiskon = $harga - ($harga * ($diskon / 100));
              ?>
                <tr>
                  <td>
                    <img src="../../../uploads/<?php echo htmlspecialchars($row['gambar1']); ?>" alt="Kamar Image" class="img-fluid" style="width: 100px; height: auto;">
                  </td>
                  <td><?php echo htmlspecialchars($row['nama_kost']); ?></td>
                  <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                  <td><?php echo htmlspecialchars($row['durasi']); ?> Bulan</td>
                  <td><?php echo htmlspecialchars($row['kapasitas']); ?> Orang</td>
                  <td>Rp <?php echo number_format($harga, 0, ',', '.'); ?></td>
                  <td><?php echo htmlspecialchars($row['diskon']); ?></td>
                  <td>Rp <?php echo number_format($hargaSetelahDiskon, 0, ',', '.'); ?></td>
                  <td>
                    <?php
                    if ($row['status'] == 'Tidak Tersedia') {
                      echo '<span class="badge bg-danger">Tidak Tersedia</span>';
                    } else {
                      echo '<span class="badge bg-success">Tersedia</span>';
                    }
                    ?>
                  </td>
                  <td><?php echo htmlspecialchars($row['fasilitas']); ?></td>
                  <td>
                    <a href="edit_kamar.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning text-light rounded-3 mb-2">
                      <i class="fas fa-edit"></i> <!-- Ikon untuk Edit -->
                    </a>
                    <a href="delete_kamar.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger rounded-3">
                      <i class="fas fa-trash-alt"></i> <!-- Ikon untuk Delete -->
                    </a>
                  </td>
                </tr>
              <?php }
            } else { ?>
              <tr>
                <td colspan="11" class="text-center text-muted">No records found.</td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script>
      document.getElementById('searchInput').addEventListener('keyup', function() {
        var searchValue = this.value.toLowerCase();
        var tableRows = document.querySelectorAll('#kamarTable tbody tr');

        tableRows.forEach(function(row) {
          var rowText = row.textContent.toLowerCase();
          if (rowText.includes(searchValue)) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
