-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2019 at 03:18 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_detail`
--

CREATE TABLE `tbl_invoice_detail` (
  `id_detail` int(15) NOT NULL,
  `no_invoice` varchar(25) NOT NULL,
  `account_code` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `amount` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice_detail`
--

INSERT INTO `tbl_invoice_detail` (`id_detail`, `no_invoice`, `account_code`, `description`, `amount`) VALUES
(1, 'B234DCR45', 'BC2332', 'BAJU', 60000),
(2, 'B234DCR45', 'dsfsdf', 'df', 70000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_master`
--

CREATE TABLE `tbl_invoice_master` (
  `no_invoice` varchar(25) NOT NULL,
  `no_job_order` varchar(25) NOT NULL,
  `remarks` text NOT NULL,
  `tujuan` text NOT NULL,
  `total` bigint(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice_master`
--

INSERT INTO `tbl_invoice_master` (`no_invoice`, `no_job_order`, `remarks`, `tujuan`, `total`, `tanggal`) VALUES
('B234DCR45', '1001', 'test', 'BOGOR', 130000, '2019-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_order`
--

CREATE TABLE `tbl_job_order` (
  `no_job_order` varchar(25) NOT NULL,
  `customer_code` varchar(50) NOT NULL,
  `no_pib_peb` varchar(25) NOT NULL,
  `no_b_l` varchar(25) NOT NULL,
  `vessel` text NOT NULL,
  `eta` date NOT NULL,
  `port_loading` text NOT NULL,
  `port_destination` text NOT NULL,
  `tps_warehouse` text NOT NULL,
  `bc_tgl` text NOT NULL,
  `party_volume` text NOT NULL,
  `description_of_goods` text NOT NULL,
  `no_container` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_order`
--

INSERT INTO `tbl_job_order` (`no_job_order`, `customer_code`, `no_pib_peb`, `no_b_l`, `vessel`, `eta`, `port_loading`, `port_destination`, `tps_warehouse`, `bc_tgl`, `party_volume`, `description_of_goods`, `no_container`) VALUES
('1001', 'DS 4008 KJ', 'NMAA', 'BNDS', 'dsad', '2019-03-11', 'dzc', 'zsc', 'zsc', 'asc', 'dfv', 'vsd', 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kasbon_detail`
--

CREATE TABLE `tbl_kasbon_detail` (
  `id` int(11) NOT NULL,
  `no_kasbon` varchar(15) NOT NULL,
  `pengeluaran` text NOT NULL,
  `kode_rek` varchar(35) NOT NULL,
  `jumlah` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kasbon_detail`
--

INSERT INTO `tbl_kasbon_detail` (`id`, `no_kasbon`, `pengeluaran`, `kode_rek`, `jumlah`) VALUES
(1, '7887gghg', 'sada', 'asds', 90000),
(2, '7887gghg', 'hgfhgf', 'hjh77', 100000),
(3, 'asd', 'dsf', 'sf', 56000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kasbon_master`
--

CREATE TABLE `tbl_kasbon_master` (
  `no_kasbon` varchar(15) NOT NULL,
  `untuk` varchar(35) NOT NULL,
  `total` bigint(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kasbon_master`
--

INSERT INTO `tbl_kasbon_master` (`no_kasbon`, `untuk`, `total`, `tanggal`) VALUES
('7887gghg', 'Batu Bara', 190000, '0000-00-00'),
('asd', 'sad', 56000, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_jalan_detail`
--

CREATE TABLE `tbl_surat_jalan_detail` (
  `id` int(11) NOT NULL,
  `no_surat_jalan` int(15) NOT NULL,
  `no_merk` varchar(100) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `jumlah_barang` int(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_surat_jalan_detail`
--

INSERT INTO `tbl_surat_jalan_detail` (`id`, `no_surat_jalan`, `no_merk`, `jenis_barang`, `jumlah_barang`, `keterangan`) VALUES
(1, 1001, '23', 'sdcd', 0, 'sdcds');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_jalan_master`
--

CREATE TABLE `tbl_surat_jalan_master` (
  `id_surat_jalan` int(11) NOT NULL,
  `no` int(15) NOT NULL,
  `tujuan` text NOT NULL,
  `asal` text NOT NULL,
  `no_polisi` varchar(15) NOT NULL,
  `pemilik_angkutan` text NOT NULL,
  `no_do` varchar(25) NOT NULL,
  `emkl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_surat_jalan_master`
--

INSERT INTO `tbl_surat_jalan_master` (`id_surat_jalan`, `no`, `tujuan`, `asal`, `no_polisi`, `pemilik_angkutan`, `no_do`, `emkl`) VALUES
(1, 1001, 'ded', 'ed', 'D4545ga', 'dec', 'ecde', 'efcde');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_invoice_detail`
--
ALTER TABLE `tbl_invoice_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tbl_invoice_master`
--
ALTER TABLE `tbl_invoice_master`
  ADD PRIMARY KEY (`no_invoice`),
  ADD UNIQUE KEY `no_invoice` (`no_invoice`);

--
-- Indexes for table `tbl_job_order`
--
ALTER TABLE `tbl_job_order`
  ADD PRIMARY KEY (`no_job_order`),
  ADD UNIQUE KEY `no_job_order` (`no_job_order`);

--
-- Indexes for table `tbl_kasbon_detail`
--
ALTER TABLE `tbl_kasbon_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kasbon_master`
--
ALTER TABLE `tbl_kasbon_master`
  ADD PRIMARY KEY (`no_kasbon`),
  ADD UNIQUE KEY `no_kasbon` (`no_kasbon`);

--
-- Indexes for table `tbl_surat_jalan_detail`
--
ALTER TABLE `tbl_surat_jalan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_surat_jalan_master`
--
ALTER TABLE `tbl_surat_jalan_master`
  ADD PRIMARY KEY (`id_surat_jalan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_invoice_detail`
--
ALTER TABLE `tbl_invoice_detail`
  MODIFY `id_detail` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_kasbon_detail`
--
ALTER TABLE `tbl_kasbon_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_surat_jalan_detail`
--
ALTER TABLE `tbl_surat_jalan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_surat_jalan_master`
--
ALTER TABLE `tbl_surat_jalan_master`
  MODIFY `id_surat_jalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
