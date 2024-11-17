<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .success-icon {
            font-size: 80px;
            color: #28a745;
        }
        .success-message {
            font-size: 24px;
            margin: 20px 0;
            font-weight: bold;
        }
        .details {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Pembayaran Berhasil</h5>
                </div>
                <div class="modal-body text-center">
                    <div class="success-icon">✅</div>
                    <p class="success-message">Pembayaran Anda Berhasil!</p>
                    <p class="details">Terima kasih telah melakukan pembayaran. Reservasi Anda sudah dikonfirmasi.</p>
                </div>
                <div class="modal-footer">
                    <a href="landing_page.php" class="btn btn-success position-absolute top-90 start-50 translate-middle">Kembali ke Halaman Utama</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk langsung menampilkan modal
        function showSuccessModal() {
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        }

        // Panggil fungsi showSuccessModal setelah halaman selesai dimuat
        window.onload = function() {
            showSuccessModal();
        };
    </script>
</body>
</html>
