<?php 

// ambil nilai id dari url
$id = $_GET['id'];
// menampilkan data jenis berdasarkan id
$result = mysqli_query($conn, "SELECT * FROM layanan WHERE id_layanan = '$id'");
$row = mysqli_fetch_assoc($result);

  $jenis_layanan = $row['jenis'];
  $tarif = $row['harga'];

// jika tombol ubah ditekan
if (isset($_POST['ubah'])) {
  $jenis_layanan = htmlentities(strip_tags(trim($_POST["jenis_layanan"])));
  $tarif = htmlentities(strip_tags(trim($_POST["tarif"])));
  $pesan_error = "";

  // mengecek jenis laundry
  // jika jenis laundry yang diinputkan tidak sama dengan nama jenis laundry yg lama, maka 
  if ($row['jenis_layanan'] !== $jenis_layanan) {
    // menampilkan data jenis laundry sesuai dengan inputan jenis laundry
    $query_jenis = mysqli_query($conn, "SELECT * FROM layanan WHERE id_layanan = '$jenis_layanan'");
    $result_jenis = mysqli_num_rows($query_jenis);

    // cek apakah jenis laundry ada yang
    if ($result_jenis > 0) {
      $pesan_error = "Jenis Laundry <b>$jenis_layanan</b> sudah ada <br>";
    }
  }

  // jika tidak terdapat pesan error
  if ($pesan_error == "") {
    $query = mysqli_query($conn, "UPDATE `layanan` SET `jenis` = '$jenis_layanan', `harga` = '$tarif' WHERE `layanan`.`id_layanan` = $id");
    if ($query) {
      echo "
      <script>
        alert('Data jenis $jenis_layanan berhasil diubah');
        window.location.href = '?page=jenis';
      </script>
      ";
    }else{
      // jika gagal disimpan
      $pesan_error .= "Data gagal disimpan !";
    }
  // jika ada error
  }else{
    $pesan_error .= "Data gagal disimpan !";
  }

}else{
  $pesan_error = "";
}

?>

<div class="page-content-wrapper">
<div class="container-fluid">

  <div class="row">
      <div class="col-sm-12">
          <div class="page-title-box">
              <div class="btn-group float-right">
                  <ol class="breadcrumb hide-phone p-0 m-0">
                      <li class="breadcrumb-item"><a href="index.php">Laundry</a></li>
                      <li class="breadcrumb-item active">Data Jenis Laundry</li>
                      <li class="breadcrumb-item active">Edit Jenis Laundry</li>
                  </ol>
              </div>
              <h4 class="page-title">Edit Jenis Laundry</h4>
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
                  <input class="form-control"type="text"id="example-text-input" name="jenis_layanan" placeholder="Masukkan jenis layanan" value="<?= $jenis_layanan; ?>" required autofocus/>
                </div>
              </div>

              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Tarif</label>
                <div class="col-sm-10">
                  <input class="form-control" type="number" id="example-text-input" name="tarif" placeholder="Masukkan tarif" value="<?= $tarif; ?>" required/>
                </div>
              </div>

              <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
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
