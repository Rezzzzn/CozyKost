<?php
include("../../../php/koneksi.php");

function uploadImage($file, $target_dir, $existing_image = '')
{
  // Jika tidak ada file baru, gunakan gambar lama
  if ($file['error'] == 4) {
    return $existing_image; // Tidak ada file yang diupload, gunakan gambar lama
  }

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
    // Jika gambar lama ada, hapus gambar lama dari server
    if (!empty($existing_image) && file_exists($existing_image)) {
      unlink($existing_image);
    }
    return $file_path; // Kembalikan path file yang baru diupload
  } else {
    echo "Terjadi kesalahan saat mengupload gambar.";
    return '';
  }
}


// Cek apakah ID dikirim melalui URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Ambil data kost berdasarkan ID
  $sql = "SELECT * FROM kost WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
  } else {
    echo "Kost tidak ditemukan.";
    exit;
  }
} else {
  echo "ID tidak ditemukan.";
  exit;
}

// Proses form jika dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $deskripsi = $_POST['deskripsi'];

  // Ambil gambar yang sudah ada sebelumnya dari database
  $sql = "SELECT foto FROM kost WHERE id = $id";
  $result = $conn->query($sql);
  $existing_image = ''; // Default tidak ada gambar
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $existing_image = $row['foto']; // Ambil gambar lama dari database
  }

  // Proses upload gambar (jika ada gambar baru)
  $foto = uploadImage($_FILES['foto'], "../../../upload1/", $existing_image);

  if ($foto != '') {
    // Update data kost
    $update_sql = "UPDATE kost SET 
          nama = '$nama', 
          alamat = '$alamat',  
          deskripsi = '$deskripsi',
          foto = '$foto' 
          WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
      // Menampilkan alert dan redirect setelah beberapa detik
      echo "<script>
              alert('Data kost berhasil diupdate.');
              window.location.href = 'kost.php';
            </script>";
    } else {
      echo "Error: " . $conn->error;
    }
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
    <title>Edit Kost</title>
</head>

<body>

  <div class="container">
    <h3>Edit Kost</h3>

    <!-- Tampilkan pesan sukses jika ada -->
    <?php if (!empty($success_message)) { ?>
      <p class="alert alert-success"><?php echo $success_message; ?></p>
    <?php } ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="form-grid">
        <div class="field full-width">
          <label>Nama Kost</label>
          <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>"><br>
        </div>
        <div class="field full-width">
          <label>Alamat</label>
          <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>"><br>
        </div>
        <div class="field full-width">
          <label>Deskripsi</label>
          <input type="text" id="deskripsi" name="deskripsi" value="<?php echo $row['deskripsi']; ?>"><br>
        </div>
        <div class="field full-width">
          <label>foto</label>
          <input type="file" name="foto">
          <?php if ($row['foto']) { ?>
            <img src='../../../upload1/<?php echo $row['foto']; ?>' alt='foto' style='width:250px; height:auto;'><br>
          <?php } ?>
        </div>
      </div>
      <button type="submit" name="submit" class="submit-btn" style="margin-bottom:2rem;">Edit Kost</button>
    </form>
  </div>
</body>

</html>