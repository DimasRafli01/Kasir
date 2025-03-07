<?php 
$server = "localhost";
$user = "root";
$pass = "";
$database = "kasir";
 
$conn = mysqli_connect($server, $user, $pass, $database);
 
if (!$conn) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}

$queryuser = mysqli_query($conn, "SELECT *from user");
$querypelanggan = mysqli_query($conn, "SELECT *from pelanggan");

?>