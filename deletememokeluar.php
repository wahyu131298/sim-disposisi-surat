<?php
    include "koneksi2.php";
    $id = $_GET['kode_memo'];
    $query = "DELETE FROM memo_keluar WHERE kode_memo='$id'";
    if (mysqli_query($host,$query)) {
        header("location:list_memo_keluar.php");
    }else{
        echo "Hapus Data Gagal";
    }

?>
