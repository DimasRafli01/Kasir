<?php
session_start();

if (!isset($_SESSION['nama'])) {
	header("Location: ../index.php");
}
include '../include/config.php';
date_default_timezone_set('Asia/Bangkok');

$total = $_GET["total"];
$bayar = $_GET["bayar"];
$kemb = $_GET["kemb"];

$dpenj = mysqli_query($conn, "SELECT produk.namaproduk, produk.harga, iddetail, idpenjualan, jumlah, subtotal 
FROM detailpenjualan INNER JOIN produk ON Produk.idproduk = detailpenjualan.idproduk;");
// while ($rowdpenj = mysqli_fetch_assoc($dpenj)) {}
?>
<html>

<head>
	<title>print</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
	<script>window.print();</script>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<center>
					<p>
						<?php echo "MsEMart"; ?>
					</p>
					<p>
						<?php echo "Jalan Sudirman"; ?>
					</p>
					<p>Tanggal :
						<?php echo date("j F Y, G:i"); ?>
					</p>
					<p>Kasir :
						<?php echo $_SESSION['nama']; ?>
					</p>
				</center>
				<table class="table table-bordered" style="width:100%;">
					<tr>
						<td>No.</td>
						<td>Barang</td>
						<td>Jumlah</td>
						<td>Total</td>
					</tr>
					<?php $no = 1;
					while ($row = mysqli_fetch_assoc($dpenj)) {
						?>
						<tr>
							<td>
								<?php echo $no; ?>
							</td>
							<td>
								<?php echo $row['namaproduk']; ?>
							</td>
							<td>
								<?php echo $row['jumlah']; ?>
							</td>
							<td>
								<?php echo $row['subtotal']; ?>
							</td>
						</tr>
						<?php $no++;
					} ?>
				</table>
				<div class="pull-right">
					Total : Rp.
					<?php echo number_format($total); ?>,-
					<br />
					Bayar : Rp.
					<?php echo number_format($bayar); ?>,-
					<br />
					Kembali : Rp.
					<?php echo number_format($kemb); ?>,-
				</div>
				<div class="clearfix"></div>
				<center>
					<p>Terima Kasih Telah berbelanja di toko kami !</p>
				</center>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>

</html>