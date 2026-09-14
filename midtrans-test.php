<?php
// Script diagnosa mandiri — TIDAK terhubung ke Laravel sama sekali.
// Tujuannya murni untuk memastikan apakah Server Key Midtrans ini
// diterima atau ditolak, di luar konteks aplikasi.
//
// CARA PAKAI:
// 1. Taruh file ini di root project (folder yang sama dengan file "artisan").
// 2. Jalankan: php midtrans-test.php
// 3. Kirim SELURUH hasil yang muncul di terminal ke Claude.
// 4. Setelah selesai diagnosa, file ini boleh dihapus.

$serverKey = 'SB-Mid-server-3QvX8JasRnR3rrkHz61bHkUp';

$data = json_encode([
    'transaction_details' => [
        'order_id' => 'test-order-' . time(),
        'gross_amount' => 10000,
    ],
]);

$ch = curl_init('https://app.sandbox.midtrans.com/snap/v1/transactions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Content-Type: application/json',
]);
curl_setopt($ch, CURLOPT_USERPWD, $serverKey . ':');

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

echo "===================================\n";
echo "HTTP Status Code: $httpCode\n";
echo "===================================\n";

if ($curlError) {
    echo "cURL Error (koneksi gagal, bukan soal key): $curlError\n";
} else {
    echo "Response dari Midtrans:\n";
    echo $response . "\n";
}
