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
            <h1 class="m-0 text-dark">Konfirmasi Memo</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Konfirmasi Memo</li>
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
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped responsiv">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nomor</th>
                  <th>Tujuan</th>
                  <th>Dari</th>
                  <th>Diteruskan</th>
                  <th>Tanggal</th>
                  <th>Perihal</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    include "koneksi2.php";
                    $no = 1;
                    $query_mysql = "SELECT * FROM memo_masuk  
                    INNER JOIN jabatan jb ON memo_masuk.id_jabatan = jb.id_jabatan
                    WHERE memo_masuk.status = 'belum' 
                    AND memo_masuk.mengetahui = '$_SESSION[id_jabatan]'
                    ";
                    $sql_keluar = mysqli_query($host, $query_mysql) or die (mysqli_error($host));
                    while($data = mysqli_fetch_array($sql_keluar)){ 
                  ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['no_memo']; ?></td>
                  <td>
                  <?php $query_tujuan = "SELECT * FROM memo_keluar  
                    INNER JOIN jabatan ON memo_keluar.id_penerima = jabatan.id_jabatan
                    where memo_keluar.kode_memo = '$data[kode_memo]'";
                    $sql_tujuan = mysqli_query($host, $query_tujuan) or die (mysqli_error($host));
                    while($data2 = mysqli_fetch_array($sql_tujuan)){ 
                      echo $data2['jabatan']; }
                  ?>
                  </td>
                  <td><?php echo $data['jabatan']; ?></td>
                  <td>
                  <?php
                   $sql_cc = mysqli_query($host,"SELECT * FROM detail_cc 
                   INNER JOIN jabatan ON detail_cc.id_pegawai = jabatan.id_jabatan WHERE kode_memo = '$data[kode_memo]'
                   ") or die (mysqli_error($host));
                  while ($data_memo_keluar = mysqli_fetch_array($sql_cc)) {
                    echo "- ".$data_memo_keluar['jabatan']."</br>";
                  }
                  ?>
                  
                  </td>
                  <td> <?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                  <td> <?php echo $data['perihal']; ?></td>
                  <td style="text-align:center;">
                    <a href="proses_konfir.php?kode_memo=<?= $data['kode_memo']?>" style="color:white" class="btn btn-info btn-sm" title="verifikasi memo" ><i class="fas fa-check"></i></a>
                    <a href="layout_memo.php?kode_memo=<?php echo $data['kode_memo']; ?>" style="color:white" class="btn btn-success btn-sm" title="Print memo" target="_blank"><i class="fas fa-print"></i></a>
                    <a href="proses_tolak.php?kode_memo=<?php echo $data['kode_memo']; ?>" style="color:white" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin mau Tolak memo ini ?')"><i class="fas fa-trash"></i></a>
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
