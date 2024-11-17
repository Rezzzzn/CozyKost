<?php
require 'midtrans_config.php';

header('Content-Type: application/json');

$json = file_get_contents('php://input');
$data = json_decode($json);

// Siapkan detail transaksi
$params = array(
    'transaction_details' => array(
        'order_id' => $data->order_id,
        'gross_amount' => $data->gross_amount,
    ),
    'customer_details' => array(
        'first_name' => 'Nama Customer',
        'email' => 'email@contoh.com',
        'phone' => '08123456789',
    ),
);

// Dapatkan Snap token
$snapToken = \Midtrans\Snap::getSnapToken($params);
echo json_encode(['token' => $snapToken]);
?>
