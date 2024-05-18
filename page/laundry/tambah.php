<?php

// jika tombol tambah ditekan
if (isset($_POST['tambah'])) {
  $idlayanan = $_POST['id_layanan'];
  $total = htmlentities(strip_tags(trim($_POST["total"])));
  $plat = htmlentities(strip_tags(trim($_POST["plat"])));
  $diskon = htmlentities(strip_tags(trim($_POST["diskon"])));
  $tanggal = date('Y-m-d');
  // $ket_laporan = 1;
  $pesan_error = "";

  // input ke tb transaksi
  $query = mysqli_query($conn, "INSERT INTO `transaksi` (`id_layanan`, `total`, `plat`, `tanggal`, `diskon`) VALUES ('$idlayanan', '$total', '$plat', '$tanggal', '$diskon')");
  // $result = mysqli_query($conn, $query);

  // jika sudah lunas, maka input data transaksi ke tb_laporan
  // mysqli_query($conn, "INSERT INTO `tb_laporan` (`id_laporan`, `tgl_laporan`, `ket_laporan`, `catatan`, `id_laundry`, `pemasukan`) VALUES ('', '$tgl_terima', '$ket_laporan', '$catatan', '$idlaundry', '$totalbayar')");
  
  
  if ($query) {
    echo "
      <script>
        alert('Transaksi $idlayanan berhasil ditambahkan');
        window.location.href = '?page=laundry';
      </script>
    ";
  }else{
    $pesan_error .= "Data gagal disimpan !";
  }

}else{
  $pesan_error = "";
  $total = "";
  $plat = "";
  $tanggal = "";
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
                      <li class="breadcrumb-item active">Transaksi</li>
                      <li class="breadcrumb-item active">Tambah Transaksi</li>
                  </ol>
              </div>
              <h4 class="page-title">Tambah Transaksi</h4>
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

            <input type="hidden" name="userid" value=<?= $_SESSION['userid']; ?>>

            <?php 
            // mencari id_laundry otomatis
            $q = mysqli_query($conn, "SELECT MAX(RIGHT(id_transaksi,4)) AS kd_max FROM transaksi");
            $jml = mysqli_num_rows($q);
            $kd = "";
            if ($jml > 0) {
              while ($result = mysqli_fetch_assoc($q)) {
                $tmp = ((int)$result['kd_max']) + 1;
                $kd = sprintf("%04s", $tmp);
              }
            } else {
              $kd = "0001";
            }
            $id_laundry = 'LD-' . $kd;
            ?>
            <!-- inptu id_laundry bertipe hidden -->
            <input type="hidden" name="id_laundry" value="<?= $id_laundry; ?>">        

              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Layanan</label>
                <div class="col-sm-10">
                  <!-- jenis() => function javascript -->
                  <!-- onchange => jika dipilih maka fungsi jenis dijalankan -->
                  <select class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;" name="id_layanan" id="id_jenis" onchange="jenis();">
                  <option>--Pilih jenis---</option>
                  <?php 
                  $query = mysqli_query($conn, "SELECT * FROM layanan");
                  while ($result = mysqli_fetch_assoc($query)) :
                  if ($result['id_layanan'] == $jenis) { ?>
                    <option value="<?= $result['id_layanan']; ?>" selected><?= $result['jenis']; ?></option>
                  <?php }else{ ?>
                    <option value="<?= $result['id_layanan']; ?>"><?= $result['jenis']; ?></option>
                  <?php } ?>
                  <?php endwhile; ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Tarif</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" id="tarif" name="tarif" value="<?= $tarif; ?>" required readonly/>
                </div>
              </div>

              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">No Plat</label>
                <div class="col-sm-10">
                <input class="form-control" type="text" id="no_plat" name="plat" value="" required onkeyup="jenis();"/>
                </div>
              </div>

              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Diskon</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" id="diskon" name="diskon" value="<?= $diskon; ?>" required readonly/>
                </div>
              </div>

              <div class="form-group row">
                <label for="example-number-input" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                  <!-- onkeyup = bereaksi ketika diketik -->
                  <input class="form-control" type="number" id="jml_kilo" name="jml_kilo" value="<?= $jml_kilo; ?>" onkeyup="sum();" required/>
                </div>
              </div>

              <div class="form-group row">
                <label for="example-number-input" class="col-sm-2 col-form-label">Total Bayar</label>
                <div class="col-sm-10">
                  <input class="form-control"type="number" value="<?= $totalbayar; ?>" id="totalbayar" name="total" readonly required/>
                </div>
              </div>

              <button type="submit" name="tambah" class="btn btn-primary tambah" onclick="return confirm('Apakah data yang anda masukkan sudah benar ?');">Tambah</button>
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

<script>
  // menghitung total bayar
 function sum() {
  var jmlKilo = parseInt(document.getElementById('jml_kilo').value);
  var tarif = parseInt(document.getElementById('tarif').value);
  var diskon = parseInt(document.getElementById('diskon').value);

  // Menghitung total sebelum diskon
  var totalSebelumDiskon = jmlKilo * tarif;

  // Menghitung total setelah diskon
  var totalSetelahDiskon = totalSebelumDiskon - diskon;

  // Memeriksa apakah parameter numerik
  if (!isNaN(totalSetelahDiskon)) {
    document.getElementById('totalbayar').value = totalSetelahDiskon;
  } else {
    document.getElementById('totalbayar').value = '';
  }
}

function jenis() {
  var id = $("#id_jenis").val();
  var plat = $("#no_plat").val();

  // Hanya lakukan permintaan AJAX jika kedua input terisi
  if (id !== "" && plat !== "") {
    $.ajax({
      url: "page/laundry/autofill.php",
      data: {
        'idjenis': id,
        'plat': plat
      },
      success: function(data) {
        var json = data,
          obj = JSON.parse(json);

        // Jika sukses mengirim balik
        if (obj.sukses) {
          // Auto mengisi data pada id = tarif
          $('#tarif').val(obj.sukses.tarif);

          // Auto mengisi data pada id = diskon
          $('#diskon').val(obj.sukses.diskon);

          // Auto mengisi data pada id = status
          $('#status').val(obj.sukses.status);

          $('#jml_kilo').val('');
          $('#totalbayar').val('');

          // Panggil fungsi sum() setelah mengisi nilai diskon
          sum();
        } else if (obj.gagal) {
          $('#tarif').val('');
          $('#diskon').val('');
          $('#status').val('');
          $('#jml_kilo').val('');
          $('#totalbayar').val('');
        }
      }
    });
  }
}
        
</script>