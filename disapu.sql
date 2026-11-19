-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2024 pada 09.44
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `disapu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hadiah`
--

CREATE TABLE `hadiah` (
  `id_hadiah` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `poin` int(11) DEFAULT NULL,
  `stok_barang` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_sampah`
--

CREATE TABLE `kategori_sampah` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `updater` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_sampah`
--

INSERT INTO `kategori_sampah` (`id_kategori`, `kategori`, `deskripsi`, `tgl_input`, `tgl_update`, `updater`) VALUES
(1, 'kertas', 'macam-macam kertas', '2024-06-03 04:44:42', '2024-06-03 04:44:42', ''),
(2, 'plastik', 'macam-macam plastik', '2024-06-03 04:44:42', '2024-06-03 04:44:42', ''),
(3, 'elektronik', 'macam-acam elektronik', '2024-06-03 04:46:30', '2024-06-03 04:46:30', ''),
(4, 'besi', 'macam-macam besi', '2024-06-03 04:46:30', '2024-06-03 04:46:30', ''),
(5, 'alumunium', 'macam-macam alumunium', '2024-06-03 04:47:30', '2024-06-03 04:47:30', ''),
(6, 'botol kaca', 'macam-macam botol kaca', '2024-06-03 04:47:30', '2024-06-03 04:47:30', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurs_poin`
--

CREATE TABLE `kurs_poin` (
  `id` int(11) NOT NULL,
  `poin` int(11) NOT NULL,
  `kurs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kurs_poin`
--

INSERT INTO `kurs_poin` (`id`, `poin`, `kurs`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_user`
--

CREATE TABLE `level_user` (
  `id_level` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_output` timestamp NOT NULL DEFAULT current_timestamp(),
  `updater` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level_user`
--

INSERT INTO `level_user` (`id_level`, `deskripsi`, `tgl_input`, `tgl_output`, `updater`, `level`) VALUES
(1, 'User', '2024-06-03 02:31:31', '2024-06-03 02:31:31', '', 'user'),
(2, 'admin', '2024-06-03 02:31:31', '2024-06-03 02:31:31', '', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `poin_user`
--

CREATE TABLE `poin_user` (
  `id_poin` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `poin_in` decimal(11,2) DEFAULT 0.00,
  `poin_out` decimal(11,2) DEFAULT 0.00,
  `poin_now` decimal(11,2) DEFAULT 0.00,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `updater` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `poin_user`
--

INSERT INTO `poin_user` (`id_poin`, `id_user`, `poin_in`, `poin_out`, `poin_now`, `tgl_input`, `tgl_update`, `updater`) VALUES
(4, '66aa37f310f80', '0.00', '0.00', '0.00', '2024-07-31 13:17:25', '2024-08-01 02:40:34', 'Dzul'),
(5, '66aa3967dbfc2', '0.00', '0.00', '0.00', '2024-07-31 13:18:22', '2024-07-31 13:18:22', 'Dzul');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sampah`
--

CREATE TABLE `sampah` (
  `id_sampah` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_klasifikasi` varchar(225) NOT NULL,
  `satuan_berat` varchar(100) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `updater` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setor_sampah`
--

CREATE TABLE `setor_sampah` (
  `id_setor` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `id_sampah` int(11) NOT NULL,
  `nama_klasifikasi` varchar(255) DEFAULT NULL,
  `harga_jual` int(11) NOT NULL,
  `qty_setor` decimal(11,2) NOT NULL,
  `kurs_poin` decimal(11,2) NOT NULL,
  `total_poin` decimal(11,2) NOT NULL,
  `tgl_input` timestamp NULL DEFAULT current_timestamp(),
  `tgl_update` timestamp NULL DEFAULT current_timestamp(),
  `updater` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tukar_poin`
--

CREATE TABLE `tukar_poin` (
  `id_tukar` int(11) NOT NULL,
  `id_hadiah` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `nama_hadiah` varchar(255) DEFAULT NULL,
  `poin_checkout` decimal(11,2) DEFAULT NULL,
  `key_checkout` varchar(50) DEFAULT NULL,
  `status_checkout` enum('Y','N') DEFAULT NULL,
  `tgl_checkout` timestamp NULL DEFAULT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_output` timestamp NOT NULL DEFAULT current_timestamp(),
  `updater` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(100) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash_password` varchar(255) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nik` varchar(18) DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `rt` int(3) DEFAULT NULL,
  `rw` int(3) DEFAULT NULL,
  `dusun` varchar(150) DEFAULT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_telp` varchar(16) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `updater` varchar(150) NOT NULL,
  `id_level` int(11) NOT NULL,
  `peringkat` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `hash_password`, `nama`, `nik`, `jk`, `rt`, `rw`, `dusun`, `alamat`, `no_telp`, `tgl_input`, `tgl_update`, `updater`, `id_level`, `peringkat`) VALUES
('66aa37f310f80', 'hasyim', '1234', '81dc9bdb52d04dc20036dbd8313ed055', 'Hasyim', '35089985098098', 'Laki-laki', 1, 1, 'Krajan', 'Purworejo', '934849834', '2024-07-31 13:17:25', '2024-07-31 13:17:25', 'Dzul', 1, ''),
('66aa3967dbfc2', 'farizqi', 'farizqi', '591b121a88803637c57a87cbface913d', 'Farizqi Saifullah', '35089985098098', 'Laki-laki', 1, 1, 'Krajan', 'Purworejo', '99484', '2024-07-31 13:18:22', '2024-07-31 01:26:02', 'Dzul', 1, ''),
('ADMIN1', 'zul', 'zul', '1cf440e0df367e8a74becfa88ba0595a', 'Dzul', '35089090909', 'Laki-laki', 1, 1, 'Karangsari', 'Lumajang', '0998989', '2024-07-31 13:07:01', '2024-07-31 13:07:01', '', 2, '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hadiah`
--
ALTER TABLE `hadiah`
  ADD PRIMARY KEY (`id_hadiah`);

--
-- Indeks untuk tabel `kategori_sampah`
--
ALTER TABLE `kategori_sampah`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kurs_poin`
--
ALTER TABLE `kurs_poin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `poin_user`
--
ALTER TABLE `poin_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_poin` (`id_poin`);

--
-- Indeks untuk tabel `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`id_sampah`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `setor_sampah`
--
ALTER TABLE `setor_sampah`
  ADD PRIMARY KEY (`id_setor`,`id_user`,`id_kategori`,`id_sampah`) USING BTREE;

--
-- Indeks untuk tabel `tukar_poin`
--
ALTER TABLE `tukar_poin`
  ADD PRIMARY KEY (`id_tukar`,`id_user`) USING BTREE,
  ADD KEY `id_tukar` (`id_tukar`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hadiah`
--
ALTER TABLE `hadiah`
  MODIFY `id_hadiah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `kategori_sampah`
--
ALTER TABLE `kategori_sampah`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kurs_poin`
--
ALTER TABLE `kurs_poin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `level_user`
--
ALTER TABLE `level_user`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `poin_user`
--
ALTER TABLE `poin_user`
  MODIFY `id_poin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id_sampah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `setor_sampah`
--
ALTER TABLE `setor_sampah`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tukar_poin`
--
ALTER TABLE `tukar_poin`
  MODIFY `id_tukar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `poin_user`
--
ALTER TABLE `poin_user`
  ADD CONSTRAINT `poin_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sampah`
--
ALTER TABLE `sampah`
  ADD CONSTRAINT `sampah_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_sampah` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tukar_poin`
--
ALTER TABLE `tukar_poin`
  ADD CONSTRAINT `tukar_poin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level_user` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
