<?php

// jika mencari data tanggal
if (isset($_POST['cari'])) {
  // menampilkan data transaksi
  $tglAwal = $_POST['tanggalawal'];
  $tglAkhir = $_POST['tanggalakhir'];
  $query = "SELECT * FROM `transaksi` INNER JOIN `layanan` ON `layanan`.`id_layanan` = `transaksi`.`id_layanan` WHERE tanggal BETWEEN '$tglAwal' AND '$tglAkhir'";
  $result = mysqli_query($conn, $query); 
}else{
  // menampilkan data transaksi
  $query = "SELECT * FROM `transaksi` INNER JOIN `layanan` ON `layanan`.`id_layanan` = `transaksi`.`id_layanan` ORDER BY `transaksi`.`id_transaksi` DESC";
  $result = mysqli_query($conn, $query); 
}
?>

<div class ="page-content-wrapper">
  <div class="container-fluid">

  <div class="row">
      <div class="col-sm-12">
          <div class="page-title-box">
              <div class="btn-group float-right">
                  <ol class="breadcrumb hide-phone p-0 m-0">
                      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                      <li class="breadcrumb-item active">Transaksi</li>
                  </ol>
              </div>
              <h4 class="page-title">Transaksi</h4>
          </div>
      </div>
  </div>

    <div class="row">
      <div class="col-12">
        <div class="card m-b-30">
          <div class="card-body">
            <form class="form-inline mr-auto w-100 navbar-search" action="" method="POST">
            <div class="input-group">
              <label for="" class="form-control-label">Tanggal Awal</label>
                <input type="date" class="form-control bg-light border-0 small ml-3 mr-3" name="tanggalawal" id="tanggalawal" required>
              
              <label for="" class="form-control-label">Tanggal Akhir</label>
                <input type="date" class="form-control bg-light border-0 small ml-3" name="tanggalakhir" id="tanggalakhir" required>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="cari">
                        <i class="fa fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
          </form>
          <div class="table-responsive">
            <h4 class="mt-0 header-title" style="text-align: right;">
              <a href="?page=laundry&aksi=tambah" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Transaksi Laundry</a>
            </h4>
            <h4 class="mt-0 header-title">
              <!-- menampilkan status yang sudah lunas -->
              <!-- <a href="?page=laundry&aksi=laundrylunas" class="btn btn-success">Status Lunas</a> -->
              <!-- menampilkan status yang belum lunas -->
              <!-- <a href="?page=laundry&aksi=laundrybelumlunas" class="btn btn-danger">Status Belum Lunas</a> -->
            </h4>
            <table id="datatable" class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Jenis Layanan</th>
                  <th>Tanggal</th>
                  <th>Plat</th>
                  <th>Diskon</th>
                  <th>Total Bayar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              // menampilkan data transaksi laundry
              // $query = "SELECT * FROM `transaksi` INNER JOIN `layanan` ON `layanan`.`id_layanan` = `transaksi`.`id_layanan` ORDER BY `transaksi`.`id_transaksi` DESC";
              // $result = mysqli_query($conn, $query); ?>
              <?php $i = 1; ?>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $row['jenis']; ?></td>
                  <td><?= $row['tanggal']; ?></td>
                  <td><?= $row['plat']; ?></td>
                  <!-- jika status 1 berarti lunas, jika 0 belum lunas -->
                  <td>Rp. <?= number_format($row['diskon']); ?></td>
                  <td>Rp. <?= number_format($row['total']); ?></td>
                  <td>
                    <!-- jika status pembayaran = 1 -->
                      

                      <a href="page/cetak_transaksi.php?id=<?= $row['id_transaksi']; ?>" class="btn btn-success" target="_blank"><i class="fa fa-download"> Cetak</i></></a>

                    <!-- jika status pembayaran = 0 -->
                  </td>
                </tr>
              <?php $i++; ?>
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
    <!-- end page title end breadcrumb -->
  </div>
  <!-- container -->
</div>
