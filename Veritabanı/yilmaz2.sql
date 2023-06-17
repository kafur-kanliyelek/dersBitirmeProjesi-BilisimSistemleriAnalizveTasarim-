-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 04 Oca 2023, 18:29:59
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `yilmaz2`
--

DELIMITER $$
--
-- Yordamlar
--
DROP PROCEDURE IF EXISTS `ekle`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ekle` (IN `id` INT, IN `ad` VARCHAR(50) CHARSET utf8, IN `soyad` VARCHAR(50) CHARSET utf8)  NO SQL
INSERT INTO calisanlar(calisanlar.calisan_id, calisanlar.calisan_ad, calisanlar.calisan_soyad)
VALUES(id, ad, soyad)$$

DROP PROCEDURE IF EXISTS `sayi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sayi` ()  NO SQL
SELECT calisanlar.calisan_ad, calisanlar.calisan_soyad, yoklama.yoklama_calisan_id, COUNT(yoklama.yoklama_calisan_id)
FROM yoklama, calisanlar
WHERE  yoklama.yoklama_calisan_id = calisanlar.calisan_id
GROUP BY yoklama.yoklama_calisan_id$$

DROP PROCEDURE IF EXISTS `sil`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sil` (IN `ad` VARCHAR(50) CHARSET utf8, IN `soyad` VARCHAR(50) CHARSET utf8)  NO SQL
DELETE FROM calisanlar
WHERE calisanlar.calisan_ad = ad AND
		calisanlar.calisan_soyad = soyad$$

DROP PROCEDURE IF EXISTS `toplantiEkle`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `toplantiEkle` (IN `id` INT)  NO SQL
INSERT INTO `toplanti`(`toplanti_id`, `toplanti_tarih`) VALUES (id,now())$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ara_qr_calisan`
--

DROP TABLE IF EXISTS `ara_qr_calisan`;
CREATE TABLE IF NOT EXISTS `ara_qr_calisan` (
  `qr_kod_id` int(11) NOT NULL,
  `qr_kod` int(11) NOT NULL,
  KEY `qr_kod_id` (`qr_kod_id`),
  KEY `qr_kod` (`qr_kod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ara_toplanti_calisan`
--

DROP TABLE IF EXISTS `ara_toplanti_calisan`;
CREATE TABLE IF NOT EXISTS `ara_toplanti_calisan` (
  `toplnati_id` int(11) NOT NULL,
  `calisan_id` int(11) NOT NULL,
  KEY `toplnati_id` (`toplnati_id`),
  KEY `calisan_id` (`calisan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `calisanlar`
--

