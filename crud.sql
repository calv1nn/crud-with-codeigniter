-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 24, 2014 at 12:44 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE IF NOT EXISTS `konsumen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id`, `name`, `gender`, `dob`) VALUES
(1, 'auoaaaaaaaaooooo', 'F', '1985-09-09'),
(2, 'saya', 'M', '1990-12-19'),
(4, 'name_003', 'm', '2000-02-02'),
(7, 'Calvin', 'M', '2013-08-06'),
(9, 'aaaac', 'M', '1890-11-30'),
(10, 'ini saya lo ah', 'F', '2014-01-01'),
(11, 'juuullllll', 'F', '2014-01-12'),
(12, 'asda', 'F', '2014-01-02'),
(13, 'tulis', 'F', '1890-01-06'),
(14, 'tangan', 'M', '1878-12-01'),
(15, 'itu', 'F', '1899-11-30'),
(16, 'lalaalal', 'M', '1899-11-30'),
(17, 'lalalala', 'M', '2014-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE IF NOT EXISTS `obat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `golongan` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama`, `golongan`, `stok`, `gambar`, `harga`) VALUES
(3, 'obat nyamuk', 'Obat Bebas', 100, '0', 4111),
(4, 'obat jiwa', 'Obat Bebas', 3, '001.jpg', 111),
(5, 'obat nyamuk', 'Obat Bebas', 300, '0', 1),
(6, 'obat jiwa', 'Obat Keras', 3, '0', 111),
(7, 'obat jiwa', 'Obat Bebas', 3, '0', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_obat`, `jumlah`, `total_harga`) VALUES
(1, 3, 1, 111),
(2, 3, 1, 111),
(3, 3, 1, 111),
(4, 3, 21, 86331),
(5, 3, 90, 369990),
(6, 3, 900, 3699900),
(7, 3, 900, 3699900);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) NOT NULL,
  `pass` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `pass`) VALUES
(1, 'manager', '65ba841e01d6db7733e90a5b7f9e6f80'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
