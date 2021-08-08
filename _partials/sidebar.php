<?php

if (!isset($_SESSION['user_login'])) {
  header("location:login.php");
  exit;
}
?> 
 
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="img/logo-rsmg.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">E-Memo RSMG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php 
           $level = $_SESSION['level'];
              if($level == 'direktur'){
          ?>
          <img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
          <?php } ?>
          <?php 
           $level = $_SESSION['level'];
              if($level == 'kabag'){
          ?>
          <img src="dist/img/avatar1.png" class="img-circle elevation-2" alt="User Image">
          <?php } ?>
          <?php 
           $level = $_SESSION['level'];
              if($level == 'karu'){
          ?>
          <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
          <?php } ?>
          <?php 
           $level = $_SESSION['level'];
              if($level == 'admin'){
          ?>
          <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
          <?php } ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['user_login'];?> </a>
          <p style="color:#ced2d6">(<?php echo $_SESSION['nama_jabatan'];?>)</p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!--li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Surat
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="list_memo_masuk.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="list_memo_keluar.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat Keluar</p>
                </a>
              </li>
            </ul>
          </li-->
          <?php 
           $level = $_SESSION['level'];
              if($level != 'direktur'){
          ?>
          <li class="nav-item">
            <a href="list_memo_keluar.php" class="nav-link">
            <i class="nav-icon far  fa-paper-plane"></i>
              <p>
               Buat Memo
              </p>
            </a>
          </li>
              <?php } ?>
          <li class="nav-item">
            <a href="list_memo_masuk.php" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
              <p>
               Memo Masuk
              </p>
            </a>
          </li>
         
          <?php 
         
          if($level == 'admin'){
          ?>
          <li class="nav-header">Data Master</li>
          <li class="nav-item">
            <a href="list_memo_m.php" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
              Daftar Memo Masuk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="list_memo_k.php" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
              Daftar Memo Keluar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="listpegawai.php" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
               Kelola Pegawai
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="listjabatan.php" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>
               Kelola Jabatan
              </p>
            </a>
          </li>
           <?php } ?>

           <?php 
              if($level == 'direktur'){
          ?>
          <li class="nav-item">
            <a href="list_disposisi.php" class="nav-link">
            <i class="fas fa-envelope-open-text nav-icon"></i>
              <p>
               Disposisi
              </p>
            </a>
          </li>
          <?php } ?>
          <?php
           if($level == 'kabag'){

          ?>
          <li class="nav-item">
            <a href="konfir_memo.php" class="nav-link">
            <i class="fas fa-envelope-open-text nav-icon"></i>
              <p>
               Konfirmasi Memo
              </p>
            </a>
          </li>
           <?php } ?>
          <?php
           if($level == 'karu'){

          ?>
          <li class="nav-item">
            <a href="disposisi_masuk.php" class="nav-link">
            <i class="fas fa-envelope-open-text nav-icon"></i>
              <p>
               Disposisi Masuk
              </p>
            </a>
          </li>
           <?php } ?>
           <li class="nav-header">Laporan</li>
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php 
            $level = $_SESSION['level'];
                if($level != 'direktur'){
            ?>
              <li class="nav-item">
                <a href="laporan_memo_k.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Memo Keluar</p>
                </a>
              </li>
              <?php } ?>
              <li class="nav-item">
                <a href="laporan_memo_m.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Memo Masuk</p>
                </a>
              </li>
              <?php
              if($level == 'karu'){

              ?>
              <li class="nav-item">
                <a href="laporan_disposisi.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Disposisi</p>
                </a>
              </li>
              <?php } ?>
              <?php
              if($level == 'direktur'){

              ?>
              <li class="nav-item">
                <a href="laporan_disposisi_direktur.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Disposisi</p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
            <i class="fa fa-chevron-circle-left nav-icon"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>