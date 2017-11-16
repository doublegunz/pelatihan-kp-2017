<?php
session_start();
if (! isset($_SESSION['loggedIN'])) {
	header('location: login.php');
}

//set judul
$judul = "Report - APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI";


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $judul; ?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div id="container">
	<h1><?php echo $judul; ?></h1>

	<div id="body">
	<p>Selamat Datang <strong>
	<?php echo $_SESSION['username']; ?></strong></p>
	<?php 
		include 'menu.php'; 
	?>
	<div class="cleaner_h10"></div>

	<!-- Konten -->
	<h2>Report Pembayaran Keuangan</h2>

	<table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse;">
	<tr>
		<td colspan="5" align="center">Laporan Keuangan</td>
	</tr>
	<tr bgcolor="#FFFFFF" align="center">
		<td align="center">No</td>
		<td align="center">Jenis Pembayaran</td>
		<td align="center" colspan="3">Menu</td>
	</tr>
	<tr>
		<td align="center">1</td>
		<td align="center">Pembayaran SPP</td>
		<td align="center"><a href="print.php?jenis_pembayaran=1" target="_blank" class="link2">Print</a></td>
		<td align="center"><a href="export_excel.php?jenis_pembayaran=1" class="link2">Export Excel</a></td>
	</tr>
	<tr>
		<td align="center">2</td>
		<td align="center">Pembayaran DSP</td>
		<td align="center"><a href="print.php?jenis_pembayaran=2" target="_blank" class="link2">Print</a></td>
		<td align="center"><a href="export_excel.php?jenis_pembayaran=2" target="_blank" class="link2">Export Excel</a></td>
	</tr>
	
		
	</table>
	</div>
	<br><br><br>

	<!-- Footer -->
	<p class="footer">
	APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI<br />
	Halaman ini dimuat selama <strong><?php echo microtime(); ?></strong> detik
	</p>
</div>
</body>
</html>

