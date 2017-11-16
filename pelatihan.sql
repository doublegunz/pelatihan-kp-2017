CREATE TABLE `tbl_pengguna` (
  `id_pengguna` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_siswa` (
  `nis` varchar(15) NOT NULL PRIMARY KEY,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nis` varchar(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tanggal_pembayaran` DATE NOT NULL,
  `jenis_pembayaran` int(1) NOT NULL,
  `jumlah_pembayaran` int(15) NOT NULL,
  `sisa_pembayaran` int(15) NOT NULL,
  `status_pembayaran` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;