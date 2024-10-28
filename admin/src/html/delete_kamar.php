<?php
include("../../../php/koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data dari database
    $sql = "DELETE FROM kamar WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect kembali ke daftar kamar setelah berhasil dihapus
        header("Location: read_kamar.php?message=Data berhasil dihapus");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID tidak valid.";
}

$conn->close();
?>
