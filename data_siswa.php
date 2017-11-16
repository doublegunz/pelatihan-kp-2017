<?php
session_start();
if (! isset($_SESSION['loggedIN'])) {
	header('location: login.php');
}

//set judul
$judul = "Data Siswa - APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI";


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
	<h2>Data Pembayaran Siswa</h2>

	<!-- Pesan -->
	<?php 
		if (isset($_SESSION['pesan'])) {
			echo $_SESSION['pesan'];
			unset($_SESSION['pesan']);
		}
	?>

	<form method="post" action="">
		<input type="text" name="keyword">
		<button name="cari">Cari</button>
	</form>
	<br>

	<table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse;">
	<tr bgcolor="#FFFFFF" align="center">
		<td width="5%">No</td>
		<td width="25%">NIS</td>
		<td width="25%">Nama</td>
		<td width="20%">Kelas</td>
		<td width="20%">Tahun Ajaran</td>
		<td colspan="2"  width="5%"><a href="add_siswa.php" class="link">Tambah Data</a></td>
	</tr>
	<?php 
		//ambil data dari database

		//lampirkan file db_config.php
	    include 'db_config.php';

	    //sql untuk ambil data
	    $sql = "SELECT * FROM tbl_siswa ORDER BY NIS DESC";
	    $data_siswa = mysqli_query($koneksi, $sql);
	    $jumlah_data = mysqli_num_rows($data_siswa);

	    //kode untuk pencarian data
	    if (isset($_POST['cari'])) {
	    	$keyword = $_POST['keyword'];

		    //sql untuk ambil data
		    $sql = "SELECT * FROM tbl_siswa 
		    	WHERE 
		    	nis like '%{$keyword}%' 
		    	or nama like '%{$keyword}%'
		    	or kelas like '%{$keyword}%'
		    	ORDER BY nis DESC";

		    $data_siswa = mysqli_query($koneksi, $sql);
		    $jumlah_data = mysqli_num_rows($data_siswa);
	    }


	    //cek apakah datanya ada atau ngga
	    if ($jumlah_data > 0) {
	    	$no =1;
	    	//tampilkan data
	    	while ($row = mysqli_fetch_array($data_siswa)) { ?>
	    	<tr bgcolor="#FFFFFF" align="center">
				<td align="center"><?php echo $no; ?></td>
				<td align="center"><?php echo $row['nis']; ?></td>
				<td align="center"><?php echo $row['nama']; ?></td>
				<td align="center"><?php echo $row['kelas']; ?></td>
				<td align="center"><?php echo $row['tahun_ajaran']; ?></td>
				<td align="center">
					<a href="edit_siswa.php?nis=<?php echo $row["nis"]; ?>" class="link">Edit</a>
				</td>
				<td>
					<a href="hapus_siswa.php?nis=<?php echo $row["nis"]; ?>" onclick="return confirm('Anda yakin akan menghapus data ini ?')" class="link">Hapus</a>
				</td>
			</tr>
	    	<?php 
	    		$no++;
	    	} //end while
	    } else { ?>
		<tr>
			<td colspan="9" align="center">Data siswa Kosong</td>
		</tr>
	    <?php } ?>
		
	</table>
	<p> Jumlah data: <?php echo $jumlah_data; ?> </p>

	<!-- End: Konten -->


	</div> <!-- End: id body -->

	<!-- Footer -->
	<p class="footer">
	APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI<br />
	Halaman ini dimuat selama <strong><?php echo microtime(); ?></strong> detik
	</p>
</div><!-- End: Container -->
</body>
</html>

