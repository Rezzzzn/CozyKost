<?php
// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Include file koneksi database
include('koneksi.php'); // Pastikan file ini ada dan benar

// Periksa apakah user sudah login
if (!isset($_SESSION['id_user']) || !isset($_SESSION['nama'])) {
    die("User not logged in.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id_user'];
    $nama = $_SESSION['nama']; // Ambil user ID dari sesi
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($email) || empty($username)) {
        die("Email or username cannot be empty.");
    }

    // Cek apakah password diisi dan cocok
    if (!empty($password) && $password === $confirm_password) {
        // Hash password baru
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update dengan password baru
        $sql = "UPDATE tbl_login SET email=?, nama=?, sandi=? WHERE id_user=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $email, $username, $hashed_password, $user_id);
    } else {
        // Update tanpa password
        $sql = "UPDATE tbl_login SET email=?, nama=? WHERE id_user=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $email, $username, $user_id);
    }

    if ($stmt->execute()) {
        echo "Profil berhasil diperbarui.";
        header('Location: ../landing_page.php'); // Redirect ke halaman profil setelah update
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup statement
    $stmt->close();
}
?>
