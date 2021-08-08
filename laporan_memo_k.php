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
            <h1 class="m-0 text-dark">Laporan Memo Keluar </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Memo Keluar</li>
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
                            <a href="laporan_memo_k.php"  class="btn btn-secondary"><i class="fas fa-sync"></i></a>    
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['tgl_awal']) && isset($_POST['tgl_akhir']) == 1){
                        ?>
                        <div class="col-md-2">
                            <h3 class="card-title filter" style="padding-top: 36px;"><a target="_blank" href="cetak_laporan_k.php?tgl_awal=<?php echo $_POST['tgl_awal'];?> && tgl_akhir=<?php echo $_POST['tgl_akhir'];?>" style="color:#000" class="btn btn-default btn-flat"><i class="fas fa-print"></i> Print</a></h3> 
                        </div>
                        <?php } ?>
                    </div>
                </form>
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
                 
                </tr>
                </thead>
                <tbody>
                    <?php
                    include "koneksi2.php";
                    if (isset($_POST['tgl_awal']) && isset($_POST['tgl_akhir'])) {

                        $tgl_awal= date('Y-m-d', strtotime($_POST["tgl_awal"])); //var_dump($tgl_awal);
                        $tgl_akhir=date('Y-m-d', strtotime($_POST["tgl_akhir"]));//var_dump($tgl_akhir);

                        $sql = "SELECT * FROM memo_keluar  
                        INNER JOIN jabatan ON memo_keluar.id_penerima = jabatan.id_jabatan
                        where memo_keluar.pengirim = '$_SESSION[id_pegawai]' AND memo_keluar.tanggal
                        BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY memo_keluar.tanggal DESC ";

                      
                    }else {
                        $sql = "SELECT * FROM memo_keluar  
                        INNER JOIN jabatan ON memo_keluar.id_penerima = jabatan.id_jabatan
                        where memo_keluar.pengirim = '$_SESSION[id_pegawai]' ORDER BY memo_keluar.tanggal DESC";
                    }

                    $hasil= mysqli_query($host, $sql) or die (mysqli_error($host));
                    $no=1;
                    while ($data = mysqli_fetch_array($hasil)) {
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
                  <td> <?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                  <td> <?php echo $data['perihal']; ?></td>
                  <td> 
                  <?php
                  $status = $data['status']; 
                  if ($status == 'sudah'){
                    echo "<span class='badge badge-success'>Terkirim</span>";
                  } else{
                    echo "<span class='badge badge-danger'>Pendding</span>";
                  }
                  
                  
                  ?>
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
