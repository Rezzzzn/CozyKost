<?php
require_once '../../../midtrans_config.php';

// Looping melalui ID order
for ($order_id = 1; $order_id <= 100; $order_id++) { // Sesuaikan rentang loop sesuai kebutuhan
    try {
        // Ambil data transaksi dari Midtrans
        $transaction = \Midtrans\Transaction::status($order_id);

        // Tampilkan hasilnya jika transaksi ditemukan
        echo "<pre>";
        echo "Transaction details for Order ID: $order_id\n";
        print_r($transaction);
        echo "</pre>";

    } catch (Exception $e) {
        // Ambil pesan error dari exception
        $error_message = $e->getMessage();

        // Lewati jika pesan error berisi 'Transaction doesn't exist'
        if (strpos($error_message, 'Transaction doesn\'t exist') === false) {
            echo 'Error for Order ID ' . $order_id . ': ' . $error_message . "<br>";
        }
        // Jika error adalah 'Transaction doesn't exist', kita lewati tanpa menampilkan pesan apapun
    }
}
?>
