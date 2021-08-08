<?php
    include "koneksi2.php";
    $id = $_GET['id_pegawai'];
    $query = "DELETE FROM pegawai WHERE id_pegawai='$id'";
    if (mysqli_query($host,$query)) {
        header("location:listpegawai.php");
    }else{
        echo "Hapus Data Gagal";
    }

?>
