<?php
    include "koneksi2.php";
    if (isset($_POST['update'])) {
        $id_jabatan = $_POST['id_jabatan'];
        $jabatan = $_POST['jabatan'];
        $query = " UPDATE jabatan SET
         jabatan = '$jabatan'
        WHERE id_jabatan = $id_jabatan";
        $hasil = mysqli_query($host, $query);
        if ($hasil) {
           header("location:listjabatan.php");
        }else{
            echo"Gagal Update Data";
        }
        
    }
?>
