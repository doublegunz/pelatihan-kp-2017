<?php
    session_start();
    if (! isset($_SESSION['loggedIN'])) {
        header('location: login.php');
    }

	if (isset($_GET['nis'])) {
        //variable username dan password
        $nis 		= $_GET['nis'];

        //lampirkan file db_config.php
        include 'db_config.php';

        //sql untuk menambakan data
        $sql = "DELETE FROM tbl_siswa where nis ='{$nis}'";

        
        $delete = mysqli_query($koneksi, $sql); //variable $koneksi ada di file db_config.php

        if ($delete) { 
			$_SESSION['pesan'] = "<p>Data siswa berhasil dihapus.</p>";
			header('location: data_siswa.php');
            exit;

         } else { 
			$_SESSION['pesan'] = "<p style='color:red'>Terjadi kesalahan.</p>";
			header('location: data_siswa.php');
            exit;
       	} 
	} else {
        echo "<h3 style='color:red'>Forbidden Access.</h3>";
    } //end iff
?>
