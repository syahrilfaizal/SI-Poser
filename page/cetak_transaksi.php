<?php
include '../include/koneksi.php';
$id_laundry = $_GET['id'];

// Ambil data transaksi berdasarkan id_transaksi
$query_transaksi = "SELECT * FROM `transaksi` WHERE `id_transaksi` = '$id_laundry'";
$result_transaksi = mysqli_query($conn, $query_transaksi);
$row_transaksi = mysqli_fetch_assoc($result_transaksi);

// Ambil data layanan berdasarkan id_layanan pada transaksi
$id_layanan = $row_transaksi['id_layanan'];
$query_layanan = "SELECT * FROM `layanan` WHERE `id_layanan` = '$id_layanan'";
$result_layanan = mysqli_query($conn, $query_layanan);
$row_layanan = mysqli_fetch_assoc($result_layanan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice Transaksi</title>
  <style>
    @media print {
      @page {
        size: 37mm 57mm;
        margin: 0;
      }
      body {
        margin: 0;
        padding: 0;
        font-family: 'Courier New', monospace;
        font-size: 8px;
        line-height: 1.2;
        width: 57mm;
      }
      h2, p {
        margin: 0;
        padding: 0;
        line-height: 1.2;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        font-size: 8px;
      }
      th, td {
        padding: 2px;
        text-align: left;
      }
      hr {
        border: 0;
        border-top: 1px dashed #8c8c8c;
      }
    }
  </style>
</head>
<body onload="window.print()">
  <h2 style="text-align: center;">Pondok Service</h2>
  <p style="text-align: center; font-size: 6px;">Jl. Sudirman No. 123, Kota Baru</p>
  <p style="text-align: center; font-size: 6px;">No. Hp / WA : 081234567890</p>
  <p style="text-align: center; font-size: 6px;">Jam Operasional : Setiap Hari : 08.00 – 17.30 WIB</p>
  <hr>
  <p style="text-align: center;"><b>Invoice Transaksi</b></p>
  <p style="text-align: center; font-size: 6px;"><b>Tanggal : </b> <?= date('Y-m-d H:i:s'); ?></p>
  <table>
    <tr>
      <th>Jenis</th>
      <td><?= $row_layanan['jenis']; ?></td>
    </tr>
    <tr>
      <th>Tanggal</th>
      <td><?= $row_transaksi['tanggal']; ?></td>
    </tr>
    <tr>
      <th>Plat</th>
      <td><?= $row_transaksi['plat']; ?></td>
    </tr>
    <tr>
      <th>Diskon</th>
      <td>Rp. <?= number_format($row_transaksi['diskon']); ?></td>
    </tr>
    <tr>
      <th>Total</th>
      <td>Rp. <?= number_format($row_transaksi['total']); ?></td>
    </tr>
  </table>
  <hr>
  <p style="font-size: 6px;">Terima kasih telah menggunakan layanan kami.</p>
</body>
</html>