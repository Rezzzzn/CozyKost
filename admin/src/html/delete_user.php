<?php
session_start();
include "../../../php/koneksi.php";

// Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['id_user']) || ($_SESSION['level'] != '1' && $_SESSION['level'] != '2')) {
    header("Location: ../../landing_page.php");
    exit();
}

// Ambil ID user dari URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Hapus user dari database
    $stmt = $conn->prepare("DELETE FROM tbl_login WHERE id_user = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect kembali ke halaman manage_user.php setelah berhasil dihapus
        header("Location: manage_user.php");
        exit();
    } else {
        echo "Gagal menghapus user!";
    }
}
?>
