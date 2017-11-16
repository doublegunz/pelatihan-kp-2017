<?php
	session_start();

	if (isset($_POST['simpan'])) {
        //variable username dan password
		$nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $jenis_pembayaran = $_POST['jenis_pembayaran'];
        $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
        $jumlah_pembayaran = $_POST['jumlah_pembayaran'];

        if ($jenis_pembayaran == 1) {
            //biaya spp
            $biaya = 150000;
        } else {
            //biaya dsp
            $biaya = 2000000;
        }

        $sisa_pembayaran = $biaya - $jumlah_pembayaran;

        if ($sisa_pembayaran <= 0) {
            $status_pembayaran = 'LUNAS';
            $sisa_pembayaran = 0;
        } else {
            $status_pembayaran = 'MENUNGGAK';
        }

        //lampirkan file db_config.php
        include 'db_config.php';

        //sql untuk menambakan data
        $sql = "INSERT INTO tbl_pembayaran (nis, nama, tanggal_pembayaran, jenis_pembayaran, jumlah_pembayaran, sisa_pembayaran, status_pembayaran) VALUES ('{$nis}', '{$nama}', '{$tanggal_pembayaran}', '{$jenis_pembayaran}', '{$jumlah_pembayaran}', '{$sisa_pembayaran}', '{$status_pembayaran}')";

        
        $simpan = mysqli_query($koneksi, $sql); //variable $koneksi ada di file db_config.php

		//apakah proses insert berhasil
		if ($simpan) { 
			//jangan lupa, unset session untuk transaksi
			unset($_SESSION['nis']);
			
			$_SESSION['pesan'] = "<p>Data berhasil disimpan</p>";


			header('location: data_pembayaran.php');
            exit;

		} else { 
			$_SESSION['pesan'] =	"<p style='color:red'>Data gagal disimpan.</p>";
			header('location: add_pembayaran.php');
            exit;
		}
        
	} else {
   		echo "<h3 style='color:red'>Forbidden Access.</h3>";

    } //end iff
?>
