<?php 

// jika tombol tambah ditekan
if (isset($_POST['tambah'])) {
  $jenis_layanan = htmlentities(strip_tags(trim($_POST["jenis"])));
  $tarif = htmlentities(strip_tags(trim($_POST["tarif"])));
  $pesan_error = "";

  // mengecek apakah ada jenis laundry yg sama
  $query_jenis = mysqli_query($conn, "SELECT * FROM layanan WHERE jenis = '$jenis_layanan'");
  $result_jenis = mysqli_num_rows($query_jenis);
  if ($result_jenis > 0) {
    $pesan_error .= "Jenis <b>$jenis_laundry</b> sudah ada <br>";
  }

  // jika tidak ada error
  if ($pesan_error == "") {
    $query = mysqli_query($conn, "INSERT INTO `layanan` (`jenis`, `harga`) VALUES ('$jenis_layanan', '$tarif')");
    if ($query) {
      echo "
      <script>
        alert('Data dengan jenis $jenis_layanan berhasil ditambahkan');
        window.location.href = '?page=jenis';
      </script>
      ";

    // jika ada error
    }else{
      $pesan_error .= "Data gagal disimpan !";
    }
    
  }else{
    $pesan_error .= "Data gagal disimpan !";
  }

}else{
  $pesan_error = "";
  $jenis_layanan = "";
  $tarif = "";
}

?>

<div class="page-content-wrapper">
<div class="container-fluid">

  <div class="row">
      <div class="col-sm-12">
          <div class="page-title-box">
              <div class="btn-group float-right">
                  <ol class="breadcrumb hide-phone p-0 m-0">
                      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                      <li class="breadcrumb-item active">Layanan</li>
                      <li class="breadcrumb-item active">Tambah Layanan</li>
                  </ol>
              </div>
              <h4 class="page-title">Tambah Layanan</h4>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-12">

      <!-- menampilkan notifikasi pesan error jika ada -->
      <?php if ($pesan_error !== "") : ?>
        <div class="alert alert-danger" role="alert">
          <?= $pesan_error; ?>
        </div>
      <?php endif; ?>

          <form action="" method="post">
          <div class="card m-b-100">
            <div class="card-body">

              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Layanan</label>
                <div class="col-sm-10">
                  <input class="form-control"type="text"id="example-text-input" name="jenis" placeholder="Masukkan jenis Layanan" value="<?= $jenis_layanan; ?>" required autofocus/>
                </div>
              </div>

              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Tarif</label>
                <div class="col-sm-10">
                  <input class="form-control" type="number" id="example-text-input" name="tarif" placeholder="Masukkan tarif" value="<?= $tarif; ?>" required/>
                </div>
              </div>

              <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
              <a href="?page=jenis" class="btn btn-warning">Kembali</a>
            </div>
          </div>
        </form>
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
  </div>
</div>
<br>
