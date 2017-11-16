<?php 
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$database = 'db_pelatihan';

$koneksi = mysqli_connect($db_host, $db_user, $db_password, $database);

//jika tidak terhubung, maka tampilkan pesan
if (!$koneksi) {
	die('gagal terhubung dengan database');
}