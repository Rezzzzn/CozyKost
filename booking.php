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
            $id_booking = $conn->insert_id;

            $_SESSION['booking_data'] = [
                'id_booking' => $id_booking,
                'nama' => $nama,
                'email' => $email,
                'no_telp' => $no_telp,
                'id_kamar' => $id_kamar
            ];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/createkamar.css">

</head>
<body>
    
    <div class="container">
        <h3>Form Booking Kamar</h3>
        <form action="" method="POST">
            <div class="form-grid">
                <div class="field full-width">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" placeholder="Masukkan nama Anda" required>
                </div>
                <div class="field full-width">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan email Anda" required>
                </div>
                <div class="field full-width">
                    <label for="no_telp">No. Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" placeholder="Masukkan no. telepon Anda" required>
                </div>
                <div class="field full-width">
                    <label for="id_kamar">Pilih Kamar</label>
                    <select name="id_kamar" id="id_kamar" required>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>"><?= $row['nama_kost'] ?> - Rp<?= number_format($row['harga'], 0, ',', '.') ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="submit-btn">Booking Sekarang</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
