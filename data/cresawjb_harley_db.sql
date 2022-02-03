-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2020 at 12:37 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cresawjb_harley_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `full_name` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL DEFAULT '1234',
  `status` int(1) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`full_name`, `username`, `password`, `status`, `date`, `id`) VALUES
('web master', 'admin03', '1234', 3, '2020-04-14 09:30:11', 1),
('super admin', 'admin02', '1234', 2, '2020-04-14 09:30:11', 2),
('default admin', 'admin01', '1234', 1, '2020-04-14 09:30:38', 3);

-- --------------------------------------------------------

--
-- Table structure for table `allergies`
--

DROP TABLE IF EXISTS `allergies`;
CREATE TABLE IF NOT EXISTS `allergies` (
  `allergy` varchar(25) NOT NULL,
  `summary` varchar(160) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `allergy` (`allergy`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allergies`
--

INSERT INTO `allergies` (`allergy`, `summary`, `status`, `date`, `id`) VALUES
('Celery', 'Linseed, Sesame Seed, Peach, Banana, Avocado, Kiwi Fruit, Passion Fruit, Garlic, Mustard Seeds, Aniseed, Chamomile', 0, '2020-04-14 09:36:03', 1),
('Cheese', 'Fresh Cheese, Barley, Oats, Cottage, Queso, Cream, Mascarpone, Ricotta, Chevre', 0, '2020-04-14 09:36:03', 2),
('Egg', 'Chicken Egg, Quail, Duck, Caviar, Goose, Turkey, Emu, Hilsa, Ostrich, Bantam', 0, '2020-04-14 09:36:12', 3),
('Fish', 'Shellfish, Shrimp, Prawns, Crayfish, Lobster, Squid, Scallops', 0, '2020-04-14 09:36:12', 4),
('Gluten', 'Gliadins, Glutenins', 0, '2020-04-14 09:36:34', 5),
('Milk', 'Cow’s Milk, Milk Powder, Cheese, Butter, Margarine, Yogurt, Cream', 0, '2020-04-14 09:36:34', 6),
('Mustard', 'Yellow, Dijon, Spicy Brown, Hot, Whole Grain, Stone Ground, Honey, Horseradish', 0, '2020-04-14 09:36:46', 7),
('Peanut', 'Almonds, Hazelnuts, Walnuts, Brazil Nuts, Cashews, Pecans, Pistachios, Macadamia Nuts, Pine Nuts', 0, '2020-04-14 09:36:46', 8),
('Soy', 'Soy Milk, Soybeans, Soy Flour, Edamame, Tempeh, Miso', 0, '2020-04-14 09:36:57', 9),
('Wheat', 'Spelt, Durum, Einkorn, Emmer, Khorasan Compactum, Triticum Timopheevii, Trticum Turgidum, Triticum Polonicum', 0, '2020-04-14 09:36:57', 10);

-- --------------------------------------------------------

--
-- Table structure for table `map_meal_allergies`
--

DROP TABLE IF EXISTS `map_meal_allergies`;
CREATE TABLE IF NOT EXISTS `map_meal_allergies` (
  `meal_id` int(11) NOT NULL,
  `allergy_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_meal_allergies`
--

INSERT INTO `map_meal_allergies` (`meal_id`, `allergy_id`, `status`, `date`, `id`) VALUES
(1, 6, 1, '2020-04-21 19:21:58', 1),
(2, 4, 2, '2020-04-21 19:21:58', 2),
(3, 3, 3, '2020-04-21 19:21:58', 3),
(4, 1, 4, '2020-04-21 19:21:58', 4),
(4, 3, 4, '2020-04-21 22:24:44', 5),
(4, 6, 4, '2020-04-21 22:24:44', 6);

-- --------------------------------------------------------

--
-- Table structure for table `map_user_allergies`
--

DROP TABLE IF EXISTS `map_user_allergies`;
CREATE TABLE IF NOT EXISTS `map_user_allergies` (
  `user_id` int(11) NOT NULL,
  `allergy_id` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_user_allergies`
--

INSERT INTO `map_user_allergies` (`user_id`, `allergy_id`, `status`, `date`, `id`) VALUES
(1, 4, 0, '2020-04-21 13:34:21', 1),
(1, 5, 0, '2020-04-21 13:38:33', 2),
(1, 8, 0, '2020-04-21 21:43:12', 4),
(2, 4, 0, '2020-04-21 13:34:21', 5),
(2, 5, 0, '2020-04-21 13:38:33', 6),
(2, 8, 0, '2020-04-21 21:43:12', 7);

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

DROP TABLE IF EXISTS `meals`;
CREATE TABLE IF NOT EXISTS `meals` (
  `image` varchar(25) DEFAULT NULL,
  `meal` varchar(50) NOT NULL,
  `summary` varchar(160) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`image`, `meal`, `summary`, `status`, `date`, `id`) VALUES
('202004140733001.png', 'Bread and Tea', 'A Healthy Breakfast', 1, '2020-04-14 09:39:27', 1),
('202004140733002.png', 'Beans, Plantain and Fish', 'A Proteinous Lunch', 2, '2020-04-14 10:21:10', 2),
('202004140733003.png', 'Noodles and Egg', 'A Light Dinner', 3, '2020-04-14 10:22:15', 3),
('202004140733004.png', 'Cupcake and Ice Cream', 'A Sweet Dessert', 4, '2020-04-14 10:22:15', 4);

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

DROP TABLE IF EXISTS `suggestions`;
CREATE TABLE IF NOT EXISTS `suggestions` (
  `user_id` int(11) NOT NULL,
  `suggestion` varchar(160) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suggestions`
--

INSERT INTO `suggestions` (`user_id`, `suggestion`, `status`, `date`, `id`) VALUES
(1, 'Sea Biscuit', 1, '2020-04-21 12:59:58', 1),
(2, 'Diced Pineapples', 2, '2020-04-21 12:59:58', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `full_name` varchar(50) NOT NULL,
  `sex` enum('m','f') DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`full_name`, `sex`, `email`, `phone`, `username`, `password`, `status`, `date`, `id`) VALUES
('john doe', 'm', 'john@example.com', '01234567891', 'john', '1234', 1, '2020-04-14 09:34:11', 1),
('jane doe', 'f', 'jane@example.com', '01234567892', 'jane', '1234', 1, '2020-04-14 09:34:11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_dessert`
--

DROP TABLE IF EXISTS `user_dessert`;
CREATE TABLE IF NOT EXISTS `user_dessert` (
  `user_id` int(11) NOT NULL,
  `breakfast` enum('0','1') NOT NULL DEFAULT '0',
  `lunch` enum('0','1') NOT NULL DEFAULT '0',
  `dinner` enum('0','1') NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_dessert`
--

INSERT INTO `user_dessert` (`user_id`, `breakfast`, `lunch`, `dinner`, `status`, `date`, `id`) VALUES
(1, '1', '0', '0', 0, '2020-04-21 13:23:21', 1),
(2, '0', '0', '1', 0, '2020-04-21 13:23:21', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_meal_plan`
--

DROP TABLE IF EXISTS `user_meal_plan`;
CREATE TABLE IF NOT EXISTS `user_meal_plan` (
  `user_id` int(11) NOT NULL,
  `breakfast_id` int(11) DEFAULT NULL,
  `lunch_id` int(11) DEFAULT NULL,
  `dinner_id` int(11) DEFAULT NULL,
  `dessert_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_meal_plan`
--

INSERT INTO `user_meal_plan` (`user_id`, `breakfast_id`, `lunch_id`, `dinner_id`, `dessert_id`, `status`, `date`, `id`) VALUES
(1, 1, NULL, 3, 4, 0, '2020-04-21 20:45:05', 1),
(2, 1, NULL, 3, 4, 0, '2020-04-21 20:45:05', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
