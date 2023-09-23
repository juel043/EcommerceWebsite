-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2023 at 09:04 AM
-- Server version: 5.7.23-23
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minmaxc1_furniture`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `password`, `regdate`, `updatedate`) VALUES
(1, 'juel', 'hossain', 'it@minmaxbd.net', '827ccb0eea8a706c4c34a1689', '2023-06-07 08:54:31', NULL),
(2, 'juel', 'hossain', 'it@minmaxbd.net', '827ccb0eea8a706c4c34a16891f84e7b', '2023-06-07 10:42:03', NULL),
(3, 'Sohel ', 'Rana', 'sohel@minmaxbd.net', '202cb962ac59075b964b07152d234b70', '2023-06-07 10:55:31', NULL),
(4, 'juel', 'hossain', 'minmaxceo@gmail.com', '202cb962ac59075b964b07152d234b70', '2023-06-11 10:23:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(200) NOT NULL,
  `pname` varchar(120) NOT NULL,
  `pprice` text NOT NULL,
  `pqty` text NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `uid`, `pid`, `pname`, `pprice`, `pqty`, `PostingDate`, `LastUpdationDate`) VALUES
(4, 2, 4, 'Work Station', '15000', '1', '2023-06-17 03:08:14', NULL),
(5, 2, 3, 'Office Cabinet', '30000', '2', '2023-06-17 03:08:51', '2023-06-19 02:49:15'),
(12, 2, 8, 'Metal Bed', '20000', '1', '2023-06-20 09:58:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` int(100) NOT NULL,
  `mobnumber` int(100) NOT NULL,
  `totalproduct` varchar(100) NOT NULL,
  `totalprice` bigint(255) NOT NULL,
  `txid` varchar(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `UpdationAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userid`, `address`, `phone`, `mobnumber`, `totalproduct`, `totalprice`, `txid`, `status`, `created_at`, `UpdationAt`) VALUES
