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
            <h1 class="m-0 text-dark">Input Pegawai  </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Input Pegawai</li>
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
              <h3 class="card-title"><button type="button" onclick="history.back();" class="btn btn-block btn-outline-primary"><i class="fas fa-arrow-alt-circle-left"></i></i> Kembali</button></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <form role="form" method="POST" action="inputpegawai.php">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>NIP</label>
                        <input type="number" name="nip" class="form-control" placeholder="NIP">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-8">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                      </div>
                    </div>
                   
                  </div>
                  <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan">
                        <?php
                        include "koneksi2.php";
                        $sql2 = mysqli_query($host, "SELECT * FROM  jabatan");
                        while ($data2 = mysqli_fetch_array($sql2)) {
                        ?>
                          <option value="<?php echo $data2['id_jabatan']?>"><?php echo $data2['jabatan']?></option>
                        <?php } ?>
                        </select>
                        <small>*Satu Jabatan Hanya digunakan 1 Karyawan</small>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Akses</label>
                        <select class="form-control" name="akses">
                          <option value="admin">Administrator</option>
                          <option value="direktur">Direktur</option>
                          <option value="kabag">Kepala Bagian</option>
                          <option value="karu">Kepala Ruangan</option>
                        </select>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                  <div class="col-sm-4">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username"class="form-control" placeholder="Username">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password2" class="form-control" placeholder="Ketik Ulang Password">
                      </div>
                    </div>
                    <!--div class="col-sm-4"-->
                      <!-- text input -->
                      <!--div class="form-group">
                        <label>QR Code</label><br>
                        <button type="submit" name="qr_code" class="btn btn-primary">Generate</button>
                      </div>
                    </div-->
                  </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Submit</button>
                </form>
                <!--?php
                if (isset($_POST['qr_code'])) {
                    include "plugins/phpqrcode/qrlib.php"; 
            
                    $tempdir = "img/qr_code/"; //Nama folder tempat menyimpan file qrcode
                    //isi qrcode jika di scan
                    $codeContents = $_POST['nip'];
                    //nama file qrcode yang akan disimpan
                    $namaFile=$_POST['nama'].".png";
                    //ECC Level
                    $level=QR_ECLEVEL_H;
                    //Ukuran pixel
                    $UkuranPixel=10;
                    //Ukuran frame
                    $UkuranFrame=4;
                    QRcode::png($codeContents, $tempdir.$namaFile, $level, $UkuranPixel, $UkuranFrame); 
                   
                }
                ?-->
    


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
