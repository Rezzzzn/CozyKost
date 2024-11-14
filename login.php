<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login-regis.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <div class="background-image"></div>
                <div class="logo-container">
                    <?php
                    // Tentukan path gambar
                    $logo_path = "asset/logo cozykost1.png";
                    ?>
                    <img src="<?php echo $logo_path; ?>" alt="Your Logo" class="logo-image">
                </div>
            </div>
            <div class="back">
                <div class="text">
                    <span class="text-1">Complete miles of journey <br> with one step</span>
                    <span class="text-2">Let's get started</span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Masuk</div>
                    <form action="php/proses_login.php" method="post">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" placeholder="Masukan email anda" name="email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Masukan sandi anda" name="password" required>
                            </div>
                            <div class="text"><a href="#" class="forgot-password">Lupa sandi?</a></div>
                            <div class="button input-box">
                                <input type="submit" name="Masuk" value="Masuk">
                            </div>
                            <!-- Registrasi -->
                            <div class="text sign-up-text">Belum punya akun? <label for="flip">Daftar</label></div>
                        </div>
                    </form>
                </div>
                <div class="signup-form">
                    <div class="title">Daftar</div>
                    <form action="php/proses_register.php" method="post">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Masukan nama anda" name="nama" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" placeholder="Masukan email anda" name="email" required>
                            </div>
                            <div class="error-message text-danger"></div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Masukan sandi anda" name="password" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" name="register" value="Daftar">
                            </div>
                            <div class="text sign-up-text">Sudah punya akun? <label for="flip">Masuk</label></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email); // Validasi sederhana dengan regex
        }

        function validateForm(event) {
            const emailInput = event.target.querySelector('input[name="email"]');
            const errorMessage = event.target.querySelector('.error-message');

            if (!validateEmail(emailInput.value)) {
                errorMessage.textContent = "Email harus mengandung '@'.";
                errorMessage.style.display = "block"; // Tampilkan pesan
                event.preventDefault(); // Cegah pengiriman form
            } else {
                errorMessage.style.display = "none"; // Sembunyikan pesan
            }
        }

        // Tambahkan event listener ke form
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', validateForm);
        });
    </script>
</body>
</html>
