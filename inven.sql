-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 10:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inven`
--

-- --------------------------------------------------------

--
-- Table structure for table `allorders`
--

CREATE TABLE `allorders` (
  `orderId` int(100) NOT NULL,
  `itemId` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `unitPrice` decimal(65,0) NOT NULL,
  `total` decimal(65,0) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allorders`
--

INSERT INTO `allorders` (`orderId`, `itemId`, `quantity`, `unitPrice`, `total`, `status`) VALUES
(10, 1, 2, 500, 1000, 3),
(11, 1, 1, 500, 500, 2),
(12, 2, 1, 400, 400, 3),
(13, 1, 1, 500, 500, 3),
(14, 2, 1, 400, 400, 2),
(15, 1, 1, 500, 500, 3),
(17, 2, 1, 400, 400, 3),
(18, 3, 5, 13, 65, 3),
(19, 1, 2, 500, 1000, 3),
(20, 3, 5, 13, 65, 3),
(21, 2, 5, 400, 2000, 2),
(22, 1, 50, 500, 25000, 3),
(23, 3, 10, 13, 130, 3),
(24, 1, 6, 500, 3000, 1),
(25, 3, 3, 13, 39, 3),
(26, 1, 6, 500, 3000, 3),
(27, 2, 1, 400, 400, 2),
(28, 3, 5, 13, 65, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `catname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `catname`) VALUES
(1, 'catagory 2'),
(3, 'catagory 1'),
(4, 'catagory 5'),
(5, 'category 3'),
(6, 'category 4'),
(7, 'category 6'),
(8, 'category 9');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `catid` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `unitid` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemname`, `catid`, `subid`, `unitid`, `price`, `quantity`, `status`, `image`) VALUES
(1, 'item 1', 3, 2, 1, 500, 444, 1, '6437984c78231.png'),
(2, 'item 2', 3, 4, 4, 400, 80, 1, '6437986a55e15.png'),
(3, 'item 3', 4, 10, 5, 13, 5, 1, '643d062edf3ae.png');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `sid` int(10) NOT NULL,
  `subcname` varchar(255) NOT NULL,
  `catname` varchar(255) NOT NULL,
  `created_by` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`sid`, `subcname`, `catname`, `created_by`) VALUES
(2, 'Sub 1', '3', '2023-04-11 08:07:52.366118'),
(4, 'Sub 435', '3', '2023-04-11 08:16:22.711878'),
(5, 'Sub 23', '2', '2023-04-13 05:58:00.728961'),
(6, 'Sub 43', '4', '2023-04-13 05:58:08.171575'),
(7, 'Sub 4', '2', '2023-04-13 05:58:15.985916'),
(8, 'Sub 9', '1', '2023-04-13 05:59:22.056562'),
(9, 'Sub 19', '1', '2023-04-13 05:59:29.051387'),
(10, 'Sub 30', '4', '2023-04-13 05:59:36.682385'),
(11, 'Sub 18', '7', '2023-04-13 06:26:41.923474'),
(12, 'Sub 10', '6', '2023-04-13 06:26:50.315415'),
(13, 'Sub 45', '5', '2023-04-13 06:26:59.618157'),
(14, 'Sub 7', '7', '2023-04-13 06:27:08.325729'),
(15, 'Sub 2', '3', '2023-04-16 03:55:26.392225'),
(16, 'Sub 3', '3', '2023-04-16 03:55:33.256496');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(150) DEFAULT NULL,
  `LastName` varchar(150) DEFAULT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `userType` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FirstName`, `LastName`, `Email`, `Password`, `userType`, `created_at`) VALUES
(1, 'riad', 'riad', 'riad@g.com', 'asdasd', 1, '2023-04-12 09:36:03'),
(2, 'aaa', 'aaa', 'aaa@a.com', 'asdasd', 0, '2023-04-17 06:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unitId` int(10) NOT NULL,
  `unitName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unitId`, `unitName`) VALUES
(1, 'KG'),
(2, 'Piece'),
(3, 'Dozen'),
(4, 'ML'),
(5, 'L'),
(6, 'Kilogram'),
(7, 'KGss'),
(8, 'Piecesssssss'),
(9, 'hgfhfhgfh'),
(15, 'KGs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allorders`
--
ALTER TABLE `allorders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unitId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allorders`
--
ALTER TABLE `allorders`
  MODIFY `orderId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `sid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unitId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
