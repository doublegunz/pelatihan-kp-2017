<?php
session_start();
if (! isset($_SESSION['loggedIN'])) {
	header('location: index.php');
}

//set judul
$judul = "Tambah Data Siswa - APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI";


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
	}
?>

<form action="add_siswa_action.php" method="POST">
<div id="bg-line">
	<label for="nis">NIS:</label>
	<input type="text" name="nis" class="input-teks-login" required>

	<label for="nama">Nama:</label>
    <input type="text" name="nama" class="input-teks-login" required>

    <label for="kelas">Kelas:</label>
    <input type="text" name="kelas" class="input-teks-login" required>

    <label for="tahun_ajaran">Tahun Ajaran:</label>
    <input type="text" name="tahun_ajaran" class="input-teks-login" required>

	<input type="submit" name="simpan" value="Simpan" class="btn-kirim-login">
	<input type="reset" name="reset" value="reset" class="btn-kirim-login">

	
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

