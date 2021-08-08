<!DOCTYPE html>
<html>
<head>
  <?php
    include'_partials/header.php';
    session_start();
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
            
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nomor</th>
                  <th>Dari</th>
                  <th>Bagian</th>
                  <th>Tembusan</th>
                  <th>Mengetahui</th>
                  <th>Tanggal</th>
                  <th>Perihal</th>
                  <th>Lampiran</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    include "koneksi2.php";
                      $no = 1;
                     
                        $query_mysql = "SELECT mm.no_memo, mm.kode_memo, mm.id_penerima,mm.pengirim,mm.id_jabatan,
                        mm.mengetahui, mm.tanggal,  mm.perihal ,mm.lampiran , mm.status,jb.jabatan, dc.id_pegawai 
                        FROM memo_keluar mm
                        INNER JOIN jabatan jb ON mm.id_jabatan = jb.id_jabatan
                        LEFT JOIN jabatan pgw ON mm.mengetahui = pgw.id_jabatan
                        LEFT JOIN detail_cc dc ON mm.kode_memo = dc.kode_memo
                        INNER JOIN jabatan pw ON mm.id_penerima = pw.id_jabatan
                       
                       GROUP BY dc.kode_memo
                        
                      ";//var_dump($_SESSION['id_jabatan']);
                    $query_result = mysqli_query($host, $query_mysql) or die (mysqli_error($host));
                    while($data = mysqli_fetch_array($query_result)){
                  ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['no_memo']; ?></td>
                  <td>
                  <?php 
                  $query_mysql2 = mysqli_query($host,"SELECT nama FROM pegawai  
                  WHERE id_pegawai = '$data[pengirim]'") or die (mysqli_error($host));
                  while ($data_nama = mysqli_fetch_array($query_mysql2)) {
                    echo $data_nama['nama'];
                 }
                ?>
                  </td>
                  <td><?php echo $data['jabatan']; ?></td>
                  <td>
                  <!--Tembusan-->
                  <?php
                  $sql_cc = mysqli_query($host,"SELECT * FROM detail_cc dg 
                  INNER JOIN jabatan kk ON dg.id_pegawai = kk.id_jabatan 
                  WHERE dg.kode_memo = '$data[kode_memo]' ") ;
                  while ($data_memo_masuk = mysqli_fetch_array($sql_cc)) {
                    echo "- ".$data_memo_masuk['jabatan']."</br>";
                  }
                  ?>
                  </td>
                  <td>
                  <?php 
                  $query_mysql3 = mysqli_query($host,"SELECT * FROM memo_masuk 
                  INNER JOIN jabatan ON memo_masuk.mengetahui = jabatan.id_jabatan
                   WHERE kode_memo = '$data[kode_memo]'") or die (mysqli_error($host));
                  while ($data_jbt = mysqli_fetch_array($query_mysql3)) {
                    echo $data_jbt['jabatan'];
                  }
                  ?>
                  </td>
                  <td> <?php echo $data['tanggal']; ?></td>
                  <td> <?php echo $data['perihal']; ?></td>
                  <td> <a href="download.php/img/<?php echo $data['lampiran']; ?>"><?php echo  $data['lampiran']; ?></a></td>
                  
                  <td style="text-align:center;">
                    <a href="deletememokeluar.php?kode_memo=<?php echo $data['kode_memo']; ?>" style="color:white" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></a>
                    <a href="layout_memo.php?kode_memo=<?php echo $data['kode_memo']; ?>"  style="color:white" class="btn btn-success btn-sm" title="Print"><i class="fas fa-print"></i></a>
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