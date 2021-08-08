<?php
    include "koneksi2.php";
    $id = $_GET['kode_memo'];
    $query = "UPDATE memo_masuk SET status = 'sudah' WHERE kode_memo='$id'";
    if (mysqli_query($host,$query)) {
        $query2 = mysqli_query($host, "UPDATE memo_keluar SET status = 'sudah' WHERE kode_memo='$id'");
        header("location:konfir_memo.php");
    }
?>
