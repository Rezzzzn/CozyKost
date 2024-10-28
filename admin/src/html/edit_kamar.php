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
        gambar1 = '$gambar1', 
        gambar2 = '$gambar2', 
        gambar3 = '$gambar3', 
        gambar4 = '$gambar4' 
        WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Data kamar berhasil diupdate. <a href='read_kamar.php'>Kembali ke Daftar Kamar</a>";
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
    <title>Edit Kamar</title>
</head>

<body>
    <h2>Edit Kamar</h2>

    <form method="post" enctype="multipart/form-data">
        <label for="nama_kost">Nama Kost:</label><br>
        <input type="text" id="nama_kost" name="nama_kost" value="<?php echo $row['nama_kost']; ?>" required><br>

        <label for="harga">Harga:</label><br>
        <input type="text" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required><br>

        <label for="alamat">Alamat:</label><br>
        <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required><br>

        <label for="durasi">Durasi:</label><br>
        <input type="text" id="durasi" name="durasi" value="<?php echo $row['durasi']; ?>" required><br>

        <label for="kapasitas">Kapasitas:</label><br>
        <input type="text" id="kapasitas" name="kapasitas" value="<?php echo $row['kapasitas']; ?>" required><br>

        <label for="fasilitas">Fasilitas:</label><br>
        <input type="text" id="fasilitas" name="fasilitas" value="<?php echo $row['fasilitas']; ?>" required><br>

        <label for="status">Status:</label><br>
        <input type="text" id="status" name="status" value="<?php echo $row['status']; ?>" required><br>

        <label for="gambar1">Gambar 1:</label><br>
        <input type="file" id="gambar1" name="gambar1"><br>
        <?php if ($row['gambar1']) { ?>
            <img src='../../../uploads/<?php echo $row['gambar1']; ?>' alt='Gambar 1' style='width:100px; height:auto;'><br>
        <?php } ?>

        <label for="gambar2">Gambar 2:</label><br>
        <input type="file" id="gambar2" name="gambar2"><br>
        <?php if ($row['gambar2']) { ?>
            <img src='../../../uploads/<?php echo $row['gambar2']; ?>' alt='Gambar 2' style='width:100px; height:auto;'><br>
        <?php } ?>

        <label for="gambar3">Gambar 3:</label><br>
        <input type="file" id="gambar3" name="gambar3"><br>
        <?php if ($row['gambar3']) { ?>
            <img src='../../../uploads/<?php echo $row['gambar3']; ?>' alt='Gambar 3' style='width:100px; height:auto;'><br>
        <?php } ?>

        <label for="gambar4">Gambar 4:</label><br>
        <input type="file" id="gambar4" name="gambar4"><br>
        <?php if ($row['gambar4']) { ?>
            <img src='../../../uploads/<?php echo $row['gambar4']; ?>' alt='Gambar 4' style='width:100px; height:auto;'><br>
        <?php } ?>

        <input type="submit" value="Update Kamar">
    </form>
</body>

</html>
