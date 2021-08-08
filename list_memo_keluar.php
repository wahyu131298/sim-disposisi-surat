<!DOCTYPE html>
<html>
<head>
  <?php
  session_start();
    include'_partials/header.php';
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
            <h1 class="m-0 text-dark">Memo Keluar </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Memo Keluar</li>
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
            <div class="card-header">
              <h3 class="card-title"><button type="button" onclick="window.location.href='http://localhost/memo2/memo_keluar.php'" class="btn btn-block btn-outline-primary"><i class="fas fa-plus"></i> Buat Memo</button></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped responsiv">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nomor</th>
                  <th>Tujuan</th>
                  <th>Dari</th>
                  <th>Tembusan</th>
                  <th>Tanggal</th>
                  <th>Perihal</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    include "koneksi2.php";
                    $no = 1;
                    $query_mysql = "SELECT * FROM memo_keluar  
                    INNER JOIN jabatan ON memo_keluar.id_penerima = jabatan.id_jabatan
                    where memo_keluar.pengirim = '$_SESSION[id_pegawai]' ORDER BY memo_keluar.tanggal DESC
                    ";
                    $sql_keluar = mysqli_query($host, $query_mysql) or die (mysqli_error($host));
                    while($data = mysqli_fetch_array($sql_keluar)){ 
                  ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['no_memo']; ?></td>
                  <td>
                  <?php echo $data['jabatan']; ?>
                  </td>
                  <td><?php 
                  $query_mysql2 = "SELECT jabatan FROM jabatan  
                  where id_jabatan = '$_SESSION[id_jabatan]'";
                  $sql_keluar2 = mysqli_query($host, $query_mysql2) or die (mysqli_error($host));
                  while($data3 = mysqli_fetch_array($sql_keluar2)){ 
                    echo $data3['jabatan']; 
                  }
                  ?></td>
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
                  <td> <?php echo $data['tanggal']; ?></td>
                  <td> <?php echo $data['perihal']; ?></td>
                  <td> 
                  <?php
                  $status = $data['status']; 
                  if ($status == 'sudah'){
                    echo "<span class='badge badge-success'>Terkirim</span>";
                  } else if ($status == 'belum'){
                    echo "<span class='badge badge-danger'>Pendding</span>";
                  } else {
                    echo "<span class='badge badge-warning'>Di Tolak</span>";
                  }
                  
                  
                  ?>
                  </td>
                  <td style="text-align:center;">
                    <a href="layout_memo.php?kode_memo=<?php echo $data['kode_memo']; ?>" target="_blank"  style="color:white" class="btn btn-success btn-sm" title="Print"><i class="fas fa-print"></i></a>
                   
                    <a href="deletememokeluar.php?kode_memo=<?php echo $data['kode_memo']; ?>" style="color:white" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash"></i></a>
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
