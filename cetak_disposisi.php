<!DOCTYPE html>
<html lang="en">
<head>
   <style>
   table, th, td {
    
    }
   </style>
</head>
<body>
<table style="width:100%" >
    <tr>
        <td style="text-align:center"><img  src="img/logo-rsmg.png" alt="logo-rsmg"></td>
        <td>
			<h2><b>RS MUHAMMADIYAH GRESIK</b></h2>
			<p>Jl. Raya Dayeuhkolot NO.409, Citeureup. Telp/Fax: (022) 5223238 <br>email : kec_dayeuhkolot@yahoo.co.id Bandung 40257 </p>
        </td>
        <td></td>
      
    </tr>
    <tr>
        <td colspan="3">
            <hr style="border:1px solid #000">
        </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center">
            <h4><b>LEMBAR DISPOSISI</b></h4>
        </td>
    </tr>
</table>
<?php 

    include 'koneksi2.php';
    $id_disposisi = $_GET['id_disposisi'];
    $query_cetak = "SELECT * FROM disposisi
    INNER JOIN jabatan ON disposisi.dari = jabatan.id_jabatan 
    WHERE disposisi.id_disposisi = '$id_disposisi'";
    $query_result = mysqli_query($host, $query_cetak) or die (mysqli_error($host));
    while($data = mysqli_fetch_array($query_result)){
?>
<table class="table" style="width: 100%; border: 1px solid gray;padding: 10px;">
    <tr>
        <td style="width: 30%"><b>No Memo</b></td>
        <td style="width: 5%">:</td>
        <td><?= $data['kode_memo']?></td>
    </tr>
    <tr>
        <td style="width: 30%"><b>Memo dari</b></td>
        <td style="width: 5%">:</td>
        <td>
        <?php
                    $query_dari = " SELECT * FROM jabatan where id_jabatan = '$data[dari]'";
                    $query_result3 = mysqli_query($host, $query_dari) or die (mysqli_error($host));
                    while($data2 = mysqli_fetch_array($query_result3)){
                  ?>
                  <?php echo $data2['jabatan']; ?>

        <?php }?>
        </td>
    </tr>
    <tr>
        <td style="width: 30%"><b>Tanggal Memo</b></td>
        <td style="width: 5%">:</td>
        <td><?= $data['tanggal']?></td>
    </tr>
    <tr>
        <td style="width: 30%"><b>Tanggal Disposisi</b></td>
        <td style="width: 5%">:</td>
        <td><?= $data['tgl_disposisi']?></td>
    </tr>
    <tr>
        <td style="width: 30%"><b>Sifat</b></td>
        <td style="width: 5%">:</td>
        <td><?= $data['sifat']?></td>
    </tr>
    <tr>
        <td style="width: 30%"><b>Perihal</b></td>
        <td style="width: 5%">:</td>
        <td><?= $data['perihal']?></td>
    </tr>
    <tr>
        <td style="width: 30%"><b>Diteruskan Kepada</b></td>
        <td style="width: 5%">:</td>
        <td>
        <?php
                    $query_dari = " SELECT * FROM jabatan where id_jabatan = '$data[tujuan]'";
                    $query_result3 = mysqli_query($host, $query_dari) or die (mysqli_error($host));
                    while($data2 = mysqli_fetch_array($query_result3)){
                  ?>
                  <?php echo $data2['jabatan']; ?>

        <?php }?>
        
        </td>
    </tr>
    <tr>
        <td style="width: 30%"><b>Dengan Hormat Harap</b></td>
        <td style="width: 5%">:</td>
        <td><?= $data['dg_hormat']?></td>
    </tr>

</table>
<table class="isi_disposiis" style="width: 100%; padding: 10px;">
    <tr>
        <td style="width: 30%"><b>Isi Disposisi :</b></td>
        
    </tr>
    <tr>
    <td>
        <?= $data['isi_disposisi']; ?>
    </td>
    </tr>

</table>
<?php } ?>
    
</body>
</html>