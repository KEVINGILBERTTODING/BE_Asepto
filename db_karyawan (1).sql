-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 07:46 AM
-- Server version: 10.4.13-MariaDB-log
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` char(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` int(11) NOT NULL,
  `hash_key` varchar(255) DEFAULT NULL,
  `hash_expiry` varchar(50) DEFAULT NULL,
  `created_date` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `nama`, `telp`, `email`, `username`, `password`, `role`, `hash_key`, `hash_expiry`, `created_date`) VALUES
('1', 'test', '34234', 'xyz480167@gmail.com', 'coba', 'c3ec0f7b054e729c5a716c8125839829', 1, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `catatan_tambahan`
--

CREATE TABLE `catatan_tambahan` (
  `catatan_id` char(20) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catatan_tambahan`
--

INSERT INTO `catatan_tambahan` (`catatan_id`, `catatan`, `tanggal_event`) VALUES
('NOTE-2022-00001', 'test', '2022-10-20 19:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `project_id` char(20) NOT NULL,
  `karyawan_id` char(20) NOT NULL,
  `nama_project` varchar(150) NOT NULL,
  `feedback` text NOT NULL,
  `admin_id` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `project_id`, `karyawan_id`, `nama_project`, `feedback`, `admin_id`) VALUES
(12, 'PRJ-2022-00002', 'KN-2022-00002', 'project2', 'belum selesai', '1'),
(13, 'PRJ-2022-00002', 'KN-2022-00002', 'project2', 'coba\r\n', '1'),
(14, 'PRJ-2022-00002', 'KN-2022-00001', 'project2', 'tets', '1');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `karyawan_id` char(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `norekening` varchar(20) NOT NULL,
  `bank` varchar(20) NOT NULL,
  `jeniskel` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`karyawan_id`, `nama`, `email`, `jabatan`, `telp`, `norekening`, `bank`, `jeniskel`) VALUES
('KN-2022-00001', 'Karyawan ABC', 'xyz480167@gmail.com', '', '34343', '232423', 'bri', 'L'),
('KN-2022-00002', 'Karyawan DEF', 'coba@mail.com', '', '8834934', '98989823', 'BRI', 'L'),
('KN-2022-00003', 'Karyawan FGH', 'f', '', '343', '3434', 'BRI', 'P'),
('KN-2022-00004', 'Karyawan IJK', 'ijaya4830@gmail.com', 'Branding Designer', '081215914468', '081215914468', 'BRI', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_karyawan`
--

CREATE TABLE `pembayaran_karyawan` (
  `id_pembayaran` int(11) NOT NULL,
  `project_id` char(20) NOT NULL,
  `karyawan_id` char(20) NOT NULL,
  `admin_id` char(20) NOT NULL,
  `nama_project` varchar(150) NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `nominal_dibayarkan` double NOT NULL,
  `nominal_bonus` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran_karyawan`
--

INSERT INTO `pembayaran_karyawan` (`id_pembayaran`, `project_id`, `karyawan_id`, `admin_id`, `nama_project`, `tgl_bayar`, `bukti_transfer`, `nominal_dibayarkan`, `nominal_bonus`) VALUES
(1, 'PRJ-2022-00001', 'KN-2022-00001', '1', '', '0000-00-00 00:00:00', '', 10000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `progress_id` int(11) NOT NULL,
  `project_id` char(20) NOT NULL,
  `karyawan_id` char(20) NOT NULL,
  `jabatan` varchar(150) NOT NULL,
  `nama_project` varchar(150) NOT NULL,
  `progress` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`progress_id`, `project_id`, `karyawan_id`, `jabatan`, `nama_project`, `progress`, `keterangan`, `tanggal`) VALUES
(1, '', 'KN-2022-00001', 'Marketing', 'contoh', 'selesai', 'Lorem ipsum dolore?', '2023-06-10 12:24:29'),
(2, 'PRJ-2022-00002', 'KN-2022-00001', 'Sales', 'contoh', 'selesai', 'Simply dummy text', '2023-06-10 12:25:01'),
(3, 'PRJ-2022-00002', 'KN-2022-00003', 'Programmer', 'Project 2', '100', 'Aldus PageMaker', '2022-12-30 10:58:34'),
(4, 'PRJ-2022-00002', 'KN-2022-00004', 'Manajer Proyek', 'Project 2', '50', 'Essentially unchanged', '2022-11-11 16:52:12'),
(5, 'PRJ-2022-00003', 'KN-2022-00001', 'Akuntan', 'Project 2', '25', 'Contrary to popular belief', '2022-12-30 10:58:34'),
(6, 'PRJ-2022-00003', 'KN-2022-00003', 'Digital Marketing', 'Project 2', '50', 'Renaissance', '2022-12-30 10:58:34'),
(7, 'PRJ-2022-00001', 'KN-2022-00001', 'Mandor', 'Project 7', '50', 'Injected humour', '2022-11-17 17:08:02'),
(8, 'PRJ-2022-00001', 'KN-2022-00002', 'Kuli', 'Project 8', '75', 'Like readable English', '2022-12-30 11:00:49'),
(9, 'PRJ-2022-00004', 'KN-2022-00004', 'Branding Designer', 'Project 9', '100', 'Content here, content here', '2022-12-30 16:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `project_id` char(20) NOT NULL,
  `nama_project` varchar(150) NOT NULL,
  `deskripsi_project` text NOT NULL,
  `kategori` varchar(150) NOT NULL,
  `gambar_project` varchar(255) DEFAULT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `email_perusahaan` varchar(50) NOT NULL,
  `tipe_perusahaan` char(10) NOT NULL,
  `budget` double NOT NULL,
  `karyawan_id` char(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_id`, `nama_project`, `deskripsi_project`, `kategori`, `gambar_project`, `tgl_mulai`, `tgl_selesai`, `nama_perusahaan`, `email_perusahaan`, `tipe_perusahaan`, `budget`, `karyawan_id`, `nama`, `status`) VALUES
(1, 'PRJ-2022-00001', 'Project 1', 'Ini Project Ke-1', '', '', '2022-10-24 22:18:00', '2022-10-31 22:18:00', 'contoh', 'contoh@mail.com', 'Small', 0, '', '', 1),
(2, 'PRJ-2022-00002', 'Project 2', 'Ini Project Ke-2', '', '', '2022-11-12 16:49:00', '2022-11-13 16:49:00', 'PT.ABC', 'abc@gmail.com', 'Big', 0, '', '', 1),
(3, 'PRJ-2022-00003', 'Project 3', 'Ini Project Ke-3', '', '', '2022-12-29 11:25:00', '2022-12-31 11:37:00', 'ada', 'test@mail.com', 'Small', 0, '', '', 0),
(4, 'PRJ-2022-00004', 'Project 4', 'Ini Project Ke-4', 'Web', NULL, '2022-12-30 21:50:00', '2022-12-31 21:52:00', 'no', 'f@mail.com', '', 0, '', '', 0),
(5, 'PRJ-2022-00005', 'Project 5', 'Ini Project Ke-5', 'Animation', NULL, '2022-12-31 21:56:00', '0000-00-00 00:00:00', 'sd', 'xyz480167@gmail.com', 'Small', 0, '', '', 0),
(6, 'PRJ-2022-00006', 'Project 6', 'Ini Project Ke-6', 'Photo Studio', NULL, '2022-12-31 21:56:00', '0000-00-00 00:00:00', 'pt photo', 'phtphoto@gmail.com', 'Small', 0, '', '', 0),
(7, 'PRJ-2022-00007', 'Project 7', 'Ini Project Ke-8', 'Kuli', NULL, '2022-12-31 21:56:00', '0000-00-00 00:00:00', 'pt kuli', 'ptkuli@gmail.com', 'Small', 0, '', '', 0),
(8, 'PRJ-2023-00008', 'w', 'e', 'Web', NULL, '2023-01-19 16:31:00', '2023-01-20 16:31:00', 'd', 'test@mail.com', '', 100000, 'KN-2022-00001', 'Karyawan ABC', 0),
(9, 'PRJ-2023-00008', 'w', 'e', 'Web', NULL, '2023-01-19 17:05:00', '2023-01-20 17:05:00', 'd', 'test@mail.com', '', 100000, 'KN-2022-00002', 'Karyawan DEF', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `catatan_tambahan`
--
ALTER TABLE `catatan_tambahan`
  ADD PRIMARY KEY (`catatan_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`karyawan_id`);

--
-- Indexes for table `pembayaran_karyawan`
--
ALTER TABLE `pembayaran_karyawan`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`progress_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pembayaran_karyawan`
--
ALTER TABLE `pembayaran_karyawan`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
