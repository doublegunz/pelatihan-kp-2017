<?php

session_start();
if (isset($_POST['start'])) {
	//mulai session untuk transaksi
	$nis = $_POST['nis'];

    //lampirkan file db_config.php
    include 'db_config.php';

    //sql untuk mengecek apakah nis siswa ada di database
    $sql = "SELECT * FROM tbl_siswa WHERE nis='{$nis}'";

    //kita cek ke db
    $cek = mysqli_query($koneksi, $sql); //variable $koneksi ada di file db_config.php

    if (mysqli_num_rows($cek) == 1) {
    	//kalau ada kita mulai sesi transaksi pembayaran
    	$_SESSION['nis'] = $nis;

    	//lalu arahkan ke halaman transaksi
	    header('location: add_pembayaran.php');
	    exit;
    } else {
		$_SESSION['pesan'] = "<p style='color:red'>NIS {$nis} tidak valid.</p>";
		header('location: transaksi_pembayaran.php');
        exit;
    }


} else {
	echo "<h3 style='color:red'>Forbidden Access.</h3>";

} //end if
?>
