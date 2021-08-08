<!DOCTYPE html>
<html lang="en">
<head>
   
    
    <?php
  session_start();
    include'_partials/header.php';
  ?>
</head>
<body>
    <p style="text-align:center;font-size:25px"><b>LAPORAN MEMO KELUAR</b></p>
   <table id="example1" class="table table-bordered responsiv">
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
                    $tgl_awal= date('Y-m-d', strtotime($_GET["tgl_awal"]));// var_dump($tgl_awal);
                    $tgl_akhir= date('Y-m-d', strtotime($_GET["tgl_akhir"]));// var_dump($tgl_akhir);

                        $sql = "SELECT * FROM memo_keluar  
                        INNER JOIN jabatan ON memo_keluar.id_penerima = jabatan.id_jabatan
                        where memo_keluar.pengirim = '$_SESSION[id_pegawai]' AND memo_keluar.tanggal
                        BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY memo_keluar.tanggal DESC ";
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
                    echo "<span>Terkirim</span>";
                  } else{
                    echo "<span>Pendding</span>";
                  }
                  
                  
                  ?>
                  </td>
                 
                </tr>
                    <?php }?>
    </table>
    
</body>
</html>