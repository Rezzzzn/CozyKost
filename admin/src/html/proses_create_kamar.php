<?php
include("../../../php/koneksi.php");

// Function to upload file
function uploadGambar($file, $upload_dir) {
    if (isset($file) && $file['error'] == 0) {
        $file_name = basename($file['name']);
        $target_file = $upload_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an image
        $check = getimagesize($file['tmp_name']);
        if ($check !== false) {
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                return '';
            }

            // Check file size (limit to 5MB)
            if ($file['size'] > 5000000) {
                echo "Sorry, your file is too large.";
                return '';
            }

            // Allow only certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "webp") {
                echo "Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed.";
                return '';
            }

            // Upload file
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                return $file_name; // Return the file name to save in DB
            } else {
                echo "Sorry, there was an error uploading your file.";
                return '';
            }
        } else {
            echo "File is not an image.";
            return '';
        }
    } else {
        echo "No file uploaded or upload error.";
        return '';
    }
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_kost'];
    $harga = $_POST['harga'];
    $alamat = $_POST['alamat'];
    $durasi = $_POST['durasi'];
    $kapasitas = $_POST['kapasitas'];
    $fasilitas = $_POST['fasilitas'];
    $status = $_POST['status'];

    // Define upload directory
    $upload_dir = "../../../uploads/";

    // Ensure the directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true); // Create folder if it doesn't exist
    }

    // Process the uploaded images
    $gambar1 = uploadGambar($_FILES['gambar1'], $upload_dir);
    $gambar2 = uploadGambar($_FILES['gambar2'], $upload_dir);
    $gambar3 = uploadGambar($_FILES['gambar3'], $upload_dir);
    $gambar4 = uploadGambar($_FILES['gambar4'], $upload_dir);

    // Debugging output for uploaded file names
    var_dump($gambar1, $gambar2, $gambar3, $gambar4);

    // Check if at least one image has been uploaded
    if (!empty($gambar1) || !empty($gambar2) || !empty($gambar3) || !empty($gambar4)) {
        // Insert data into the database
        $sql = "INSERT INTO kamar (nama_kost, harga, alamat, durasi, kapasitas, fasilitas, status, gambar1, gambar2, gambar3, gambar4)
                VALUES ('$nama', '$harga', '$alamat', '$durasi', '$kapasitas', '$fasilitas', '$status', '$gambar1', '$gambar2', '$gambar3', '$gambar4')";

        // Debugging query output
        echo $sql;

        if ($conn->query($sql) === TRUE) {
            echo "Record added successfully";
            header('Location: read_kamar.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "No images were uploaded.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Kamar</title>
</head>
<body>
    <h2>Create Kamar</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nama Kost:</label>
        <input type="text" name="nama_kost" required><br>
        
        <label>Harga:</label>
        <input type="number" name="harga" required><br>
        
        <label>Alamat:</label>
        <input type="text" name="alamat" required><br>
        
        <label>Durasi:</label>
        <input type="text" name="durasi" required><br>
        
        <label>Kapasitas:</label>
        <input type="number" name="kapasitas" required><br>
        
        <label>Fasilitas:</label>
        <textarea name="fasilitas" required></textarea><br>
        
        <label>Status:</label>
        <select name="status">
            <option value="Tersedia">Tersedia</option>
            <option value="Tidak Tersedia">Tidak Tersedia</option>
        </select><br>
        
        <label>Gambar 1:</label>
        <input type="file" name="gambar1" required><br>
        
        <label>Gambar 2:</label>
        <input type="file" name="gambar2"><br>
        
        <label>Gambar 3:</label>
        <input type="file" name="gambar3"><br>
        
        <label>Gambar 4:</label>
        <input type="file" name="gambar4"><br>

        <input type="submit" name="submit" value="Create Kamar">
    </form>
</body>
</html>
