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
            <h1 class="m-0 text-dark">Disposisi</h1>
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
                  <th>No Memo</th>
                  <th>Memo Dari</th>
                  <th>Tanggal Memo</th>
                  <th>Perihal</th>
                  <th>Sifat</th>
                  <th>Tujuan </th>
                  <th>Tanggal Disposisi</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    include "koneksi2.php";
                      $no = 1;
                      $query_mysql = " SELECT * FROM disposisi
                      INNER JOIN jabatan ON disposisi.dari = jabatan.id_jabatan
                      WHERE disposisi.tujuan = '$_SESSION[id_jabatan]' ORDER BY disposisi.tgl_disposisi DESC";
                      
                    $query_result = mysqli_query($host, $query_mysql) or die (mysqli_error($host));
                    while($data = mysqli_fetch_array($query_result)){
                  ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['kode_memo']; ?></td>
                  <td><?php echo $data['jabatan']; ?></td>
                  <td><?php echo $data['tanggal']; ?></td>
                  <td> <?php echo $data['perihal']; ?></td>
                  <td>
                  <?php
                  $sifat2 = $data['sifat']; 
                  if ($sifat2 == 'Sangat Segera'){
                    echo "<span class='badge badge-success'>Sangat Segera</span>";
                  } elseif ($sifat2 == 'Segera') {
                    echo "<span class='badge badge-warning'>Segera</span>";
                  }elseif ($sifat2 == 'Rahasia'){
                    echo "<span class='badge badge-danger'>Rahasia</span>";
                  }
                  ?>
                  </td>
                  <td> 
                  <?php
                    $query_tujuan = " SELECT * FROM jabatan where id_jabatan = '$data[tujuan]'";
                    $query_result3 = mysqli_query($host, $query_tujuan) or die (mysqli_error($host));
                    while($data2 = mysqli_fetch_array($query_result3)){
                  ?>
                  <?php echo $data2['jabatan']; ?>

                  <?php }?>
                  
                  </td>
                  <td> <?php echo $data['tgl_disposisi']; ?></td>
                  
                  
                  <td style="text-align:center;">
                    <a href="#" style="color:white" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></a>
                    <a href="cetak_disposisi.php?id_disposisi=<?php echo $data['id_disposisi'] ?>"  target="_blank" style="color:white" class="btn btn-success btn-sm" title="Print"><i class="fas fa-print"></i></a>
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