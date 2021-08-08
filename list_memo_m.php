<!DOCTYPE html>
<html>
<head>
  <?php
    include'_partials/header.php';session_start();
  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php
    include'_partials/navbar.php';
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
    include'_partials/sidebar.php';
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Memo Masuk </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Memo Masuk</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
          <?php if (isset($delete_berhasil)) :?>
              <div class="alert alert-danger" role="alert">
              <p style="color:#fff;padding:0px" class="login-box-msg">
                Hapus Data Berhasil   
                </p>
            </div>
             <?php endif ?> 
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nomor</th>
                  <th>Dari</th>
                  <th>Bagian</th>
                  <th>Diteruskan</th>
                  <th>Mengetahui</th>
                  <th>Tanggal</th>
                  <th>Perihal</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    include "koneksi2.php";
                    $no = 1;
                    $query_mysql = "SELECT * FROM memo_masuk mm
                    LEFT JOIN detail_cc dc ON mm.kode_memo = dc.kode_memo
                    INNER JOIN jabatan jb ON mm.id_jabatan = jb.id_jabatan
                    LEFT JOIN pegawai ph ON mm.pengirim = ph.id_pegawai
                    GROUP BY mm.kode_memo
                    ";
                    $sql_keluar = mysqli_query($host, $query_mysql) or die (mysqli_error($host));
                    while($data = mysqli_fetch_array($sql_keluar)){
                  ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['no_memo']; ?></td>
                  <td>
                  <?php $query_mysql2 = mysqli_query($host,"SELECT nama FROM pegawai nm  WHERE id_pegawai = '$data[pengirim]'") or die (mysqli_error($host));
                  while ($data_nama = mysqli_fetch_array($query_mysql2)) {
                    echo $data_nama['nama']."</br>";
                }
                  
                  ?></td>
                  <td><?php echo $data['jabatan']; ?></td>
                  <td>
                  <?php
                  $sql_cc = mysqli_query($host,"SELECT * FROM detail_cc   
                  INNER JOIN jabatan ON detail_cc.id_pegawai = jabatan.id_jabatan
                  WHERE kode_memo = '$data[kode_memo]'
                 
                 ") or die (mysqli_error($host));
                  while ($data_memo_masuk = mysqli_fetch_array($sql_cc)) {
                    echo "- ".$data_memo_masuk['jabatan']."</br>";
                  }
                  ?>
                  </td>
                  <td>
                  <?php $query_mysql3 = mysqli_query($host,"SELECT jabatan FROM jabatan ml 
                  LEFT JOIN memo_masuk jl ON  ml.id_jabatan = jl.mengetahui
                   WHERE ml.id_jabatan = '$data[mengetahui]' GROUP BY ml.id_jabatan" ) or die (mysqli_error($host));
                  while ($data_jbt = mysqli_fetch_array($query_mysql3)) {
                    echo $data_jbt['jabatan']."</br>";
                  }
                  ?>
                  </td>
                  <td> <?php echo $data['tanggal']; ?></td>
                  <td> <?php echo $data['perihal']; ?></td>
                  <td style="text-align:center;">
                    <a href="delete_memo_m.php?kode_memo=<?php echo $data['kode_memo']?>" style="color:white" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    <a href="layout_memo.php?kode_memo=<?php echo $data['kode_memo']; ?>" target="_blank" style="color:white" class="btn btn-success btn-sm"><i class="fas fa-print"></i></a>
                  </td>
                </tr>
                    <?php }?>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    include'_partials/footer.php';
  ?>

</div>
<!-- ./wrapper -->

<?php
    include'_partials/js.php';
  ?>
</body>
</html>
