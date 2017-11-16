<?php
session_start();
//cek apakah pengguna sudah login
if (isset($_SESSION['loggedIN'])) {
	header('location: index.php');
        exit;
}

//set judul
$judul = "Halaman Login - APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI";

if (isset($_POST['login'])) {
        //variable username dan password
        $username               = $_POST['username'];
        $password               = md5($_POST['password']);

        //lampirkan file db_config.php
        include 'db_config.php';

        //sql untuk mengecek apakah pengguna ada dalam tabel pengguna
        $sql = "SELECT * FROM tbl_pengguna WHERE username='{$username}'";

        //kita cek ke db
        $cek = mysqli_query($koneksi, $sql); //variable $koneksi ada di file db_config.php

        if (mysqli_num_rows($cek) == 1) {
                //kita fetch / ambil data yang kita cek tadi, lalu ubah menjadi array
                $user = mysqli_fetch_array($cek);

                //cek apakah password yang dimasukan sama dengan yang ada di database
                if ($password == $user['password']) {
                        //set session
                        $_SESSION['loggedIN'] = TRUE;
                        $_SESSION['username'] = $user['username'];
                        header('location: index.php');
                        exit;
                } 
        } 

        $error = TRUE;

}

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
<h1>Selamat Datang di APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI</h1>

<div id="body">
	<?php

	if (isset($error)) {
	       echo "<p style='color:red'>Username atau password anda salah.</p>";          
	} else {
		echo "<p>Silahkan login untuk mengakses informasi akademik.</p>";
	}

	?>
	
	<form action=""  method="POST">
	<div id="bg-line">
	Username : 
	<input type="text" name="username" class="input-teks-login" placeholder="Masukkan Username">
	Password : 
	<input type="password" name="password" class="input-teks-login" placeholder="Masukkan Password">
	<button name="login" class="btn-kirim-login">Login</button>
	</div>
	</form>	
</div>

	<!-- Footer -->
	<p class="footer">
	APLIKASI PEMBAYARAN KEUANGAN SISWA SMAN 2 KOTA SUKABUMI<br />
	Halaman ini dimuat selama <strong><?php echo microtime(); ?></strong> detik
	</p>
</div>
</body>
</html>

