<!DOCTYPE html>
<html>
<head>
<?php session_start(); ?>
  <?php
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
    <?php
    include'_partials/breadcrumb.php';
    ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php
              include "koneksi2.php";
              $query_mysql = 
                        "SELECT mm.no_memo, mm.kode_memo, mm.id_penerima,mm.pengirim,mm.id_jabatan,
                        mm.mengetahui, mm.tanggal,  mm.perihal ,mm.lampiran , mm.status,jb.jabatan, dc.id_pegawai 
                        FROM memo_masuk mm
                        INNER JOIN jabatan jb ON mm.id_jabatan = jb.id_jabatan
                        LEFT JOIN jabatan pgw ON mm.mengetahui = pgw.id_jabatan
                        LEFT JOIN detail_cc dc ON mm.kode_memo = dc.kode_memo
                        INNER JOIN jabatan pw ON mm.id_penerima = pw.id_jabatan
                        WHERE ( mm.status = 'sudah' and dc.id_pegawai= '$_SESSION[id_jabatan]') 
                         OR( mm.status = 'sudah' AND mm.id_penerima  = '$_SESSION[id_jabatan]')
                       OR (mm.status = 'sudah' and mm.mengetahui= '$_SESSION[id_jabatan]')
                       GROUP BY dc.kode_memo";
              $result = mysqli_query($host, $query_mysql) or die (mysqli_error($host));
              ?>

    
                <h3><?php echo mysqli_num_rows($result); ?></h3>

                <p>Memo Masuk</p>
              </div>
              <div class="icon">
              <i class="far fa-envelope"></i>
              </div>
              <a href="list_memo_masuk.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php 
           $level = $_SESSION['level'];
              if($level != 'direktur'){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php
              include "koneksi2.php";
              $query_mysql = "SELECT * FROM memo_keluar  
              INNER JOIN jabatan ON memo_keluar.id_penerima = jabatan.id_jabatan
              where memo_keluar.pengirim = '$_SESSION[id_pegawai]' 
              ";
              $result = mysqli_query($host, $query_mysql) or die (mysqli_error($host));
              ?>

    
                <h3><?php echo mysqli_num_rows($result); ?></h3>

                <p>Memo Keluar</p>
              </div>
              <div class="icon">
              <i class="nav-icon far  fa-paper-plane"></i>
              </div>
              <a href="list_memo_keluar.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <!-- ./col -->
          <?php 
           $level = $_SESSION['level'];
              if($level == 'karu'){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php
              include "koneksi2.php";
              $query_mysql = " SELECT * FROM disposisi
              INNER JOIN jabatan ON disposisi.dari = jabatan.id_jabatan
              WHERE disposisi.tujuan = '$_SESSION[id_jabatan]' ORDER BY disposisi.tgl_disposisi DESC";
              $result = mysqli_query($host, $query_mysql) or die (mysqli_error($host));
              ?>

    
                <h3><?php echo mysqli_num_rows($result); ?></h3>

                <p>Disposisi Masuk</p>
              </div>
              <div class="icon">
              <i class="fas fa-envelope-open-text "></i>
              </div>
              <a href="disposisi_masuk.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <!-- ./col -->
          <?php 
          $level = $_SESSION['level'];
          if($level == 'admin'){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php 
              include 'koneksi2.php';
              $user = "SELECT * FROM pegawai";
              $result1 = mysqli_query($host, $user)or die (mysqli_error($host));
              ?>
              <h3><?php echo mysqli_num_rows($result1); ?></h3>
                <p>User Terdaftar</p>
              </div>
              <div class="icon">
               <i class="nav-icon far fa-user"></i>
              </div>
              <a href="listpegawai.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php } ?>
          <?php 
          $level = $_SESSION['level'];
          if($level == 'admin'){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php 
              include 'koneksi2.php';
              $jabatan = "SELECT * FROM jabatan";
              $result5 = mysqli_query($host, $jabatan)or die (mysqli_error($host));
              ?>
              <h3><?php echo mysqli_num_rows($result5); ?></h3>
              <p>Daftar Jabatan</p>
              </div>
              <div class="icon">
               <i class="fas fa-users nav-icon"></i>
              </div>
              <a href="list_disposisi.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php } ?>
          <?php 
          $level = $_SESSION['level'];
          if($level == 'direktur'){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php 
              include 'koneksi2.php';
              $diposisi = "SELECT * FROM disposisi";
              $result2 = mysqli_query($host, $diposisi)or die (mysqli_error($host));
              ?>
              <h3><?php echo mysqli_num_rows($result2); ?></h3>
              <p>Disposisi</p>
              </div>
              <div class="icon">
              <i class="fas fa-share"></i>
              </div>
              <a href="list_disposisi.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php } ?>
          <?php 
          $level = $_SESSION['level'];
          if($level == 'kabag'){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php
              $query_mysql = "SELECT * FROM memo_masuk  
                    INNER JOIN jabatan jb ON memo_masuk.id_jabatan = jb.id_jabatan
                    WHERE memo_masuk.status = 'belum' 
                    AND memo_masuk.mengetahui = '$_SESSION[id_jabatan]'
                    ";
                    $sql_keluar = mysqli_query($host, $query_mysql) or die (mysqli_error($host));  ?>
               <h3><?php echo mysqli_num_rows($sql_keluar); ?></h3>
                <p>Konfirmasi Memo</p>
              </div>
              <div class="icon">
              <i class="fas fa-envelope-open-text nav-icon"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php } ?>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
        <div class="col-md-7">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-bullhorn"></i>  Alur Pembuatan dan Pendisposisian Memo</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="accordion">
                  <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h4 class="card-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false">
                         #1 Membuat Memo Oleh Kepala Ruangan
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse in collapse" style="">
                      <div class="card-body">
                            <div class="timeline">
                              <!-- timeline time label -->
                              <div class="time-label">
                                <span class="bg-red">Membuat Memo Oleh Kepala Ruangan</span>
                              </div>
                              <!-- /.timeline-label -->
                              <!-- timeline item -->
                              <div>
                              <i class="fas  fa-paper-plane bg-green"></i>
                                <div class="timeline-item">
                                  <h3 class="timeline-header"><b>Klik Menu Buat Memo</b></h3>
                                  <div class="timeline-body">
                                   Untuk membuat memo / Mengirimkan Memo silahkan Klik Menu Buat Memo
                                   yang ada di Sidebar Sistem atau bisa Klik Button dibawah ini
                                  </div>
                                  <div class="timeline-footer">
                                    <a class="btn btn-primary btn-sm"> <i class="fas  fa-paper-plane"></i> Buat Memo</a>
                                  </div>
                                </div>
                              </div>
                              <!-- END timeline item -->
                              <!-- timeline item -->
                              <div>
                                <i class="fas fa-plus bg-green"></i>
                                <div class="timeline-item">
                                  <h3 class="timeline-header">Klik  <i class="fas fa-plus"></i> Buat Memo pada Memu Memo Keluar </h3>
                                </div>
                              </div>
                              <!-- END timeline item -->
                              <!-- timeline item -->
                              <div>
                                <i class="fas fa-comments bg-yellow"></i>
                                <div class="timeline-item">
                                  <h3 class="timeline-header">Kemudian Isi Form Memo Keluar Sesuai yang dibutuhkan</h3>
                                </div>
                              </div>
                              <!-- END timeline item -->
                              <!-- timeline time label -->
                              <div>
                              <i class="fas  fa-paper-plane bg-green"></i>
                                <div class="timeline-item">
                                  <h3 class="timeline-header">Jika Sudah Klik Button Kirim</h3>
                                  <div class="timeline-body">
                                   Tahap Berikutnya <b> Kepala Bagian </b>Harus melakukan Verifikasi 
                                   supaya Memo Terkirim ke Direktur
                                  </div>
                                  
                                </div>
                              </div>
                              <!-- END timeline item -->
                            </div>
                      </div>
                    </div>
                  </div>
                  <div class="card card-danger">
                    <div class="card-header">
                      <h4 class="card-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                        #2 Verifikasi Memo Oleh Kepala Bagian
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" style="">
                      <div class="card-body">
                            <div class="timeline">
                             <!-- timeline time label -->
                              <div class="time-label">
                                <span class="bg-green">Verifikasi Memo Oleh Kepala Bagian</span>
                              </div>
                              <!-- /.timeline-label -->
                              <!-- timeline item -->
                              <div>
                              <i class="fa fa-envelope-open-text bg-purple"></i>
                               
                                <div class="timeline-item">
                                 
                                  <h3 class="timeline-header">Klik Menu Konfirmasi Memo di Sidebar</h3>
                                  
                                </div>
                              </div>
                              <!-- END timeline item -->
                              <!-- timeline item -->
                              
                              <div>
                                <i class="fa fa-check bg-red"></i>
                                <div class="timeline-item">
                                 
                                  <h3 class="timeline-header">Klik Button <i class="fas fa-check"></i>  Checlist pada pada memo yang ingin di verifikasi</h3>
                                  
                                </div>
                              </div>
                              <!-- END timeline item -->
                              <!-- timeline item -->
                              <div>
                               <i class="fa fa-check bg-green"></i>
                                <div class="timeline-item">
                                  <h3 class="timeline-header">Jika sudah Memo akan Terkirim Ke Direktur</h3>
                                  <div class="timeline-body">
                                   Tahap Berikutnya <b> Direktur </b> bisa Melakukan Disposisi Memo Ke Bagian Yang dikehendaki
                                  </div>
                                </div>
                              </div>
                              <!-- END timeline item -->
                              <!-- timeline item -->
                            </div>
                    </div>
                    </div>
                  </div>
                  <div class="card card-success">
                    <div class="card-header">
                      <h4 class="card-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                        #3 Disposisi Memo Oleh Direktur
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                      <div class="card-body">
                        <div class="timeline">
                         <!--Direktur-->
                              <div class="time-label">
                                <span class="bg-purple">Disposisi Memo Oleh Direktur</span>
                              </div>
                              <!-- /.timeline-label -->
                              <!-- timeline item -->
                              <div>
                              <i class="fa fa-envelope bg-yellow"></i>
                                <div class="timeline-item">
                                 
                                  <h3 class="timeline-header">Klik Menu Memo Masuk di Sidebar</h3>
                                  
                                </div>
                              </div>
                              <!-- END timeline item -->
                              <!-- timeline item -->
                              
                              <div>
                              <i class="fa fa-share bg-red"></i></a>
                                <div class="timeline-item">
                                 
                                  <h3 class="timeline-header">Klik Button  <i class="fa fa-share"></i></a> Pada Memo yang ingin di Disposisikan</h3>
                                  
                                </div>
                              </div>
                              <!-- END timeline item -->
                              <!-- timeline item -->
                              <div>
                              <i class="fa fa-edit bg-green"></i>
                                <div class="timeline-item">
                                 
                                  <h3 class="timeline-header">Kemudian Isi Form Sesuai Kebutuhan</h3>
                                  <div class="timeline-body">
                                    Jika Form sudah terisi semua kemudian Klik Tombol kirim maka
                                    Disposisi akan terkirim ke Tujuan
                                  </div>
                                  
                                </div>
                              </div>
                              <!-- END timeline item -->
                              <!-- timeline item -->
                              <div class="time-label">
                                <span class="bg-yellow">Selesai</span>
                              </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            
            

            
          </div>
          <div class="col-md-5">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-edit"></i>
                  Tentang Sistem
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                      <img src="img/logo-rsmg.png" alt="">
                    </div>
                    <div class="col-md-9">
                      <p style="text-align: justify;"><b>Sistem E-Memo Internal RS Muhammadiyah Gresik </b> merupakan Sistem untuk memudahkan para karyawan dalam 
                      membuat memo internal dan memudahkan Direktur dalam melakukan proses Disposisi Memo </p>
                    </div>
                </div>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            
          </div>
        </div><!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
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
  <script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($label); ?>,
				datasets: [{
					label: 'Grafik Penjualan',
					data: <?php echo json_encode($jumlah_produk); ?>,
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
<script>
/*
     * BAR CHART
     * ---------
     */

    var bar_data = {
      data : [[1,10], [2,8], [3,4], [4,13], [5,17], [6,9]],
      bars: { show: true }
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
          show: true, barWidth: 0.5, align: 'center',
        },
      },
      colors: ['#3c8dbc'],
      xaxis : {
        ticks: [[1,'January'], [2,'February'], [3,'March'], [4,'April'], [5,'May'], [6,'June']]
      }
    })
    /* END BAR CHART */

</script>

</body>
</html>
