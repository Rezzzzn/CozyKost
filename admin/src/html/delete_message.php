<?php
include("../../../php/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Persiapkan dan eksekusi query penghapusan
    $stmt = $conn->prepare("DELETE FROM kontak WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request";
}

$conn->close();
?>
