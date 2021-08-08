<?php
include 'koneksi2.php';
session_start();
	$content = '
	<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laporan Memo Keluar</title>
</head>
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
</style>
<body>
	<center><h4>LAPORAN MEMO KELUAR</h4></center>';
	
	$tgl_awal= date('Y-m-d', strtotime($_POST["tgl_awal"])); //var_dump($tgl_awal);
	$tgl_akhir=date('Y-m-d', strtotime($_POST["tgl_akhir"]));//var_dump($tgl_akhir);

	$sql = "SELECT * FROM memo_keluar  
	INNER JOIN jabatan ON memo_keluar.id_penerima = jabatan.id_jabatan
	where memo_keluar.pengirim = '$_SESSION[id_pegawai]' AND memo_keluar.tanggal
	BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY memo_keluar.tanggal DESC ";
				   
	$cetak_laporan = mysqli_query($host, $sql) or die (mysqli_error($host));
    while($data = mysqli_fetch_array($cetak_laporan)){
                
	
	$content .= '<table class="table_memo" style="width:100%;">
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
			   
	
	
	';
					}
$content .=	'<tr>
		<td colspan="6" ><div class="solid"></div></td>
	</tr>

	
	
	
	</table>

</body>
</html>
	';

	require_once 'plugins/mpdf/vendor/autoload.php';
	$mpdf = new \Mpdf\Mpdf();
	$mpdf->AddPage('P','','','','','15','15','15','15','','','','','','','','','','','','A4');
	$mpdf->WriteHTML($content);
	$mpdf->Output();
?>