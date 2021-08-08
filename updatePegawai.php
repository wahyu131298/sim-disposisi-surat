<?php
    include "koneksi2.php";
    include "plugins/phpqrcode/qrlib.php";
    if (isset($_POST['update'])) {
        $id_pegawai = $_POST['id_pegawai'];
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];
        $akses = $_POST['akses'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $password2 = $_POST['password2'];
         //$qrcode = $_POST['qr_code'];        
        $tempdir = "img/qr_code/"; //Nama folder tempat menyimpan file qrcode
        //isi qrcode jika di scan
        $codeContents = $_POST['nip'];
        //nama file qrcode yang akan disimpan
        $namaFile=$_POST['nip'].".png";
        //ECC Level
        $level=QR_ECLEVEL_H;
        //Ukuran pixel
        $UkuranPixel=10;
        //Ukuran frame
        $UkuranFrame=4;
        QRcode::png($codeContents, $tempdir.$namaFile, $level, $UkuranPixel, $UkuranFrame); 
        if (empty($_POST['password'] OR $_POST['password2'] )) {
            echo "<script>alert('Masukkan Password Terlebih Dahulu');history.go(-1)</script>";
        }else if ($_POST['password']==$_POST['password2']) {
            $query = " UPDATE pegawai SET 
            nip = $nip,
            nama ='$nama',
            id_jabatan ='$jabatan',
            akses ='$akses',
            username ='$username',
            password ='$password',
            qr_code = '$namaFile' 
            WHERE id_pegawai=$id_pegawai";
            $hasil = mysqli_query($host, $query);
            header("location:listpegawai.php");
        }else {
            echo "<script>alert('Password yang Anda Masukan Tidak Sama');history.go(-1)</script>";
        }
        
    }
?>
