-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 01 Oca 2022, 12:36:04
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
-- Veritabanı: `karar_destek_sistemleri_proje`
--

DELIMITER $$
--
-- Yordamlar
--
DROP PROCEDURE IF EXISTS `deneme`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deneme` ()  NO SQL
SELECT ariza.makina_id , ariza.ariza_turu 
FROM ariza , makina 
WHERE ariza.makina_id = makina.makina_id 
GROUP BY ariza.ariza_id$$

DROP PROCEDURE IF EXISTS `kalite_kontrol`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kalite_kontrol` ()  NO SQL
SELECT siparis.siparis_id , siparis.siparis_adeti, kalite_kontrol.saglam_adet , kalite_kontrol.defolu_adet , kalite_kontrol.tamir_adet 
FROM kalite_kontrol , siparis 
WHERE kalite_kontrol.siparis_id = siparis.siparis_id$$

DROP PROCEDURE IF EXISTS `kalite_kontrol_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kalite_kontrol_update` ()  NO SQL
UPDATE  `kalite_kontrol` SET   kalite_kontrol.siparis_id = 1 , kalite_kontrol.saglam_adet = 100 , kalite_kontrol.defolu_adet = 20 , kalite_kontrol.tamir_adet = 20 
WHERE kalite_kontrol.kalite_id = 1$$

DROP PROCEDURE IF EXISTS `kalite_kontrol_yuzde`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kalite_kontrol_yuzde` ()  NO SQL
SELECT round((kalite_kontrol.saglam_adet / siparis.siparis_adeti)*100,2) as saglam_yuzde , 
round((kalite_kontrol.defolu_adet / siparis.siparis_adeti)*100,2) as defolu_yuzde , 
round((kalite_kontrol.tamir_adet / siparis.siparis_adeti)*100,2) as tamir_yuzde 
FROM 
siparis , kalite_kontrol 
WHERE siparis.siparis_id = kalite_kontrol.siparis_id
GROUP BY siparis.siparis_id$$

DROP PROCEDURE IF EXISTS `kesimhane`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `kesimhane` ()  NO SQL
SELECT siparis.siparis_id , siparis.istenen_parca , kesimhane.cikan_parca , (SELECT CASE 
 WHEN ((siparis.istenen_parca)-(kesimhane.cikan_parca)) > 0 THEN "Kesim Fazlası"
 ELSE "Kesim Açığı"
 END) as kesim_farki , siparis.siparis_tarihi , kesimhane.kesim_tarihi , DATEDIFF(kesimhane.kesim_tarihi,siparis.siparis_tarihi) AS kesim_suresi
FROM kesimhane , siparis 
WHERE kesimhane.kesim_id = siparis.kesim_id$$

DROP PROCEDURE IF EXISTS `makina_ariza`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `makina_ariza` ()  NO SQL
SELECT makina.makina_id , makina.makina_turu ,ariza.ariza_turu,round(AVG(ariza.ariza_suresi)) as ortalama_ariza_suresi , COUNT(ariza.ariza_turu) as ariza_sikligi
FROM makina , ariza 
WHERE makina.makina_id = ariza.makina_id 
GROUP BY ariza.ariza_turu$$

DROP PROCEDURE IF EXISTS `makina_igne`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `makina_igne` ()  NO SQL
SELECT makina.makina_id , makina.makina_turu ,igne.igne_turu , igne.igne_boyutu 
FROM makina,igne,makina_igne
WHERE makina.makina_id=makina_igne.makina_id AND igne.igne_id = makina_igne.igne_id$$

DROP PROCEDURE IF EXISTS `performans`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `performans` ()  NO SQL
SELECT performans.siparis_id , operator.operator_adi , performans.bes_dk_op ,(performans.bes_dk_op*12)
AS bir_saatlik ,(performans.bes_dk_op*108) AS bir_gunluk , performans.tarih 
FROM performans , siparis , operator
WHERE operator.operator_id = performans.operator_id and siparis.siparis_id=performans.siparis_id$$

DROP PROCEDURE IF EXISTS `siparis`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `siparis` ()  NO SQL
SELECT siparis.siparis_id , tedarikci.tedarikci_adi , operasyon.operasyon_adi , siparis.siparis_adeti , siparis.siparis_tarihi 
FROM siparis INNER JOIN tedarikci ON siparis.tedarikci_id = tedarikci.tedarikci_id INNER JOIN siparis_operasyon ON siparis_operasyon.siparis_id = siparis.siparis_id INNER JOIN operasyon ON operasyon.operasyon_id = siparis_operasyon.operasyon_id
GROUP BY siparis.siparis_id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ariza`
--

