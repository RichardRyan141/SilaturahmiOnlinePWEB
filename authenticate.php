<?php

include("config.php");

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM pejabat WHERE username = '$username' and password = '$password'";
  $result = mysqli_query($db,$sql);
  $count = mysqli_num_rows($result);

  // If result matched username and password, table row must be 1 row
  if($count == 1) {
    // Authentication successful
    session_start();
    $_SESSION['login_user'] = $username;
    header("location: balas-pesan.php");
  }else {
    // Authentication failed
    $error = "Username or Password is invalid";
  }
}
?>