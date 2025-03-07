<?php

session_start();

if (!isset($_SESSION['nama'])) {
	header("Location: index.php");
}
include 'include/config.php';

if (isset($_POST['cari'])) {
	$cari = $_POST['cari'];

	$queryproduk = mysqli_query($conn, "SELECT * FROM produk WHERE 
						idproduk LIKE '%$cari%' OR namaproduk LIKE '%$cari%'");
}
$querydpenjualan = mysqli_query($conn, "SELECT *from detailpenjualan");
date_default_timezone_set('Asia/Bangkok');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description"
		content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Keranjang</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.html">
								<img src="assets/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a href="beranda.php">Beranda</a></li>
								<li><a href="produk.php">Produk</a></li>
								<li class="current-list-item"><a href="#">Keranjang</a></li>
								<li><a href="laporan.php">Laporan</a></li>
								<li><a href="#">
										<?php echo $_SESSION['nama']; ?>
									</a>
									<ul class="sub-menu">
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</li>
							</ul>
						</nav>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<h1>Keranjang</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- cart -->

	<div class="cart-section mt-100 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form style="margin-bottom:20px;" class="searchform" action="" method="post">
						<input type="text" placeholder="Cari Produk..." name="cari">
					</form>
					<div class="cart-table-wrap">
						<table class="cart-table" style="margin-bottom:20px;">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-image">No</th>
									<th class="product-name">Produk</th>
									<th class="product-price">Harga</th>
									<th class="product-total">Stok</th>
									<th class="product-remove"></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (isset($_POST['cari'])) {
									$i = 1;
									while ($rowp = mysqli_fetch_assoc($queryproduk)) { ?>
										<tr class="table-body-row">
											<td>
												<?php echo $i ?>
											</td>
											<td class="product-name">
												<?php echo $rowp['namaproduk']; ?>
											</td>
											<td class="product-price">Rp.
												<?php echo number_format($rowp['harga']); ?>,-
											</td>
											<td class="product-total">
												<?php echo number_format($rowp['stok']); ?>
											</td>
											<td class="product-remove">
												<a href="aksi/pnjtbhact.php?id=<?php echo $rowp['idproduk']; ?>"
													title="Keranjang" class="buttona">
													<i class="fa fa-shopping-cart" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
										<?php
										$i++;
									}
								} else {
									echo "<tr class='table-body-row'>
								<td class='product-remove' colspan='6'>Hasil Pencarian</td>
							</tr>";
								}
								?>
							</tbody>
						</table>

						<?php ?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<a style="margin-right:20px;" class="boxed-btn" href="aksi/dpenjhapus.php">Kosongkan Keranjang</a>
					<label>Tanggal : </label>
					<input style="margin-bottom:20px;" class="frm-a" type="text" name="" size="35"
						value="<?php echo date("l ,j F Y, H:i"); ?>" disabled>
					<Label style="margin-left:20px;">Kasir :
						<?php echo $_SESSION['nama']; ?>
					</Label>
				</div>
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-remove"></th>
									<th class="product-image">No</th>
									<th class="product-name">Produk</th>
									<th class="product-quantity">Jumlah</th>
									<th class="product-price">Harga</th>
									<th class="product-total">Total</th>
								</tr>
							</thead>
							<?php
							if (mysqli_num_rows($querydpenjualan) > 0) {
								?>
								<tbody>
									<?php
									$i = 1;
									$total = 0;

									$querynmp = mysqli_query($conn, "SELECT produk.namaproduk, produk.harga, iddetail, idpenjualan, jumlah, subtotal FROM detailpenjualan INNER JOIN produk ON Produk.idproduk = detailpenjualan.idproduk;");
									// $queryprd = mysqli_fetch_assoc($querynmp);
									while ($penjualn = mysqli_fetch_assoc($querynmp)) { ?>
										<tr class="table-body-row">
											<td class="product-remove">
												<a href="aksi/pnjhapus.php?id=<?php echo $penjualn['iddetail']; ?>"
													title="Hapus">
													<i class="far fa-window-close"></i>
												</a>
											</td>
											<td>
												<?php echo $i ?>
											</td>
											<td class="product-name">
												<?php echo $penjualn['namaproduk']; ?>
											</td>
											<td class="product-quantity">
												<form action="aksi/pnjeditjmlhact.php" method="POST">
													<input type="hidden" value="<?php echo $penjualn['iddetail']; ?>"
														name="idd">
													<input type="number" value="<?php echo $penjualn['jumlah']; ?>"
														name="jumlah">
												</form>
											</td>
											<td class="product-price">Rp.
												<?php echo number_format($penjualn['harga']); ?>,-
											</td>
											<td class="product-total">Rp.
												<?php echo number_format($penjualn['subtotal']); ?>,-
											</td>
										</tr>
										<?php
										$i++;
										$total += $penjualn['subtotal'];
									}
									?>
								</tbody>
								<?php
							} else {
								echo "<tr class='table-body-row'>
											<td class='product-remove' colspan='6'>Tidak Ada Data</td>
										</tr>";
							}
							?>
						</table>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Total</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong>Subtotal: </strong></td>
									<td>
										<?php
										if (isset($total)) {
											echo "Rp. " . number_format($total) . ",-";
										} else {
											echo "Rp. " . number_format(0) . ",-";
										}
										?>
									</td>
								</tr>
								<tr class="total-data">
									<td><strong>Bayar: </strong></td>
									<td>
										<form action="" method="post">
											<input type="number" id="number" name="bayar" value="<?php
											if (isset($_POST['bayar'])) {
												$bayar = $_POST['bayar'];
												echo $bayar;
											} else {
											}
											?>">
										</form>
									</td>
								</tr>
								<tr class="total-data">
									<td><strong>Kembalian: </strong></td>
									<td>
										<?php
										if (isset($total) && isset($_POST['bayar'])) {

											$bayar = $_POST['bayar'];

											if ($bayar >= $total) {

												$kembalian = $bayar - $total;
												echo "Rp. " . number_format($kembalian) . ",-";


											} else {

												$kembalian = $bayar - $total;
												?>
												<script>alert("Uang Kurang Rp. <?php echo $kembalian; ?>.-");</script>
												<?php
												echo "Rp. " . number_format($kembalian) . ",-";

											}

										} else {
											echo "Rp. " . number_format(0) . ",-";
										}
										?>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="cart-buttons">
							<?php
							if (isset($total) && isset($_POST['bayar'])) {

								$bayar = $_POST['bayar'];

								if ($bayar >= $total) {
									?>
									<!-- <form action="aksi/pnjknf.php" target="_blank" method="post">
										<input type="hidden" name="total" value="<?php //echo $total; ?>">
										<input type="hidden" name="bayar" value="<?php //echo $bayar; ?>">
										<input type="hidden" name="kemb" value="<?php //echo $kembalian; ?>">
										<input type="submit" value="Konfirmasi">
									</form> -->
									<a href="aksi/pnjknf.php?total=<?php echo $total;?>&bayar=<?php echo $bayar?>&kemb=<?php echo $kembalian ?>" target="_blank" class="boxed-btn">Konfirmasi</a>
									<!-- <a href="" class="boxed-btn">Print</a> -->

									<?php
								} else {
									?>
									<a class="kunci">Konfirmasi</a>
									<!-- <a class="kunci">Print</a> -->
									<?php
								}

							} else {
								?>
								<a class="kunci">Konfirmasi</a>
								<!-- <a class="kunci">Print</a> -->
								<?php
							}
							?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- end cart -->

	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium
							doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li>34/8, East Hukupara, Gifirtok, Sadan.</li>
							<li>support@fruitkha.com</li>
							<li>+00 111 222 3333</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Pages</h2>
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="services.html">Shop</a></li>
							<li><a href="news.html">News</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<form action="index.html">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Imran Hossain</a>, All Rights
						Reserved.<br>
						Distributed By - <a href="https://themewagon.com/">Themewagon</a>
					</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->

	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>

</body>

</html>