DROP TABLE IF EXISTS `ariza`;
CREATE TABLE IF NOT EXISTS `ariza` (
  `ariza_id` int(11) NOT NULL,
  `makina_id` int(11) NOT NULL AUTO_INCREMENT,
  `ariza_turu` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `ariza_suresi` int(11) NOT NULL,
  `ariza_tarihi` date NOT NULL,
  PRIMARY KEY (`ariza_id`),
  KEY `makina_id` (`makina_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ariza`
--

INSERT INTO `ariza` (`ariza_id`, `makina_id`, `ariza_turu`, `ariza_suresi`, `ariza_tarihi`) VALUES
(1, 1, 'İğne Kırma', 20, '2021-06-14'),
(2, 1, 'İp Sarma', 20, '2021-07-14'),
(3, 1, 'İğne Kırma', 15, '2021-08-14'),
(4, 1, 'İğne Kırma', 17, '2021-09-14'),
(5, 1, 'Masura Hatası', 12, '2021-10-18'),
(6, 1, 'İp Sarma', 13, '2021-11-18'),
(7, 1, 'İğne Kırma', 25, '2021-12-18'),
(8, 5, 'Bobin Sarma', 35, '2021-06-21'),
(9, 5, 'İğne Kırma', 10, '2021-07-10'),
(11, 5, 'Zoje Error Hatası', 19, '2021-08-21'),
(12, 5, 'Bobin Sarma', 14, '2021-09-18'),
(13, 5, 'İğne Kırma', 13, '2021-10-21'),
(14, 5, 'İğne Kırma', 25, '2021-11-15'),
(15, 5, 'Bobin Sarma', 16, '2021-12-23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `firma`
--

DROP TABLE IF EXISTS `firma`;
CREATE TABLE IF NOT EXISTS `firma` (
  `firma_id` int(11) NOT NULL,
  `firma_adi` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`firma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `firma`
--

INSERT INTO `firma` (`firma_id`, `firma_adi`) VALUES
(1, 'Avcı Tekstil');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hammadde`
--

DROP TABLE IF EXISTS `hammadde`;
CREATE TABLE IF NOT EXISTS `hammadde` (
  `ham_id` int(11) NOT NULL,
  `ham_nitelik` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `ham_fiyat` int(11) NOT NULL,
  `ham_adi` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`ham_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `hammadde`
--

INSERT INTO `hammadde` (`ham_id`, `ham_nitelik`, `ham_fiyat`, `ham_adi`) VALUES
(1, 'İyi', 50, 'Pamuk Kumaş'),
(2, 'Orta', 40, 'Pamuk Kumaş'),
(3, 'Kötü', 30, 'Pamuk Kumaş'),
(4, 'İyi', 30, 'Elyaf'),
(5, 'Orta', 20, 'Elyaf'),
(6, 'Kötü', 10, 'Elyaf'),
(7, 'İyi', 20, 'Polyester'),
(8, 'Orta', 15, 'Polyester'),
(9, 'Kötü', 10, 'Polyester'),
(10, 'İyi', 80, 'Keten Kumaş'),
(11, 'Orta', 75, 'Keten Kumaş'),
(12, 'Kötü', 70, 'Keten Kumaş');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hammadde_tedarik`
--

DROP TABLE IF EXISTS `hammadde_tedarik`;
CREATE TABLE IF NOT EXISTS `hammadde_tedarik` (
  `ham_id` int(11) NOT NULL,
  `tedarikci_id` int(11) NOT NULL,
  KEY `ham_id` (`ham_id`),
  KEY `tedarikci_id` (`tedarikci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `hammadde_tedarik`
--

INSERT INTO `hammadde_tedarik` (`ham_id`, `tedarikci_id`) VALUES
(1, 1),
(4, 1),
(1, 1),
(7, 1),
(10, 1),
(2, 2),
(3, 2),
(4, 2),
(11, 2),
(5, 3),
(11, 3),
(1, 3),
(11, 3),
(1, 4),
(2, 4),
(10, 4),
(11, 4),
(7, 4),
(1, 5),
(2, 5),
(4, 5),
(5, 5),
(10, 5),
(11, 5),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(8, 1),
(9, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `igne`
--

DROP TABLE IF EXISTS `igne`;
CREATE TABLE IF NOT EXISTS `igne` (
  `igne_id` int(11) NOT NULL,
  `igne_turu` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `igne_boyutu` int(11) NOT NULL,
  PRIMARY KEY (`igne_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `igne`
--

INSERT INTO `igne` (`igne_id`, `igne_turu`, `igne_boyutu`) VALUES
(1, 'DB*1', 1),
(2, 'DB*1', 2),
(3, 'DB*1', 3),
(4, 'DC*27', 1),
(5, 'DC*27', 2),
(6, 'DC*27', 3),
(7, 'TQX1', 1),
(8, 'TQX1', 2),
(9, 'TQX1', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kalite_kontrol`
--

DROP TABLE IF EXISTS `kalite_kontrol`;
CREATE TABLE IF NOT EXISTS `kalite_kontrol` (
  `saglam_adet` int(11) NOT NULL,
  `defolu_adet` int(11) NOT NULL,
  `tamir_adet` int(11) NOT NULL,
  `kalite_id` int(11) NOT NULL,
  `siparis_id` int(11) NOT NULL,
  PRIMARY KEY (`kalite_id`),
  KEY `siparis_id` (`siparis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kalite_kontrol`
--

INSERT INTO `kalite_kontrol` (`saglam_adet`, `defolu_adet`, `tamir_adet`, `kalite_id`, `siparis_id`) VALUES
(50, 10, 10, 1, 1),
(285, 5, 10, 2, 2),
(500, 20, 80, 3, 3),
(95, 3, 2, 4, 4),
(600, 100, 200, 5, 5),
(160, 20, 20, 7, 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kesimhane`
--

DROP TABLE IF EXISTS `kesimhane`;
CREATE TABLE IF NOT EXISTS `kesimhane` (
  `kesim_id` int(11) NOT NULL AUTO_INCREMENT,
  `siparis_id` int(11) NOT NULL,
  `cikan_parca` int(11) NOT NULL,
  `kesim_tarihi` date NOT NULL,
  PRIMARY KEY (`kesim_id`),
  KEY `siparis_id` (`siparis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kesimhane`
--

INSERT INTO `kesimhane` (`kesim_id`, `siparis_id`, `cikan_parca`, `kesim_tarihi`) VALUES
(1, 1, 1600, '2021-06-15'),
(2, 2, 800, '2021-07-20'),
(3, 3, 1500, '2021-08-21'),
(4, 4, 800, '2021-09-28'),
(5, 5, 2900, '2021-11-02'),
(6, 6, 2000, '2021-11-09'),
(7, 7, 600, '2021-12-23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `makina`
--

DROP TABLE IF EXISTS `makina`;
CREATE TABLE IF NOT EXISTS `makina` (
  `makina_id` int(11) NOT NULL,
  `makina_turu` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`makina_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `makina`
--

INSERT INTO `makina` (`makina_id`, `makina_turu`) VALUES
(1, 'Düz Makina'),
(2, 'Düz Makina'),
(3, 'Düz Makina'),
(4, 'Düz Makina'),
(5, 'Overlok Makinası'),
(6, 'Overlok Makinası'),
(7, 'Overlok Makinası'),
(8, 'Reçme Makinası'),
(9, 'Reçme Makinası'),
(10, 'Reçme Makinası'),
(11, 'Düğme Makinası'),
(12, 'Düğme Makinası'),
(13, 'Düğme Makinası'),
(14, 'Lastik Makinası'),
(15, 'Lastik Makinası'),
(16, 'Lastik Makinası');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `makina_igne`
--

DROP TABLE IF EXISTS `makina_igne`;
CREATE TABLE IF NOT EXISTS `makina_igne` (
  `makina_id` int(11) NOT NULL,
  `igne_id` int(11) NOT NULL,
  KEY `makina_id` (`makina_id`),
  KEY `igne_id` (`igne_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `makina_igne`
--

INSERT INTO `makina_igne` (`makina_id`, `igne_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(4, 1),
(3, 3),
(5, 6),
(6, 4),
(9, 6),
(12, 8),
(15, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `operasyon`
--

DROP TABLE IF EXISTS `operasyon`;
CREATE TABLE IF NOT EXISTS `operasyon` (
  `operasyon_id` int(11) NOT NULL,
  `operasyon_adi` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`operasyon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `operasyon`
--

INSERT INTO `operasyon` (`operasyon_id`, `operasyon_adi`) VALUES
(1, 'Çıma çekme'),
(2, 'Büzgü'),
(3, 'Kenar Bağlama'),
(4, 'Reçme'),
(5, 'Lastik takma'),
(6, 'Biye'),
(7, 'Çatma'),
(8, 'Fırfır'),
(9, 'Gaze Çekme'),
(10, 'kemer takma'),
(11, 'Manşet Takma'),
(12, 'Pervaz Takma'),
(13, 'Pens Atma'),
(14, 'Tela Takma');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `operator`
--

DROP TABLE IF EXISTS `operator`;
CREATE TABLE IF NOT EXISTS `operator` (
  `operator_id` int(11) NOT NULL,
  `operator_adi` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`operator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `operator`
--

INSERT INTO `operator` (`operator_id`, `operator_adi`) VALUES
(1, 'Ömer Kars'),
(2, 'Mehmet Furkan Anter'),
(3, 'Mustafa Çağrı Açıkgöz'),
(4, 'Şevket Can Yorulmaz'),
(5, 'Samet Güney'),
(6, 'Özde Kaymaz'),
(7, 'Gülden Temel'),
(8, 'Elif Mutlu'),
(9, 'Taner Türkoğlu'),
(10, 'Fatma Bilge');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `performans`
--

DROP TABLE IF EXISTS `performans`;
CREATE TABLE IF NOT EXISTS `performans` (
  `performans_id` int(11) NOT NULL AUTO_INCREMENT,
  `operator_id` int(11) NOT NULL,
  `siparis_id` int(11) NOT NULL,
  `tarih` date NOT NULL,
  `bes_dk_op` int(11) NOT NULL,
  PRIMARY KEY (`performans_id`),
  KEY `operator_id` (`operator_id`),
  KEY `siapris_id` (`siparis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `performans`
--

INSERT INTO `performans` (`performans_id`, `operator_id`, `siparis_id`, `tarih`, `bes_dk_op`) VALUES
(1, 1, 1, '2021-06-14', 10),
(2, 1, 2, '2021-07-17', 6),
(3, 1, 3, '2021-10-19', 4),
(4, 1, 4, '2021-10-25', 25),
(5, 1, 5, '2021-10-31', 21),
(6, 1, 6, '2021-11-08', 8),
(7, 1, 7, '2021-12-17', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis`
--

DROP TABLE IF EXISTS `siparis`;
CREATE TABLE IF NOT EXISTS `siparis` (
  `siparis_id` int(11) NOT NULL,
  `firma_id` int(11) NOT NULL,
  `tedarikci_id` int(11) NOT NULL,
  `kesim_id` int(11) DEFAULT NULL,
  `siparis_adeti` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `istenen_parca` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `siparis_tarihi` date NOT NULL,
  PRIMARY KEY (`siparis_id`),
  KEY `firma_id` (`firma_id`),
  KEY `tedarikci_id` (`tedarikci_id`),
  KEY `kesim_id` (`kesim_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `siparis`
--

INSERT INTO `siparis` (`siparis_id`, `firma_id`, `tedarikci_id`, `kesim_id`, `siparis_adeti`, `istenen_parca`, `siparis_tarihi`) VALUES
(1, 1, 1, 1, '500', '1500', '2021-06-09'),
(2, 1, 2, 2, '300', '800', '2021-07-15'),
(3, 1, 3, 3, '600', '1800', '2021-08-16'),
(4, 1, 4, 4, '100', '550', '2021-09-24'),
(5, 1, 5, 5, '900', '2700', '2021-10-30'),
(6, 1, 1, 6, '600', '1900', '2021-11-06'),
(7, 1, 2, 7, '200', '500', '2021-12-16');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis_operasyon`
--

DROP TABLE IF EXISTS `siparis_operasyon`;
CREATE TABLE IF NOT EXISTS `siparis_operasyon` (
  `siparis_id` int(11) NOT NULL,
  `operasyon_id` int(11) NOT NULL,
  KEY `siparis_id` (`siparis_id`),
  KEY `operasyon_id` (`operasyon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `siparis_operasyon`
--

INSERT INTO `siparis_operasyon` (`siparis_id`, `operasyon_id`) VALUES
(1, 1),
(1, 10),
(1, 5),
(2, 12),
(2, 2),
(2, 13),
(3, 10),
(3, 11),
(3, 4),
(4, 14),
(4, 6),
(4, 12),
(5, 9),
(5, 1),
(5, 2),
(6, 13),
(6, 13),
(6, 1),
(6, 14),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tedarikci`
--

DROP TABLE IF EXISTS `tedarikci`;
CREATE TABLE IF NOT EXISTS `tedarikci` (
  `tedarikci_id` int(11) NOT NULL,
  `tedarikci_adi` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`tedarikci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `tedarikci`
--

INSERT INTO `tedarikci` (`tedarikci_id`, `tedarikci_adi`) VALUES
(1, 'Karslıoğulları Toptan Ticaret'),
(2, 'Acar Giyim'),
(3, 'Özcan Kumaş Ticaret'),
(4, 'Erenler Giyim Toptan A.Ş.'),
(5, 'Kardeşler Butik Tekstil ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'omerkars0078@gmail.com', 'f9226e7a54580ea89f39c72e2e970c0b'),
(2, 'omer123@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'omer200078@hotmail.com', 'd06450914c84f958531a85f4db7a277d'),
(4, 'furkan@gmail.com', 'bdc6a9d55a26ee383a9b5e7bf8e42c83'),
(5, 'caqri@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `ariza`
--
ALTER TABLE `ariza`
  ADD CONSTRAINT `ariza_ibfk_1` FOREIGN KEY (`makina_id`) REFERENCES `makina` (`makina_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `hammadde_tedarik`
--
ALTER TABLE `hammadde_tedarik`
  ADD CONSTRAINT `hammadde_tedarik_ibfk_1` FOREIGN KEY (`ham_id`) REFERENCES `hammadde` (`ham_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hammadde_tedarik_ibfk_2` FOREIGN KEY (`tedarikci_id`) REFERENCES `tedarikci` (`tedarikci_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `kalite_kontrol`
--
ALTER TABLE `kalite_kontrol`
  ADD CONSTRAINT `kalite_kontrol_ibfk_1` FOREIGN KEY (`siparis_id`) REFERENCES `siparis` (`siparis_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `kesimhane`
--
ALTER TABLE `kesimhane`
  ADD CONSTRAINT `kesimhane_ibfk_1` FOREIGN KEY (`siparis_id`) REFERENCES `siparis` (`siparis_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `makina_igne`
--
ALTER TABLE `makina_igne`
  ADD CONSTRAINT `makina_igne_ibfk_1` FOREIGN KEY (`igne_id`) REFERENCES `igne` (`igne_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `makina_igne_ibfk_2` FOREIGN KEY (`makina_id`) REFERENCES `makina` (`makina_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `performans`
--
ALTER TABLE `performans`
  ADD CONSTRAINT `performans_ibfk_1` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`operator_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `performans_ibfk_2` FOREIGN KEY (`siparis_id`) REFERENCES `siparis` (`siparis_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `siparis`
--
ALTER TABLE `siparis`
  ADD CONSTRAINT `siparis_ibfk_1` FOREIGN KEY (`firma_id`) REFERENCES `firma` (`firma_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siparis_ibfk_3` FOREIGN KEY (`tedarikci_id`) REFERENCES `tedarikci` (`tedarikci_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `siparis_operasyon`
--
ALTER TABLE `siparis_operasyon`
  ADD CONSTRAINT `siparis_operasyon_ibfk_1` FOREIGN KEY (`operasyon_id`) REFERENCES `operasyon` (`operasyon_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siparis_operasyon_ibfk_2` FOREIGN KEY (`siparis_id`) REFERENCES `siparis` (`siparis_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
