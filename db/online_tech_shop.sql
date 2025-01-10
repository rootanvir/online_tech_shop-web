-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 04:20 PM
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
-- Database: `online_tech_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_mobile_number` varchar(15) NOT NULL,
  `customer_password` varchar(50) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `customer_email` varchar(40) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_dob` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` varchar(15) NOT NULL,
  `employee_password` varchar(50) NOT NULL,
  `employee_mobile_number` varchar(20) NOT NULL,
  `employee_email` varchar(50) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `employee_gender` varchar(10) NOT NULL,
  `employee_dob` varchar(20) NOT NULL,
  `employee_address` varchar(100) NOT NULL,
  `employee_role` varchar(20) NOT NULL,
  `employee_joining_date` varchar(20) NOT NULL,
  `employee_salary` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_password`, `employee_mobile_number`, `employee_email`, `employee_name`, `employee_gender`, `employee_dob`, `employee_address`, `employee_role`, `employee_joining_date`, `employee_salary`) VALUES
('11111', 'password', '01712345678', 'admin@gamil.com', 'Mr Admin', 'Male', '01/01/1990', 'Bashundara R/A ,Dhaka ,Bangladesh', 'CEO', '01/01/2025', 80000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` varchar(15) NOT NULL,
  `product_category` varchar(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` double(10,2) DEFAULT NULL,
  `product_quantity` int(10) DEFAULT NULL,
  `product_location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_mobile_number`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
