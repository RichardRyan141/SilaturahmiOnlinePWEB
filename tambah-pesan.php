<?php

include("config.php");

if(isset($_POST['buat'])){

    $jenis_pesan = $_POST['jenis_pesan'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];
    $tujuan = $_POST['pejabat_id'];
    $sql = "INSERT INTO pesan (jenis_pesan, nama, email, pesan, id_pejabat) VALUE ('$jenis_pesan', '$nama', '$email', '$pesan', '$tujuan')";
    $query = mysqli_query($db, $sql);

    header('Location: lihat-pesan.php');

} else {
    die("Akses dilarang...");
}

?>