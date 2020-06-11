-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 12, 2020 at 11:38 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kentrehberi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(10) NOT NULL,
  `adminMail` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `adminPass` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminMail`, `adminPass`) VALUES
(2, 'hasanmertermis@gmail.com', 'Deneme1234'),
(3, 'basari.hmertoo@gmail.com', 'Merhaba123455');

-- --------------------------------------------------------

--
-- Table structure for table `firmaistekleri`
--

CREATE TABLE `firmaistekleri` (
  `firmaIstekId` int(10) NOT NULL,
  `telefon` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `metin` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `firmaistekleri`
--

INSERT INTO `firmaistekleri` (`firmaIstekId`, `telefon`, `metin`) VALUES
(1, '123123123', 'istek metni istek metni istek metni istek metni istek metni istek metniistek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni istek metni'),
(2, '123123', 'asdasd asd asdasd'),
(3, '123123123', 'merhaba sitenize firmamı eklemek istiyorum.');

-- --------------------------------------------------------

--
-- Table structure for table `firmalar`
--

CREATE TABLE `firmalar` (
  `firmaAdi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `firmaAciklama` text COLLATE utf8_turkish_ci,
  `firmaFotosu` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `firmaId` int(10) NOT NULL,
  `adres` text COLLATE utf8_turkish_ci,
  `telefon` varchar(13) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `firmalar`
--

INSERT INTO `firmalar` (`firmaAdi`, `firmaAciklama`, `firmaFotosu`, `firmaId`, `adres`, `telefon`) VALUES
('Hicaz Pazarı', 'Hac malzemeleri satıyoruz.Hasanmertermis', '../img/deneme.jpeg', 1, 'adres bilgileri', '123123'),
('benim firmam', 'Hac malzemeleri satıyoruz.asdasdasd', '../img/deneme.jpeg', 3, NULL, 'asdasdasd'),
('denede', NULL, NULL, 5, 'adres kısmı', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `hakkimizda`
--

CREATE TABLE `hakkimizda` (
  `id` int(10) NOT NULL,
  `hakkimizdaBaslik` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizdaMetin` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `hakkimizda`
--

INSERT INTO `hakkimizda` (`id`, `hakkimizdaBaslik`, `hakkimizdaMetin`) VALUES
(1, 'Hakkımızda', 'antalya Kent rehberi sitemiz proje ödevidir.\nSiteyi yapan kişiler;\nMuhammed Alperen Çil');

-- --------------------------------------------------------

--
-- Table structure for table `isletmeGiris`
--

CREATE TABLE `isletmeGiris` (
  `isletmeId` int(10) NOT NULL,
  `isletmeMail` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isletmePass` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `isletmeGiris`
--

INSERT INTO `isletmeGiris` (`isletmeId`, `isletmeMail`, `isletmePass`) VALUES
(1, 'basari.hmert@gmail.com', 'Deneme1234'),
(3, 'aaaaaccc', 'bbbbbdddd'),
(4, 'aadsadasd', 'asdadfa'),
(5, 'adsadas', 'adasdas'),
(6, 'hasa', 'hasa'),
(8, 'isim1', 'sifre1'),
(9, 'isim2', 'sifre2'),
(10, 'isim3', 'sifre3'),
(11, 'isim4', 'sifre4');

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kullaniciId` int(10) NOT NULL,
  `kullaniciAdi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `kullaniciSifre` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`kullaniciId`, `kullaniciAdi`, `kullaniciSifre`) VALUES
(3, 'zeynep', 'zeynep1234'),
(4, 'egehan', 'ege1234'),
(5, 'neslito', 'neslito1234'),
(9, 'hasanmertooommm', 'deneme123456'),
(10, 'merhabalarosman', 'osman1234');

-- --------------------------------------------------------

--
-- Table structure for table `puanlar`
--

CREATE TABLE `puanlar` (
  `puanId` int(11) NOT NULL,
  `puan` float NOT NULL,
  `puanYapanId` int(11) NOT NULL,
  `firmaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `puanlar`
--

INSERT INTO `puanlar` (`puanId`, `puan`, `puanYapanId`, `firmaId`) VALUES
(1, 2, 3, 1),
(2, 4, 3, 5),
(3, 4, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorumId` int(10) NOT NULL,
  `yorumMetni` text COLLATE utf8_turkish_ci NOT NULL,
  `yorumuYazanId` int(11) NOT NULL,
  `firmaId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `yorumlar`
--

INSERT INTO `yorumlar` (`yorumId`, `yorumMetni`, `yorumuYazanId`, `firmaId`) VALUES
(11, 'siteniz efsane çok beğendim', 3, 1),
(12, 'siteniz efsane çok beğendimasdasdasd', 3, 1),
(13, 'fenasınız', 3, 1),
(14, 'mukemmell', 3, 1),
(15, 'hasanmertin yorumudur bu yorum', 3, 1),
(16, 'bir yorumda benden olsun', 3, 1),
(17, 'bir yorumda benden olsunasdasd', 3, 1),
(18, 'sadasdasd', 3, 1),
(19, 'deneme yorumu', 3, 1),
(20, 'merhabalar', 3, 3),
(21, 'merhabalar site super begendim sanki oğlum yapmış gibi', 3, 1),
(22, 'bu firmada iyiymiş', 3, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `firmaistekleri`
--
ALTER TABLE `firmaistekleri`
  ADD PRIMARY KEY (`firmaIstekId`);

--
-- Indexes for table `firmalar`
--
ALTER TABLE `firmalar`
  ADD PRIMARY KEY (`firmaId`);

--
-- Indexes for table `hakkimizda`
--
ALTER TABLE `hakkimizda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `isletmeGiris`
--
ALTER TABLE `isletmeGiris`
  ADD PRIMARY KEY (`isletmeId`);

--
-- Indexes for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kullaniciId`);

--
-- Indexes for table `puanlar`
--
ALTER TABLE `puanlar`
  ADD PRIMARY KEY (`puanId`);

--
-- Indexes for table `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorumId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `firmaistekleri`
--
ALTER TABLE `firmaistekleri`
  MODIFY `firmaIstekId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hakkimizda`
--
ALTER TABLE `hakkimizda`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `isletmeGiris`
--
ALTER TABLE `isletmeGiris`
  MODIFY `isletmeId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kullaniciId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `puanlar`
--
ALTER TABLE `puanlar`
  MODIFY `puanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorumId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
