<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styless.css">
    <style>
        body {
    font-family: 'Poppins', sans-serif;
    background-color: #f5f5f5;
}

.card {
    transition: background-color 0.3s, transform 0.3s;
    width: 100%; /* Memperlebar kartu */
    max-width: 600px; /* Mengatur lebar maksimum menjadi lebih besar */
    border: 1px solid #ced4da; /* Menambahkan border */
    margin: 0 auto; /* Memusatkan kartu */
}

.card:hover {
    background-color: #c4e3cb; /* Warna saat hover */
    cursor: pointer;
    transform: scale(1.05); /* Efek zoom saat hover */
}

.card.active {
    background-color: #c4e3cb; /* Warna saat aktif */
}

.card.active i {
    color: #ffffff; /* Mengubah warna ikon saat aktif */
}

.card i {
    color: #6c757d;
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Pilih Tipe Akun</h2>
        
        <!-- Admin Card -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="card text-center p-3" id="adminCard">
                    <div class="card-body">
                        <i class="fas fa-user-shield fa-3x mb-3"></i>
                        <h5 class="card-title">Admin</h5>
                        <p class="card-text">Kelola seluruh sistem dan data pada platform ini.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Member Card -->
        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <div class="card text-center p-3" id="memberCard">
                    <div class="card-body">
                        <i class="fas fa-home fa-3x mb-3"></i>
                        <h5 class="card-title">Member (Pemilik Kost)</h5>
                        <p class="card-text">Daftarkan dan kelola properti kost Anda.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- User Card -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="card text-center p-3" id="userCard">
                    <div class="card-body">
                        <i class="fas fa-user fa-3x mb-3"></i>
                        <h5 class="card-title">User</h5>
                        <p class="card-text">Cari dan pesan kost yang sesuai dengan kebutuhan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mb-3">
            <button class="btn btn-success" id="submitBtn" disabled>Pilih Akun</button>
        </div>
    </div>

    <script>
        // Mengambil elemen kartu
        const adminCard = document.getElementById('adminCard');
        const memberCard = document.getElementById('memberCard');
        const userCard = document.getElementById('userCard');
        const submitBtn = document.getElementById('submitBtn');
        
        let selectedRole = '';

        // Fungsi untuk mengaktifkan kartu yang dipilih
        function selectCard(card, role) {
            adminCard.classList.remove('active');
            memberCard.classList.remove('active');
            userCard.classList.remove('active');
            card.classList.add('active');
            selectedRole = role;
            submitBtn.disabled = false;
        }

        // Menambahkan event listener ke setiap kartu
        adminCard.addEventListener('click', () => selectCard(adminCard, 'Admin'));
        memberCard.addEventListener('click', () => selectCard(memberCard, 'Member'));
        userCard.addEventListener('click', () => selectCard(userCard, 'User'));

        // Event listener untuk tombol submit
        submitBtn.addEventListener('click', () => {
            if (selectedRole === 'Admin') {
                window.location.href = 'login.php'; // Arahkan ke halaman registrasi Admin
            } else if (selectedRole === 'Member') {
                window.location.href = 'login.php'; // Arahkan ke halaman registrasi Member
            } else if (selectedRole === 'User') {
                window.location.href = 'login.php'; // Arahkan ke halaman registrasi User
            }
        });
    </script>
</body>
</html>
