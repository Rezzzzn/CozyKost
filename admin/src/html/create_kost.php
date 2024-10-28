<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Proses upload foto
    $target_dir = "uploads/";  // folder tempat menyimpan foto
    $foto_kost = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($foto_kost, PATHINFO_EXTENSION));

    // Cek apakah file adalah gambar asli
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek apakah file sudah ada
    if (file_exists($foto_kost)) {
        echo "File sudah ada.";
        $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES["foto"]["size"] > 500000) {
        echo "Ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Hanya izinkan format tertentu
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Hanya format JPG, JPEG, dan PNG yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Cek apakah $uploadOk bernilai 0 karena error
    if ($uploadOk == 0) {
        echo "Maaf, foto gagal diupload.";
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $foto_kost)) {
            $sql = "INSERT INTO kost (nama_kost, alamat_kost, harga_kost, deskripsi_kost, foto_kost) 
                    VALUES ('$nama', '$alamat', '$harga', '$deskripsi', '$foto_kost')";

            if ($conn->query($sql) === TRUE) {
                echo "Kost berhasil ditambahkan!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Terjadi kesalahan saat mengupload foto.";
        }
    }
}
?>

<form method="post" enctype="multipart/form-data">
    Nama Kost: <input type="text" name="nama"><br>
    Alamat: <textarea name="alamat"></textarea><br>
    Harga: <input type="text" name="harga"><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br>
    Upload Foto: <input type="file" name="foto" id="foto"><br>
    <input type="submit" name="submit" value="Tambah Kost">
</form>
