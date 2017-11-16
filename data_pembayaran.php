<?php
session_start();
if (! isset($_SESSION['loggedIN'])) {
	header('location: login.php');
}

//set judul
$judul = "Data Pembayaran - APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI";


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
	
	<!-- Form Pencarian -->
	<form method="post" action="">
		<input type="text" name="keyword">
		<button name="cari">Cari</button>
	</form>
	<br>

	<table border="1" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse;">
	<tr bgcolor="#FFFFFF" align="center">
		<td align="center" width="5%">No</td>
		<td align="center" width="20%">NIS</td>
		<td align="center" width="25%">Nama</td>
		<td align="center" width="15%">Tanggal Pembayaran</td>
		<td  align="center" width="10%">Jenis Pembayaran</td>
		<td align="center" width="5%">Sisa Pembayaran</td>
		<td align="center" width="5%">Status Pembayaran</td>
		<td align="center" colspan="2"  width="15%"><a href="transaksi_pembayaran.php" class="link">Mulai Transaksi Pembayaran</a></td>
	</tr>
	<?php 
	//ambil data dari database

		//lampirkan file db_config.php
	    include 'db_config.php';

	    //sql untuk ambil data
	    $sql = "SELECT * FROM tbl_pembayaran ORDER BY id_pembayaran DESC";
	    $data_pembayaran = mysqli_query($koneksi, $sql);
	    $jumlah_data = mysqli_num_rows($data_pembayaran);

	    //kode untuk pencarian data
	    if (isset($_POST['cari'])) {
	    	$keyword = $_POST['keyword'];

		    //sql untuk ambil data
		    $sql = "SELECT * FROM tbl_pembayaran 
		    	WHERE 
		    	nis like '%{$keyword}%' 
		    	or nama like '%{$keyword}%'
		    	ORDER BY id_pembayaran DESC";

		    //kita timpa data pembayaran
		    $data_pembayaran = mysqli_query($koneksi, $sql);
		    $jumlah_data = mysqli_num_rows($data_pembayaran);
	    }

	    //cek apakah datanya ada atau ngga
	    if ($jumlah_data > 0) {
	    	$no =1;
	    	//tampilkan data
	    	while ($row = mysqli_fetch_array($data_pembayaran)) { ?>
	    	<tr>
				<td align="center"><?php echo $no; ?></td>
				<td align="center"><?php echo $row['nis']; ?></td>
				<td align="center"><?php echo $row['nama']; ?></td>
				<td align="center"><?php echo $row['tanggal_pembayaran']; ?></td>
				<td align="center"><?php 
						if ($row['jenis_pembayaran'] == 1) { 
							echo 'SPP';
						} else {
							echo 'DSP'; 
						} //end if
					?>
				</td>
				<td align="center"><?php echo $row['sisa_pembayaran']; ?></td>
				<td align="center"><?php echo $row['status_pembayaran']; ?></td>
				<td align="center">
					<a href="edit.php?id=<?php echo $row["id_pembayaran"]; ?>" class="link">Edit</a>
				</td>
				<td>
					<a href="hapus.php?id=<?php echo $row["id_pembayaran"]; ?>" onclick="return confirm('Anda yakin akan menghapus data ini ?')" class="link">Hapus</a>
				</td>
			</tr>
	    	<?php 
	    		$no++;
	    	} //end while
	    } else { ?>
		<tr>
			<td colspan="9" align="center">Data Pembayaran Kosong</td>
		</tr>
	    <?php } ?>
		
	</table>
	<p> Jumlah data: <?php echo $jumlah_data; ?></p>
	</div>

	<!-- Footer -->
	<p class="footer">
	APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI<br />
	Halaman ini dimuat selama <strong><?php echo microtime(); ?></strong> detik
	</p>
</div>
</body>
</html>

