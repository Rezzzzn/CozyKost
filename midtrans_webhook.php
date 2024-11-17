<?php
require_once '../../../php/koneksi.php';

// Mendapatkan data dari webhook Midtrans
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Cek status pembayaran
if ($data['transaction_status'] == 'settlement') {
    // Pembayaran berhasil, update status pembayaran di database
    $id_booking = $data['order_id'];  // ID booking dari Midtrans
    $status_pembayaran = 'Berhasil';
    $metode_pembayaran = $data['payment_type'];  // Jenis pembayaran (e.g., credit card, bank transfer)

    // Query untuk update status pembayaran
    $query = "UPDATE booking SET status_pembayaran = ?, metode_pembayaran = ? WHERE id_booking = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $status_pembayaran, $metode_pembayaran, $id_booking);
    $stmt->execute();

    echo json_encode(['message' => 'Payment status updated']);
} else {
    // Jika bukan status 'settlement' atau gagal
    echo json_encode(['message' => 'Payment status not updated']);
}
?>
