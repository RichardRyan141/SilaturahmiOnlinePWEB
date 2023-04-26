<?php

include("config.php");
session_start();
$_SESSION['login_user'] = "";

header("location: index.php");
?>