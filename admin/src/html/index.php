<?php
session_start();
include("../../../php/koneksi.php");
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CozyKost</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo cozykost1.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
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
      <div class="body-wrapper-inner">
        <div class="container-fluid">

          <div class="container-fluid">
            <!-- Dashboard Title -->
            <div class="mb-4 dashboard-title">
              <h2 class="fw-bold">Dashboard</h2>
            </div>
            <!-- Row for Cards -->
            <div class="row">
              <!-- Card 1 -->
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card bg-danger-subtle shadow-none w-100">
                  <div class="card-body">
                    <div class="d-flex mb-10 pb-1 justify-content-between align-items-center">
                      <div class="d-flex align-items-center gap-6">
                        <div class="rounded-circle-shape bg-danger px-3 py-2 rounded-pill d-inline-flex align-items-center justify-content-center">
                          <iconify-icon icon="ic:baseline-home" class="fs-7 text-white"></iconify-icon>
                        </div>
                        <h6 class="mb-0 fs-4 fw-medium text-muted">Total Kost</h6>
                      </div>
                      <div class="dropdown dropstart">
                        <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ti ti-dots-vertical fs-6"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i class="fs-4 ti ti-plus"></i>Add</a></li>
                          <li><a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i class="fs-4 ti ti-edit"></i>Edit</a></li>
                          <li><a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i class="fs-4 ti ti-trash"></i>Delete</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="row align-items-center">
                      <div class="col-6">
                        <h2 class="mb-6 fs-8">456</h2>
                        <span class="badge rounded-pill border border-muted fw-bold text-muted fs-2 py-1">+23% bulan lalu</span>
                      </div>
                      <div class="col-6">
                        <div id="total-kost-chart" style="height: 100px;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Card 2 -->
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card bg-secondary-subtle shadow-none w-100">
                  <div class="card-body">
                    <div class="d-flex mb-10 pb-1 justify-content-between align-items-center">
                      <div class="d-flex align-items-center gap-6">
                        <div class="rounded-circle-shape bg-secondary px-3 py-2 rounded-pill d-inline-flex align-items-center justify-content-center">
                          <iconify-icon icon="material-symbols:bed" class="fs-7 text-white"></iconify-icon>
                        </div>
                        <h6 class="mb-0 fs-4 fw-medium text-muted">Total Kamar</h6>
                      </div>
                      <div class="dropdown dropstart">
                        <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ti ti-dots-vertical fs-6"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i class="fs-4 ti ti-plus"></i>Add</a></li>
                          <li><a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i class="fs-4 ti ti-edit"></i>Edit</a></li>
                          <li><a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i class="fs-4 ti ti-trash"></i>Delete</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="row align-items-center">
                      <div class="col-6">
                        <h2 class="mb-6 fs-8">630</h2>
                        <span class="badge rounded-pill border border-muted fw-bold text-muted fs-2 py-1">+18% bulan lalu</span>
                      </div>
                      <div class="col-6">
                        <div id="total-kamar-chart" style="height: 100px;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Card 3 -->
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card bg-info-subtle shadow-none w-100">
                  <div class="card-body">
                    <div class="d-flex mb-10 pb-1 justify-content-between align-items-center">
                      <div class="d-flex align-items-center gap-6">
                        <div class="rounded-circle-shape bg-info px-3 py-2 rounded-pill d-inline-flex align-items-center justify-content-center">
                          <iconify-icon icon="ic:baseline-person" class="fs-7 text-white"></iconify-icon>
                        </div>
                        <h6 class="mb-0 fs-4 fw-medium text-muted">Total Pengguna</h6>
                      </div>
                      <div class="dropdown dropstart">
                        <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ti ti-dots-vertical fs-6"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i class="fs-4 ti ti-plus"></i>Add</a></li>
                          <li><a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i class="fs-4 ti ti-edit"></i>Edit</a></li>
                          <li><a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i class="fs-4 ti ti-trash"></i>Delete</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="row align-items-center">
                      <div class="col-6">
                        <h2 class="mb-6 fs-8">780</h2>
                        <span class="badge rounded-pill border border-muted fw-bold text-muted fs-2 py-1">+12% bulan lalu</span>
                      </div>
                      <div class="col-6">
                        <div id="total-users-chart" style="height: 100px;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Row for Penjualan Kost -->
            <div class="row mt-4">
              <div class="col-lg-12 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                      <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Penjualan Kost</h5>
                      </div>
                      <div>
                        <select class="form-select">
                          <option value="1">March 2024</option>
                          <option value="2">April 2024</option>
                          <option value="3">May 2024</option>
                          <option value="4">June 2024</option>
                        </select>
                      </div>
                    </div>
                    <div id="sales-profit"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>
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