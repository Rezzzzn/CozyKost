<?php
require_once 'midtrans_config.php';

// Mendapatkan data POST dari JavaScript
$data = json_decode(file_get_contents("php://input"), true);

$id_booking = $data['id_booking']; // Ini berasal dari tabel booking
$harga = $data['harga'];
$paymentMethod = $data['paymentMethod'];
$ewalletOption = $data['ewalletOption'] ?? null; // Null jika bukan E-Wallet

$harga_awal = $harga; // Harga sebelum diskon
$diskon_persen = 10; // Persentase diskon
$diskon = ($harga_awal * $diskon_persen) / 100;
$harga_setelah_diskon = $harga_awal - $diskon;

// Data transaksi
$transaction_details = [
    'order_id' => $id_booking,
    'gross_amount' => $harga_setelah_diskon,
];

// Data item
$item_details = [
    [
        'id' => 'kost_1',
        'price' => $harga_awal,
        'quantity' => 1,
        'name' => "Sewa Kost",
    ]
];

// Pelanggan
$customer_details = [
    'first_name' => 'Nama Depan',
    'last_name' => 'Nama Belakang',
    'email' => 'customer@example.com',
    'phone' => '081234567890',
];

// Pilihan metode pembayaran sesuai dengan yang dipilih
$enabled_payments = [];
if ($paymentMethod === "Bank Transfer") {
    $enabled_payments = ["bank_transfer"];
} elseif ($paymentMethod === "Credit Card") {
    $enabled_payments = ["credit_card"];
} elseif ($paymentMethod === "E-Wallet") {
    if ($ewalletOption === "OVO") {
        $enabled_payments = ["ovo"];
    } elseif ($ewalletOption === "GoPay") {
        $enabled_payments = ["gopay"];
    } elseif ($ewalletOption === "DANA") {
        $enabled_payments = ["dana"];
    }
}


// Parameter request
$params = [
    'transaction_details' => $transaction_details,
    'item_details' => $item_details,
    'customer_details' => $customer_details,
    'enabled_payments' => $enabled_payments
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo json_encode(['token' => $snapToken]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
