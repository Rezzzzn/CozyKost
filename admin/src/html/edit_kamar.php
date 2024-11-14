<?php
include("../../../php/koneksi.php");

// Cek apakah ID dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data kamar berdasarkan ID
    $sql = "SELECT * FROM kamar WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Kamar tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}

// Proses form jika dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kost = $_POST['nama_kost'];
    $harga = $_POST['harga'];
    $alamat = $_POST['alamat'];
    $durasi = $_POST['durasi'];
    $kapasitas = $_POST['kapasitas'];
    $fasilitas = $_POST['fasilitas'];
    $status = $_POST['status'];

    $diskon = '0%';

    // Hitung diskon
    if ($durasi == '12') {
        $diskon = '20%'; // Diskon 20%
    } elseif ($durasi == '6') {
        $diskon = '10%'; // Diskon 10%
    }       

    // Proses upload gambar
    $gambar1 = $_FILES['gambar1']['name'];
    $gambar2 = $_FILES['gambar2']['name'];
    $gambar3 = $_FILES['gambar3']['name'];
    $gambar4 = $_FILES['gambar4']['name'];

    // Lokasi upload
    $target_dir = "../../../uploads/";

    // Cek dan upload gambar jika ada
    if (!empty($gambar1)) {
        move_uploaded_file($_FILES['gambar1']['tmp_name'], $target_dir . $gambar1);
    } else {
        $gambar1 = $row['gambar1']; // Jika tidak ada gambar baru, gunakan gambar lama
    }
    if (!empty($gambar2)) {
        move_uploaded_file($_FILES['gambar2']['tmp_name'], $target_dir . $gambar2);
    } else {
        $gambar2 = $row['gambar2'];
    }
    if (!empty($gambar3)) {
        move_uploaded_file($_FILES['gambar3']['tmp_name'], $target_dir . $gambar3);
    } else {
        $gambar3 = $row['gambar3'];
    }
    if (!empty($gambar4)) {
        move_uploaded_file($_FILES['gambar4']['tmp_name'], $target_dir . $gambar4);
    } else {
        $gambar4 = $row['gambar4'];
    }

    // Update data kamar
    $update_sql = "UPDATE kamar SET 
        nama_kost = '$nama_kost', 
        harga = '$harga', 
        alamat = '$alamat', 
        durasi = '$durasi', 
        kapasitas = '$kapasitas', 
        fasilitas = '$fasilitas', 
        status = '$status', 
        diskon = '$diskon', 
        gambar1 = '$gambar1', 
        gambar2 = '$gambar2', 
        gambar3 = '$gambar3', 
        gambar4 = '$gambar4' 
        WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        $success_message = "Data kamar berhasil diupdate. <a href='read_kamar.php'>Kembali</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/createkamar.css">
    <title>Edit Kamar</title>
</head>

<body>

    <div class="container">
        <h3>Edit Kamar Kost</h3>

        <!-- Tampilkan pesan sukses jika ada -->
        <?php if (!empty($success_message)) { ?>
            <p class="alert alert-success"><?php echo $success_message; ?></p>
        <?php } ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="field">
                    <label>Nama Kost</label>
                    <input type="text" id="nama_kost" name="nama_kost" value="<?php echo $row['nama_kost']; ?>" required><br>
                </div>
                <div class="field">
                    <label>Harga</label>
                    <input type="text" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required><br>
                </div>
                <div class="field full-width">
                    <label>Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required><br>
                </div>
                <div class="field">
                    <label>Durasi</label>
                    <input type="text" id="durasi" name="durasi" value="<?php echo $row['durasi']; ?>" required><br>
                </div>
                <div class="field">
                    <label>Kapasitas</label>
                    <input type="text" id="kapasitas" name="kapasitas" value="<?php echo $row['kapasitas']; ?>" required><br>
                </div>
                <div class="field full-width">
                    <label>Fasilitas</label>
                    <input type="textarea" id="fasilitas" name="fasilitas" value="<?php echo $row['fasilitas']; ?>" required><br>
                </div>
                <div class="field full-width">
                    <label>Status</label>
                    <select name="status">
                        <option value="Tersedia" <?php echo $row['status'] == 'Tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                        <option value="Tidak Tersedia" <?php echo $row['status'] == 'Tidak Tersedia' ? 'selected' : ''; ?>>Tidak Tersedia</option>
                    </select>
                </div>
                <div class="field">
                    <label>Gambar 1</label>
                    <input type="file" name="gambar1">
                    <?php if ($row['gambar1']) { ?>
                        <img src='../../../uploads/<?php echo $row['gambar1']; ?>' alt='Gambar 1' style='width:250px; height:auto;'><br>
                    <?php } ?>
                </div>
                <div class="field">
                    <label>Gambar 2</label>
                    <input type="file" name="gambar2">
                    <?php if ($row['gambar2']) { ?>
                        <img src='../../../uploads/<?php echo $row['gambar2']; ?>' alt='Gambar 2' style='width:250px; height:auto;'><br>
                    <?php } ?>
                </div>
                <div class="field">
                    <label>Gambar 3</label>
                    <input type="file" name="gambar3">
                    <?php if ($row['gambar3']) { ?>
                        <img src='../../../uploads/<?php echo $row['gambar3']; ?>' alt='Gambar 3' style='width:250px; height:auto;'><br>
                    <?php } ?>
                </div>
                <div class="field">
                    <label>Gambar 4</label>
                    <input type="file" name="gambar4">
                    <?php if ($row['gambar4']) { ?>
                        <img src='../../../uploads/<?php echo $row['gambar4']; ?>' alt='Gambar 4' style='width:250px; height:auto;'><br>
                    <?php } ?>
                </div>
            </div>
            <button type="submit" name="submit" class="submit-btn" style="margin-bottom:2rem;">Edit Kamar</button>
        </form>
    </div>

</body>

</html>
