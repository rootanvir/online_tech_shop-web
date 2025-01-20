-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 07:06 PM
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
-- Table structure for table `ordered`
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

INSERT INTO `ordered` (`order_id`, `customer_mobile_number`, `total_cost`, `payment_method`, `order_status`) VALUES
('0001', '8765432109', 639.99, 'bkash', 'order placed');

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
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_category`, `product_name`, `product_price`, `product_quantity`, `product_location`) VALUES
('1', 'Electronics', 'Smartphone', 599.99, 50, 'Aisle 1'),
('10', 'Food', 'Cereal', 5.50, 200, 'Aisle 9'),
('2', 'Electronics', 'Laptop', 999.99, 30, 'Aisle 2'),
('3', 'Home Appliances', 'Microwave', 150.00, 20, 'Aisle 3'),
('4', 'Furniture', 'Office Chair', 120.00, 10, 'Aisle 4'),
('5', 'Clothing', 'T-Shirt', 20.00, 100, 'Aisle 5'),
('6', 'Clothing', 'Jeans', 40.00, 60, 'Aisle 5'),
('7', 'Sports', 'Basketball', 25.00, 25, 'Aisle 6'),
('8', 'Books', 'Programming Book', 45.00, 15, 'Aisle 7'),
('9', 'Toys', 'Lego Set', 35.00, 40, 'Aisle 8');

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `sell_id` int(15) NOT NULL,
  `customer_mobile_number` varchar(25) NOT NULL,
  `price` float NOT NULL,
  `time` datetime NOT NULL,
  `payment_method` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `notice` (
  `notice_id` varchar(20) NOT NULL,
  `notice_content` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

-- Indexes for dumped tables
--

--
-- Indexes for table `notice`
--

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
-- Indexes for table `ordered`
--
ALTER TABLE `ordered`
  ADD PRIMARY KEY (`order_id`);

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
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);


--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `sell_id` int(15) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
