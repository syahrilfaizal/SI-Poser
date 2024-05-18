<?php 

// menangkap nilai id dari url
$id = $_GET['id'];
// mengambil data dari tb_jenis berdasarkan id
$query = mysqli_query($conn, "SELECT * FROM layanan WHERE id_layanan = $id");
$row = mysqli_fetch_assoc($query);
$jenis_laundry = $row['jenis'];

// menghapus data jenis laundry
$result = mysqli_query($conn, "DELETE FROM layanan WHERE id_layanan = $id");

if ($result) {
  echo "
  <script>
    alert('Data dengan Jenis $jenis_layanan berhasil dihapus');
    window.location.href = '?page=jenis';
  </script>
";
}

?>