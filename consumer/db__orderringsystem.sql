-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2018 at 10:36 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db__orderringsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(50) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `dateadded` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `dateadded`) VALUES
(1, 'Bread', '2018-06-19'),
(2, 'Sauce', '2018-06-19'),
(3, 'Sandwich Types', '2018-06-19'),
(4, 'Cheese', '2018-06-19'),
(5, 'Veggies', '2018-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(50) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `cart_id` varchar(50) NOT NULL,
  `dateorder` date NOT NULL,
  `dateadded` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `customer_name`, `customer_email`, `product_id`, `cart_id`, `dateorder`, `dateadded`) VALUES
(132, 'arnold', 'arnold.subastil@gmail.com', '23', '200620185b2a110b6af06', '2018-06-21', '2018-06-20'),
(133, 'arnold', 'arnold.subastil@gmail.com', '20', '200620185b2a110b6af06', '2018-06-21', '2018-06-20'),
(134, 'arnold', 'arnold.subastil@gmail.com', '17', '200620185b2a110b6af06', '2018-06-21', '2018-06-20'),
(135, 'arnold', 'arnold.subastil@gmail.com', '13', '200620185b2a110b6af06', '2018-06-21', '2018-06-20'),
(136, 'arnold', 'arnold.subastil@gmail.com', '34', '200620185b2a110b6af06', '2018-06-21', '2018-06-20'),
(137, 'sdfsdfd', 'arnoldcsubastil@gmail.com', '21', '200620185b2a11dc99a6a', '2018-06-21', '2018-06-20'),
(138, 'sdfsdfd', 'arnoldcsubastil@gmail.com', '19', '200620185b2a11dc99a6a', '2018-06-21', '2018-06-20'),
(139, 'sdfsdfd', 'arnoldcsubastil@gmail.com', '17', '200620185b2a11dc99a6a', '2018-06-21', '2018-06-20'),
(140, 'sdfsdfd', 'arnoldcsubastil@gmail.com', '13', '200620185b2a11dc99a6a', '2018-06-21', '2018-06-20'),
(141, 'sdfsdfd', 'arnoldcsubastil@gmail.com', '10', '200620185b2a11dc99a6a', '2018-06-21', '2018-06-20'),
(142, 'sdfsdfd', 'arnoldcsubastil@gmail.com', '6', '200620185b2a11dc99a6a', '2018-06-21', '2018-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(50) NOT NULL,
  `product_category` int(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(50) NOT NULL,
  `dateadded` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_category`, `product_name`, `product_price`, `dateadded`) VALUES
(1, 1, 'Whole Wheat', 20, '2018-06-19'),
(2, 1, 'Italian Herb', 20, '2018-06-19'),
(3, 1, 'Jalapeno Parmesan', 20, '2018-06-19'),
(4, 2, 'Mayo', 20, '2018-06-19'),
(5, 2, 'Mustard', 20, '2018-06-19'),
(6, 2, 'Honey Mustard', 20, '2018-06-19'),
(7, 2, 'Spicy Mayo', 20, '2018-06-19'),
(8, 3, 'Turkey Bacon Club', 20, '2018-06-19'),
(9, 3, 'Over Roasted Turkey', 20, '2018-06-19'),
(10, 3, 'Italian (Salami, Ham 7 Pepperoni)', 20, '2018-06-19'),
(11, 4, 'American', 20, '2018-06-19'),
(12, 4, 'Swiss', 20, '2018-06-19'),
(13, 4, 'Pepperjack', 20, '2018-06-19'),
(14, 5, 'Cucumber', 20, '2018-06-19'),
(15, 5, 'Lettuce', 20, '2018-06-19'),
(16, 5, 'Peepers - Banana', 20, '2018-06-19'),
(17, 5, 'Peppers - Jalapeno', 20, '2018-06-19'),
(18, 5, 'Peppers - Green and Red', 20, '2018-06-19'),
(19, 5, 'Pickles', 20, '2018-06-19'),
(20, 5, 'Spinach', 20, '2018-06-19'),
(21, 5, 'Tomato', 20, '2018-06-19'),
(22, 5, 'Olives', 20, '2018-06-19'),
(23, 5, 'Onions', 20, '2018-06-19'),
(25, 0, 'new', 54, '2018-06-20'),
(26, 0, '', 0, '2018-06-20'),
(27, 0, '4543', 45, '2018-06-20'),
(34, 1, 'dfd 454', 45, '2018-06-20'),
(36, 1, 'dfsd', 45, '2018-06-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
