<?php
session_start();
if (! isset($_SESSION['loggedIN'])) {
	header('location: index.php');
}

//set judul
$judul = "Edit Data Siswa - APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI";


//tangkap nis dari url
$nis = $_GET['nis'];

//lampirkan file db_config.php
include 'db_config.php';

//sql untuk mengambil data berdasarkan nis
$sql = "SELECT * FROM tbl_siswa where nis ='{$nis}'";
$get_data = mysqli_query($koneksi, $sql);
$data_siswa = mysqli_fetch_array($get_data);
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

<form action="edit_siswa_action.php" method="POST">
<div id="bg-line">
	<label for="nis">NIS:</label>
	<input type="text" name="nis" class="input-teks-login" value="<?php echo $data_siswa['nis']; ?>" readonly>

	<label for="nama">Nama:</label>
    <input type="text" name="nama" class="input-teks-login" value="<?php echo $data_siswa['nama']; ?>" required>

    <label for="kelas">Kelas:</label>
    <input type="text" name="kelas" class="input-teks-login" value="<?php echo $data_siswa['kelas']; ?>" required>

    <label for="tahun_ajaran">Tahun Ajaran:</label>
    <input type="text" name="tahun_ajaran" class="input-teks-login" value="<?php echo $data_siswa['tahun_ajaran']; ?>" required>

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

