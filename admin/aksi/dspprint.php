<?php 

include '../include/config.php';

$id = $_GET['id_surat'];
$query = mysqli_query($conn, "SELECT * FROM tbl_disposisi where id_surat = '$id'");
$query2 = mysqli_query($conn, "SELECT * FROM tbl_suratmasuk where id_surat = '$id'");
$query3 = mysqli_query($conn, "SELECT * FROM tbl_tujuan where id_surat = '$id'");
$cek = mysqli_fetch_assoc($query);
$data = mysqli_fetch_assoc($query2);
$tujuan = mysqli_fetch_assoc($query3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Disposisi</title>
</head>
<body>

<link rel="stylesheet" href="../assets/css/style.css">


<table style="background-color:lightgrey;" class="tabeld" >
	<tr>
		<td style="border-right:none;">
		Surat dari <br>
		No. Surat  <br>
		Tgl. Surat
		</td>
		<td style="border-left:none;">
		: <?php echo $data['asal_surat']; ?> <br>
		: <?php echo $data['no_surat']; ?> <br>
		: <?php echo $data['tgl_surat']; ?>
		</td>
		<td style="border-right:none;">
		Diterima Tgl <br>
		No. Agenda <br>
		Sifat
		</td>
		<td style="border-left:none;">
		: <?php echo $data['tgl_diterima']; ?> <br>
		: <?php echo $data['no_agenda']; ?> <br>
		: <?php echo $cek['sifat']; ?>
		</td>
	</tr>
	<tr height="100px">
		<td style="border-right:none;">Hal</td>
		<td colspan="3" style="border-left:none;">: <?php echo $data['hal']; ?></td>
	</tr>
	<tr>
		<td colspan="2">
			Diteruskan Kepada : <br>
			<?php echo ($tujuan['sekretaris'] == 1 ? "<img src='../assets/icon/check-square.svg'>" : "<img src='../assets/icon/Square.svg'>") ; ?> Sekretaris <br>
			<?php echo ($tujuan['irban1'] == 1 ? "<img src='../assets/icon/check-square.svg'>" : "<img src='../assets/icon/Square.svg'>") ; ?> Irban I <br>
			<?php echo ($tujuan['irban2'] == 1 ? "<img src='../assets/icon/check-square.svg'>" : "<img src='../assets/icon/Square.svg'>") ; ?> Irban II <br>
			<?php echo ($tujuan['irban3'] == 1 ? "<img src='../assets/icon/check-square.svg'>" : "<img src='../assets/icon/Square.svg'>") ; ?> Irban III <br>
			<?php echo ($tujuan['irbansus'] == 1 ? "<img src='../assets/icon/check-square.svg'>" : "<img src='../assets/icon/Square.svg'>") ; ?> Irban Khusus <br>
			<?php echo ($tujuan['umum'] == 1 ? "<img src='../assets/icon/check-square.svg'>" : "<img src='../assets/icon/Square.svg'>") ; ?> Kasubbag Umum <br>
			<?php echo ($tujuan['keuangan'] == 1 ? "<img src='../assets/icon/check-square.svg'>" : "<img src='../assets/icon/Square.svg'>") ; ?> Kasubbag Keuangan <br>
			Dan Seterusnya ........................................
		</td>
		<td colspan="2">
			Dengan hormat harap :<br>
			<img src="../assets/icon/Square.svg"> Tanggapan dan Saran <br>
			<img src="../assets/icon/Square.svg"> Proses lebih lanjut <br>
			<img src="../assets/icon/Square.svg"> Koordinasi dan Konfirmasi <br>
			<img src='../assets/icon/Square.svg'> .................................................
		</td>
	</tr>
	<tr>
		<td height="300px" colspan="4">
			Catatan : <br>
			<?php echo $cek['catatan']; ?>
		</td>
	</tr>
	</table>

    <script>
		window.print();
	</script>