-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2021 at 06:47 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendataan_alumni_fti`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `nim` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kode_jurusan` varchar(100) NOT NULL,
  `ipk` double NOT NULL,
  `instansi` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `alumni_sosial_media`
--

CREATE TABLE `alumni_sosial_media` (
  `nim` varchar(100) NOT NULL,
  `kode_sosial_media` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `kode_jurusan` varchar(100) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kode_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_organisasi`
--

CREATE TABLE `riwayat_organisasi` (
  `nim` varchar(100) NOT NULL,
  `no_urut` varchar(100) NOT NULL,
  `nama_organisasi` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sosial_media`
--

CREATE TABLE `sosial_media` (
  `kode_sosial_media` varchar(100) NOT NULL,
  `nama_sosial_media` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staf_fakultas`
--

CREATE TABLE `staf_fakultas` (
  `nip` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staf_fakultas`
--

INSERT INTO `staf_fakultas` (`nip`, `nama`) VALUES
('1234567890', 'Steven');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nim_nip` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nim_nip`, `password`, `role`) VALUES
('1234567890', '$2y$10$YIkSagzeHx6KrdxFkPU92uDJb8qNb8kYU.GQDK2HJk7q1bDmM71Pe', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `kode_jurusan` (`kode_jurusan`);

--
-- Indexes for table `alumni_sosial_media`
--
ALTER TABLE `alumni_sosial_media`
  ADD PRIMARY KEY (`nim`,`kode_sosial_media`),
  ADD KEY `kode_sosial_media` (`kode_sosial_media`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`kode_jurusan`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `kode_jurusan` (`kode_jurusan`);

--
-- Indexes for table `riwayat_organisasi`
--
ALTER TABLE `riwayat_organisasi`
  ADD PRIMARY KEY (`nim`,`no_urut`);

--
-- Indexes for table `sosial_media`
--
ALTER TABLE `sosial_media`
  ADD PRIMARY KEY (`kode_sosial_media`);

--
-- Indexes for table `staf_fakultas`
--
ALTER TABLE `staf_fakultas`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nim_nip`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni`
--
ALTER TABLE `alumni`
  ADD CONSTRAINT `alumni_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `user` (`nim_nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumni_ibfk_2` FOREIGN KEY (`kode_jurusan`) REFERENCES `jurusan` (`kode_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `alumni_sosial_media`
--
ALTER TABLE `alumni_sosial_media`
  ADD CONSTRAINT `alumni_sosial_media_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `alumni` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumni_sosial_media_ibfk_2` FOREIGN KEY (`kode_sosial_media`) REFERENCES `sosial_media` (`kode_sosial_media`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `user` (`nim_nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`kode_jurusan`) REFERENCES `jurusan` (`kode_jurusan`);

--
-- Constraints for table `riwayat_organisasi`
--
ALTER TABLE `riwayat_organisasi`
  ADD CONSTRAINT `riwayat_organisasi_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `alumni` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staf_fakultas`
--
ALTER TABLE `staf_fakultas`
  ADD CONSTRAINT `staf_fakultas_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `user` (`nim_nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
