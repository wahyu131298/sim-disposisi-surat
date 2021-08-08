<!DOCTYPE html>
<html lang="en">
<head>
   
    
    <?php
  session_start();
    include'_partials/header.php';
  ?>
</head>
<body>
    <p style="text-align:center;font-size:25px"><b>LAPORAN MEMO MASUK</b></p>
   <table id="example1" class="table table-bordered responsiv">
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
                  
            </tr>
        </thead>
        <tbody>
                    <?php
                    include "koneksi2.php";
                    $tgl_awal= date('Y-m-d', strtotime($_GET["tgl_awal"]));// var_dump($tgl_awal);
                    $tgl_akhir= date('Y-m-d', strtotime($_GET["tgl_akhir"]));// var_dump($tgl_akhir);

                        $sql = "SELECT mm.no_memo, mm.kode_memo, mm.id_penerima,mm.pengirim,mm.id_jabatan,
                        mm.mengetahui, mm.tanggal,  mm.perihal ,mm.lampiran , mm.status,jb.jabatan, dc.id_pegawai 
                        FROM memo_masuk mm
                        INNER JOIN jabatan jb ON mm.id_jabatan = jb.id_jabatan
                        LEFT JOIN jabatan pgw ON mm.mengetahui = pgw.id_jabatan
                        LEFT JOIN detail_cc dc ON mm.kode_memo = dc.kode_memo
                        INNER JOIN jabatan pw ON mm.id_penerima = pw.id_jabatan
                        WHERE ( mm.status = 'sudah' and dc.id_pegawai= '$_SESSION[id_jabatan]' AND mm.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir') 
                        OR( mm.status = 'sudah' AND mm.id_penerima  = '$_SESSION[id_jabatan]' AND mm.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir')
                        OR (mm.status = 'sudah' and mm.mengetahui= '$_SESSION[id_jabatan]' AND mm.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir') 
                        GROUP BY dc.kode_memo ORDER BY mm.tanggal DESC";

                    $hasil= mysqli_query($host, $sql) or die (mysqli_error($host));
                    $no=1;
                    while ($data = mysqli_fetch_array($hasil)) {
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
                  
                  
                </tr>
                    <?php }?>
    </table>
    
</body>
</html>