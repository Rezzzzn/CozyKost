<?php
session_start();
include "../../../php/koneksi.php";

// Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['id_user']) || ($_SESSION['level'] != '1' && $_SESSION['level'] != '2')) {
    header("Location: ../../landing_page.php");
    exit();
}

// Ambil data user berdasarkan ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM tbl_login WHERE id_user = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User tidak ditemukan!";
        exit();
    }
}

// Jika form disubmit untuk update data user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update data user
    if (!empty($password)) {
        $stmt = $conn->prepare("UPDATE tbl_login SET nama = ?, email = ?, sandi = ? WHERE id_user = ?");
        $stmt->bind_param("sssi", $nama, $email, $password, $id);
    } else {
        $stmt = $conn->prepare("UPDATE tbl_login SET nama = ?, email = ? WHERE id_user = ?");
        $stmt->bind_param("ssi", $nama, $email, $id);
    }

    if ($stmt->execute()) {
        header("Location: manage_user.php");
        exit();
    } else {
        echo "Gagal memperbarui data!";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CozyKost</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo cozykost1.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/kamar.css  ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/logo cozykost1.png" alt="" width="200px" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <!-- Sidebar Header -->
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                            <span class="hide-menu">Home</span>
                        </li>

                        <!-- Dashboard Section -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./index.php" aria-expanded="false">
                                <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <span class="sidebar-divider lg"></span>
                        </li>

                        <!-- New Section Title with Icon -->
                        <?php if ($_SESSION['level'] == 1) { ?>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="kost.php" aria-expanded="false">
                                    <iconify-icon icon="mdi:home-outline"></iconify-icon>
                                    <span class="hide-menu">Kost</span>
                                </a>
                            </li>
                        <?php } ?>

                        <!-- Kamar Section -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="kamar.php" aria-expanded="false">
                                <iconify-icon icon="material-symbols:bed"></iconify-icon>
                                <span class="hide-menu">Kamar</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="booking.php" aria-expanded="false">
                                <iconify-icon icon="uil:calender"></iconify-icon>
                                <span class="hide-menu">Booking</span>
                            </a>
                        </li>

                        <?php if ($_SESSION['level'] == 1) { ?>
                            <li class="nav-small-cap">
                                <iconify-icon icon="solar:widget-add-line-duotone" class="nav-small-cap-icon fs-4"></iconify-icon>
                                <span class="hide-menu">User</span>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="manage_user.php" aria-expanded="false">
                                    <iconify-icon icon="mdi:user"></iconify-icon>
                                    <span class="hide-menu">User</span>
                                </a>
                            </li>
                        <?php } ?>


                    </ul>
                </nav>

                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <div class="ikan mb-5">
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
            </div>

            <!--  Header End -->

            <!-- Main Content -->
            <div class="row">
                <div class="col-md-1">
                    <?php include 'sidebar.php'; // Include file sidebar untuk navigasi 
                    ?>
                </div>
                <div class="col-md-10 mt-5">
                    <div class="content">
                        <h3>Edit User: <?= $user['nama']; ?></h3>
                        <div class="form-container">
                            <form action="edit_user.php?id=<?= $user['id_user'] ?>" method="post">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama:</label>
                                    <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah):</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="manage_user.php" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Add -->
            <div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="addEditModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEditModalLabel">Add/Edit Kamar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../php/create_kamar.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal for Edit -->
            <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="EditModalLabel">Edit Kamar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../php/create_kamar.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Scripts -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
            <script>
                // Search Functionality
                document.getElementById('searchInput').addEventListener('input', function() {
                    const searchValue = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#kamarTable tbody tr');

                    rows.forEach(row => {
                        const cells = row.getElementsByTagName('td');
                        let match = false;
                        for (let i = 1; i < cells.length - 1; i++) {
                            if (cells[i].innerText.toLowerCase().includes(searchValue)) {
                                match = true;
                                break;
                            }
                        }
                        row.style.display = match ? '' : 'none';
                    });
                });
            </script>
            <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
            <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <script src="../assets/js/sidebarmenu.js"></script>
            <script src="../assets/js/app.min.js"></script>
            <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
            <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
            <script src="../assets/js/dashboard.js"></script>
            <!-- solar icons -->
            <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>