-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2025 at 11:29 AM
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
('11111', 'password', '01712345678', 'admin@gamil.com', 'Mr Admin', 'Male', '01/01/1990', 'Bashundara R/A ,Dhaka ,Bangladesh', 'CEO', '01/01/2025', 80000),
('2200', '0011', '012', 'dw@gmail.com', 'ds', 'Male', '12/12/2014', 'Dhaka', 'Manager', '01/01/2025', 500),
('2202', '0011', '012', 'dw@gmail.com', 'ds', 'Male', '12/12/2014', 'Dhaka', 'Admin', '01/01/2025', 500);

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

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `sell_id` int(15) NOT NULL,
  `customer_name` varchar(25) NOT NULL,
  `customer_email` varchar(30) NOT NULL,
  `products` varchar(70) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` float NOT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`sell_id`, `customer_name`, `customer_email`, `products`, `quantity`, `price`, `time`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'Laptop', 2, 1200.5, '2025-01-10 10:30:00'),
(2, 'Jane Smith', 'jane.smith@example.com', 'Smartphone', 1, 899.99, '2025-01-10 12:00:00'),
(3, 'Alice Johnson', 'alice.johnson@example.com', 'Tablet', 3, 499.99, '2025-01-11 14:45:00'),
(4, 'Bob Brown', 'bob.brown@example.com', 'Laptop, Mouse', 1, 1350.75, '2025-01-11 16:20:00'),
(5, 'Eve Davis', 'eve.davis@example.com', 'Headphones', 5, 199.95, '2025-01-12 09:15:00'),
(6, 'Tom Harris', 'tom.harris@example.com', 'Monitor', 2, 299.99, '2025-01-12 11:00:00'),
(7, 'Sophia Green', 'sophia.green@example.com', 'Keyboard', 4, 89.99, '2025-01-13 13:30:00'),
(8, 'Liam Scott', 'liam.scott@example.com', 'Smartphone', 2, 899.99, '2025-01-13 15:45:00'),
(9, 'Mia White', 'mia.white@example.com', 'Laptop', 1, 1200.5, '2025-01-14 10:00:00'),
(10, 'Noah Taylor', 'noah.taylor@example.com', 'Tablet', 2, 499.99, '2025-01-14 11:30:00');

--
-- Indexes for dumped tables
--
CREATE TABLE `ordered` (
  `order_id` varchar(20) NOT NULL,
  `customer_mobile_number` varchar(20) NOT NULL,
  `total_cost` double(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordered`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `ordered`
--
ALTER TABLE `ordered`
  ADD PRIMARY KEY (`order_id`);
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

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`sell_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `sell_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
