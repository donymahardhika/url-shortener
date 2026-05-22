-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2026 at 05:02 AM
-- Server version: 11.8.6-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `short`
--

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` int(11) NOT NULL,
  `long_url` text NOT NULL,
  `short_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `clicks` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `qr_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `long_url`, `short_code`, `clicks`, `created_at`, `qr_path`) VALUES
(1, 'https://donymahardhika.com/blog/buku-strategi-manajemen-persediaan-spare-part-pada-mesin-produksi/', 'BukuDhika', 1, '2026-05-19 03:58:09', 'qrcodes/BukuDhika.png'),
(2, 'https://shopee.co.id/product/256474177/54702299157/', 'BukuDhika_Shopee', 1, '2026-05-19 03:59:49', 'qrcodes/BukuDhika_Shopee.png'),
(3, 'https://www.tokopedia.com/penapersadabookstore/strategi-manajemen-persediaan-spare-part-pada-mesin-produksi-1733398237585442779', 'BukuDhika_Tokopedia', 1, '2026-05-19 04:23:02', 'qrcodes/BukuDhika_Tokopedia.png'),
(4, 'https://shop-id.tokopedia.com/view/product/1733398237585442779?encode_params=MIIBpgQME6F0tNWFcunC9g6jBIIBgvYmAY04U0sjI4PqrDYyxh4HSTr6EXNTr-ykjVndpWQsCVtm5Q2fBhufMsnwyrW9UnDGfIODmtrS4RcfByEqETnf9gsj3HB858pIu7IduQUEZCaayA0uM-qCXKM8W27GBgfKvmk7cLNYcosW7cbAA7eD1HuL8xvYZ8o2veVAxabz3UlceRsh-ELN_B_scUqIiVDerG-4GxyCZuHui5tCDHVIraaTiUIVdhfmPYNoJ71nDC6ON44ZiBpn7OOmePRZQYgHdK4xib33LkrUaszKu-N8R03_pP60VnVWdackl7398rVm3Z84XankByaN1y_CCgEf8lrIcpSGUoVxg1HiDQIfDbcNcE07uwlorf-SbSWW6BJuYpNqR096WKRQkglpr9cug0FOv-4tRifFgv9x2uqseohn3D213Qea04nWJCEPzVXWE6BQgnwFBR9iHYnqCjaYyyFevdWIeeN6-mZ9gyIhy6dg8ii3Gb0AKnn1-M-YadJG6d4apgp9451pmAguCOdlBBBCtAYKMsMU3hiy7kfC2-Fx&region=ID&locale=id-ID&source=seller_center&hide_tips=&no-cache=1&e=1', 'BukuDhika_TikTok', 2, '2026-05-19 04:28:16', 'qrcodes/BukuDhika_TikTok.png'),
(5, 'https://docs.google.com/spreadsheets/d/17dkR8AyvH7AiejD7JaFwm2cABGtdiju6jNpumsJGrHw/edit?usp=sharing', 'ProcessCycle', 1, '2026-05-19 04:32:17', 'qrcodes/ProcessCycle.png'),
(6, 'https://docs.google.com/spreadsheets/d/1xZT-98qIF-dayQKG8Qt4cVrIj5eSBAQWQeLi_v6Qfek/edit?usp=sharing', 'MoM_Prod_Eng', 0, '2026-05-19 04:34:07', 'qrcodes/MoM_Prod_Eng.png'),
(7, 'https://donymahardhika.com/blog/overall-equipment-effectiveness/', 'OEE', 0, '2026-05-20 00:48:49', 'qrcodes/OEE.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$UrVR3cxryBlq2jZzvAnKAOzNoZNfmNn2XerYrz4S8FHfbvkEwA9Vy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_code` (`short_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
