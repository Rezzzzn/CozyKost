<?php
// Memulai session
session_start();

// Memanggil file koneksi ke database
include "koneksi.php";

// Cek apakah tombol login ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah email dan password diisi
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim($_POST['email']); // Menghilangkan spasi tambahan
        $password = trim($_POST['password']);

        // Menyeleksi data user dengan email yang sesuai
        $stmt = $conn->prepare("SELECT * FROM tbl_login WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Mengecek apakah user ditemukan
        if ($result->num_rows > 0) {
            // Menangkap data dari hasil query
            $user = $result->fetch_assoc();
            
            // Memeriksa kecocokan password
            if ($password === trim($user['sandi'])) {
                // Set session untuk user
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['level'] = $user['level'];

                // Redirect sesuai level user
                if ($user['level'] == '2' || $user['level'] == '1') {
                    header("Location: ../admin/src/html/index.php");
                } else {
                    header("Location: ../landing_page.php");
                }
                exit();
            } else {
                echo "GAGAL LOGIN!!! Password salah";
            }
        } else {
            echo "GAGAL LOGIN!!! Email tidak ditemukan";
        }

        // Menutup statement
        $stmt->close();
    } else {
        echo "Email dan password harus diisi!";
    }
} else {
    echo "Akses tidak sah.";
}

// Menutup koneksi
$conn->close();
?>
