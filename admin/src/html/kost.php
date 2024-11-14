<?php
session_start();
include("../../../php/koneksi.php");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CozyKost - Kelola Kost</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo cozykost1.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="../assets/css/kamar.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
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
                <i class="ti ti-menu-2"></i>
              </a>
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

      <div class="container mt-5">
        <h1>Kelola Kost</h1>
        <p>Selamat datang, <?php echo isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'Pengguna'; ?>!</p>

        <!-- Button Tambah Kost -->
        <div class="d-flex justify-content-between my-2">
          <input type="text" id="searchInput" class="form-control rounded-pill h-50 w-25" placeholder="Cari kamar...">
          <a href="create_kost.php" class="btn btn-success mb-3 rounded">
            <i class="fas fa-plus"></i> Tambah Kost
          </a>
        </div>


        <!-- Tabel untuk menampilkan data kost -->
        <table class="table table-bordered" id="kostable">
          <thead>
            <tr>
              <th>No</th>
              <th>Foto</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Deskripsi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM kost";
            $result = $conn->query($query);
            $no = 1;

            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $id = isset($row['id']) ? htmlspecialchars($row['id']) : 'Tidak ada ID';
                // $foto = !empty($row['foto']) ? "../../../uploads/kos/" . htmlspecialchars($row['foto']) : "../../../uploads/kos/default.jpg";
                $foto = !empty($row['foto']) ? htmlspecialchars($row['foto']) : "../../../upload1/";
                $nama = htmlspecialchars($row['nama']);
                $alamat = htmlspecialchars($row['alamat']);
                $deskripsi = htmlspecialchars($row['deskripsi']);

                echo "<tr>
                <td>{$no}</td>
                <td><img src='{$foto}' alt='Kamar Image' class='img-fluid' style='width: 100px; height: auto;'></td>
                <td>{$nama}</td>
                <td>{$alamat}</td>
                <td>{$deskripsi}</td>
                <td>
                  <a href='read_kamar.php?id={$id}' class='btn btn-info btn-sm'><i class='fas fa-eye'></i> Detail</a>
                  <a href='kelola_kost.php?id={$id}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a>
                  <a href='hapus_kost.php?id={$id}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus kost ini?\");'><i class='fas fa-trash'></i> Hapus</a>
                </td>
              </tr>";
                $no++;
              }
            } else {
              echo "<tr><td colspan='6' class='text-center'>Tidak ada data kost</td></tr>";
            }
            ?>
          </tbody>

        </table>
      </div>

      <!-- Scripts -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
      <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
      <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../assets/js/sidebarmenu.js"></script>
      <script src="../assets/js/app.min.js"></script>
      <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
      <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
      <script src="../assets/js/dashboard.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
      <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
          var searchValue = this.value.toLowerCase();
          var tableRows = document.querySelectorAll('#kostable tbody tr');

          tableRows.forEach(function(row) {
            var nama = row.cells[1].textContent.toLowerCase();
            var alamat = row.cells[2].textContent.toLowerCase();
            var deskripsi = row.cells[5].textContent.toLowerCase();

            // Jika pencarian cocok dengan salah satu kolom
            if (nama.includes(searchValue) || alamat.includes(searchValue) || deskripsi.includes(searchValue)) {
              row.style.display = '';
            } else {
              row.style.display = 'none';
            }
          });
        });
      </script>
</body>

</html>