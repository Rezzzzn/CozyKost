<?php
include("../../../php/koneksi.php");

// Function to upload file
function uploadGambar($file, $upload_dir)
{
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
            if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
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

    // Inisialisasi diskon
    $diskon = '0%';

    // Hitung diskon
    if ($durasi == '12') {
        $diskon = '20%'; // Diskon 20%
    } elseif ($durasi == '6') {
        $diskon = '10%'; // Diskon 10%
    }

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

    // Check if at least one image has been uploaded
    if (!empty($gambar1) || !empty($gambar2) || !empty($gambar3) || !empty($gambar4)) {
        // Insert data into the database
        $sql = "INSERT INTO kamar (nama_kost, harga, alamat, durasi, kapasitas, fasilitas, status, diskon, gambar1, gambar2, gambar3, gambar4)
                VALUES ('$nama', '$harga', '$alamat', '$durasi', '$kapasitas', '$fasilitas', '$status', '$diskon', '$gambar1', '$gambar2', '$gambar3', '$gambar4')";

        if ($conn->query($sql) === TRUE) {
            header('Location: read_kamar.php');
            exit;
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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/createkamar.css">
    <style>
        #discountPrice {
            display: none;
            /* Hide the discount price by default */
        }
    </style>
    <script>
        function calculateDiscount() {
            const harga = parseFloat(document.querySelector('input[name="harga"]').value) || 0;
            const durasi = document.querySelector('input[name="durasi"]').value;
            const discountElement = document.getElementById('discountPrice');

            // Check if the duration is 6 or 12 months and apply the discount
            if (durasi === '12') {
                const discount = harga * 0.20;
                const discountedPrice = harga - discount;
                discountElement.textContent = 'Discounted Price: Rp ' + discountedPrice.toFixed(2);
                discountElement.style.display = 'block'; // Show the discount element
            } else if (durasi === '6') {
                const discount = harga * 0.10;
                const discountedPrice = harga - discount;
                discountElement.textContent = 'Discounted Price: Rp ' + discountedPrice.toFixed(1);
                discountElement.style.display = 'block'; // Show the discount element
            } else {
                discountElement.style.display = 'none'; // Hide the discount element if duration is not 6 or 12
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h3>Tambah Kamar Kost</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="field">
                    <label>Nama Kost</label>
                    <input type="text" name="nama_kost" required>
                </div>
                <div class="field">
                    <label>Harga</label>
                    <input type="number" name="harga" oninput="calculateDiscount()" required>
                </div>
                <div class="field full-width">
                    <label>Alamat</label>
                    <input type="text" name="alamat" required>
                </div>
                <div class="field">
                    <label>Durasi (bulan)</label>
                    <input type="text" name="durasi" oninput="calculateDiscount()" required>
                    <div id="discountPrice" class="text-success mb-2"></div>
                </div>
                <div class="field">
                    <label>Kapasitas</label>
                    <input type="number" name="kapasitas" required>
                </div>
                <div class="field full-width">
                    <label>Fasilitas</label>
                    <textarea name="fasilitas" required></textarea>
                </div>
                <div class="field full-width">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                    </select>
                </div>
                <div class="field">
                    <label>Gambar 1</label>
                    <input type="file" name="gambar1" accept="image/*" required>
                </div>
                <div class="field">
                    <label>Gambar 2</label>
                    <input type="file" name="gambar2" accept="image/*">
                </div>
                <div class="field">
                    <label>Gambar 3</label>
                    <input type="file" name="gambar3" accept="image/*">
                </div>
                <div class="field">
                    <label>Gambar 4</label>
                    <input type="file" name="gambar4" accept="image/*">
                </div>
            </div>
            <button type="submit" name="submit" class="submit-btn">Tambah Kamar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>