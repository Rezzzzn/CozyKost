<?php
include("../../../php/koneksi.php");

// Cek apakah ID dikirim melalui URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Ambil data kost berdasarkan ID untuk mengambil nama gambar
  $sql = "SELECT foto FROM kost WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Ambil data kost
    $row = $result->fetch_assoc();
    $existing_image = $row['foto']; // Nama file gambar yang ada

    // Hapus gambar dari server jika ada
    if (!empty($existing_image) && file_exists($existing_image)) {
      unlink($existing_image); // Menghapus gambar dari server
    }

    // Hapus data kost dari database
    $delete_sql = "DELETE FROM kost WHERE id = $id";
    if ($conn->query($delete_sql) === TRUE) {
      // Menampilkan alert dan redirect setelah penghapusan
      echo "<script>
              alert('Data kost berhasil dihapus.');
              window.location.href = 'kost.php'; // Redirect ke halaman kost.php
            </script>";
    } else {
      echo "Error: " . $conn->error;
    }
  } else {
    echo "Kost tidak ditemukan.";
  }
} else {
  echo "ID tidak ditemukan.";
}
?>
