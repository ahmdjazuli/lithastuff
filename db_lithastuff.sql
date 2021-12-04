-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2021 at 12:11 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lithastuff`
--

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE `beli` (
  `idbeli` int(5) NOT NULL,
  `id` int(5) NOT NULL,
  `idongkir` int(5) NOT NULL,
  `tglbeli` date NOT NULL,
  `total` int(11) NOT NULL,
  `bukti` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `namakota` varchar(80) NOT NULL,
  `tarifnya` float NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`idbeli`, `id`, `idongkir`, `tglbeli`, `total`, `bukti`, `status`, `namakota`, `tarifnya`, `alamat`) VALUES
(10, 3, 10, '2021-11-06', 155000, '2265IMG.20210815.WA0023.jpg', 'Menunggu', 'Batakan', 25000, 'Gang Hijrah Raya, Muhibbin 4 Sekumpul'),
(37, 4, 11, '2021-11-01', 23000, '1833IMG.20211022.WA0026.jpg', 'Menunggu', 'Martapura', 10000, 'Jl. Bunga Melati kota Banjarbaru'),
(40, 6, 8, '2021-11-06', 227000, '1727IMG.20210815.WA0021.jpg', 'Diterima', 'Martapura', 17000, 'Jl. Trikora Rt.32 Rw.5 Kode Pos 70721 Guntung Manggis'),
(41, 2, 8, '2021-11-06', 157000, '5937image22a.png', 'Diterima', 'Martapura', 17000, 'komplek pangeran antasari no. 33'),
(42, 4, 6, '2021-11-06', 195000, '1279Screenshot.2020.0821.193603.9b553e87d5bc57b8c2fe37f8ae5bc043.png', 'Diterima', 'Marabahan', 25000, 'Jl. Bunga Melati kota Banjarbaru'),
(44, 2, 0, '2021-12-04', 73000, '', '', '', 0, 'komplek pangeran antasari no. 33'),
(46, 7, 3, '2021-12-04', 119000, '8052image22a.png', 'Diterima', 'Barabai', 5000, 'MTP'),
(47, 7, 0, '2021-12-04', 8000, '', '', '', 0, 'MTP');

-- --------------------------------------------------------

--
-- Table structure for table `beliproduk`
--

CREATE TABLE `beliproduk` (
  `idbeliproduk` int(5) NOT NULL,
  `idbeli` int(5) NOT NULL,
  `idtanam` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `namanya` varchar(80) NOT NULL,
  `harganya` float NOT NULL,
  `subharga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beliproduk`
--

INSERT INTO `beliproduk` (`idbeliproduk`, `idbeli`, `idtanam`, `jumlah`, `namanya`, `harganya`, `subharga`) VALUES
(29, 37, 12, 1, 'Chemira Bergo Sport', 13000, 13000),
(32, 10, 7, 1, 'Highwaist Loose Kulot', 63000, 63000),
(33, 10, 13, 1, 'Kemeja Flanel Korea', 70000, 70000),
(34, 40, 13, 3, 'Kemeja Flanel Korea', 70000, 210000),
(35, 41, 13, 2, 'Kemeja Flanel Korea', 70000, 140000),
(36, 42, 10, 2, 'Kemeja Flanel Crop', 85000, 170000),
(38, 44, 5, 1, 'Kemeja Saku Rempel 1029', 73000, 73000),
(40, 46, 9, 2, 'Highwaist Loose Kulot 1024', 57000, 114000),
(41, 47, 12, 1, 'Chemira Bergo Sport', 8000, 8000);

--
-- Triggers `beliproduk`
--
DELIMITER $$
CREATE TRIGGER `membeli` AFTER INSERT ON `beliproduk` FOR EACH ROW BEGIN 
	UPDATE tanam SET stok = stok - NEW.jumlah, 
                     terjual = terjual + NEW.jumlah 
    WHERE idtanam = NEW.idtanam;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `flashsale`
--

CREATE TABLE `flashsale` (
  `idflash` int(5) NOT NULL,
  `idtanam` int(5) NOT NULL,
  `hargaawal` float NOT NULL,
  `waktu` datetime NOT NULL,
  `diskon` int(11) NOT NULL,
  `hasil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flashsale`
--

INSERT INTO `flashsale` (`idflash`, `idtanam`, `hargaawal`, `waktu`, `diskon`, `hasil`) VALUES
(4, 5, 73000, '2021-12-03 11:08:00', 10, 65700);

--
-- Triggers `flashsale`
--
DELIMITER $$
CREATE TRIGGER `delete_flash` AFTER DELETE ON `flashsale` FOR EACH ROW BEGIN 
	UPDATE tanam SET harga = OLD.hargaawal, cekflash = 0
    WHERE idtanam = OLD.idtanam;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `edit_flash` AFTER UPDATE ON `flashsale` FOR EACH ROW BEGIN
	UPDATE tanam SET harga = NEW.hasil, cekflash = 1
    WHERE idtanam = NEW.idtanam;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_flash` AFTER INSERT ON `flashsale` FOR EACH ROW BEGIN
	UPDATE tanam SET harga = NEW.hasil, cekflash = 1
    WHERE idtanam = NEW.idtanam;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kirim`
--

CREATE TABLE `kirim` (
  `idkirim` int(5) NOT NULL,
  `idbeli` int(5) NOT NULL,
  `idkurir` int(3) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `ket` text NOT NULL,
  `statuskirim` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kirim`
