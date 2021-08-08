<?php

include "koneksi2.php";
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($host,"SELECT * FROM pegawai 
    INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_login'] = $row['nama'];
            $_SESSION['id_login'] = $row['nip'];
            $_SESSION['id_pegawai'] = $row['id_pegawai'];
            $_SESSION['nama_jabatan'] = $row['jabatan'];
            $_SESSION['id_jabatan'] = $row['id_jabatan'];
            $_SESSION['level'] = $row['akses'];
        }else{
           $password_salah = true;     }
    }else {
       $username_error = true;
    }
}

if (isset($_SESSION['user_login'])) {
    header("location:index.php");

}
?>
<!DOCTYPE html>
<html>
<head>
  <?php
    include'_partials/header.php';
  ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
      <img src="img/logo-rsmg.png" alt="logo-rs"><br>
    <a href=""><b>E-Memo Internal</b></a><br>
    <a style="font-size:30px" href="">RS MUHAMMADIYAH GRESIK</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    <?php if (isset($password_salah)) :?>
      <div class="alert alert-danger" role="alert">
      <p style="color:#fff;padding:0px" class="login-box-msg">
      Password yang di Masukkan Tidak Cocok   
      </p>
      </div>
    <?php endif ?>
    <?php if (isset($username_error)) :?>
      <div class="alert alert-danger" role="alert">
      <p style="color:#fff;padding:0px" class="login-box-msg">
      Username Tidak ada
      </p>
      </div>
    <?php endif ?>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php
    include'_partials/js.php';
  ?>
</body>
</html>
