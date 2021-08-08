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
    <?php
    include'_partials/breadcrumb.php';
    ?>
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
            
            <form role="form" method="POST" action="updatePegawai.php">
            <?php
                include "koneksi2.php";
                $id_pegawai = $_GET['id_pegawai'];
                $query_mysql = mysqli_query($host,"SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'")or die(mysqli_error());
                while($data = mysqli_fetch_array($query_mysql)){      
            ?>

                  <div class="row">
                  <input type="hidden" value="<?php echo $data['id_pegawai'];?>" name="id_pegawai">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>NIP</label>
                        <input type="number" name="nip" class="form-control" placeholder="NIP" value="<?php echo $data['nip']; ?>" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-8">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo $data['nama']; ?>">
                      </div>
                    </div>
                   
                  </div>
                  <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan" >
                          <?php
                          $sql = mysqli_query($host, "SELECT * FROM  jabatan");
                          while ($data1 = mysqli_fetch_array($sql)) {
                          ?>
                            <option <?php if($data['id_jabatan'] == $data1['id_jabatan']){echo 'selected';} ?> value="<?php echo $data1['id_jabatan'];?>"><?php echo $data1['jabatan']; ?></option>
                          <?php } ?>
                        </select>
                    </div>
                  </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Akses</label>
                        <select class="form-control" name="akses">
                          
                          <option <?php if($data['akses'] == 'admin') {echo "selected";} ?> value="admin" >Administrator</option>
                          <option <?php if($data['akses'] == 'direktur') {echo "selected";} ?> value="direktur" >Direktur</option>
                          <option <?php if($data['akses'] == 'kabag') {echo "selected";} ?> value="kabag" >Kepala Bagian</option>
                          <option <?php if($data['akses'] == 'karu') {echo "selected";} ?> value="karu" >Kepala Ruangan</option>
                            
                        </select>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username"  value="<?php echo $data["username"]; ?>"/>
                      </div>
                    </div>
                    <div class="col-sm-4">
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
                  
                  <?php } ?>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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
