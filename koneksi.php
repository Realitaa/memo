<?php
// Function to get environment variable from .env file
function getEnvData($key) {
    $lines = file(__DIR__ . '/.env');
    foreach ($lines as $line) {
        if (strpos(trim($line), $key) === 0) {
            return trim(explode('=', $line)[1]);
        }
    }
    return null;
}

// Get database credentials from .env file
$db_host = getEnvData('DB_HOST');
$db_username = getEnvData('DB_USERNAME');
$db_password = getEnvData('DB_PASSWORD');
$db_database = getEnvData('DB_DATABASE');

// Update connection variable
$konek = mysqli_connect($db_host, $db_username, $db_password, $db_database);
if(!$konek){
	echo "Koneksi Database Gagal...!!!";
}

function LocalDate($tanggal) {
    $dateTime = DateTime::createFromFormat('Y-m-d', $tanggal);
    $fmt = new IntlDateFormatter(
        'id_ID',
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE
    );
    return $fmt->format($dateTime);
}

function LocalMemo(int $nomor, $tanggal) {
    // Konversi tanggal ke DateTime untuk mengambil bulannya
    $dateTime = DateTime::createFromFormat('Y-m-d', $tanggal);
    $bulan = $dateTime->format('m'); // Mendapatkan bulan dalam format angka (01-12)
    
    // Format nomor memo
    return sprintf('%04d', $nomor) . '/' . $bulan;
}

// Contoh penggunaan
// $tanggal = '2025-03-15';
// echo LocalDate($tanggal); // Output: Sabtu, 15 Maret 2025
// echo "\n";
// echo LocalMemo(5, $tanggal); // Output: 0005/03

?>