(7, 2, 'House # 06, Road # 11, Sector # 12, Uttara, Dhaka – 1230. Bangladesh', 1955576994, 1230, 'pid-4(qty-1),pid-3(qty-2),pid-8(qty-1)', 95000, '1234567', 'pending', '2023-06-20 10:01:05.120858', '2023-06-20 10:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `tblcatagory`
--

CREATE TABLE `tblcatagory` (
  `id` int(11) NOT NULL,
  `productcat` varchar(255) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcatagory`
--

INSERT INTO `tblcatagory` (`id`, `productcat`, `regdate`, `updatedate`) VALUES
(1, 'Home Furniture', '2023-06-11 08:10:02', '2023-06-11 08:43:27'),
(2, 'Office Furnitures', '2023-06-11 08:23:49', '2023-06-11 08:35:22'),
(3, 'Lab Furniture', '2023-06-11 10:27:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(11) NOT NULL,
  `catname` int(25) NOT NULL,
  `producttitle` varchar(150) DEFAULT NULL,
  `productcode` varchar(20) DEFAULT NULL,
  `productdetails` longtext,
  `productprice` int(11) DEFAULT NULL,
  `pimage1` varchar(120) DEFAULT NULL,
  `pimage2` varchar(120) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `catname`, `producttitle`, `productcode`, `productdetails`, `productprice`, `pimage1`, `pimage2`, `RegDate`, `UpdationDate`) VALUES
(1, 3, 'Metal Bed', 'MB-102', 'MinMax Furniture Company has plans to introduce new products in all categories and expand its rural reach. Company is optimistic about good business growth in coming years.The manufacturing facility of MinMax Furniture is located at Hotapara in Bangladesh. The products manufactured here includes Office Furniture, Home Furniture, Industrial Furniture.', 15000, 'metal_bed.jpg', 'metal_bed (2).jpg', '2023-06-11 03:25:53', '2023-06-15 04:32:03'),
(3, 2, 'Office Cabinet', 'OC-101', 'MinMax Furniture Company has plans to introduce new products in all categories and expand its rural reach. Company is optimistic about good business growth in coming years.The manufacturing facility of MinMax Furniture is located at Hotapara in Bangladesh. The products manufactured here includes Office Furniture, Home Furniture, Industrial Furniture.', 30000, 'Cabinet2.jpg', 'Cabinet2.jpg', '2023-06-11 03:35:38', '2023-06-15 04:21:53'),
(4, 1, 'Dining Table', 'DT-101', 'MinMax Furniture Company has plans to introduce new products in all categories and expand its rural reach. Company is optimistic about good business growth in coming years.The manufacturing facility of MinMax Furniture is located at Hotapara in Bangladesh. The products manufactured here includes Office Furniture, Home Furniture, Industrial Furniture.', 15000, 'Dinig.jpg', 'Dinig.jpg', '2023-06-11 05:57:21', '2023-06-18 09:58:15'),
(5, 3, 'Metal Bed', 'MB-103', 'MinMax Furniture Company has plans to introduce new products in all categories and expand its rural reach. Company is optimistic about good business growth in coming years.The manufacturing facility of MinMax Furniture is located at Hotapara in Bangladesh. The products manufactured here includes Office Furniture, Home Furniture, Industrial Furniture.', 14000, 'bed1.png', 'bed1.png', '2023-06-11 09:15:23', '2023-06-15 04:32:06'),
(6, 3, 'Metal Bed', 'MB-102', 'MinMax Furniture Company has plans to introduce new products in all categories and expand its rural reach. Company is optimistic about good business growth in coming years.The manufacturing facility of MinMax Furniture is located at Hotapara in Bangladesh. The products manufactured here includes Office Furniture, Home Furniture, Industrial Furniture.', 15000, 'metal_bed.jpg', 'metal_bed (2).jpg', '2023-06-10 21:25:53', '2023-06-15 04:32:10'),
(7, 2, 'Office Cabinet', 'OC-101', 'MinMax Furniture Company has plans to introduce new products in all categories and expand its rural reach. Company is optimistic about good business growth in coming years.The manufacturing facility of MinMax Furniture is located at Hotapara in Bangladesh. The products manufactured here includes Office Furniture, Home Furniture, Industrial Furniture.', 30000, 'Cabinet2.jpg', 'Cabinet2.jpg', '2023-06-10 21:35:38', '2023-06-15 04:22:00'),
(8, 1, 'Metal Bed', 'DT-101', 'MinMax Furniture Company has plans to introduce new products in all categories and expand its rural reach. Company is optimistic about good business growth in coming years.The manufacturing facility of MinMax Furniture is located at Hotapara in Bangladesh. The products manufactured here includes Office Furniture, Home Furniture, Industrial Furniture.', 20000, 'metal_bed.jpg', 'metal_bed.jpg', '2023-06-10 23:57:21', '2023-06-18 09:56:30'),
(9, 3, 'Metal Bed', 'MB-103', 'MinMax Furniture Company has plans to introduce new products in all categories and expand its rural reach. Company is optimistic about good business growth in coming years.The manufacturing facility of MinMax Furniture is located at Hotapara in Bangladesh. The products manufactured here includes Office Furniture, Home Furniture, Industrial Furniture.', 14000, 'bed1.png', 'bed1.png', '2023-06-11 03:15:23', '2023-06-15 04:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `EmailId`, `Password`, `ContactNo`, `dob`, `Address`, `RegDate`, `UpdationDate`) VALUES
(1, 'Md Juel ', 'minmaxceo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '01690030017', NULL, 'House # 06, Road # 11, Sector # 12, Uttara, Dhaka – 1230. Bangladesh', '2023-06-05 08:36:40', NULL),
(2, 'MinMax', 'it@minmaxbd.net', '827ccb0eea8a706c4c34a16891f84e7b', '01690030017', NULL, 'House # 06, Road # 11, Sector # 12, Uttara, Dhaka – 1230. Bangladesh', '2023-06-13 03:20:55', NULL),
(3, 'Md Juel ', 'minmaxceo@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01690030017', NULL, 'House # 06, Road # 11, Sector # 12, Uttara, Dhaka – 1230. Bangladesh', '2023-06-21 03:32:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcatagory`
--
ALTER TABLE `tblcatagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcatagory`
--
ALTER TABLE `tblcatagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
