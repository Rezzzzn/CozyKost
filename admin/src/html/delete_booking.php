<?php
session_start();
include '../../../php/koneksi.php';

// Periksa apakah `id_booking` diterima dari POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_booking'])) {
    $id_booking = intval($_POST['id_booking']); // Pastikan input valid

    // Query untuk menghapus data booking
    $query = "DELETE FROM booking WHERE id_booking = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_booking);

    if ($stmt->execute()) {
        // Berhasil menghapus data
        $_SESSION['message'] = "Data berhasil dihapus.";
    } else {
        // Gagal menghapus data
        $_SESSION['error'] = "Gagal menghapus data.";
    }

    // Redirect kembali ke halaman sebelumnya
    header('Location: kelola_booking.php');
    exit();
} else {
    // Akses langsung tanpa POST atau `id_booking` tidak ada
    $_SESSION['error'] = "Aksi tidak valid.";
    header('Location: kelola_booking.php');
    exit();
}
?>
