<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_laundry";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data transaksi dari database
$sql = "SELECT tanggal, SUM(total) AS total_per_tanggal FROM transaksi GROUP BY tanggal";
$result = $conn->query($sql);

$transactionData = array();

// Mengisi array dengan data transaksi
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $transactionData[] = array(
            'tanggal' => $row['tanggal'],
            'total' => $row['total_per_tanggal']
        );
    }
}

// Mengembalikan data transaksi dalam format JSON
header('Content-Type: application/json');
echo json_encode($transactionData);

// Tutup koneksi
$conn->close();
?>