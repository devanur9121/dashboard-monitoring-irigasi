<?php
error_reporting(0);

if (isset($_POST['register'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);

  if ($password == $cpassword) {
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($koneksi, $sql);
    if (!$result->num_rows > 0) {
      $level = "User"; // Role default untuk user
      $sql = "INSERT INTO user (nama, username, email, password, level) VALUES ('$nama', '$username', '$email', '$password', '$level')";
      $result = mysqli_query($koneksi, $sql);
      if ($result) {

        $_SESSION['username'] = $username;

        header('Location: index.php?include=login&success=berhasil_register');
      } else {
        header('Location: index.php?include=register&error=gagal_register');
      }
    } else {
      header('Location: index.php?include=register&error=email_sudah_terdaftar');
    }
  } else {
    header('Location: index.php?include=register&error=password_tidak_sesuai');
  }
}
