<?php
$host = 'localhost';
$user = 'root'; // Biasanya 'root' untuk XAMPP
$pass = ''; // Kosongkan jika tidak ada password
$db = 'db_multimedia'; // Ganti dengan nama database Anda

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>

