<?php
session_start();
if (! isset($_SESSION['loggedIN'])) {
	header('location: index.php');
}

//set judul
$judul = "Transaksi Pembayaran - APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI";


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

<h2>Form Pembayaran:</h2>

<?php 
	if (isset($_SESSION['pesan'])) {
		echo $_SESSION['pesan'];
		unset($_SESSION['pesan']);
	} else {
		echo "Masukkan NIS Siswa untuk memulai transaksi pembayaran.";
	}
?>
<form action="trans_action.php" method="POST">
<div id="bg-line">
	NIS :
	<input type="text" name="nis" class="input-teks-login" required>
	<input type="submit" name="start" value="Mulai Transaksi" class="btn-kirim-login">
</div>
</form>


	<!-- Footer -->
	<p class="footer">
	APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI<br />
	Halaman ini dimuat selama <strong><?php echo microtime(); ?></strong> detik
	</p>
</div>
</body>
</html>

