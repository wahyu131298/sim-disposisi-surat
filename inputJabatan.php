<?php
include "koneksi2.php";
if (isset($_POST['simpan'])) {
    $id_jabatan = $_POST['id_jabatan'];
    $jabatan = $_POST['jabatan'];
    mysqli_query($host, "INSERT INTO jabatan VALUES ('','$jabatan')");
    header("location:listjabatan.php");
}
?>