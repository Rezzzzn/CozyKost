<?php
session_start();

include("../../../php/koneksi.php");

// Ambil data dari form
$nama = $_POST['nama'];
$pesan = $_POST['pesan'];
$email = $_POST['email']; // Ambil email dari input form

// Persiapkan dan eksekusi query
$stmt = $conn->prepare("INSERT INTO kontak (nama, email, pesan) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama, $email, $pesan);

if ($stmt->execute()) {
    echo "<p class='alert alert-success'>Pesan berhasil dikirim.</p>";
} else {
    echo "<p class='alert alert-danger'>Gagal mengirim pesan.</p>";
}

$stmt->close();
$conn->close();
?>
