<?php
    session_start();
    if (! isset($_SESSION['loggedIN'])) {
        header('location: login.php');
    }

	if (isset($_GET['id'])) {
        //variable username dan password
        $id_pembayaran 		= $_GET['id'];

        //lampirkan file db_config.php
        include 'db_config.php';

        //sql untuk menambakan data
        $sql = "DELETE FROM tbl_pembayaran where id_pembayaran ='{$id_pembayaran}'";

        
        $delete = mysqli_query($koneksi, $sql); //variable $koneksi ada di file db_config.php

		if ($delete) { 
			
			$_SESSION['pesan'] = "<p>Data berhasil dihapus</p>";
			header('location: data_pembayaran.php');
			exit;

		} else { 
			$_SESSION['pesan'] =    "<p style='color:red'>Data gagal dihapus.</p>";
			header('location: edit.php?id=');
			exit;
		}
        
	} else {
        echo "<h3 style='color:red'>Forbidden Access.</h3>";

    } //end iff
?>
