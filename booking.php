<?php
// Sertakan koneksi
include 'php/koneksi.php';
session_start();

// Proses form booking jika data dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $id_kamar = $_POST['id_kamar'];

    // Pastikan data yang diterima dari form sudah valid
    if (!empty($nama) && !empty($email) && !empty($no_telp) && !empty($id_kamar)) {
        $sql = "INSERT INTO booking (nama, email, no_telp, id_kamar) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nama, $email, $no_telp, $id_kamar);

        if ($stmt->execute()) {
            // Ambil ID booking terakhir yang berhasil disimpan
            $id_booking = $conn->insert_id;

            // Simpan ID booking dan data lainnya ke session
            $_SESSION['booking_data'] = [
                'id_booking' => $id_booking,
                'nama' => $nama,
                'email' => $email,
                'no_telp' => $no_telp,
                'id_kamar' => $id_kamar
            ];

            // Lanjutkan ke halaman pembayaran
            header("Location: pembayaran.php?id_booking=" . $id_booking);
            exit();
        } else {
            echo "Gagal melakukan booking: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Harap isi semua field.";
    }
}

// Ambil data kamar untuk pilihan booking
$result = $conn->query("SELECT id, nama_kost, harga FROM kamar WHERE status = 'Tersedia'");
if (!$result) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Kamar</title>
</head>
<body>
    <h2>Form Booking Kamar</h2>
    <form action="" method="POST">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="no_telp">No. Telepon:</label>
        <input type="text" name="no_telp" required><br>

        <label for="id_kamar">Pilih Kamar:</label>
        <select name="id_kamar" required>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= $row['nama_kost'] ?> - Rp<?= number_format($row['harga'], 0, ',', '.') ?></option>
            <?php endwhile; ?>
        </select><br>

        <!-- Input hidden untuk menyimpan id_booking (jika ada) -->
        <?php if (isset($id_booking)): ?>
            <input type="hidden" name="id_booking" value="<?= $id_booking ?>">
        <?php endif; ?>

        <button type="submit">Booking Sekarang</button>
    </form>
</body>
</html>

<?php
// Tutup koneksi setelah selesai
$conn->close();
?>
