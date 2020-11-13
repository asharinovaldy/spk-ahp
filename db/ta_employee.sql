-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Bulan Mei 2020 pada 09.13
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_employee`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id` varchar(3) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `hasil_akhir` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id`, `nama`, `hasil_akhir`) VALUES
('A1', 'Jerry', 0.318164),
('A2', 'Wisnu', 0.322301),
('A3', 'Andri', 0.359534);

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_alternatif`
--

CREATE TABLE `analisa_alternatif` (
  `alternatif1` varchar(3) NOT NULL,
  `indeks` float DEFAULT NULL,
  `hasil_analisa_alternatif` float DEFAULT NULL,
  `alternatif2` varchar(3) NOT NULL,
  `idKriteria` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `analisa_alternatif`
--

INSERT INTO `analisa_alternatif` (`alternatif1`, `indeks`, `hasil_analisa_alternatif`, `alternatif2`, `idKriteria`) VALUES
('A1', 1, 0.333333, 'A1', 'C1'),
('A1', 1, 0.333333, 'A1', 'C2'),
('A1', 1, 0.717947, 'A1', 'C3'),
('A1', 1, 0.142857, 'A1', 'C4'),
('A1', 1, 0.333333, 'A2', 'C1'),
('A1', 1, 0.333333, 'A2', 'C2'),
('A1', 7, 0.636364, 'A2', 'C3'),
('A1', 0.333333, 0.1, 'A2', 'C4'),
('A1', 1, 0.333333, 'A3', 'C1'),
('A1', 1, 0.333333, 'A3', 'C2'),
('A1', 4, 0.75, 'A3', 'C3'),
('A1', 0.333333, 0.181818, 'A3', 'C4'),
('A2', 1, 0.333333, 'A1', 'C1'),
('A2', 1, 0.333333, 'A1', 'C2'),
('A2', 0.142857, 0.102564, 'A1', 'C3'),
('A2', 3, 0.428571, 'A1', 'C4'),
('A2', 1, 0.333333, 'A2', 'C1'),
('A2', 1, 0.333333, 'A2', 'C2'),
('A2', 1, 0.0909091, 'A2', 'C3'),
('A2', 1, 0.3, 'A2', 'C4'),
('A2', 1, 0.333333, 'A3', 'C1'),
('A2', 1, 0.333333, 'A3', 'C2'),
('A2', 0.333333, 0.0625, 'A3', 'C3'),
('A2', 0.5, 0.272728, 'A3', 'C4'),
('A3', 1, 0.333333, 'A1', 'C1'),
('A3', 1, 0.333333, 'A1', 'C2'),
('A3', 0.25, 0.179487, 'A1', 'C3'),
('A3', 3, 0.428571, 'A1', 'C4'),
('A3', 1, 0.333333, 'A2', 'C1'),
('A3', 1, 0.333333, 'A2', 'C2'),
('A3', 3, 0.272727, 'A2', 'C3'),
('A3', 2, 0.600001, 'A2', 'C4'),
('A3', 1, 0.333333, 'A3', 'C1'),
('A3', 1, 0.333333, 'A3', 'C2'),
('A3', 1, 0.1875, 'A3', 'C3'),
('A3', 1, 0.545456, 'A3', 'C4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_kriteria`
--

CREATE TABLE `analisa_kriteria` (
  `kriteria1` varchar(3) NOT NULL DEFAULT '',
  `indeks` float DEFAULT NULL,
  `hasil_analisa_kriteria` float DEFAULT NULL,
  `kriteria2` varchar(3) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `analisa_kriteria`
--

INSERT INTO `analisa_kriteria` (`kriteria1`, `indeks`, `hasil_analisa_kriteria`, `kriteria2`) VALUES
('C1', 1, 0.138889, 'C1'),
('C1', 0.2, 0.132353, 'C2'),
('C1', 5, 0.25, 'C3'),
('C1', 1, 0.138889, 'C4'),
('C2', 5, 0.694444, 'C1'),
('C2', 1, 0.661765, 'C2'),
('C2', 9, 0.45, 'C3'),
('C2', 5, 0.694444, 'C4'),
('C3', 0.2, 0.0277778, 'C1'),
('C3', 0.111111, 0.0735294, 'C2'),
('C3', 1, 0.05, 'C3'),
('C3', 0.2, 0.0277778, 'C4'),
('C4', 1, 0.138889, 'C1'),
('C4', 0.2, 0.132353, 'C2'),
('C4', 5, 0.25, 'C3'),
('C4', 1, 0.138889, 'C4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `indeks`
--

CREATE TABLE `indeks` (
  `id` int(11) NOT NULL,
  `angka` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `indeks`
--

INSERT INTO `indeks` (`id`, `angka`, `keterangan`) VALUES
(1, 1, 'Kedua Elemen Sama Pentingnya'),
(2, 2, 'Nilai-nilai Intermediate'),
(3, 3, 'Elemen yang Satu Sedikit Lebih Penting daripada Elemen Lainnya'),
(4, 4, 'Nilai-nilai Intermediate'),
(5, 5, 'Elemen yang Satu Lebih Penting daripada Elemen Lainnya'),
(6, 6, 'Nilai-nilai Intermediate'),
(7, 7, 'Satu Elemen Jelas Lebih Mutlak Penting daripada Elemen Lainnya'),
(8, 8, 'Nilai-nilai Intermediate'),
(9, 9, 'Satu Elemen Mutlak Penting daripada Elemen Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `juml_alt_kri`
--

CREATE TABLE `juml_alt_kri` (
  `id_alternatif` varchar(3) NOT NULL,
  `id_kriteria` varchar(3) NOT NULL,
  `jumlah` float DEFAULT NULL,
  `bobot_alternatif` float DEFAULT NULL,
  `bobot_akhir` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `juml_alt_kri`
--

INSERT INTO `juml_alt_kri` (`id_alternatif`, `id_kriteria`, `jumlah`, `bobot_alternatif`, `bobot_akhir`) VALUES
('A1', 'C1', 3, 0.333333, 0.0550109),
('A1', 'C2', 3, 0.333333, 0.208387),
('A1', 'C3', 1.39286, 0.701437, 0.0314042),
('A1', 'C4', 7, 0.141558, 0.0233617),
('A2', 'C1', 3, 0.333333, 0.0550109),
('A2', 'C2', 3, 0.333333, 0.208387),
('A2', 'C3', 11, 0.0853243, 0.00382007),
('A2', 'C4', 3.33333, 0.333766, 0.0550824),
('A3', 'C1', 3, 0.333333, 0.0550109),
('A3', 'C2', 3, 0.333333, 0.208387),
('A3', 'C3', 5.33333, 0.213238, 0.00954692),
('A3', 'C4', 1.83333, 0.524676, 0.0865889);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` varchar(3) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jumlah_kriteria` float DEFAULT NULL,
  `bobot_kriteria` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`, `jumlah_kriteria`, `bobot_kriteria`) VALUES
('C1', 'Tepat Waktu', 7.2, 0.165033),
('C2', 'Respon Klien', 1.51111, 0.625163),
('C3', 'Banyak Projek yang Diambil', 20, 0.0447712),
('C4', 'Kehadiran', 7.2, 0.165033);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `analisa_alternatif`
--
ALTER TABLE `analisa_alternatif`
  ADD PRIMARY KEY (`alternatif1`,`alternatif2`,`idKriteria`),
  ADD KEY `alternatif2` (`alternatif2`),
  ADD KEY `idKriteria` (`idKriteria`);

--
-- Indeks untuk tabel `analisa_kriteria`
--
ALTER TABLE `analisa_kriteria`
  ADD PRIMARY KEY (`kriteria1`,`kriteria2`),
  ADD KEY `kriteria2` (`kriteria2`);

--
-- Indeks untuk tabel `indeks`
--
ALTER TABLE `indeks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `juml_alt_kri`
--
ALTER TABLE `juml_alt_kri`
  ADD PRIMARY KEY (`id_alternatif`,`id_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `indeks`
--
ALTER TABLE `indeks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `analisa_alternatif`
--
ALTER TABLE `analisa_alternatif`
  ADD CONSTRAINT `FK_analisa_alternatif_alternatif` FOREIGN KEY (`alternatif1`) REFERENCES `alternatif` (`id`),
  ADD CONSTRAINT `FK_analisa_alternatif_alternatif_2` FOREIGN KEY (`alternatif2`) REFERENCES `alternatif` (`id`),
  ADD CONSTRAINT `FK_analisa_alternatif_kriteria` FOREIGN KEY (`idKriteria`) REFERENCES `kriteria` (`id`);

--
-- Ketidakleluasaan untuk tabel `analisa_kriteria`
--
ALTER TABLE `analisa_kriteria`
  ADD CONSTRAINT `kriteria1` FOREIGN KEY (`kriteria1`) REFERENCES `kriteria` (`id`),
  ADD CONSTRAINT `kriteria2` FOREIGN KEY (`kriteria2`) REFERENCES `kriteria` (`id`);

--
-- Ketidakleluasaan untuk tabel `juml_alt_kri`
--
ALTER TABLE `juml_alt_kri`
  ADD CONSTRAINT `FK_juml_alt_kri_alternatif` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`),
  ADD CONSTRAINT `FK_juml_alt_kri_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
