<?php
session_start();
include 'koneksi2.php';
if (isset($_POST['kirim'])) {
  $nomor = $_POST['nomor'];
  $jabatan = $_POST['jabatan'];
  $tanggal = $_POST['tanggal'];
  $perihal = $_POST['perihal'];
  $sifat = $_POST['sifat'];
  $tujuan = $_POST['tujuan'];
  $tanggapan = $_POST['tanggapan'];
  $tgl_disposisi = $_POST['tgl_disposisi'];
  $catatan = $_POST['catatan'];
  mysqli_query($host, "INSERT INTO disposisi VALUES('','$nomor','$jabatan','$tanggal','$perihal','$sifat','$tujuan','$tanggapan','$tgl_disposisi','$catatan')");
  header("location:list_disposisi.php");

}
?>
<!DOCTYPE html>
<html>
<head>

  <?php
    include'_partials/header.php';
  ?>
  <style>
      .select2-selection__choice{
        background-color:#007bff!important;
        border : #007bff!important;
      }
      .select2-selection__choice__remove{
          color : #fff!important;
      }
  </style>
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
            <h1 class="m-0 text-dark">Tulis Disposisi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tulis Disposisi</li>
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
            <form role="form" method="POST" action="" enctype="multipart/form-data">
            <?php
                include "koneksi2.php";
                $get_kode = $_GET['kode_memo'];
                $query_mysql = mysqli_query($host,"SELECT * FROM memo_masuk 
                INNER JOIN pegawai ON memo_masuk.pengirim = pegawai.id_pegawai
                WHERE kode_memo='$get_kode'")or die(mysqli_error());
                while($data = mysqli_fetch_array($query_mysql)){      
            ?>
            <div class="row">
             <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nomor</label>
                        <input type="text" name="nomor" class="form-control" placeholder="Nomor" value="<?php echo $data['no_memo'];?>" readonly required>
                      </div>
                      <!-- text input -->
                      <div class="form-group">
                        <label>Surat Dari</label>
                        <input  type="text" name="pengirim" class="form-control" placeholder="Pengirim" value="<?php echo $data['nama'];?>" readonly >
                      </div>
                   
                      <!-- text input -->
                      <div class="form-group">
                        <label>Bagian</label>
                        <?php
                        $query_bagian = mysqli_query($host,"SELECT * FROM pegawai 
                        INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan
                        WHERE id_pegawai='$data[pengirim]'")or die(mysqli_error());
                        while($data2 = mysqli_fetch_array($query_bagian)){      
                        ?>
                        <input  type="text" name="jabatan" class="form-control" placeholder="Pengirim" value="<?php echo $data2['id_jabatan'];?>" readonly >
                        <?php } ?>
                      </div>
                    
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" name="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo $data['tanggal'];?>" readonly required>
                      </div>
                    
                      <!-- text input -->
                      <div class="form-group">
                        <label>Perihal</label>
                        <input type="text" name="perihal" class="form-control" placeholder="Tanggal" value="<?php echo $data['perihal'];?>" readonly required>
                      </div>
                   
                 </div>
             <div class="col-sm-6">
                      <div class="form-group">
                        <label>Sifat</label>
                        <select class="form-control" name="sifat">
                          <option value="Sangat Segera">Sangat Segera</option>
                          <option value="Segera">Segera</option>
                          <option value="Rahasia">Rahasia</option>
                        </select>
                      </div>
                      <!-- text input -->
                      <div class="form-group">
                        <label>Di Teruskan Kepada </label>
                        <select class="form-control" name="tujuan" >
                          <?php
                          $sql = mysqli_query($host, "SELECT * FROM  pegawai
                          INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan");
                          while ($data1 = mysqli_fetch_array($sql)) {
                          ?>
                            <option value="<?php echo $data1['id_jabatan'];?>"><?php echo $data1['nama']; ?> ( <?php echo $data1['jabatan']; ?> )</option>
                          <?php } ?>
                        </select>
                      </div>
                      <!-- text input -->
                      <div class="form-group">
                        <label>Dengan Hormat Harap</label>
                        <select class="form-control" name="tanggapan">
                          <option value="Tanggapan dan Saran">Tanggapan dan Saran</option>
                          <option value="Proses Lebih lanjut">Proses Lebih lanjut</option>
                          <option value="Koordinasi dan Konfirmasi">Koordinasi dan Konfirmasi</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Tanggal Disposisi</label>
                        <input type="date" name="tgl_disposisi" class="form-control" placeholder="Tanggal" value=""  required>
                      </div>
                      <!-- text area -->
                      <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="5" placeholder="Catatan"></textarea>
                      </div>   
              </div>
              </div>
                 
                    <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
                <?php } ?>
                </form>
            </div>
            <!-- /.card-body -->          </div>
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
