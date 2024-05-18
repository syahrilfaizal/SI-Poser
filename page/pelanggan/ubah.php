<?php 

// mengambil data url id
$id = $_GET['id'];

// mengambil data dari tb_pelanggan berdasarkan id
$result = mysqli_query($conn, "SELECT * FROM member WHERE id_member = $id");
$row = mysqli_fetch_assoc($result);

  $nama = $row['nama'];
  $plat = $row['plat'];

// jika tombol ubah ditekan
if (isset($_POST['ubah'])) {
  // menamgkap data dari form
  $nama = htmlentities(strip_tags(trim($_POST["namamember"])));
  $plat = htmlentities(strip_tags(trim($_POST["plat"])));
  $pesan_error = "";

  // update data
  $query = mysqli_query($conn, "UPDATE `member` SET `nama` = '$nama', `plat` = '$plat' WHERE `member`.`id_member` = $id");
  
  // cek keberhasilan
  if ($query) {
    echo "
    <script>
      alert('Data dengan nama $nama berhasil diubah');
      window.location.href = '?page=pelanggan';
    </script>
    ";
  // tidak berhasil, maka menampilkan pesan error
  }else{
    $pesan_error .= "Data gagal diubah !";
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
                      <li class="breadcrumb-item active">Data Pelanggan</li>
                      <li class="breadcrumb-item active">Edit Pelanggan</li>
                  </ol>
              </div>
              <h4 class="page-title">Edit Pelanggan</h4>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-12">

      <?php if ($pesan_error !== "") : ?>
        <div class="alert alert-danger" role="alert">
          <?= $pesan_error; ?>
        </div>
      <?php endif; ?>

          <form action="" method="post">
          <div class="card m-b-100">
            <div class="card-body">

              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input class="form-control"type="text"id="example-text-input" name="namamember" placeholder="Masukkan nama" value="<?= $nama; ?>" required autofocus/>
                </div>
              </div>

              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Nomor Plat</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text"id="example-text-input" name="plat" placeholder="Masukkan No.Plat" value="<?= $plat; ?>" required/>
                </div>
              </div>

              <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
              <a href="?page=pelanggan" class="btn btn-warning">Kembali</a>
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
