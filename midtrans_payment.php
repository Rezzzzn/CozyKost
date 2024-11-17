<?php
require_once 'vendor/autoload.php';

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-c0JO7T_LqieBX31Rlg-Dd_jb'; // Ganti dengan server key Anda
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil data dari permintaan POST
$order_id = "ORDER_ID_" . rand(1000, 9999); // Ganti dengan ID pemesanan yang valid
$gross_amount = 100000; // Ganti dengan jumlah total pembayaran (misalnya setelah diskon)
$customer_name = "John Doe"; // Ganti dengan nama pelanggan
$payment_method = "gopay"; // Ganti dengan metode pembayaran yang dipilih, misalnya GoPay atau OVO

// Data transaksi yang dikirimkan ke Midtrans
$transaction = [
    'transaction_details' => [
        'order_id' => $order_id,
        'gross_amount' => $gross_amount
    ],
    'customer_details' => [
        'first_name' => $customer_name,
        'email' => 'customer@example.com', // Ganti dengan email pelanggan
        // 'phone' => '081234567890' // Ganti dengan nomor telepon pelanggan
    ],
    'enabled_payments' => [$payment_method] // Aktifkan metode pembayaran yang dipilih
];
    // Dapatkan Snap Token dari Midtrans
    $params = array(
        'payment_type' => 'credit_card',
        'transaction_details' => array(
            'order_id' => 'order-id-123',
            'gross_amount' => 10000, // total amount
        ),
    );
try {
    // Dapatkan Snap Token dari Midtrans
    $params = array(
        'payment_type' => 'credit_card',
        'transaction_details' => array(
            'order_id' => 'order-id-123',
            'gross_amount' => 10000, // total amount
        ),
    );
    
    $snapToken = \Midtrans\Snap::getSnapToken($transaction);

    // Kirimkan token Snap ke frontend
    echo json_encode(['token' => $snapToken]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
