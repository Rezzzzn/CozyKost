<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $deskripsi = $_POST['deskripsi'];
  $alamat = $_POST['alamat'];
  $harga = $_POST['harga'];
  
  // Upload foto
  $foto = $_FILES['foto']['name'];
  $target_dir = "../assets/images/kamar/";
  $target_file = $target_dir . basename($foto);
  
  if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    // Query untuk menambahkan data
    $sql = "INSERT INTO kamar (nama, deskripsi, alamat, harga, foto) VALUES ('$nama', '$deskripsi', '$alamat', '$harga', '$foto')";

    if ($conn->query($sql) === TRUE) {
      echo "Kamar berhasil ditambahkan.";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo "Gagal mengupload foto.";
  }

  $conn->close();
}
?>
