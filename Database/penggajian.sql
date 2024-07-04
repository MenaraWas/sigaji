-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 12:21 PM
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
(1, 'Target', '25000', 'Tambahan Bonus'),
(2, 'Pegawai Terbaik', '500000', 'Pegawai Terbaik');

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
  `status_pengajuan` enum('Diterima','Ditolak','Proses') NOT NULL,
  `catatan` text NOT NULL,
  `nip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_gaji`
--

INSERT INTO `data_gaji` (`no_slip_gaji`, `tgl_gaji`, `tot_gapok`, `id_tunjangan`, `id_potongan`, `id_bonus`, `gaji_bersih`, `gaji_kotor`, `status_pengajuan`, `catatan`, `nip`) VALUES
(35, '2024-06-01', '1500000', 15000, 200000, 25000, '1340000', '1540000', 'Diterima', '', 215610058),
(37, '2024-07-01', '250000', 15000, 200000, 500000, '565000', '765000', 'Proses', '', 215610054),
(38, '2024-07-01', '23123213', 0, 0, 0, '23123213', '23123213', 'Proses', '', 215610055),
(39, '2024-07-01', '4', 15000, 0, 25000, '40004', '40004', 'Proses', '', 215610053);

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
(6, 'Kiper');

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
(94, '2024-06', 215610058, 'Bintang Nasution', 12, 1, 11, 2),
(95, '2024-07', 215610057, 'alex', 34, 2, 33, 1),
(96, '2024-06', 215610056, 'blo', 11, 3, 2, 4),
(97, '2024-06', 215610059, 'anderson', 12, 10, 11, 11),
(98, '2024-05', 215610053, 'wanto', 12, 2, 11, 0),
(99, '2024-06', 215610054, 'ww', 12, 10, 11, 2);

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
(215610052, 'wwe', 'ww@mail.com', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'HRD', '2024-06-08', '', 3, 'Karyawan Tidak Tetap', 'shadhdsh', '0', '123'),
(215610053, 'wanto', 'wan@wan.com', '7363a0d0604902af7b70b271a0b96480', 'Perempuan', 'Admin', '2024-06-01', '', 1, 'Karyawan Tidak Tetap', '23213123', '4', '23213123'),
(215610054, 'ww', 'waa@mas.com', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'Staff Marketing', '2024-06-01', '', 2, 'Karyawan Tetap', 'sleman', '250000', '2222'),
(215610055, 'heh', '', '', 'Laki-Laki', 'Admin', '2024-06-01', '', 0, 'Karyawan Tetap', 'sjsjdja', '23123213', '1231'),
(215610056, 'blo', '', '', 'Laki-Laki', 'Staff Marketing', '2024-06-08', '', 0, 'Karyawan Tetap', 'heheh', '2121', '222'),
(215610057, 'alex', 'tomupdate@mail.com', 'd9b1d7db4cd6e70935368a1efb10e377', '', 'Staff Marketing', '2024-06-01', '', 2, '', 'tiksjfd', '1000000', '1232'),
(215610058, 'Bintang Nasution', 'bintang@mail.com', '202cb962ac59075b964b07152d234b70', '', 'Admin', '2024-06-07', '', 1, '', 'hshs', '1500000', '123'),
(215610059, 'anderson', 'ander@mail.com', '202cb962ac59075b964b07152d234b70', '', 'Staff Marketing', '2024-06-01', '', 1, '', 'whwh', '1000000', '123');

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
(5, 'Lembur update', '50000', 'Tambahan Uang Lembur'),
(6, 'Uang Makan', '15000', 'Tambahan Uang Makan'),
(7, 'Tunjangan Jabatan', '15000', 'Tunjangan Jabatan'),
(8, 'Tunjangan Transportasi', '50000', 'Transportasi'),
(9, 'Hari Raya', '150000', 'Hari Raya');

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
(9, 215610052, 'ww@mail.com', '202cb962ac59075b964b07152d234b70', '3'),
(10, 215610053, 'wan@wan.com', '202cb962ac59075b964b07152d234b70', '3'),
(11, 215610054, 'waa@mas.com', '202cb962ac59075b964b07152d234b70', '2'),
(13, 215610057, 'tomupdate@mail.com', 'd9b1d7db4cd6e70935368a1efb10e377', '2'),
(14, 215610058, 'bintang@mail.com', '202cb962ac59075b964b07152d234b70', '1'),
(15, 215610059, 'ander@mail.com', '202cb962ac59075b964b07152d234b70', '1');

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
(1, 35, 15000, 200000, 25000),
(2, 36, 15000, 0, 25000),
(3, 37, 15000, 200000, 500000),
(4, 39, 15000, 0, 25000);

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
-- Table structure for table `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `id_jurnal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `debit` decimal(15,2) NOT NULL,
  `kredit` decimal(15,2) NOT NULL,
  `no_slip_gaji` int(11) NOT NULL,
  `jenis` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurnal_umum`
--

INSERT INTO `jurnal_umum` (`id_jurnal`, `tanggal`, `keterangan`, `debit`, `kredit`, `no_slip_gaji`, `jenis`) VALUES
(63, '2024-06-07', 'Hutang Gaji', '40000.00', '0.00', 0, 'Debit'),
(64, '2024-06-07', 'Kas', '0.00', '40000.00', 0, 'Kredit'),
(65, '2024-07-01', 'Hutang Gaji', '565000.00', '0.00', 0, 'Debit'),
(66, '2024-07-01', 'Kas', '0.00', '565000.00', 0, 'Kredit'),
(67, '2024-07-01', 'Hutang Gaji', '40004.00', '0.00', 0, 'Debit'),
(68, '2024-07-01', 'Kas', '0.00', '40004.00', 0, 'Kredit'),
(69, '2024-07-04', 'Hutang gaji bulan 2024-07', '23728217.00', '0.00', 0, 'Debit'),
(70, '2024-07-04', 'Kas', '0.00', '23728217.00', 0, 'Kredit'),
(71, '2024-07-04', 'Hutang gaji bulan 2024-07', '23728217.00', '0.00', 0, 'Debit'),
(72, '2024-07-04', 'Kas', '0.00', '23728217.00', 0, 'Kredit'),
(73, '2024-07-04', 'Hutang gaji bulan 2024-07', '23728217.00', '0.00', 0, 'Debit'),
(74, '2024-07-04', 'Kas', '0.00', '23728217.00', 0, 'Kredit');

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
(3, 'Tanpa Keterangan', 100000, 'Tidak Hadir Tanpa Keterangan');

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
-- Indexes for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD PRIMARY KEY (`id_jurnal`);

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
  MODIFY `no_slip_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `data_tunjangan`
--
ALTER TABLE `data_tunjangan`
  MODIFY `Kode_Tunjangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  MODIFY `id_detail_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `potongan_gaji`
--
ALTER TABLE `potongan_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
