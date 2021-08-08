<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<title>MEMO INTERNAL
RS MUHAMMADIYAH GRESIK</title>
<style>
table, th, td {
  
}
.isi_surat{
	padding : 10px;
	style="line-height: 2em;
}
.tanda_tangan{
	padding : 10px;
	text_align : center;

}
.solid{
	border: 1px #000 solid;
}
#header,#nav,.noprint{
	display:none;
}
</style>
<body>
	<center><h4>MEMO INTERNAL<br>RS MUHAMMADIYAH GRESIK</h4></center>
	<?php 
	include 'koneksi2.php';
	session_start();
	$level = $_SESSION['level'];
	$kode_memo = $_GET['kode_memo'];
		$query_mysql = 
						"SELECT mm.no_memo, mm.kode_memo, mm.id_penerima,mm.pengirim,mm.id_jabatan,
						mm.mengetahui, mm.tanggal,  mm.perihal ,mm.lampiran , mm.status,mm.isi, jb.jabatan
						FROM memo_masuk mm
						INNER JOIN jabatan jb ON mm.id_jabatan = jb.id_jabatan
						LEFT JOIN jabatan pgw ON mm.mengetahui = pgw.id_jabatan
						INNER JOIN jabatan pw ON mm.id_penerima = pw.id_jabatan 
						WHERE mm.kode_memo ='$kode_memo' 
						";
						$cetakmemo = mysqli_query($host, $query_mysql) or die (mysqli_error($host));
						while($data = mysqli_fetch_array($cetakmemo)){
	?>
	<table class="table_memo" style="width:100%;">
	<tr>
		<td colspan="6" ><div class="solid"></div></td>
	</tr>
	<tr>
		<td style="text-align:right">Nomor</td>
		<td style="text-align:center">:</td>
		<td><?= $data['no_memo']; ?></td>
		
		<td style="text-align:right">Dari</td>
		<td style="text-align:center">:</td>
		<td>
		<?php $query_mysql2 = mysqli_query($host,"SELECT nama FROM pegawai
		INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan
		WHERE id_pegawai = '$data[pengirim]'") or die (mysqli_error($host));
         while ($data_nama = mysqli_fetch_array($query_mysql2)) {
                    echo $data_nama['nama']."</br>";
                }
                  
        ?>
		</td>
	</tr>
	<tr>
		<td style="text-align:right">Kepada Yth</td>
		<td style="text-align:center">:</td>
		<td>Direktur RS</td>
		<td style="text-align:right">Bagian</td>
		<td style="text-align:center">:</td>
		<td><?= $data['jabatan']; ?></td>
	</tr>
	
	
	<tr>
		<td style="text-align:right">Tembusan</td>
		<td style="text-align:center">:</td>
		<td class="tembusan">
		<?php
        $sql_cc = mysqli_query($host,"SELECT * FROM detail_cc   
        INNER JOIN jabatan ON detail_cc.id_pegawai = jabatan.id_jabatan
		WHERE kode_memo = '$data[kode_memo]'") or die (mysqli_error($host));
    	while ($data_memo_masuk = mysqli_fetch_array($sql_cc)) {
            echo "- " .$data_memo_masuk['jabatan']."</br>";
        }
        ?>
		</td>
	
		<td style="text-align:right">Tanggal</td>
		<td style="text-align:center">:</td>
		<td><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
	</tr>
	<tr>
		<td style="text-align:right">Perihal</td>
		<td style="text-align:center">:</td>
		<td colspan ="4" style="text-align:left" class="perihal"><?= $data['perihal'] ?></td>
		
	</tr>
	<tr>
		<td colspan="6" ><div class="solid"></div></td>
	</tr>
	
	<tr>
		<td colspan="6"class="isi_surat" >
		<p style="line-height: 2em;text-align:justify!important;" >
		<?= $data['isi'] ?>
		</p>
		</td>
	</tr>
	
	<tr>
	<?php if(!empty($data['mengetahui'])){?>
		<td colspan="6" style="padding-left: 20px;">
		Mengetahui,
		</td>
	<?php }?>
	</tr>
	<tr>
		<td colspan="3" style="padding-left: 20px;">
		<?php 
		$query_mysql3 = mysqli_query($host,"SELECT jabatan FROM jabatan jh
                        INNER JOIN memo_masuk mk ON jh.id_jabatan = mk.mengetahui
                        WHERE mk.mengetahui = '$data[mengetahui]' LIMIT 1") or die (mysqli_error($host));
                        while ($data_jbt = mysqli_fetch_array($query_mysql3)) {
                        echo $data_jbt['jabatan'];
                        }
        ?>
		</td>
		<td colspan="3" style="text-align:center;">
		<?= $data['jabatan']; ?>
		</td>
	</tr>
	<tr>
	
		<td colspan="3" class="tanda_tangan">
		<?php if(!empty($data['mengetahui'])){?>
			<?php $quer_ttd = mysqli_query($host,"SELECT nip FROM pegawai nia
		WHERE nia.id_jabatan = '$data[mengetahui]'") or die (mysqli_error($host));
         while ($data_ttd = mysqli_fetch_array($quer_ttd)) {
			echo "<img class='qr' src='img/qr_code/$data_ttd[nip].png' style='height: 37%'/>";
			}          
        ?>
		<?php } ?>
		</td>
		<td colspan="3" style="text-align:center" class="tanda_tangan">
		<?php $quer_ttd = mysqli_query($host,"SELECT nip FROM pegawai nia
		WHERE nia.id_pegawai = '$data[pengirim]'") or die (mysqli_error($host));
         while ($data_ttd = mysqli_fetch_array($quer_ttd)) {
			echo "<img class='qr' src='img/qr_code/$data_ttd[nip].png' style='height: 37%'/>";
			}          
        ?>
		
		
		</td>
	</tr>
	<tr>
		<td colspan="3" style="padding-left: 20px;">
		<?php $query_mysql2 = mysqli_query($host,"SELECT nama FROM pegawai ni
		inner join jabatan  jg on ni.id_jabatan = jg.id_jabatan  
		WHERE ni.id_jabatan = '$data[mengetahui]'") or die (mysqli_error($host));
         while ($data_nama_m = mysqli_fetch_array($query_mysql2)) {
                    echo $data_nama_m['nama'];
                }
                  
        ?>
		</td>
		<td colspan="3" style="text-align:center">
		<?php $query_mysql2 = mysqli_query($host,"SELECT nama FROM pegawai nm  
		WHERE id_pegawai = '$data[pengirim]'") or die (mysqli_error($host));
         while ($data_nama = mysqli_fetch_array($query_mysql2)) {
                    echo $data_nama['nama']."</br>";
                }
                  
        ?>
		</td>
	</tr>
	<tr>
		<td colspan="3" style="padding-left: 20px;">
		<?php $query_mysql2 = mysqli_query($host,"SELECT nip FROM pegawai np
		inner join jabatan  jg on np.id_jabatan = jg.id_jabatan  
		WHERE np.id_jabatan = '$data[mengetahui]'") or die (mysqli_error($host));
         while ($data_nama_m = mysqli_fetch_array($query_mysql2)) {
                    echo "NIP"." ".$data_nama_m['nip'];
                }
                  
        ?>
		</td>
		<td colspan="3" style="text-align:center">
		<?php $query_mysql2 = mysqli_query($host,"SELECT nip FROM pegawai nm  
		WHERE id_pegawai = '$data[pengirim]'") or die (mysqli_error($host));
         while ($data_nama = mysqli_fetch_array($query_mysql2)) {
				echo "NIP"." ".$data_nama['nip'];
                }
                  
        ?>
		</td>
	
	</tr>
	<?php } ?>
	<tr>
		<td colspan="6" ><div class="solid"></div></td>
	</tr>

	
	
	
	</table>

</body>
</html>