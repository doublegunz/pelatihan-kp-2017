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

        //sql untuk cek duplikasi nis
        $cek_sql = "SELECT * FROM tbl_siswa WHERE nis='{$nis}'";

        //kita cek ke db
        $cek = mysqli_query($koneksi, $cek_sql); //variable $koneksi ada di file db_config.php

        //apakah nis sudah digunakan
        if (mysqli_num_rows($cek) == 1) { 
        	//kalau sudah digunakan, arahkan ke halaman form tambah siswa
        	$_SESSION['pesan'] =	"<p style='color:red'>NIS tidak valid atau sudah digunakan.</p>";
        	header('location: add_siswa.php');
            exit;
        }

		//sql untuk menambakan data
		$sql = "INSERT INTO tbl_siswa (nis, nama, kelas, tahun_ajaran) VALUES ('{$nis}', '{$nama}', '{$kelas}', '{$tahun_ajaran}')";

		//eksekusi query untuk insert data ke dalam database
		$simpan = mysqli_query($koneksi, $sql); //variable $koneksi ada di file db_config.php

		//apakah proses insert berhasil
		if ($simpan) { 
			$_SESSION['pesan'] =	"<p>Data berhasil disimpan</p>";
			header('location: data_siswa.php');
            exit;

		} else { 
			$_SESSION['pesan'] =	"<p style='color:red'>Terjadi kesalahan.</p>";
			header('location: add_siswa.php');
            exit;
	
		}
		
	} else {
		echo "<h3 style='color:red'>Forbidden Access.</h3>";

	} //end iff
?>
