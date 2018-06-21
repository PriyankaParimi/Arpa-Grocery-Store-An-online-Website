-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2016 at 04:59 AM
-- Server version: 5.5.49-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery1`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(200) NOT NULL,
  `brand_title` text NOT NULL,
  `brand_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=413 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`, `brand_description`) VALUES
(401, 'GreatValue', ''),
(402, 'Dannon', 'famous for milk'),
(403, 'Kroggers', 'kroggers '),
(404, 'Aveeno', 'Aveeno'),
(405, 'Target', 'Target'),
(406, 'walgreens', 'walgreens'),
(410, 'Jersey', 'jersey'),
(411, 'Pepsi', 'Pepsi');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(200) NOT NULL,
  `product_id` varchar(200) NOT NULL,
  `ip-address` varchar(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `product_title` varchar(200) NOT NULL,
  `product_image` text NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `total_amount` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(200) NOT NULL,
  `cat_title` text NOT NULL,
  `category_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `category_description`) VALUES
(201, 'fruits', 'fruits'),
(202, 'vegetables', 'vegetables'),
(203, 'bread', 'bread'),
(204, 'beverages', 'bevarages'),
(205, 'Health & Beauty', 'Health & Beauty'),
(206, 'dairy', 'dairy');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `total_amount` int(200) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `username`, `total_amount`, `order_date`) VALUES
(1, 'Priyanka', 94, '2016-12-07'),
(2, 'Archana', 36, '2016-12-08'),
(3, 'Archana', 96, '2016-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `product_id`, `product_price`, `product_quantity`, `flag`) VALUES
(1, 103, 16, 3, 1),
(1, 107, 6, 7, 0),
(1, 110, 4, 1, 1),
(2, 107, 6, 6, 0),
(3, 103, 16, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_img` text NOT NULL,
  `product_keywords` varchar(200) NOT NULL,
  `product_brand` int(200) NOT NULL,
  `product_quantity` varchar(200) NOT NULL,
  `product_flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_title`, `product_price`, `product_img`, `product_keywords`, `product_brand`, `product_quantity`, `product_flag`) VALUES
(103, 201, 'Grapes', '15', 'grapes.jpg', 'grapes Grapes fruits', 402, '83', 1),
(105, 201, 'Apple', '10', 'apples.jpg', 'Fruits fruits greatvalue Apple', 401, '100', 0),
(106, 202, 'Beans', '5', 'beans.jpg', 'Beans Bean vegetable', 403, '100', 0),
(107, 202, 'Carrots', '6', 'carrots.jpg', 'vegetables Carrots', 405, '85', 0),
(108, 203, 'Rolls', '10', 'rolls.jpg', 'Breads rolls', 405, '100', 0),
(109, 203, 'tortillos', '11', 'tortillos.jpg', 'Breads tortillos', 402, '99', 0),
(110, 204, 'Coffee', '4', 'coffee.jpg', 'Cofee beverages', 401, '92', 1),
(111, 204, '7up', '6', '7up.jpg', 'beverages 7up', 403, '95', 1),
(112, 202, 'Tomatoes', '6', 'tomatoes.jpg', 'vegetables tomatoes red', 401, '93', 1),
(113, 205, 'Vaseline1', '120', 'Vaseline.jpg', 'Aveeno Vaseline', 405, '110', 1),
(114, 206, 'Yogurt', '5', 'yogurt.jpg', 'Yogurt curd dairy', 401, '100', 1),
(115, 201, 'Oranges', '8', 'oranges.jpg', 'fruits Oranges', 403, '100', 1),
(116, 206, 'Butter', '3', 'butter.jpg', 'butter cheese GreatValue dairy', 401, '100', 1),
(118, 205, 'Vaseline', '10', 'lipbalms.jpg', 'balm', 404, '100', 0),
(121, 203, 'tortillos', '8', 'tortillos.jpg', 'Breads tortillos', 405, '100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `first_name`, `last_name`, `email`, `password`) VALUES
('admin', 'admin', 'admin', 'admin@gmail.com', 'admin123'),
('Archana', 'archana', 'g', 'archana@gmail.com', '37f706226d2cb349334a494923bb14db'),
('arpitha', 'arpitha', 'm', 'arpita.mothukuri@gmail.com', '1f642da5e154c40d02c9765421c1e2c3'),
('Priyanka', 'Priyanka', 'Parimi', 'Priyanka@gmail.com', '654d97c2330e1a725b686065a2b51d68');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_fk` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=413;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=207;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `product_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
