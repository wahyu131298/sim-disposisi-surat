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
            <h1 class="m-0 text-dark">Laporan Disposisi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Dipsoisi</li>
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
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    <div class="row">
                        <div class="col-md-2">
                            <h3 class="card-title"> <p>Tanggal Awal</p> <input id="tgl_mulai" placeholder="masukkan tanggal Awal" type="text" class="form-control datepicker" name="tgl_awal"  value="<?php if (isset($_POST['tgl_awal'])) echo $_POST['tgl_awal'];?>" ></h3>
                        </div>
                        <div class="col-md-2">
                            <h3 class="card-title"> <p>Tanggal Akhir</p><input id="tgl_akhir" placeholder="masukkan tanggal Akhir" type="text" class="form-control datepicker" name="tgl_akhir" value="<?php if (isset($_POST['tgl_akhir'])) echo $_POST['tgl_akhir'];?>"></h3>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group fiter" style="padding-top:36px">
                             <button type="submit" name="filter" class="btn btn-primary"><i class="fas fa-filter"></i></button>   
                            </div>
                            <div class="btn-group fiter" style="padding-top:36px">
                            <a href="laporan_disposisi.php"  class="btn btn-secondary"><i class="fas fa-sync"></i></a>    
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['tgl_awal']) && isset($_POST['tgl_akhir']) == 1){
                        ?>
                        <div class="col-md-2">
                            <h3 class="card-title filter" style="padding-top: 36px;"><a target="_blank" href="cetak_laporan_disposisi.php?tgl_awal=<?php echo $_POST['tgl_awal'];?> && tgl_akhir=<?php echo $_POST['tgl_akhir'];?>" style="color:#000" class="btn btn-default btn-flat"><i class="fas fa-print"></i> Print</a></h3> 
                        </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
            
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
                      if (isset($_POST['tgl_awal']) && isset($_POST['tgl_akhir'])) {

                        $tgl_awal= date('Y-m-d', strtotime($_POST["tgl_awal"])); //var_dump($tgl_awal);
                        $tgl_akhir=date('Y-m-d', strtotime($_POST["tgl_akhir"]));//var_dump($tgl_akhir);
                      
                      $query_mysql = " SELECT * FROM disposisi
                      INNER JOIN jabatan ON disposisi.dari = jabatan.id_jabatan
                      WHERE disposisi.tujuan = '$_SESSION[id_jabatan]' 
                      AND disposisi.tgl_disposisi
                      BETWEEN '$tgl_awal' AND '$tgl_akhir'
                      ORDER BY disposisi.tgl_disposisi DESC"; 
                      
                      }else{
                        $query_mysql = " SELECT * FROM disposisi
                        INNER JOIN jabatan ON disposisi.dari = jabatan.id_jabatan
                        WHERE disposisi.tujuan = '$_SESSION[id_jabatan]' 
                        ORDER BY disposisi.tgl_disposisi DESC"; 

                      }
                      
                    $query_result = mysqli_query($host, $query_mysql) or die (mysqli_error($host));
                    while($data = mysqli_fetch_array($query_result)){
                  ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['kode_memo']; ?></td>
                  <td><?php echo $data['jabatan']; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
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
                  <td> <?php echo date('d-m-Y', strtotime($data['tgl_disposisi'])); ?></td>
                  
                  
                  <td style="text-align:center;">
                    
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