-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 09:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `DateAndTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Username`, `Password`, `DateAndTime`) VALUES
(3, 'admin', 'c93ccd78b2076528346216b3b2f701e6', '2023-11-16 20:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `completed_order`
--

CREATE TABLE `completed_order` (
  `Id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `items` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_order`
--

INSERT INTO `completed_order` (`Id`, `product_name`, `price`, `items`, `Date`) VALUES
(13, 'Bread', 7, 12, '2025-01-18'),
(19, 'Pandesal', 10, 2, '2025-01-18'),
(20, 'Brown Cookies', 5, 2, '2025-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `Id` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `DateAndTime` date NOT NULL DEFAULT current_timestamp(),
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`Id`, `Fname`, `Lname`, `Email`, `DateAndTime`, `message`) VALUES
(3, 'Lebron', '', 'LB@example.com', '2025-01-18', 'this project sucks\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `orders_product`
--

CREATE TABLE `orders_product` (
  `Id` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Items` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_img` varchar(70) NOT NULL,
  `Dateandtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `process_order`
--

CREATE TABLE `process_order` (
  `Id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `items` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `process_order`
--

INSERT INTO `process_order` (`Id`, `product_name`, `price`, `items`, `Date`) VALUES
(13, 'Bread', 7, 2, '2025-03-12 20:58:50'),
(22, 'Ensaymada', 15, 12, '2025-03-12 20:58:50'),
(23, 'Bread', 7, 12, '2025-03-12 20:58:50'),
(25, 'Croissant Custard', 23, 2, '2025-03-12 21:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_pic` varchar(120) NOT NULL,
  `description` varchar(300) NOT NULL,
  `price` varchar(60) NOT NULL,
  `DateAndTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `product_name`, `product_pic`, `description`, `price`, `DateAndTime`) VALUES
(11, 'Chocolate Chip', 'brown_cookies_with_chocolates.png', 'Best paired with milk', '5', '2023-11-19 06:28:53'),
(12, 'Hopia', 'hopia.jpg', 'efsfsdfs', '5', '2023-11-19 06:29:05'),
(14, 'Pandesal', 'pandesal.jpg', 'Best paired sasasaqwq', '10', '2023-11-27 08:23:05'),
(15, 'Ensaymada', 'Ensaïmada.png', 'Delicious treat best paired with you', '15', '2023-11-27 15:53:32'),
(17, 'Ube', 'pan_de_ube.jpg', '', '1', '2025-01-18 19:20:48'),
(18, 'Croissant Custard', 'croissant_custard.png', 'Yummy', '23', '2025-03-13 01:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `Profile_pic` varchar(255) NOT NULL,
  `Dateandtime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Username`, `Password`, `Firstname`, `Lastname`, `Email`, `Phone`, `Profile_pic`, `Dateandtime`) VALUES
(0, 'don', '92aaca0a62039d9355429e9fe5175d80', 'Chester don', 'Pagteilan', '20223743@s.ubaguio.edu', '09657589541', '656b65a24f9e09.24042519.png', '2023-11-18 23:40:11'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Chester', 'Valencerina', 'Example@gmail.com', '09452658451', '267b77951261702.38790162.jpg', '2023-11-27 09:51:26'),
(3, 'lebron', 'b4cc344d25a2efe540adbf2678e2304c', 'Lebron', 'James', 'lebronj@gamil.com', '12313817391', 'Lebron67a7ca123a9344.86755799.png', '2025-02-08 21:18:10'),
(4, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Demo', 'DemoLast', 'LB@example.com', '38192837189', 'Demo67d2344beca915.48461616.jpg', '2025-03-13 01:26:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `completed_order`
--
ALTER TABLE `completed_order`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orders_product`
--
ALTER TABLE `orders_product`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `process_order`
--
ALTER TABLE `process_order`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `completed_order`
--
ALTER TABLE `completed_order`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders_product`
--
ALTER TABLE `orders_product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `process_order`
--
ALTER TABLE `process_order`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
