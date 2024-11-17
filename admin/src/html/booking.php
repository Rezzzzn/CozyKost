<?php
session_start();
include '../../../php/koneksi.php';
require_once '../../../midtrans_config.php';

// Query untuk mengambil data booking dengan order_id
$query = "SELECT b.id_booking AS order_id, b.nama, b.email, b.no_telp, k.nama_kost, b.created_at, k.durasi, b.status_pembayaran, b.metode_pembayaran
          FROM booking b
          JOIN kamar k ON b.id_kamar = k.id";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Mengecek apakah ada data booking
if ($result->num_rows > 0) {
    while ($booking = $result->fetch_assoc()) {
        $order_id = $booking['order_id']; // Ambil order_id dari database

        try {
            // Ambil status pembayaran dan metode pembayaran dari Midtrans
            $transaction = \Midtrans\Transaction::status($order_id);
            $new_status = $transaction->transaction_status; // Status pembayaran dari Midtrans
            $payment_method = $transaction->payment_type; // Metode pembayaran dari Midtrans

            // Konversi status Midtrans ke format status yang Anda gunakan
            switch ($new_status) {
                case 'settlement':
                    $status_pembayaran = 'Lunas';
                    break;
                case 'pending':
                    $status_pembayaran = 'Menunggu Pembayaran';
                    break;
                case 'cancel':
                case 'deny':
                case 'expire':
                    $status_pembayaran = 'Gagal';
                    break;
                default:
                    $status_pembayaran = 'Tidak Diketahui';
            }

            // Update status pembayaran dan metode pembayaran di database
            $update_query = "UPDATE booking SET status_pembayaran = ?, metode_pembayaran = ? WHERE id_booking = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param('ssi', $status_pembayaran, $payment_method, $booking['id_booking']);
            $update_stmt->execute();

            // Tambahkan data ke array untuk digunakan di tabel HTML
            $booking['status_pembayaran'] = $status_pembayaran;
            $booking['metode_pembayaran'] = $payment_method;
        } catch (Exception $e) {
            // Abaikan error jika order_id tidak ditemukan di Midtrans
            error_log("Error for Order ID $order_id: " . $e->getMessage());
        }
        $bookings[] = $booking; // Simpan setiap data booking dengan nilai terbaru
    }
} else {
    echo "Tidak ada data booking yang tersedia.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Detail Booking</h2>

    <?php if (!empty($bookings)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Booking</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Nama Kamar</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Status Pembayaran</th>
                    <th>Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <?php
                    $nama = $booking['nama'];
                    $email = $booking['email'];
                    $no_telp = $booking['no_telp'];
                    $nama_kamar = $booking['nama_kost'];
                    $tgl_masuk = $booking['created_at'];
                    $durasi = $booking['durasi'];

                    if ($tgl_masuk && $durasi) {
                        $datetime = new DateTime($tgl_masuk);
                        $datetime->add(new DateInterval('P' . $durasi . 'M'));
                        $tgl_keluar = $datetime->format('Y-m-d');
                    } else {
                        $tgl_keluar = null;
                    }
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['order_id']) ?></td>
                        <td><?= htmlspecialchars($nama) ?></td>
                        <td><?= htmlspecialchars($email) ?></td>
                        <td><?= htmlspecialchars($no_telp) ?></td>
                        <td><?= htmlspecialchars($nama_kamar) ?></td>
                        <td><?= htmlspecialchars($tgl_masuk) ?></td>
                        <td><?= htmlspecialchars($tgl_keluar) ?></td>
                        <td><?= htmlspecialchars($booking['status_pembayaran']) ?></td>
                        <td><?= htmlspecialchars($booking['metode_pembayaran']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada data booking yang tersedia.</p>
    <?php endif; ?>
</body>
</html>
