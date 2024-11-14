<?php
include("../../../php/koneksi.php");

// Function to upload image
function uploadImage($file, $target_dir)
{
    $file_path = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        echo "File bukan gambar.";
        return '';
    }

    // Check if file already exists
    if (file_exists($file_path)) {
        echo "File sudah ada.";
        return '';
    }

    // Check file size (max 500KB)
    if ($file["size"] > 50000000) {
        echo "Ukuran file terlalu besar.";
        return '';
    }

    // Allow only certain formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
        echo "Hanya format JPG, JPEG, dan PNG yang diperbolehkan.";
        return '';
    }

    // Upload file
    if (move_uploaded_file($file["tmp_name"], $file_path)) {
        return $file_path;
    } else {
        echo "Terjadi kesalahan saat mengupload gambar.";
        return '';
    }
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    // $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Set upload directory
    $target_dir = "../../../upload1/";

    // Ensure the directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Process the uploaded image
    $foto_kost = uploadImage($_FILES['foto'], $target_dir);

    // Check if an image was uploaded successfully
    if (!empty($foto_kost)) {
        // Insert data into the database
        $sql = "INSERT INTO kost (nama, alamat, deskripsi, foto) 
        VALUES ('$nama', '$alamat', '$deskripsi', '$foto_kost')";


        if ($conn->query($sql) === TRUE) {
            echo "Kost berhasil ditambahkan!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kost</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Tambah Kost</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Kost:</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea name="alamat" id="alamat" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="foto">Upload Foto:</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
            </div>

            <input type="submit" name="submit" value="Tambah Kost" class="btn btn-success mt-3">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>