DROP TABLE IF EXISTS `calisanlar`;
CREATE TABLE IF NOT EXISTS `calisanlar` (
  `calisan_id` int(3) NOT NULL AUTO_INCREMENT,
  `calisan_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `calisan_soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`calisan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `calisanlar`
--

INSERT INTO `calisanlar` (`calisan_id`, `calisan_ad`, `calisan_soyad`) VALUES
(5, 'Sedef', 'Sss'),
(9, 'Ozan', 'Y.'),
(10, 'Ilknur', 'T.'),
(11, 'Kafur', 'K.'),
(12, 'Ezgi', 'D.'),
(13, 'Talha', 'T.'),
(15, 'Sumeyye', 'U.');

--
-- Tetikleyiciler `calisanlar`
--
DROP TRIGGER IF EXISTS `aciklama`;
DELIMITER $$
CREATE TRIGGER `aciklama` AFTER INSERT ON `calisanlar` FOR EACH ROW INSERT INTO log
VALUES(new.calisan_id,now(),(CONCAT(new.calisan_ad, ' ', new.calisan_soyad, ' isimli üye eklendi')))
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `eski_calisan`;
DELIMITER $$
CREATE TRIGGER `eski_calisan` BEFORE DELETE ON `calisanlar` FOR EACH ROW INSERT INTO eski_calisan 
VALUES(old.calisan_id, old.calisan_ad, old.calisan_soyad, now())
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `guncel_calisan_sayisi_ekleme`;
DELIMITER $$
CREATE TRIGGER `guncel_calisan_sayisi_ekleme` AFTER INSERT ON `calisanlar` FOR EACH ROW INSERT INTO guncel_calisan_sayisi
VALUES((SELECT COUNT(*) FROM calisanlar), now())
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `guncel_calisan_sayisi_silme`;
DELIMITER $$
CREATE TRIGGER `guncel_calisan_sayisi_silme` AFTER DELETE ON `calisanlar` FOR EACH ROW INSERT INTO guncel_calisan_sayisi
VALUES((SELECT COUNT(*) FROM calisanlar),now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `calisan_qr_kod`
--

DROP TABLE IF EXISTS `calisan_qr_kod`;
CREATE TABLE IF NOT EXISTS `calisan_qr_kod` (
  `qr_kod_id` int(11) NOT NULL,
  `qr_kod` int(11) NOT NULL,
  PRIMARY KEY (`qr_kod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contribution`
--

DROP TABLE IF EXISTS `contribution`;
CREATE TABLE IF NOT EXISTS `contribution` (
  `student` text NOT NULL,
  `contribution` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `contribution`
--

INSERT INTO `contribution` (`student`, `contribution`) VALUES
('harry', 10),
('maddy', 20),
('andy', 25),
('pandy', 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `eski_calisan`
--

DROP TABLE IF EXISTS `eski_calisan`;
CREATE TABLE IF NOT EXISTS `eski_calisan` (
  `calisan_id` int(11) NOT NULL,
  `calisan_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `calisan_soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayrilma_tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `eski_calisan`
--

INSERT INTO `eski_calisan` (`calisan_id`, `calisan_ad`, `calisan_soyad`, `ayrilma_tarih`) VALUES
(1, 'asd', 'dsa', '2022-12-12'),
(1, 'awe', 'awe', '2022-12-12'),
(2, 'zxc', 'zxc', '2022-12-15'),
(2, 'zxc', 'zxc', '2022-12-15'),
(3, 'sdfg', 'fdsg', '2022-12-16'),
(4, 'we', 'we', '2022-12-16'),
(6, 'ad', 'soyad', '2022-12-16'),
(7, 'isim', 'soyisim', '2022-12-16'),
(8, 'w', 'w', '2022-12-16'),
(1, 'ad', 'soyad', '2022-12-17'),
(14, 'Sumeyye', 'P.', '2022-12-17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `guncel_calisan_sayisi`
--

DROP TABLE IF EXISTS `guncel_calisan_sayisi`;
CREATE TABLE IF NOT EXISTS `guncel_calisan_sayisi` (
  `guncel_calisan_sayisi` int(11) NOT NULL,
  `sayi_tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `guncel_calisan_sayisi`
--

INSERT INTO `guncel_calisan_sayisi` (`guncel_calisan_sayisi`, `sayi_tarih`) VALUES
(1, '2022-12-12'),
(2, '2022-12-12'),
(1, '2022-12-12'),
(2, '2022-12-12'),
(1, '2022-12-15'),
(2, '2022-12-15'),
(3, '2022-12-15'),
(2, '2022-12-15'),
(3, '2022-12-15'),
(4, '2022-12-16'),
(5, '2022-12-16'),
(4, '2022-12-16'),
(3, '2022-12-16'),
(2, '2022-12-16'),
(1, '2022-12-16'),
(0, '2022-12-16'),
(1, '2022-12-16'),
(0, '2022-12-17'),
(1, '2022-12-17'),
(2, '2022-12-17'),
(3, '2022-12-17'),
(4, '2022-12-17'),
(5, '2022-12-17'),
(6, '2022-12-17'),
(7, '2022-12-17'),
(6, '2022-12-17'),
(7, '2022-12-19');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(11) NOT NULL,
  `log_tarih` date NOT NULL,
  `log_aciklama` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `log`
--

INSERT INTO `log` (`log_id`, `log_tarih`, `log_aciklama`) VALUES
(1, '2022-12-16', 'ad soyad isimli üye eklendi'),
(2, '2022-12-15', 'zxc zxc isimli üye eklendi'),
(3, '2022-12-12', 'sdf fds isimli üye eklendi'),
(4, '2022-12-15', 'we we isimli üye eklendi'),
(5, '2022-12-17', 'Sedef S. isimli üye eklendi'),
(6, '2022-12-15', 'ad soyad isimli üye eklendi'),
(7, '2022-12-16', 'isim soyisim isimli üye eklendi'),
(8, '2022-12-16', 'w w isimli üye eklendi'),
(9, '2022-12-17', 'Ozan Y. isimli üye eklendi'),
(10, '2022-12-17', 'İlknur T. isimli üye eklendi'),
(11, '2022-12-17', 'Kafur K. isimli üye eklendi'),
(12, '2022-12-17', 'Ezgi D. isimli üye eklendi'),
(13, '2022-12-17', 'Talha T. isimli üye eklendi'),
(14, '2022-12-17', 'Sümeyye P. isimli üye eklendi'),
(15, '2022-12-19', 'Sümeyye U. isimli üye eklendi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `toplanti`
--

DROP TABLE IF EXISTS `toplanti`;
CREATE TABLE IF NOT EXISTS `toplanti` (
  `toplanti_id` int(11) NOT NULL,
  `toplanti_tarih` date NOT NULL,
  PRIMARY KEY (`toplanti_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoklama`
--

DROP TABLE IF EXISTS `yoklama`;
CREATE TABLE IF NOT EXISTS `yoklama` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `yoklama_calisan_id` int(11) DEFAULT NULL,
  `yoklama_toplanti_tarih` date DEFAULT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yoklama`
--

INSERT INTO `yoklama` (`t_id`, `yoklama_calisan_id`, `yoklama_toplanti_tarih`) VALUES
(17, 5, '2022-12-02'),
(20, 11, '2022-12-02'),
(21, 12, '2022-12-02'),
(22, 13, '2022-12-02'),
(23, 15, '2022-12-02'),
(24, 5, '2022-12-16'),
(25, 9, '2022-12-16'),
(26, 10, '2022-12-16'),
(27, 11, '2022-12-16'),
(28, 12, '2022-12-16'),
(29, 13, '2022-12-16'),
(30, 15, '2022-12-16'),
(31, 5, '2022-12-20'),
(32, 5, '2022-12-20'),
(33, 5, '2022-12-20'),
(34, 5, '2022-12-20'),
(35, 5, '2022-12-20'),
(36, 5, '2022-12-20'),
(37, 5, '2022-12-20'),
(38, 5, '2022-12-20'),
(39, 5, '2022-12-20'),
(40, 5, '2022-12-20'),
(41, 5, '2022-12-20'),
(42, 5, '2022-12-20'),
(43, 5, '2022-12-20'),
(44, 5, '2022-12-20'),
(45, 5, '2022-12-20'),
(46, 5, '2022-12-20'),
(47, 11, '2022-12-20'),
(48, 5, '2022-12-20'),
(49, 9, '2022-12-20'),
(50, 10, '2022-12-20'),
(51, 11, '2022-12-20'),
(52, 5, '2022-12-21');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoklamaders`
--

DROP TABLE IF EXISTS `yoklamaders`;
CREATE TABLE IF NOT EXISTS `yoklamaders` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `yoklama_calisan_id` int(4) NOT NULL,
  `yoklama_ders_tarih` date NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yoklamaders`
--

INSERT INTO `yoklamaders` (`d_id`, `yoklama_calisan_id`, `yoklama_ders_tarih`) VALUES
(15, 5, '2022-12-07'),
(16, 5, '2022-12-14'),
(17, 9, '2022-12-06'),
(18, 9, '2022-12-13'),
(19, 11, '2022-12-07'),
(20, 11, '2022-12-07'),
(21, 13, '2022-12-20'),
(22, 9, '2022-12-20'),
(23, 10, '2022-12-20'),
(24, 5, '2022-12-21');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetici`
--

DROP TABLE IF EXISTS `yonetici`;
CREATE TABLE IF NOT EXISTS `yonetici` (
  `yonetici_user_name` int(11) NOT NULL AUTO_INCREMENT,
  `yonetici_pass` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`yonetici_user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yonetici`
--

INSERT INTO `yonetici` (`yonetici_user_name`, `yonetici_pass`) VALUES
(1, 'asd');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `ara_qr_calisan`
--
ALTER TABLE `ara_qr_calisan`
  ADD CONSTRAINT `ara_qr_calisan_ibfk_1` FOREIGN KEY (`qr_kod_id`) REFERENCES `calisan_qr_kod` (`qr_kod_id`);

--
-- Tablo kısıtlamaları `ara_toplanti_calisan`
--
ALTER TABLE `ara_toplanti_calisan`
  ADD CONSTRAINT `ara_toplanti_calisan_ibfk_1` FOREIGN KEY (`calisan_id`) REFERENCES `calisanlar` (`calisan_id`),
  ADD CONSTRAINT `ara_toplanti_calisan_ibfk_2` FOREIGN KEY (`toplnati_id`) REFERENCES `toplanti` (`toplanti_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
