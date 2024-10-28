<?php include("../../../php/koneksi.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kamar</title>
</head>

<body>
    <h2>Daftar Kamar</h2>
    <a href="create_kamar.php">Tambah Kamar</a><br>

    <table border="1">
        <thead>
            <tr>
                <th>Nama Kost</th>
                <th>Harga</th>
                <th>Alamat</th>
                <th>Durasi</th>
                <th>Kapasitas</th>
                <th>Fasilitas</th>
                <th>Status</th>
                <th>Gambar 1</th>
                <th>Gambar 2</th>
                <th>Gambar 3</th>
                <th>Gambar 4</th>
                <th>Aksi</th> <!-- Kolom untuk tombol Aksi -->
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM kamar";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nama_kost'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>" . $row['alamat'] . "</td>";
                    echo "<td>" . $row['durasi'] . "</td>";
                    echo "<td>" . $row['kapasitas'] . "</td>";
                    echo "<td>" . $row['fasilitas'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";

                    // Gambar 1
                    echo "<td>";
                    if (!empty($row['gambar1'])) {
                        echo "<img src='../../../uploads/" . $row['gambar1'] . "' alt='Gambar 1' style='width:100px; height:auto;'><br>";
                    }
                    echo "</td>";

                    // Gambar 2
                    echo "<td>";
                    if (!empty($row['gambar2'])) {
                        echo "<img src='../../../uploads/" . $row['gambar2'] . "' alt='Gambar 2' style='width:100px; height:auto;'><br>";
                    }
                    echo "</td>";

                    // Gambar 3
                    echo "<td>";
                    if (!empty($row['gambar3'])) {
                        echo "<img src='../../../uploads/" . $row['gambar3'] . "' alt='Gambar 3' style='width:100px; height:auto;'><br>";
                    }
                    echo "</td>";

                    // Gambar 4
                    echo "<td>";
                    if (!empty($row['gambar4'])) {
                        echo "<img src='../../../uploads/" . $row['gambar4'] . "' alt='Gambar 4' style='width:100px; height:auto;'><br>";
                    }
                    echo "</td>";

                    // Tombol Edit dan Delete
                    echo "<td>";
                    echo "<a href='edit_kamar.php?id=" . $row['id'] . "'>Edit</a> | ";
                    echo "<a href='delete_kamar.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus kamar ini?\");'>Delete</a>";
                    echo "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>
