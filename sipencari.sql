-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2024 pada 17.19
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipencari`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `baranghilang`
--

CREATE TABLE `baranghilang` (
  `id` int(11) NOT NULL,
  `namaBarang` varchar(256) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `tempat` varchar(256) NOT NULL,
  `jenisBarang` varchar(256) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT 0,
  `id_user` int(11) DEFAULT NULL,
  `reporting_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `baranghilang`
--

INSERT INTO `baranghilang` (`id`, `namaBarang`, `gambar`, `tempat`, `jenisBarang`, `deskripsi`, `flag`, `id_user`, `reporting_date`) VALUES
(4, 'Kacamata', 'kacamata.jpg', '262', 'Aksesoris', 'halo', 0, 1, '2024-06-03'),
(6, 'Tws', 'tws.jpg', '251', 'Elektronik', '', 0, 3, '2024-07-01'),
(16, 'Laptop', 'laptop.jpg', '256', 'Elektronik', '', 0, 3, '2024-06-01'),
(19, 'Pulpen', '6648f05c209ef.jpg', 'maskam', 'Alat tulis', 'Gatau mas', 0, 3, '2024-06-02'),
(20, 'Kunci kos', '6648f3cb8c6bf.jpeg', '', 'Barang lain', 'Aduh mas ilang', 0, 3, '2024-05-31'),
(21, 'Airpods', '6653631035353.jpg', 'Masjid Kampus', 'Elektronik', 'Airpod warna putih', 0, 3, '2024-05-30'),
(24, 'Airpods', '667c0d7c14861.jpg', '266', 'Elektronik', '12344', 0, 1, '2024-06-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangtemuan`
--

CREATE TABLE `barangtemuan` (
  `id` int(11) NOT NULL,
  `namaBarang` varchar(256) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `tempat` varchar(256) NOT NULL,
  `jenisBarang` varchar(256) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL,
  `reporting_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barangtemuan`
--

INSERT INTO `barangtemuan` (`id`, `namaBarang`, `gambar`, `tempat`, `jenisBarang`, `deskripsi`, `flag`, `id_user`, `reporting_date`) VALUES
(1, 'TWS', '6649c80e4c10a.jpeg', 'Maskam', 'Elektronik', 'Loh kok nemu iki', 0, 3, '2024-06-05'),
(2, 'Gantungan Kunci', '66536610ee400.jpg', '', 'Aksesoris', 'Gantungan kunci pink', 0, 3, '2024-06-03'),
(6, 'Hp', '666c5fe504d33.jpg', '251', 'Elektronik', 'a', 0, 1, '2024-06-26'),
(7, 'Airpods', '667c0b0611c7b.jpg', '262', 'Elektronik', 'dawda', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photoProfil` varchar(256) DEFAULT NULL,
  `username` varchar(256) DEFAULT NULL,
  `nim` int(9) DEFAULT NULL,
  `kelas` varchar(4) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `password`, `photoProfil`, `username`, `nim`, `kelas`, `email`) VALUES
(1, '$2y$10$fnudcy/QOZnajl2a/gluhup/IR8mTiJF6ey6/nvLoKnG0mlrCi7MW', NULL, 'Zayan', 222212776, '2KS1', 'zayan@gmail.com'),
(3, '$2y$10$H2pkAnehUd/KXzwY9SuSYut.R6SbQiei8PzfLW1kuEde28xT.mJB.', '665e877621765.jpg', 'Hafizh', 12345, '2KS1', '222212776@stis.ac.id'),
(23, '$2y$10$mTrYX1cBOfj8JkCYkwszsOO8M8ZWiaudVw64tinagamcbvFd0U7I.', NULL, 'wida', NULL, NULL, '222212448@stis.ac.id'),
(24, '$2y$10$RJklPSkpA6ODNXiVkwgAq.zGV7TwlGV2rk/dUSPfXl8WjzIMwi5uS', NULL, 'Bung', NULL, NULL, '222212786@stis.ac.id'),
(25, '$2y$10$uVSYTexbu5mn0cHVHdaOwuZvydvEZ6XzjjxSwPQ7Vb.NrFbrW2xTG', NULL, 'asdf', NULL, NULL, '222212799@stis.ac.id');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `baranghilang`
--
ALTER TABLE `baranghilang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Indeks untuk tabel `barangtemuan`
--
ALTER TABLE `barangtemuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `baranghilang`
--
ALTER TABLE `baranghilang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `barangtemuan`
--
ALTER TABLE `barangtemuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `baranghilang`
--
ALTER TABLE `baranghilang`
  ADD CONSTRAINT `baranghilang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barangtemuan`
--
ALTER TABLE `barangtemuan`
  ADD CONSTRAINT `barangtemuan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
