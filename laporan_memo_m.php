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
            <h1 class="m-0 text-dark">Laporan Memo Masuk </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Memo Masuk</li>
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
                            <a href="laporan_memo_m.php"  class="btn btn-secondary"><i class="fas fa-sync"></i></a>    
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['tgl_awal']) && isset($_POST['tgl_akhir']) == 1){
                        ?>
                        <div class="col-md-2">
                            <h3 class="card-title filter" style="padding-top: 36px;"><a target="_blank" href="cetak_laporan_m.php?tgl_awal=<?php echo $_POST['tgl_awal'];?> && tgl_akhir=<?php echo $_POST['tgl_akhir'];?>" style="color:#000" class="btn btn-default btn-flat"><i class="fas fa-print"></i> Print</a></h3> 
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
                      if (isset($_POST['tgl_awal']) && isset($_POST['tgl_akhir'])) {

                        $tgl_awal= date('Y-m-d', strtotime($_POST["tgl_awal"])); //var_dump($tgl_awal);
                        $tgl_akhir=date('Y-m-d', strtotime($_POST["tgl_akhir"]));//var_dump($tgl_akhir);
                     
                        $query_mysql = "SELECT mm.no_memo, mm.kode_memo, mm.id_penerima,mm.pengirim,mm.id_jabatan,
                        mm.mengetahui, mm.tanggal,  mm.perihal ,mm.lampiran , mm.status,jb.jabatan, dc.id_pegawai 
                        FROM memo_masuk mm
                        INNER JOIN jabatan jb ON mm.id_jabatan = jb.id_jabatan
                        LEFT JOIN jabatan pgw ON mm.mengetahui = pgw.id_jabatan
                        LEFT JOIN detail_cc dc ON mm.kode_memo = dc.kode_memo
                        INNER JOIN jabatan pw ON mm.id_penerima = pw.id_jabatan
                        WHERE ( mm.status = 'sudah' and dc.id_pegawai= '$_SESSION[id_jabatan]' AND mm.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir') 
                        OR( mm.status = 'sudah' AND mm.id_penerima  = '$_SESSION[id_jabatan]' AND mm.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir')
                        OR (mm.status = 'sudah' and mm.mengetahui= '$_SESSION[id_jabatan]' AND mm.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir') 
                      
                        GROUP BY dc.kode_memo ORDER BY mm.tanggal DESC
                        
                      ";
                      }else{
                        $query_mysql = "SELECT mm.no_memo, mm.kode_memo, mm.id_penerima,mm.pengirim,mm.id_jabatan,
                        mm.mengetahui, mm.tanggal,  mm.perihal ,mm.lampiran , mm.status,jb.jabatan, dc.id_pegawai 
                        FROM memo_masuk mm
                        INNER JOIN jabatan jb ON mm.id_jabatan = jb.id_jabatan
                        LEFT JOIN jabatan pgw ON mm.mengetahui = pgw.id_jabatan
                        LEFT JOIN detail_cc dc ON mm.kode_memo = dc.kode_memo
                        INNER JOIN jabatan pw ON mm.id_penerima = pw.id_jabatan
                        WHERE ( mm.status = 'sudah' and dc.id_pegawai= '$_SESSION[id_jabatan]') 
                        OR( mm.status = 'sudah' AND mm.id_penerima  = '$_SESSION[id_jabatan]')
                        OR (mm.status = 'sudah' and mm.mengetahui= '$_SESSION[id_jabatan]') 
                        GROUP BY dc.kode_memo ORDER BY mm.tanggal DESC";

                      }//var_dump($_SESSION['id_jabatan']);
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
                  <td>  <?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                  <td> <?php echo $data['perihal']; ?></td>
                  <td> <a href="download.php?filename=<?= $data['lampiran']; ?>"><?php echo  $data['lampiran']; ?></a></td>
                  
                  <td style="text-align:center;">
                   
                    <a href="layout_memo.php?kode_memo=<?php echo $data['kode_memo']; ?>"   target="_blank" style="color:white" class="btn btn-success btn-sm" title="Print"><i class="fas fa-print"></i></a>
                    
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