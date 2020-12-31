-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2020 pada 13.23
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `mst_buku`
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
-- Dumping data untuk tabel `mst_buku`
--

INSERT INTO `mst_buku` (`id_buku`, `kode_buku`, `kategori_id`, `judul_buku`, `penulis`, `jml_hal`, `tgl_terbit`, `ket_buku`) VALUES
(8, 'BOOK-2020-0002', 9, 'Belajar Fundamental Php Framework Express. Js', 'Tegar Satya Negara', 222, '2020-11-11', '--'),
(9, 'BOOK-2020-0003', 10, 'Belajar Fundamental Php Framework React Native', 'Tegar Satya Negara', 3241, '2020-11-11', '-----'),
(10, 'BOOK-2020-0004', 10, 'Belajar Fundamental Php Framework Express. Js', 'Tegar Satya Negara', 3453, '2020-11-14', 'zxczx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_jurnal`
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
-- Dumping data untuk tabel `mst_jurnal`
--

INSERT INTO `mst_jurnal` (`id_jurnal`, `kode_jurnal`, `kategori_jurnal`, `judul_jurnal`, `penulis`, `tgl_terbit`, `ket_jurnal`) VALUES
(3, 'JURNAL-2019-0002', 4, 'Menjaga Kebugaran', 'Arya Juga', '2019-12-25', '-'),
(4, 'JURNAL-2019-0003', 5, 'Perubahan Tatanan Masyarakat ', 'Prof. Dr. Arjuna', '2010-08-12', '-'),
(6, 'JURNAL-2019-0004', 7, 'Indikator Kebersihan Kantor Instansi', 'Dr. Cornelius Hermawan', '2019-10-20', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_kategori`
--

CREATE TABLE `mst_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_kategori`
--

INSERT INTO `mst_kategori` (`id_kategori`, `kategori`) VALUES
(8, 'Bahasa Pemrogramman Php'),
(9, 'Bahasa Pemrogramman Node. JS'),
(10, 'Bahasa Pemrogramman Javascript');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_kategori_jurnal`
--

CREATE TABLE `mst_kategori_jurnal` (
  `id_kategori_jurnal` int(11) NOT NULL,
  `kategori_jurnal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_user`
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
-- Dumping data untuk tabel `mst_user`
--

INSERT INTO `mst_user` (`id`, `nama`, `email`, `username`, `password`, `level`, `image`, `date_created`, `is_active`) VALUES
(35, 'Tegar Satya Negara', 'tegarsatyanegara.if@gmail.com', 'tegarsatyanegara', '$2y$10$9papGhisbJb/yCAKXkXLH.2R5pIcSbxbST1W0oxc17rxQXHtzwQWq', 'Admin', 'api.jpg', '2020-11-12', 1),
(38, 'user', 'tegarsatyanegara.tsn@gmail.com', 'user', '$2y$10$CgAXJACEyIEcbneWzyYaYu1EDpJPBdNQaaGBPe5VZ1AVByrdqtp3S', 'User', 'FB_IMG_16006222225942.jpg', '2020-11-18', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pinjam`
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
-- Dumping data untuk tabel `tb_pinjam`
--

INSERT INTO `tb_pinjam` (`id_pinjam`, `sess_id`, `pinjaman`, `tgl_pinjam`, `tgl_kembali`, `penerima`, `ket_pinjam`, `status`) VALUES
(25, 36, 'BOOK-2020-0002', '2020-11-13', '2020-11-15', 'Ghiyat', 'pinjam saja\r\n', 0),
(26, 37, 'BOOK-2020-0002', '2020-11-12', '2020-11-15', 'Maya', 'eee', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mst_buku`
--
ALTER TABLE `mst_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `mst_jurnal`
--
ALTER TABLE `mst_jurnal`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- Indeks untuk tabel `mst_kategori`
--
ALTER TABLE `mst_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `mst_kategori_jurnal`
--
ALTER TABLE `mst_kategori_jurnal`
  ADD PRIMARY KEY (`id_kategori_jurnal`);

--
-- Indeks untuk tabel `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mst_buku`
--
ALTER TABLE `mst_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `mst_jurnal`
--
ALTER TABLE `mst_jurnal`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `mst_kategori`
--
ALTER TABLE `mst_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `mst_kategori_jurnal`
--
ALTER TABLE `mst_kategori_jurnal`
  MODIFY `id_kategori_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
