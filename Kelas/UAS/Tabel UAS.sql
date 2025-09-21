-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
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


-- Membuang struktur basisdata untuk ayamapp
DROP DATABASE IF EXISTS `ayamapp`;
CREATE DATABASE IF NOT EXISTS `ayamapp` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ayamapp`;

-- membuang struktur untuk table ayamapp.outlets
DROP TABLE IF EXISTS `outlets`;
CREATE TABLE IF NOT EXISTS `outlets` (
  `id_outlet` int NOT NULL AUTO_INCREMENT,
  `nama_outlet` varchar(20) NOT NULL,
  `alamat_outlet` varchar(35) DEFAULT NULL,
  `tipe_outlet` varchar(12) NOT NULL,
  `status_outlet` smallint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_outlet`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table ayamapp.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `nama_product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga_product` int NOT NULL,
  `gambar_product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `keterangan_product` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` smallint DEFAULT NULL,
  PRIMARY KEY (`id_product`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table ayamapp.products_inventory
DROP TABLE IF EXISTS `products_inventory`;
CREATE TABLE IF NOT EXISTS `products_inventory` (
  `id_inventory` int NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_product` int NOT NULL,
  `id_outlet` int NOT NULL,
  `quantity` int NOT NULL,
  `keterangan_inventory` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_inventory`),
  KEY `id_product` (`id_product`),
  KEY `id_outlet` (`id_outlet`),
  CONSTRAINT `products_inventory_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  CONSTRAINT `products_inventory_ibfk_2` FOREIGN KEY (`id_outlet`) REFERENCES `outlets` (`id_outlet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table ayamapp.products_quantity
DROP TABLE IF EXISTS `products_quantity`;
CREATE TABLE IF NOT EXISTS `products_quantity` (
  `id_quantity` int NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL,
  `id_outlet` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id_quantity`),
  KEY `id_product` (`id_product`),
  KEY `id_outlet` (`id_outlet`),
  CONSTRAINT `products_quantity_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  CONSTRAINT `products_quantity_ibfk_2` FOREIGN KEY (`id_outlet`) REFERENCES `outlets` (`id_outlet`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table ayamapp.transaction_details
DROP TABLE IF EXISTS `transaction_details`;
CREATE TABLE IF NOT EXISTS `transaction_details` (
  `id_struk` int NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL,
  `id_outlet` int NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_struk`),
  KEY `id_product` (`id_product`),
  KEY `id_outlet` (`id_outlet`),
  CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  CONSTRAINT `transaction_details_ibfk_2` FOREIGN KEY (`id_outlet`) REFERENCES `outlets` (`id_outlet`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table ayamapp.useslogs
DROP TABLE IF EXISTS `useslogs`;
CREATE TABLE IF NOT EXISTS `useslogs` (
  `latitude` int NOT NULL,
  `longitude` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
