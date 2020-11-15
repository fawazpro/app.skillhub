-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `image` int(11) NOT NULL,
  `p_category` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `details` longtext NOT NULL,
  `seller` tinytext NOT NULL,
  `promotion` varchar(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2020-11-15 07:01:24
