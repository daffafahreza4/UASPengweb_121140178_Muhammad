-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Des 2023 pada 18.20
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `speklaptop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `laptop`
--

CREATE TABLE `laptop` (
  `id` int(11) NOT NULL,
  `NamaLaptop` varchar(255) NOT NULL,
  `CPU` varchar(100) DEFAULT NULL,
  `GPU` varchar(100) DEFAULT NULL,
  `RAM` varchar(50) DEFAULT NULL,
  `Storage` varchar(100) DEFAULT NULL,
  `Berat` varchar(10) NOT NULL,
  `Harga` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laptop`
--

INSERT INTO `laptop` (`id`, `NamaLaptop`, `CPU`, `GPU`, `RAM`, `Storage`, `Berat`, `Harga`) VALUES
(24, 'Lenovo Thinkbook 14', 'Intel Core i5-8265U', 'NVIDIA GeForce GTX 1050', '8', '256GB SSD', '1.5', '8.000.000'),
(25, 'HP SPECTRE X360', 'AMD Ryzen 7 5800H', 'AMD Radeon RX 6700M', '16', '512GB NVMe SSD', '2.0', '12.000.000'),
(27, 'Macbook Air M2', 'AMD Ryzen 5 5600X', 'NVIDIA RTX 3060', '8', '128GB SSD', '1.8', '13.000.000'),
(35, 'Acer Predator Helios 16', 'Intel Core i5', 'NVIDIA GTX 1650', '8GB', '512GB SSD', '1.8', '1.200.000'),
(37, 'Lenovo LOQ', 'Intel Core i5', 'NVIDIA GTX 1650', '8GB', '512GB SSD', '1.8', '1.200.000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `laptop`
--
ALTER TABLE `laptop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
