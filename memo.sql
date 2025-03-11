-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 9.2.0 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table memo.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `idadmin` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `namalengkap` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`idadmin`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel memo.admin: ~0 rows (lebih kurang)
INSERT INTO `admin` (`idadmin`, `username`, `password`, `namalengkap`) VALUES
	(6, 'webdev', '$2y$12$OaAek6fZXZTug9KlJus/dOxVH4.4PJmSvXvyG7GhjXQ2jINe1w3zq', 'web developer');

-- membuang struktur untuk table memo.dmemo
CREATE TABLE IF NOT EXISTS `dmemo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor` varchar(10) NOT NULL DEFAULT '0/0',
  `tanggal` date NOT NULL,
  `nama_instansi` varchar(75) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `target_donor` int NOT NULL DEFAULT '0',
  `bus` int NOT NULL DEFAULT '0',
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `telepon` varchar(20) NOT NULL DEFAULT '',
  `piagam` varchar(100) DEFAULT '',
  `keterangan` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel memo.dmemo: ~1 rows (lebih kurang)
INSERT INTO `dmemo` (`id`, `nomor`, `tanggal`, `nama_instansi`, `alamat`, `target_donor`, `bus`, `mulai`, `selesai`, `telepon`, `piagam`, `keterangan`) VALUES
	(1, '1', '2025-03-15', 'SMKN 9 Medan', 'patriot', 50, 2, '10:00:00', '15:00:00', '088888888888', '', '');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
