-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2019 at 07:38 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_buku`
--

CREATE TABLE `mst_buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` text NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `judul_buku` text NOT NULL,
  `penulis` text NOT NULL,
  `jml_hal` int(11) NOT NULL,
  `tgl_terbit` date NOT NULL,
  `ket_buku` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_buku`
--

INSERT INTO `mst_buku` (`id_buku`, `kode_buku`, `kategori_id`, `judul_buku`, `penulis`, `jml_hal`, `tgl_terbit`, `ket_buku`) VALUES
(3, 'BOOK-2019-0002', 3, 'Belajar Coding', 'Arya Panangsang', 250, '2019-10-07', '-'),
(4, 'BOOK-2019-0003', 4, 'Stroke dan Permasalannya', 'Dr. Arjuna Wiwaha', 150, '2009-12-19', 'Kualifikasi Stroke'),
(5, 'BOOK-2019-0004', 3, 'Akses Tercepat', 'Haryo Agustina', 25, '2007-02-28', '-'),
(6, 'BOOK-2019-0005', 7, 'Pemilihan Bupati Tahun 2019', 'Arya Panangsang', 10, '2019-12-12', '-');

-- --------------------------------------------------------

--
-- Table structure for table `mst_jurnal`
--

CREATE TABLE `mst_jurnal` (
  `id_jurnal` int(11) NOT NULL,
  `kode_jurnal` text NOT NULL,
  `kategori_jurnal` int(11) NOT NULL,
  `judul_jurnal` text NOT NULL,
  `penulis` text NOT NULL,
  `tgl_terbit` date NOT NULL,
  `ket_jurnal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_jurnal`
--

INSERT INTO `mst_jurnal` (`id_jurnal`, `kode_jurnal`, `kategori_jurnal`, `judul_jurnal`, `penulis`, `tgl_terbit`, `ket_jurnal`) VALUES
(3, 'JURNAL-2019-0002', 4, 'Menjaga Kebugaran', 'Arya Juga', '2019-12-25', '-'),
(4, 'JURNAL-2019-0003', 5, 'Perubahan Tatanan Masyarakat ', 'Prof. Dr. Arjuna', '2010-08-12', '-'),
(6, 'JURNAL-2019-0004', 7, 'Indikator Kebersihan Kantor Instansi', 'Dr. Cornelius Hermawan', '2019-10-20', '-');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kategori`
--

CREATE TABLE `mst_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kategori`
--

INSERT INTO `mst_kategori` (`id_kategori`, `kategori`) VALUES
(3, 'Teknologi'),
(4, 'Kesehatan'),
(7, 'Berita');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kategori_jurnal`
--

CREATE TABLE `mst_kategori_jurnal` (
  `id_kategori_jurnal` int(11) NOT NULL,
  `kategori_jurnal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kategori_jurnal`
--

INSERT INTO `mst_kategori_jurnal` (`id_kategori_jurnal`, `kategori_jurnal`) VALUES
(4, 'Kesehatan'),
(5, 'Teknik Sipil'),
(7, 'Mutu dan Kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `level` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `date_created` date NOT NULL,
  `is_active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`id`, `nama`, `email`, `username`, `password`, `level`, `image`, `date_created`, `is_active`) VALUES
(9, 'Donny Kurniawan', 'ata.adonia@gmail.com', 'admin', '$2y$10$Fu4wp6uWIOdEPOIpkSXxouzwI1syhygCmFMqedNI1baUxrPJ2LHRC', 'Admin', 'avatar042.png', '2019-08-06', 1),
(21, 'Adonia Vincent N', 'adonia_ata@yahoo.com', 'user', '$2y$10$etiFa08mC.qXGT9cyUJrTubWcJzwERdrHSbMvF1/VBagCUXU57meO', 'User', 'avatar53.png', '2019-10-10', 1),
(30, 'Ratna Damayanti', 'adonia_maya@gmail.com', 'maya', '$2y$10$d7TZXSjuBRQgdQTdJrgVpO.tHCCqChs/gPyxPX4tJqK51JrgTQ4qO', 'User', 'avatar3.png', '2019-10-15', 1),
(33, 'Arnold Jumangin', 'admin@gmail.com', 'arnold', '$2y$10$UK9QdXsANSUxBA0wa6hWL.m6SMfc4lMRn3s4YzgluEyzyZP7yF55m', 'User', 'avatar54.png', '2019-10-20', 1),
(34, 'Harjo Waringin, SPd', 'admin@gmail.com', 'harjo', '$2y$10$NQtrgCqep04dwMPoXkbXu.mAKU0dIMTNreoTCBuXs15F7E4btmLl.', 'User', 'default.jpg', '2019-10-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjam`
--

CREATE TABLE `tb_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `sess_id` int(11) NOT NULL,
  `pinjaman` text NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `penerima` text NOT NULL,
  `ket_pinjam` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pinjam`
--

INSERT INTO `tb_pinjam` (`id_pinjam`, `sess_id`, `pinjaman`, `tgl_pinjam`, `tgl_kembali`, `penerima`, `ket_pinjam`, `status`) VALUES
(4, 21, 'BOOK-2019-0001', '2019-10-14', '2019-10-30', 'Natan', '-', 0),
(6, 21, 'JURNAL-2019-0001', '2019-10-20', '2019-10-25', 'Natan', 'Buku Rusak', 0),
(8, 30, 'BOOK-2019-0002', '2019-10-20', '2019-10-30', 'Maya', '-', 0),
(15, 21, 'BOOK-2019-0003', '2019-10-20', '2019-10-22', 'Natan', 'Tugas Kuliah ( Buku Sobek )', 0),
(16, 21, 'BOOK-2019-0004', '2019-10-20', '2019-10-21', 'Natan', '-', 0),
(18, 30, 'BOOK-2019-0005', '2019-10-20', '0000-00-00', 'Maya', '-', 1),
(19, 30, 'JURNAL-2019-0003', '2019-10-20', '2019-10-23', 'Maya', 'Buku Rusak', 0),
(20, 34, 'BOOK-2019-0002', '2019-10-20', '2019-10-23', 'Harjo', '-', 0),
(21, 34, 'JURNAL-2019-0003', '2019-10-20', '2019-10-22', 'Harjo', '-', 0),
(22, 33, 'BOOK-2019-0003', '2019-10-20', '2019-10-24', 'Arnold', '-', 0),
(23, 33, 'BOOK-2019-0002', '2019-10-20', '2019-10-22', 'Arnold', 'Tugas Sekolah', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_buku`
--
ALTER TABLE `mst_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `mst_jurnal`
--
ALTER TABLE `mst_jurnal`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- Indexes for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `mst_kategori_jurnal`
--
ALTER TABLE `mst_kategori_jurnal`
  ADD PRIMARY KEY (`id_kategori_jurnal`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_buku`
--
ALTER TABLE `mst_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mst_jurnal`
--
ALTER TABLE `mst_jurnal`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_kategori_jurnal`
--
ALTER TABLE `mst_kategori_jurnal`
  MODIFY `id_kategori_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
