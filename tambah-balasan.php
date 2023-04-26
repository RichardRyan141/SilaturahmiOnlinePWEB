<?php

include("config.php");

if(isset($_POST['balas'])){

    $id_pesan = $_POST['pesan_id'];
    $balasan = $_POST['balasan'];
    $sql = "INSERT INTO reply (id_pesan, balasan) VALUE ('$id_pesan', '$balasan')";
    $query = mysqli_query($db, $sql);

    header('Location: balas-pesan.php');

} else {
    die("Akses dilarang...");
}

?>