-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 08:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_bonus`
--

CREATE TABLE `data_bonus` (
  `Kode_Bonus` int(11) NOT NULL,
  `Nama_Bonus` varchar(25) NOT NULL,
  `Jumlah_Bonus` decimal(12,0) NOT NULL,
  `Keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `data_bonus`
--

INSERT INTO `data_bonus` (`Kode_Bonus`, `Nama_Bonus`, `Jumlah_Bonus`, `Keterangan`) VALUES
(1, 'makan siang', '20000', 'tambahan uang '),
(2, 'makan siang', '20000', 'tambahan');

-- --------------------------------------------------------

--
-- Table structure for table `data_gaji`
--

CREATE TABLE `data_gaji` (
  `no_slip_gaji` int(11) NOT NULL,
  `tgl_gaji` date NOT NULL,
  `tot_gapok` decimal(12,0) NOT NULL,
  `id_tunjangan` int(11) NOT NULL,
  `id_potongan` int(11) NOT NULL,
  `id_bonus` int(11) NOT NULL,
  `gaji_bersih` decimal(12,0) NOT NULL,
  `gaji_kotor` decimal(12,0) NOT NULL,
  `status_pengajuan` enum('opsi1','opsi2') NOT NULL,
  `catatan` text NOT NULL,
  `nip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_gaji`
--

INSERT INTO `data_gaji` (`no_slip_gaji`, `tgl_gaji`, `tot_gapok`, `id_tunjangan`, `id_potongan`, `id_bonus`, `gaji_bersih`, `gaji_kotor`, `status_pengajuan`, `catatan`, `nip`) VALUES
(1, '2024-06-01', '0', 1, 2, 2, '0', '0', '', '', 215610048),
(3, '2024-06-29', '0', 0, 0, 0, '0', '0', 'opsi1', '', 215610055),
(4, '2024-06-15', '0', 0, 0, 0, '0', '0', 'opsi1', '', 215610052),
(5, '2024-06-07', '0', 0, 0, 0, '0', '0', 'opsi1', '', 215610056),
(6, '2024-06-15', '0', 0, 0, 0, '0', '0', 'opsi1', '', 215610051),
(7, '2024-06-14', '0', 0, 0, 0, '0', '0', 'opsi1', '', 215610055);

-- --------------------------------------------------------

--
-- Table structure for table `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'HRD'),
(2, 'Staff Marketing'),
(3, 'Admin'),
(4, 'Sales'),
(5, 'hahahaha'),
(6, 'Kiper'),
(7, 'Striker');

-- --------------------------------------------------------

--
-- Table structure for table `data_kehadiran`
--

CREATE TABLE `data_kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `bulan` varchar(15) NOT NULL,
  `nip` int(16) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `hadir` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `ijin` int(11) NOT NULL,
  `alpha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_kehadiran`
--

INSERT INTO `data_kehadiran` (`id_kehadiran`, `bulan`, `nip`, `nama_pegawai`, `hadir`, `sakit`, `ijin`, `alpha`) VALUES
(5, '052024', 215610048, 'Bintang Nasution', 1, 2, 0, 0),
(7, '052024', 215610049, 'Chairul', 6, 0, 0, 0),
(56, '062024', 215610048, 'Bintang Nasution', 5, 0, 0, 0),
(57, '062024', 215610056, 'blo', 5, 0, 0, 0),
(58, '062024', 215610049, 'Chairul', 0, 0, 5, 0),
(59, '062024', 215610055, 'heh', 0, 5, 0, 0),
(60, '062024', 215610051, 'manajer bos', 0, 5, 0, 0),
(61, '062024', 215610053, 'wanto', 0, 0, 0, 0),
(62, '062024', 215610054, 'ww', 0, 0, 5, 0),
(63, '062024', 215610052, 'wwe', 0, 0, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `nip` int(16) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `photo` varchar(100) NOT NULL,
  `hak_akses` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `alamat` varchar(99) NOT NULL,
  `gaji_pokok` decimal(12,0) NOT NULL,
  `no_telp` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`nip`, `nama_pegawai`, `email`, `password`, `jenis_kelamin`, `jabatan`, `tgl_lahir`, `photo`, `hak_akses`, `status`, `alamat`, `gaji_pokok`, `no_telp`) VALUES
(215610048, 'Bintang Nasution', 'bintangnasution._', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'Admin', '2024-05-29', '', 1, 'Karyawan Tetap', 'sleman', '2500000', '0123456789'),
(215610049, 'Chairul', 'chairul', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'Staff Marketing', '2024-05-29', '', 1, 'Karyawan Tidak Tetap', 'bantul', '500000000', '012345678'),
(215610051, 'manajer bos', 'man', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'Staff Marketing', '2024-06-07', '', 2, 'Karyawan Tidak Tetap', 'sols', '150000', '12356666'),
(215610052, 'wwe', 'ww@mail.com', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'HRD', '2024-06-08', '', 3, 'Karyawan Tidak Tetap', '', '0', ''),
(215610053, 'wanto', 'wan@wan.com', '7363a0d0604902af7b70b271a0b96480', 'Perempuan', 'Admin', '2024-06-01', '', 1, 'Karyawan Tidak Tetap', '', '0', ''),
(215610054, 'ww', 'waa@mas.com', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'Staff Marketing', '2024-06-01', '', 2, 'Karyawan Tetap', 'sleman', '250000', '2222'),
(215610055, 'heh', 'heh@heh.com', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'Admin', '2024-06-01', '', 1, 'Karyawan Tetap', 'sjsjdja', '23123213', '1231'),
(215610056, 'blo', '', '', 'Laki-Laki', 'Staff Marketing', '2024-06-08', '', 0, 'Karyawan Tetap', 'heheh', '2121', '222');

-- --------------------------------------------------------

--
-- Table structure for table `data_tunjangan`
--

CREATE TABLE `data_tunjangan` (
  `Kode_Tunjangan` int(11) NOT NULL,
  `Nama_Tunjangan` varchar(50) NOT NULL,
  `Jumlah_Tunjangan` decimal(12,0) NOT NULL,
  `Keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `data_tunjangan`
--

INSERT INTO `data_tunjangan` (`Kode_Tunjangan`, `Nama_Tunjangan`, `Jumlah_Tunjangan`, `Keterangan`) VALUES
(1, 'Makan', '13000', 'tambahan'),
(2, 'uang pagi', '10000', 'tambah makan'),
(3, 'uang pagi', '20000', 'makan');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_user` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `Level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `nip`, `email`, `password`, `Level`) VALUES
(1, 0, 'bintangnasution._', '202cb962ac59075b964b07152d234b70', '1'),
(2, 0, 'chairul', '30cd2f99101cdd52cc5fda1e996ee137', '1'),
(8, 0, 'hah', '202cb962ac59075b964b07152d234b70', '2'),
(9, 0, 'ww@mail.com', '202cb962ac59075b964b07152d234b70', '3'),
(10, 0, 'wan@wan.com', '202cb962ac59075b964b07152d234b70', '3'),
(11, 0, 'waa@mas.com', '202cb962ac59075b964b07152d234b70', '2'),
(12, 215610055, 'heh@heh.com', '202cb962ac59075b964b07152d234b70', '1');

-- --------------------------------------------------------

--
-- Table structure for table `detail_gaji`
--

CREATE TABLE `detail_gaji` (
  `id_detail_gaji` int(11) NOT NULL,
  `no_slip_gaji` int(11) NOT NULL,
  `id_tunjangan` int(11) NOT NULL,
  `id_potongan` int(11) NOT NULL,
  `id_bonus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_gaji`
--

INSERT INTO `detail_gaji` (`id_detail_gaji`, `no_slip_gaji`, `id_tunjangan`, `id_potongan`, `id_bonus`) VALUES
(1, 1, 2, 1, 1),
(2, 2, 2, 1, 1),
(3, 1, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `keterangan`, `hak_akses`) VALUES
(1, 'admin', 1),
(2, 'pegawai', 2),
(3, 'manager', 3);

-- --------------------------------------------------------

--
-- Table structure for table `potongan_gaji`
--

CREATE TABLE `potongan_gaji` (
  `id` int(11) NOT NULL,
  `potongan` varchar(120) NOT NULL,
  `jml_potongan` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `potongan_gaji`
--

INSERT INTO `potongan_gaji` (`id`, `potongan`, `jml_potongan`, `keterangan`) VALUES
(1, 'lemburr', 20000, 'tambahan waktu kerja'),
(2, 'alpha', 20000, 'pasien sakit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_bonus`
--
ALTER TABLE `data_bonus`
  ADD PRIMARY KEY (`Kode_Bonus`);

--
-- Indexes for table `data_gaji`
--
ALTER TABLE `data_gaji`
  ADD PRIMARY KEY (`no_slip_gaji`);

--
-- Indexes for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `data_tunjangan`
--
ALTER TABLE `data_tunjangan`
  ADD PRIMARY KEY (`Kode_Tunjangan`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  ADD PRIMARY KEY (`id_detail_gaji`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `potongan_gaji`
--
ALTER TABLE `potongan_gaji`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_bonus`
--
ALTER TABLE `data_bonus`
  MODIFY `Kode_Bonus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_gaji`
--
ALTER TABLE `data_gaji`
  MODIFY `no_slip_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `data_tunjangan`
--
ALTER TABLE `data_tunjangan`
  MODIFY `Kode_Tunjangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  MODIFY `id_detail_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `potongan_gaji`
--
ALTER TABLE `potongan_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
