<?php
    include "koneksi2.php";
    include "plugins/phpqrcode/qrlib.php";
    if (isset($_POST['simpan'])) {
       // $id_pegawai = $_POST['id_pegawai'];
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
        $cek_nip = mysqli_num_rows(mysqli_query($host,"SELECT nip FROM pegawai where nip='$_POST[nip]' "));
        $cek_username = mysqli_num_rows(mysqli_query($host,"SELECT username FROM pegawai where username='$_POST[username]' "));
        if ($cek_nip > 0) {
            echo "<script>alert('NIP SUDAH DIGUNAKAN');history.go(-1)</script>";
        }else if ($cek_username > 0) {
            echo "<script>alert('Username sudah digunakan');history.go(-1)</script>";
        }else if ($_POST['password']==$_POST['password2']) {
            mysqli_query($host, "INSERT INTO pegawai VALUES('','$nip','$nama','$jabatan','$akses','$username','$password','$namaFile')");
            header("location:listpegawai.php");
        }else {
            echo "<script>alert('Password yang Anda Masukan Tidak Sama');history.go(-1)</script>";
        }
       
    }
?>