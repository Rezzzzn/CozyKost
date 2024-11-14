<?php
session_start();
include("../../../php/koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Document</title>
  <!-- <link rel="stylesheet" href="../assets/css/styles.min.css" /> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
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
          <li class="nav-small-cap">
            <iconify-icon icon="solar:widget-add-line-duotone" class="nav-small-cap-icon fs-4"></iconify-icon>
            <span class="hide-menu">Kost</span>
          </li>

          <!-- Kamar Section -->
          <?php if ($_SESSION['level'] == 1) { ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="kost.php" aria-expanded="false">
                <iconify-icon icon="mdi:home-outline"></iconify-icon>
                <span class="hide-menu">Kost</span>
              </a>
            </li>
          <?php } ?>

          <!-- Kamar Section -->
          <!-- <li class="sidebar-item">
            <a class="sidebar-link" href="read_kamar.php" aria-expanded="false">
              <iconify-icon icon="material-symbols:bed"></iconify-icon>
              <span class="hide-menu">Kamar</span>
            </a>
          </li> -->


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

          <?php if ($_SESSION['level'] == 1) { ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="read_kontak.php" aria-expanded="false">
                <i class="fas fa-inbox"></i> 
                <span class="hide-menu">Pesan</span>
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
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

</body>

</html>