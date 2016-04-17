-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2015 at 03:57 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `db_pengukur_kepuasan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_complain`
--

CREATE TABLE `tb_complain` (
  `id` int(7) NOT NULL auto_increment,
  `kode_complain` varchar(14) collate latin1_general_ci NOT NULL,
  `pelanggan_id` int(6) NOT NULL,
  `pegawai_id` int(9) NOT NULL,
  `jenis_complain_id` int(4) NOT NULL,
  `tanggal_complain` date NOT NULL,
  `status` enum('Sudah Diperbaiki','Belum Diperbaiki') collate latin1_general_ci NOT NULL,
  `tanggal_perbaikan` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=66 ;

--
-- Dumping data for table `tb_complain`
--

INSERT INTO `tb_complain` (`id`, `kode_complain`, `pelanggan_id`, `pegawai_id`, `jenis_complain_id`, `tanggal_complain`, `status`, `tanggal_perbaikan`) VALUES
(65, '1571500030005', 30, 46, 7, '2015-08-16', 'Belum Diperbaiki', '0000-00-00'),
(64, '1591500010004', 26, 46, 9, '2015-08-18', 'Sudah Diperbaiki', '2015-08-19'),
(63, '1581500020003', 27, 46, 8, '2015-08-11', 'Sudah Diperbaiki', '2015-08-19'),
(62, '1571500010002', 26, 46, 7, '2015-07-08', 'Sudah Diperbaiki', '2015-08-17'),
(61, '1581500010001', 26, 46, 7, '2015-07-15', 'Sudah Diperbaiki', '2015-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_kepuasan`
--

CREATE TABLE `tb_data_kepuasan` (
  `id` int(4) NOT NULL auto_increment,
  `jenis_complain_id` int(4) NOT NULL,
  `pengukuran` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `tb_data_kepuasan`
--

INSERT INTO `tb_data_kepuasan` (`id`, `jenis_complain_id`, `pengukuran`) VALUES
(36, 8, 'keseluruhan: bila point complain lebih dari 100 berati kebanyakan pelanggan tidak puas '),
(38, 7, 'keseluruhan: bila point complain lebih dari 100 berati kebanyakan pelanggan tidak puas '),
(41, 12, 'keseluruhan: bila point complain lebih dari 100 berati kebanyakan pelanggan tidak puas '),
(40, 9, 'keseluruhan: bila point complain lebih dari 100 berati kebanyakan pelanggan tidak puas ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_complain`
--

CREATE TABLE `tb_jenis_complain` (
  `id` int(4) NOT NULL auto_increment,
  `nama` varchar(255) collate latin1_general_ci NOT NULL,
  `point` double NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tb_jenis_complain`
--

INSERT INTO `tb_jenis_complain` (`id`, `nama`, `point`) VALUES
(8, 'Chanel tidak ada', 1),
(7, 'Gambar Putus-putus', 1),
(9, 'Layar warna biru', 1),
(12, 'layar blank', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id` int(4) NOT NULL auto_increment,
  `kode_pegawai` varchar(15) collate latin1_general_ci NOT NULL,
  `nama` varchar(255) collate latin1_general_ci NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `alamat` text collate latin1_general_ci NOT NULL,
  `telepon` varchar(255) collate latin1_general_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') collate latin1_general_ci NOT NULL,
  `type` enum('Customer Service','Teknisi') collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=50 ;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id`, `kode_pegawai`, `nama`, `tahun_masuk`, `alamat`, `telepon`, `jenis_kelamin`, `type`) VALUES
(46, '111150001', 'furqon', 2015, 'jl.Cendana 2', '08921212121', 'Laki-laki', 'Teknisi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id` int(6) NOT NULL auto_increment,
  `id_pelanggan` varchar(6) collate latin1_general_ci NOT NULL,
  `nama` varchar(255) collate latin1_general_ci NOT NULL,
  `alamat` text collate latin1_general_ci NOT NULL,
  `telepon` varchar(255) collate latin1_general_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id`, `id_pelanggan`, `nama`, `alamat`, `telepon`, `jenis_kelamin`) VALUES
(30, '150003', 'dedi', 'jl.cendana', '0878787878787', 'Laki-laki'),
(27, '150002', 'Rendi', 'jl.antasari no 2', '09099999900', 'Laki-laki'),
(26, '150001', 'Diki', 'jl.ratu dibalau', '08912121431', 'Laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(4) NOT NULL auto_increment,
  `pegawai_id` int(9) NOT NULL,
  `username` varchar(255) collate latin1_general_ci NOT NULL,
  `password` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=69 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `pegawai_id`, `username`, `password`) VALUES
(34, 25, 'nurul', 'baam121'),
(29, 22, 'admin1234', 'admin12'),
(25, 19, 'admin', 'admin123'),
(63, 28, 'admin1234', 'admin124'),
(68, 46, 'admin', 'admin');
