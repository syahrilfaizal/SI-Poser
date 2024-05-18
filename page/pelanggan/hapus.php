<?php

// ambil data &id= dari url
$id = $_GET['id'];

// mengambil data dari tb_pelanggan berdasarkan id
$query = mysqli_query($conn, "SELECT * FROM member WHERE id_member = $id");
$row = mysqli_fetch_assoc($query);
$username = $row['nama'];

// menghapus foto profile jika ada

// menghapus data pelanggan
$result = mysqli_query($conn, "DELETE FROM member WHERE id_member = $id");

if ($result) {
  echo "
  <script>
    alert('Data dengan nama $username berhasil dihapus');
    window.location.href = '?page=pelanggan';
  </script>
";
}

?>