<div id="sidebar-menu">
  <ul>

    <li class="menu-title">SI-POSER</li>
    
    <li>
      <a href="index.php" class="waves-effect">
        <i class="mdi mdi-airplay"></i><span> Dashboard</span>
      </a>
    </li>

    <li>
      <?php 
      // menghitung data pelanggan
      $dataPelanggan = mysqli_query($conn, "SELECT * FROM tb_pelanggan");
      $jmlDataPelanggan = mysqli_num_rows($dataPelanggan);
      ?>
      <a href="?page=pelanggan" class="waves-effect">
        <i class="fa fa-users"></i>
        <span>Member<span class="badge badge-pill badge-primary float-right"><?= $jmlDataPelanggan; ?></span></span>
      </a>
    </li>
  
  <!-- jika level admin -->
  <?php if($_SESSION['level'] == 'admin') : ?>
    <!-- <li>
      <?php 
      // menghitung data user
      // $dataUser = mysqli_query($conn, "SELECT * FROM tb_users");
      // $jmlDataUser = mysqli_num_rows($dataUser);
      ?>
      <a href="?page=users" class="waves-effect">
        <i class="fa fa-users"></i>
        <span>Data Users<span class="badge badge-pill badge-primary float-right"><?= $jmlDataUser; ?></span></span>
      </a>
    </li> -->

    <li>
    <?php 
      // menghitung data jenis
      $jenis = mysqli_query($conn, "SELECT * FROM tb_jenis");
      $jmljenis = mysqli_num_rows($jenis);
      ?>
      <a href="?page=jenis" class="waves-effect">
      <i class="fa fa-key"></i>
        <span>Layanan<span class="badge badge-pill badge-primary float-right"><?= $jmljenis; ?></span></span>
      </a>
    </li>
  <?php endif; ?>
  
    <li>
      <?php 
      // menghitung data laundry
      $laundry = mysqli_query($conn, "SELECT * FROM tb_laundry");
      $jmllaundry = mysqli_num_rows($laundry);
      ?>
      <a href="?page=laundry" class="waves-effect">
        <i class="fa fa-shopping-cart"></i>
        <span>Transaksi<span class="badge badge-pill badge-primary float-right"><?= $jmllaundry; ?></span></span>
      </a>
    </li>

    

    <li>
      <a href="?page=laporan" class="waves-effect">
        <i class="fa fa-reorder"></i>
        <span>Data Laporan</span>
      </a>
    </li>

    

  </ul>
</div>
