<?php
// memanggil koneksi
include "../../include/koneksi.php";

// autofill / mengisi data otomatis pada field transaksi
// menangkap data idjenis dari laundry/tambah.php
$idjenis = isset($_GET['idjenis']) ? $_GET['idjenis'] : '';
$plat = isset($_GET['plat']) ? $_GET['plat'] : '';

// Query untuk mendapatkan data layanan
$query_jenis = mysqli_query($conn, "SELECT * FROM layanan WHERE id_layanan = '$idjenis'");
$hasil_jenis = mysqli_fetch_assoc($query_jenis);

// Query untuk mengecek apakah plat sudah terdaftar di tabel member
if (!empty($plat)) {
  $query_member = mysqli_query($conn, "SELECT * FROM member WHERE plat = '$plat'");
  $hasil_member = mysqli_fetch_assoc($query_member);
} else {
  $hasil_member = null;
}

// Jika tarif tidak kosong
if ($hasil_jenis && mysqli_num_rows($query_jenis) > 0) {
    // Jika plat sudah terdaftar di tabel member
    if ($hasil_member && mysqli_num_rows($query_member) > 0) {
        $tarif = $hasil_jenis['harga'];
        $diskon = 10000; // Diskon 10000
        $data = [
            'sukses' => [
                'tarif' => $tarif,
                'diskon' => $diskon,
                'status' => 'Member'
            ]
        ];
    } else {
        $tarif = $hasil_jenis['harga'];
        $diskon = 0; // Tidak ada diskon
        $data = [
            'sukses' => [
                'tarif' => $tarif,
                'diskon' => $diskon,
                'status' => 'Non-member'
            ]
        ];
    }
} else {
    $data = [
        'gagal' => 'gagal'
    ];
}

// Data dikirim kembali ke laundry/tambah.php
echo json_encode($data);
?>