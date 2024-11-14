<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Masuk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/kamar.css  ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Styles */
        body {
            background-color: #f8f9fa;
            color: #333;
        }

        .inbox-header {
            font-weight: bold;
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            color: #495057;
            margin-bottom: 1.5rem;
            margin-top: 7rem;
        }

        .inbox-header i {
            color: #17a2b8;
            margin-right: 10px;
        }

        .message-card {
            background-color: #fff;
            border: none;
            border-left: 4px solid #28a745;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            padding: 1rem 1.5rem;
            border-radius: 0.375rem;
            position: relative;
        }

        .message-card .sender {
            font-weight: 600;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            color: #28a745;
            margin-bottom: 0.5rem;
        }

        .message-card .email,
        .message-card .text {
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .delete-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            color: #dc3545;
            cursor: pointer;
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
                                        <a href="../../../index.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container mt-4">
                <div class="inbox-header">
                    <i class="fas fa-inbox"></i> Pesan Masuk
                </div>

                <!-- Input untuk Search -->
                <div class=" d-flex justify-content-between my-2">
                    <input type="text" id="searchContactInput" class="form-control rounded-pill h-50  w-25" placeholder="Cari pesan...">
                </div>


                <?php
                // Tampilkan pesan notifikasi jika ada
                if (!empty($success_message)) {
                    echo '<div class="alert alert-success">' . $success_message . '</div>';
                }

                // Query untuk mendapatkan data dari tabel kontak
                include("../../../php/koneksi.php");
                $query = "SELECT id, nama, email, pesan FROM kontak ORDER BY id DESC";
                $result = $conn->query($query);

                if ($result->num_rows > 0):
                    while ($row = $result->fetch_assoc()):
                ?>
                        <div class="message-card" id="message-<?php echo $row['id']; ?>">
                            <div class="sender">
                                <i class="fas fa-user me-2"></i><?php echo htmlspecialchars($row['nama']); ?>
                            </div>
                            <div class="email">
                                <i class="fas fa-envelope me-2"></i><?php echo htmlspecialchars($row['email']); ?>
                            </div>
                            <div class="text">
                                <i class="fas fa-comment me-2"></i><?php echo nl2br(htmlspecialchars($row['pesan'])); ?>
                            </div>
                            <span class="delete-btn" onclick="deleteMessage(<?php echo $row['id']; ?>)">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </span>
                        </div>
                <?php
                    endwhile;
                else:
                    echo '<p class="alert alert-info text-center"><i class="fas fa-info-circle"></i> Tidak ada pesan masuk.</p>';
                endif;

                $conn->close();
                ?>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
            <script>
                function deleteMessage(id) {
                    if (confirm("Apakah Anda yakin ingin menghapus pesan ini?")) {
                        fetch('delete_message.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'id=' + id
                            })
                            .then(response => response.text())
                            .then(data => {
                                if (data === 'success') {
                                    document.getElementById('message-' + id).remove();
                                } else {
                                    alert('Gagal menghapus pesan: ' + data);
                                }
                            })
                            .catch(error => {
                                alert('Terjadi kesalahan: ' + error);
                            });
                    }
                }


                document.getElementById('searchContactInput').addEventListener('keyup', function() {
                    var searchValue = this.value.toLowerCase();
                    var messageCards = document.querySelectorAll('.message-card');

                    messageCards.forEach(function(card) {
                        var cardText = card.textContent.toLowerCase();
                        if (cardText.includes(searchValue)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            </script>
</body>

</html>