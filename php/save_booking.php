<?php
session_start();
include 'koneksi.php'; // Sambungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $tgl_masuk = $_POST['start-date'];
    $durasi = $_POST['duration'];

    // SQL query untuk memasukkan data ke tabel
    $sql = "INSERT INTO booking (nama, email, no_telepon, tgl_masuk, durasi) VALUES ('$nama', '$email', '$phone', '$tgl_masuk', '$durasi')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking berhasil!";
        header("Location: ../pembayaran.php"); // Redirect ke halaman sukses
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Tutup koneksi
}
?>
