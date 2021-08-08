<?php
    include "koneksi2.php";
    $id = $_GET['id_jabatan'];
    $query = "DELETE FROM jabatan WHERE id_jabatan='$id'";
    if (mysqli_query($host,$query)) {
        header("location:listjabatan.php");
    }else{
        echo "Hapus Data Gagal";
    }

?>
