<!DOCTYPE html>
<html lang="en">
<head>
   
    
    <?php
  session_start();
    include'_partials/header.php';
  ?>
</head>
<body>
    <p style="text-align:center;font-size:25px"><b>LAPORAN DISPOSISI</b></p>
   <table id="example1" class="table table-bordered responsiv">
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
                </tr>
        </thead>
        <tbody>
                    <?php
                    include "koneksi2.php";
                    $tgl_awal= date('Y-m-d', strtotime($_GET["tgl_awal"]));// var_dump($tgl_awal);
                    $tgl_akhir= date('Y-m-d', strtotime($_GET["tgl_akhir"]));// var_dump($tgl_akhir);

                    $sql = " SELECT * FROM disposisi
                    INNER JOIN jabatan ON disposisi.dari = jabatan.id_jabatan
                    WHERE disposisi.tujuan = '$_SESSION[id_jabatan]' 
                    AND disposisi.tgl_disposisi
                    BETWEEN '$tgl_awal' AND '$tgl_akhir'
                    ORDER BY disposisi.tgl_disposisi DESC"; 
                    $hasil= mysqli_query($host, $sql) or die (mysqli_error($host));
                    $no=1;
                    while ($data = mysqli_fetch_array($hasil)) {
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
                    echo "Sangat Segera";
                  } elseif ($sifat2 == 'Segera') {
                    echo "Segera";
                  }elseif ($sifat2 == 'Rahasia'){
                    echo "Rahasia";
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
                  
                  
                 
                </tr>
                    <?php }?>
    </table>
    
</body>
</html>