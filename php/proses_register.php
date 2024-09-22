<?php
// Memulai session
session_start();

// Memanggil file koneksi ke database
include "koneksi.php";

if (isset($_POST['register'])) {
    $username = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $level = "user"; // Level otomatis diisi 'user' saat registrasi

    // Menyimpan data ke database
    $query = "INSERT INTO tbl_login (email, nama, sandi, level) VALUES ('$email', '$username', '$password', '$level')";
    if (mysqli_query($conn, $query)) {
        // Set session untuk user yang baru saja daftar
        $_SESSION['nama'] = $username;
        $_SESSION['level'] = $level;

        // Alihkan ke halaman landing page
        header('Location: ../landing_page.php');
        exit();
    } else {
        echo "Registrasi User Gagal!";
    }
}

// Menutup koneksi
$conn->close();
?>