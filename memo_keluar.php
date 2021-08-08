<?php
require '_asset/vendor/autoload.php';
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
if (!isset($_SESSION)) {
  session_start();
}else{
  
}
$level = $_SESSION['level'];
  include "koneksi2.php";
    if (isset($_POST['kirim'])) {
        $uuid4 = Uuid::uuid4()->toString();
        $no_memo = $_POST['nomor'];
        $id_penerima = $_POST['penerima'];
        $pengirim = $_POST['id_pengirim'];
        $bagian = $_POST['id_jabatan'];
        $tgl = $_POST['tanggal'];
        $perihal = $_POST['perihal'];
        if($level == 'karu'){
        $mengetahui = $_POST['mengetahui'];
        }
        $isi = $_POST['isi'];
        $status = $_POST['status'];
        //lampiran
        $ekstensi_dibolehkan = array('pdf','doc','docx');
        $nama  = $_FILES['lampiran']['name'];
        $x = explode('.',$nama);
        $ekstensi = strtolower(end($x));
			  $ukuran	= $_FILES['lampiran']['size'];
        $file_tmp = $_FILES['lampiran']['tmp_name'];	
        
        if ( $cek_nomor = mysqli_num_rows(mysqli_query($host,"SELECT no_memo FROM memo_keluar WHERE no_memo = '$no_memo' "))) 
        {
          echo "<script>alert('No Memo Sudah digunakan');history.go(-1)</script>";
        }
        if (in_array($ekstensi, $ekstensi_dibolehkan) == true || empty($nama  = $_FILES['lampiran']['name'])) {
          if ($ukuran < 1000000) {
            move_uploaded_file($file_tmp, 'img/dukumen/'.$nama);
            //kabag
           
             if($level == 'kabag' && empty($_POST['cc']) )
             {
                $query_memo_keluar_kabag = mysqli_query($host, "INSERT INTO memo_keluar
                VALUES('$uuid4','$no_memo','$id_penerima','$pengirim','$bagian','$tgl','$perihal','NULL','$isi','$nama','$status')") or die (mysqli_error($host));
                if ( $query_memo_keluar_kabag)
                {
                  $query_memo_masuk2 = mysqli_query($host, "INSERT INTO memo_masuk
                  VALUES('$uuid4','$no_memo','$id_penerima','$pengirim','$bagian','$tgl','$perihal','NULL','$isi','$nama','$status')") or die (mysqli_error($host));
                  header('location:list_memo_keluar.php');
                }
             }
             if($level == 'kabag' && !empty($_POST['cc']))
             {
              $query_memo_keluar_kabag2 =  mysqli_query($host, "INSERT INTO memo_keluar
              VALUES('$uuid4','$no_memo','$id_penerima','$pengirim','$bagian','$tgl','$perihal','NULL','$isi','$nama','$status')") or die (mysqli_error($host));
              if ( $query_memo_keluar_kabag2) {
                mysqli_query($host, "INSERT INTO memo_masuk
                VALUES('$uuid4','$no_memo','$id_penerima','$pengirim','$bagian','$tgl','$perihal','NULL','$isi','$nama','$status')") or die (mysqli_error($host));
              }
              $cc = $_POST['cc'];//var_dump($cc);
                foreach ($cc as $c ) {
                mysqli_query($host, "INSERT INTO detail_cc (kode_memo,id_pegawai) VALUES ('$uuid4','$c')") or die (mysqli_error($host));
                header('location:list_memo_keluar.php');
              }
             }
             //karu
            if(empty($_POST['cc'])) 
            {
                $query_memo_keluar = mysqli_query($host, "INSERT INTO memo_keluar
                VALUES('$uuid4','$no_memo','$id_penerima','$pengirim','$bagian','$tgl','$perihal','$mengetahui','$isi','$nama','$status')") or die (mysqli_error($host));
              if ( $query_memo_keluar) {
                $query_memo_masuk = mysqli_query($host, "INSERT INTO memo_masuk
                VALUES('$uuid4','$no_memo','$id_penerima','$pengirim','$bagian','$tgl','$perihal','$mengetahui','$isi','$nama','$status')") or die (mysqli_error($host));
                header('location:list_memo_keluar.php');
              }
            }
            if (!empty($_POST['cc'])) {
              
              $query_memo_keluar2 =  mysqli_query($host, "INSERT INTO memo_keluar
              VALUES('$uuid4','$no_memo','$id_penerima','$pengirim','$bagian','$tgl','$perihal','$mengetahui','$isi','$nama','$status')") or die (mysqli_error($host));
              if ( $query_memo_keluar2) {
                mysqli_query($host, "INSERT INTO memo_masuk
                VALUES('$uuid4','$no_memo','$id_penerima','$pengirim','$bagian','$tgl','$perihal','$mengetahui','$isi','$nama','$status')") or die (mysqli_error($host));
              }
              $cc = $_POST['cc'];//var_dump($cc);
                foreach ($cc as $c ) {
                mysqli_query($host, "INSERT INTO detail_cc (kode_memo,id_pegawai) VALUES ('$uuid4','$c')") or die (mysqli_error($host));
                header('location:list_memo_keluar.php');
              }
            }         
           
          }else {
            echo "<script>alert('Ukuran File Terlalu Besar');history.go(-1)</script>";
          }
        }else {
          echo "<script>alert('Ekstensi Tidak Diizinkan');history.go(-1)</script>";
        }
        
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
            <h1 class="m-0 text-dark">Tulis Memo</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tulis Memo</li>
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
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nomor</label>
                        <input type="text" name="nomor" class="form-control" placeholder="Nomor" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-8">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Penerima</label>
                            <select class="form-control" name="penerima" >
                            <?php
                            $sql = mysqli_query($host, "SELECT * FROM  pegawai 
                            INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE pegawai.akses = 'direktur' ");
                            while ($data1 = mysqli_fetch_array($sql)) {
                            ?>
                                <option value="<?php echo $data1['id_jabatan'];?>" selected><?php echo $data1['nama'];?> (<?php echo $data1['jabatan'];?>)</option>
                            <?php } ?>
                            </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-8">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tembusan</label>
                        <select class="select2" multiple="multiple" data-placeholder="Tembusan" style="width: 100%;" name="cc[]">
                        <?php
                            $sql = mysqli_query($host, "SELECT * FROM  pegawai 
                            INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan");
                            while ($data1 = mysqli_fetch_array($sql)) {
                            ?>
                                <option value="<?php echo $data1['id_jabatan'];?>"><?php echo $data1['nama'];?> (<?php echo $data1['jabatan'];?>)</option>
                            <?php } ?>    
                            </select>
                      </div>
                    </div>
                </div>
                <input type="hidden" name="id_pengirim" value="<?php echo $_SESSION['id_pegawai'];?>">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Pengirim</label>
                        <input  type="text" name="pengirim" class="form-control" placeholder="Pengirim" value="<?php echo $_SESSION['user_login'];?>" disabled >
                    </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Bagian</label>
                        <?php
                            $sql2 = mysqli_query($host, "SELECT * FROM  pegawai INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE pegawai.id_pegawai = '$_SESSION[id_pegawai]' ");
                            while ($data2 = mysqli_fetch_array($sql2)) {
                        ?>
                        <input type="hidden" name="id_jabatan" class="form-control" placeholder="Bagian" value="<?php echo $data2['id_jabatan'];?>">
                        <input type="text" name="jabatan" class="form-control" placeholder="Bagian" value="<?php echo $data2['jabatan'];?>" disabled>
                        <?php }?>
                      </div>
                    </div>
                  </div>
                    
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Perihal</label>
                        <input type="text" name="perihal" class="form-control" placeholder="Perihal" required>
                      </div>
                    </div>
                 </div>
                 <?php
                  if($level == 'karu'){

                  ?>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Mengetahui</label>
                        <select class="form-control" name="mengetahui" >
                            <?php
                            $sql = mysqli_query($host, "SELECT * FROM  pegawai 
                            INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE pegawai.akses = 'kabag'");
                            while ($data1 = mysqli_fetch_array($sql)) {
                            ?>
                                <option value="<?php echo $data1['id_jabatan'];?>" ><?php echo $data1['nama'];?> (<?php echo $data1['jabatan'];?>)</option>
                            <?php } ?>
                          </select>
                      </div>
                    </div>
                 </div>
                 <?php } ?>
               
                 <div class="row">
                    <div class="col-sm-12">
                    <label>Isi</label>
                        <textarea class="textarea" name="isi" placeholder="Place some text here"
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                    </div>
                 </div>
                 <div class="col-sm-4">
                      <div class="form-group">
                        <label>Lampiran</label>
                        <input type="file" name="lampiran" class="form-control">
                      </div>
                  </div>
                  <input type="hidden" name="status" 
                  value="<?php if ($level == 'kabag') {
                   echo "sudah";
                  }elseif ($level == 'karu') {
                   echo "belum";
                  } 
                  ?>" class="form-control">
                    <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
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