--

INSERT INTO `kirim` (`idkirim`, `idbeli`, `idkurir`, `penerima`, `foto`, `ket`, `statuskirim`) VALUES
(2, 42, 3, 'adiknya amel', '3160IMG.20191218.135559..2..jpg', 'barang sampai', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `idkurir` int(3) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `namakurir` varchar(80) NOT NULL,
  `kontakkurir` varchar(50) NOT NULL,
  `alamatkurir` text NOT NULL,
  `jkkurir` enum('0','1') NOT NULL,
  `layanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`idkurir`, `username`, `password`, `namakurir`, `kontakkurir`, `alamatkurir`, `jkkurir`, `layanan`) VALUES
(2, 'syabani', 'syabani', 'Akhmad Syabani', '051178659932', 'Banjarmasin', '0', 'JNE'),
(3, 'ridwan', 'ridwan', 'Ridwan', '085369696664', 'Barabai', '0', 'J&T Express');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `idongkir` int(2) NOT NULL,
  `kota` varchar(80) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`idongkir`, `kota`, `tarif`) VALUES
(2, 'Banjarbaru', 15000),
(3, 'Barabai', 5000),
(4, 'Kotabaru', 17000),
(5, 'Banjarmasin', 20000),
(6, 'Marabahan', 25000),
(7, 'Kandangan', 20000),
(8, 'Martapura', 17000),
(9, 'Pelaihari', 18000),
(10, 'Batakan', 25000),
(11, 'Landasan Ulin', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(1) NOT NULL,
  `ukuran_teks` varchar(20) NOT NULL,
  `warna_navbar` varchar(20) NOT NULL,
  `warna_icon` varchar(20) NOT NULL,
  `warna_lainnya` varchar(20) NOT NULL,
  `warna_master` varchar(20) NOT NULL,
  `warna_report` varchar(20) NOT NULL,
  `background_grafik` varchar(20) NOT NULL,
  `background_grafik1` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `ukuran_teks`, `warna_navbar`, `warna_icon`, `warna_lainnya`, `warna_master`, `warna_report`, `background_grafik`, `background_grafik1`) VALUES
(1, 'text-md', 'navbar-dark', 'navbar-light', 'bg-dark', 'bg-dark', 'bg-gray', '#343a40', '#343a40');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `idpengeluaran` int(5) NOT NULL,
  `tgl` date NOT NULL,
  `ket` text NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`idpengeluaran`, `tgl`, `ket`, `total`) VALUES
(1, '2021-11-29', 'Kantong Plastik Pembungkus', 13000),
(3, '2021-11-30', 'Stiker Brand', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tanam`
--

CREATE TABLE `tanam` (
  `idtanam` int(5) NOT NULL,
  `namatanam` varchar(80) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `modal` float NOT NULL,
  `harga` float NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text NOT NULL,
  `stok` int(4) NOT NULL,
  `harga_r` float NOT NULL,
  `terjual` int(10) NOT NULL,
  `cekflash` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tanam`
--

INSERT INTO `tanam` (`idtanam`, `namatanam`, `kategori`, `modal`, `harga`, `deskripsi`, `gambar`, `stok`, `harga_r`, `terjual`, `cekflash`) VALUES
(4, 'Kemeja Crincle Airflow', 'Kemeja', 60000, 75000, 'Lingkar Dada : 110cm dan\r\nBahan : Crincle Airflow', '2538Screenshot.20211101.060015.Instagram..2..jpg', 0, 70000, 0, 0),
(5, 'Kemeja Saku Rempel 1029', 'Kemeja', 55000, 73000, 'Bahan : Rayon Premium dan Lingkar Dada 120cm', '3438Screenshot.20211101.060042.Instagram..2..jpg', 3, 65000, 1, 0),
(6, 'Kemeja Flanel Crop Premium', 'Kemeja', 60000, 85000, 'Bahan : Flanel Tebal dan Lembut, Lingkar Dada 120cm, Panjang 70cm.', '9085Screenshot.20211101.060058.Instagram..2..jpg', 2, 70000, 1, 0),
(7, 'Highwaist Loose Kulot', 'Sweater', 50000, 63000, 'Bahan : Linen, Ukuran XL, Lingkar Paha 73cm, Lingkar Pinggang 74-100cm dan Panjang 95cm. Ada kancing, saku di kanan kiri, ban di bagian depan, dan karet di bagian belakang.', '3621Screenshot.20211101.060438.Instagram..3..jpg', 2, 55000, 1, 0),
(8, 'Crincle Blouse', 'Kemeja', 35000, 50000, 'Bahan Katun Rayon Diamond, Lingkar Dada 122cm, Panjang Baju 56cm dan Panjang Lengan 54cm.', '7740Screenshot.20211101.060533.Instagram..2..jpg', 10, 40000, 0, 0),
(9, 'Highwaist Loose Kulot 1024', 'Kemeja', 52000, 63000, 'Bahan : Linen, Ukuran S-M-L, Lingkar Paha 73cm, Lingkar Pinggang 74-100cm dan Panjang 95cm.', '6256Screenshot.20211101.060455.Instagram..3..jpg', 0, 57000, 5, 0),
(10, 'Kemeja Flanel Crop', 'Kemeja', 70000, 85000, 'Bahan Flanel Tebal, Lingkar Dada 112cm dan Panjang 45cm.', '9221Screenshot.20211101.060304.Instagram..2..jpg', 3, 78000, 4, 0),
(12, 'Chemira Bergo Sport', 'Jilbab', 6000, 13000, 'Bahan Jersey.', '8746Screenshot.20211101.060737.Instagram..2..jpg', 1, 8000, 4, 0),
(13, 'Kemeja Flanel Korea', 'Kemeja', 55000, 70000, 'Bahan : Flanel Lingkar Dada 98cm, Panjang Baju 53cm dan Panjang Lengan 54cm ', '1030Screenshot.20211101.060754.Instagram..2..jpg', 2, 60000, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tanammasuk`
--

CREATE TABLE `tanammasuk` (
  `idtanammasuk` int(5) NOT NULL,
  `idtanam` int(5) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` int(5) NOT NULL,
  `hargamasuk` float NOT NULL,
  `sumber` varchar(80) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tanammasuk`
--

INSERT INTO `tanammasuk` (`idtanammasuk`, `idtanam`, `tgl`, `jumlah`, `hargamasuk`, `sumber`, `catatan`) VALUES
(13, 13, '2021-11-01', 8, 55000, 'Paman Amin', '-'),
(14, 12, '2021-11-02', 5, 6000, 'Paman Amin', '-'),
(15, 7, '2021-11-01', 3, 52000, 'Paman Amin', '-'),
(16, 5, '2021-11-02', 4, 73000, 'Paman Amin', '-'),
(17, 6, '2021-11-01', 3, 60000, 'Paman Amin', '-'),
(18, 10, '2021-11-03', 7, 70000, 'Paman Amin', '-'),
(19, 9, '2021-12-04', 5, 52000, 'Paman Amin', '-'),
(20, 8, '2021-12-04', 10, 35000, 'Paman Amin', '-');

--
-- Triggers `tanammasuk`
--
DELIMITER $$
CREATE TRIGGER `delete_masuk` AFTER DELETE ON `tanammasuk` FOR EACH ROW BEGIN 
	UPDATE tanam SET stok = stok - OLD.jumlah
    WHERE idtanam = OLD.idtanam;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `t_masuk` AFTER INSERT ON `tanammasuk` FOR EACH ROW BEGIN
	UPDATE tanam SET stok = stok + NEW.jumlah
    WHERE idtanam = NEW.idtanam;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_masuk` AFTER UPDATE ON `tanammasuk` FOR EACH ROW BEGIN
	UPDATE tanam SET stok = stok - OLD.jumlah, 
                     stok = stok + NEW.jumlah 
    WHERE idtanam = NEW.idtanam;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jk` enum('0','1') NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `alamat`, `telp`, `email`, `jk`, `level`) VALUES
(1, 'admin', 'admin', 'admin', '-', '-', '-', '0', 'admin'),
(2, 'wawan', 'wawan', 'wawan', 'komplek pangeran antasari no. 33', '6282152116441', 'yahoo@gmail.com', '0', 'pelanggan'),
(3, 'rudi', 'rudi', 'rudi', 'Gang Hijrah Raya, Muhibbin 4 Sekumpul', '08132912427', 'rudi@gmail.com', '0', 'pelanggan'),
(4, 'Amelia', 'amel', 'amel', 'Jl. Bunga Melati kota Banjarbaru', '08971441232', 'amelia666@gmail.com', '1', 'pelanggan'),
(6, 'Ikaza', 'ikaza', 'ikaza', 'Jl. Trikora Rt.32 Rw.5 Kode Pos 70721 Guntung Manggis', '082576119311', 'ikazapremium@gmail.co.id', '0', 'pelanggan'),
(7, 'zaskia', 'zaskia', 'zaskia', 'MTP', '08974321238', 'zaskiafayra777@yahoo.co.io', '0', 'reseller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`idbeli`),
  ADD KEY `id` (`id`),
  ADD KEY `idongkir` (`idongkir`);

--
-- Indexes for table `beliproduk`
--
ALTER TABLE `beliproduk`
  ADD PRIMARY KEY (`idbeliproduk`),
  ADD KEY `idbeli` (`idbeli`),
  ADD KEY `idtanam` (`idtanam`);

--
-- Indexes for table `flashsale`
--
ALTER TABLE `flashsale`
  ADD PRIMARY KEY (`idflash`),
  ADD KEY `idtanam` (`idtanam`);

--
-- Indexes for table `kirim`
--
ALTER TABLE `kirim`
  ADD PRIMARY KEY (`idkirim`),
  ADD KEY `idbeli` (`idbeli`),
  ADD KEY `idkurir` (`idkurir`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`idkurir`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`idongkir`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`idpengeluaran`);

--
-- Indexes for table `tanam`
--
ALTER TABLE `tanam`
  ADD PRIMARY KEY (`idtanam`);

--
-- Indexes for table `tanammasuk`
--
ALTER TABLE `tanammasuk`
  ADD PRIMARY KEY (`idtanammasuk`),
  ADD KEY `idtanam` (`idtanam`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beli`
--
ALTER TABLE `beli`
  MODIFY `idbeli` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `beliproduk`
--
ALTER TABLE `beliproduk`
  MODIFY `idbeliproduk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `flashsale`
--
ALTER TABLE `flashsale`
  MODIFY `idflash` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kirim`
--
ALTER TABLE `kirim`
  MODIFY `idkirim` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `idkurir` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `idongkir` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `idpengeluaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tanam`
--
ALTER TABLE `tanam`
  MODIFY `idtanam` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tanammasuk`
--
ALTER TABLE `tanammasuk`
  MODIFY `idtanammasuk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beliproduk`
--
ALTER TABLE `beliproduk`
  ADD CONSTRAINT `beliproduk_ibfk_1` FOREIGN KEY (`idbeli`) REFERENCES `beli` (`idbeli`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
