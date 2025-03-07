<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'kasir');

session_start();

if (!isset($_SESSION['nama'])) {
	header("Location: index.php");
}
$kasir = $_SESSION['nama'];

//Total Bayar Dan Kembalian
$t = $_GET["total"];
$b = $_GET["bayar"];
$k = $_GET["kemb"];

// Get the current timestamp (number of seconds since epoch)
date_default_timezone_set('Asia/Bangkok');
$currentTime = time();

// Format the timestamp as a human-readable date and time
$tgl = date("Y-m-d", $currentTime);
$wkt = date("H:i:s", $currentTime);

$dpenj = mysqli_query($koneksi, "SELECT *from detailpenjualan inner join produk on detailpenjualan.idproduk = produk.idproduk");
while ($rowdpenj = mysqli_fetch_assoc($dpenj)) {
    // Mengambil nilai-nilai dari setiap kolom di tabel detailpenjualan
    $idprd = $rowdpenj["idproduk"];
    $jumlah = $rowdpenj["jumlah"];
    $total = $rowdpenj["subtotal"];
    $hslpng = $rowdpenj['stok'] - $rowdpenj['jumlah'];
    // Query untuk insert data ke tabel penjualan
    $query = mysqli_query($koneksi, "INSERT INTO `penjualan` (`idpenjualan`, `tglpenjualan`, `waktu`, 
    `idproduk`, `jumlah`, `kasir`, `total`) 
    VALUES (NULL, '$tgl', '$wkt', '$idprd', '$jumlah', '$kasir', '$total');");
//query pengurangan stok

$query = mysqli_query($koneksi,"UPDATE produk SET stok= '$hslpng' where idproduk = '$idprd'");
  }

header("Location:bonprint.php?total=$t & bayar=$b & kemb=$k");