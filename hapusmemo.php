<?php
    include "koneksi2.php";
    $id = $_GET['kode_memo'];
    $query = "DELETE FROM memo_masuk WHERE kode_memo='$id'";
    if (mysqli_query($host,$query)) {
        header("location:konfir_memo.php");
    }else{
        echo "Hapus Data Gagal";
    }

?>
