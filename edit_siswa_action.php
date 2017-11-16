<?php
	session_start();

	if (isset($_POST['simpan'])) {
		//variable username dan password
		$nis = $_POST['nis'];
		$nama = $_POST['nama'];
		$kelas = $_POST['kelas'];
		$tahun_ajaran = $_POST['tahun_ajaran'];

		//lampirkan file db_config.php
		include 'db_config.php';

		//sql untuk update data
		$sql = "UPDATE tbl_siswa 
				SET 
				nama = '{$nama}',
				kelas = '{$kelas}',
				tahun_ajaran = '{$tahun_ajaran}'
				WHERE
				nis = '{$nis}'
				";

		//eksekusi query untuk update data ke dalam database
		$update = mysqli_query($koneksi, $sql); //variable $koneksi ada di file db_config.php

		//apakah proses update berhasil
		if ($update) { 
			$_SESSION['pesan'] = "<p>Data berhasil diperbaharui</p>";
			header('location: data_siswa.php');
            exit;

		} else { 
			$_SESSION['pesan'] = "<p style='color:red'>Terjadi kesalahan.</p>";
			header('location: edit_siswa.php?nis='.$nis);
            exit;
	
		}
		
	} else {
		echo "<h3 style='color:red'>Forbidden Access.</h3>";

	} //end iff
?>
