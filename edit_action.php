<?php
	session_start();
	if (isset($_POST['update'])) {
		$id_pembayaran = $_POST['id'];
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
		$sql = "UPDATE tbl_pembayaran SET 
					nis = '{$nis}', 
					nama = '{$nama}', 
					tanggal_pembayaran = '{$tanggal_pembayaran}', 
					jenis_pembayaran = '{$jenis_pembayaran}', 
					jumlah_pembayaran = '{$jumlah_pembayaran}', 
					sisa_pembayaran = '{$sisa_pembayaran}', 
					status_pembayaran ='{$status_pembayaran}' 
					WHERE 
					id_pembayaran ='{$id_pembayaran}'
					";

		
		$update = mysqli_query($koneksi, $sql); //variable $koneksi ada di file db_config.php

		if ($update) { 
			
			$_SESSION['pesan'] = "<p>Data berhasil diperbaharui</p>";
			header('location: data_pembayaran.php');
			exit;

		} else { 
			$_SESSION['pesan'] =    "<p style='color:red'>Data gagal diperbaharui.</p>";
			header('location: edit.php?id='.$id_pembayaran);
			exit;
		}
		
	} else {
				echo "<h3 style='color:red'>Forbidden Access.</h3>";

		} //end iff
?>
