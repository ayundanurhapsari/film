-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2020 at 03:37 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewafilm`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `film_id` int(10) UNSIGNED NOT NULL,
  `year` smallint(5) UNSIGNED NOT NULL,
  `nama_film` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `actor` varchar(255) NOT NULL,
  `harga_sewa` decimal(7,0) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`film_id`, `year`, `nama_film`, `genre`, `actor`, `harga_sewa`, `deskripsi`) VALUES
(1, 2020, 'Dilan', 'Romance', 'Iqbaal Ramdhan, Vanessa', '30000', 'Kisah asmara Dilan dan Milea'),
(8, 2020, 'Bumi Manusia', 'Sejarah', 'Iqbaal Ramadhan, Mawar Eva', '25000', 'Deskriminasi warna kulit'),
(9, 2020, 'KKN Desa Penari', 'Horror', 'Bima, Ayu', '28000', 'Melanggar adat daerah'),
(10, 2020, 'Imperfect', 'Komedi', 'Jessica Mila, Reza Rahadian', '32000', 'Tindakan body shamming'),
(6, 2020, 'Avengers', 'Laga', 'Scarlett Johansson', '30000', 'Keberhasilan Thanos'),
(7, 2020, 'Frozen', 'Fantasi', 'Evan Rachel Wood', '25000', 'Menelusuri asal usul kekuatan Elsa');

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `id_sewa` int(10) UNSIGNED NOT NULL,
  `film_id` int(10) UNSIGNED NOT NULL,
  `nama_penyewa` varchar(70) NOT NULL,
  `nomor_rekening` int(16) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `subtotal` decimal(10,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`id_sewa`, `film_id`, `nama_penyewa`, `nomor_rekening`, `tgl_mulai`, `tgl_selesai`, `subtotal`) VALUES
(1, 1, 'Ayunda', 212121, '2020-07-27', '2020-07-28', '0'),
(2, 2, 'Nur', 65657, '2020-07-15', '2020-07-16', '0'),
(3, 2, 'Hapsari', 4356789, '2020-07-19', '2020-07-21', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`film_id`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id_sewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `film_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id_sewa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
