-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 01:29 PM
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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_mobile_number`, `customer_password`, `customer_name`, `customer_email`, `customer_address`, `customer_dob`) VALUES
('01712345678', 'pass', 'TANVIR AHMED', 'tanvir@gmail.com', 'Savar, Dhaka, Bangladesh', '2322-01-01');

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
('1111', 'pass', '01712345678', 'admin@gamil.com', 'Mr Admin', 'Male', '01/01/1990', 'Bashundara R/A ,Dhaka ,Bangladesh', 'Admin', '01/01/2025', 80000),
('2222', 'pass', '01712348678', 'example@email.com', 'Mr Manager', 'Male', '2015-02-02', 'Kuril,Dhaka', 'Manager', '2024-12-31', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` varchar(20) NOT NULL,
  `notice_content` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `notice_content`) VALUES
('1212', 'this is a notice\r\n');

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
('0002', '01788899814', 256.00, 'bkash', 'pending'),
('0003', '01788899814', 340.00, 'cash', 'pending');

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
('0001', 'Arduino ', 'Arduino Pro Micro', 500.00, 3, '../product_img/p38.png'),
('00010', 'Arduino ', 'Heat Sink Set', 50.00, 4, '../product_img/p50.png'),
('0002', 'Arduino ', 'GPS Module GY-GPSV3 NEO-8M with Ceramic Active Antenna', 450.00, 5, '../product_img/p39.png'),
('0003', 'Arduino ', 'TDS Sensor', 300.00, 4, '../product_img/p41.png'),
('0004', 'Arduino ', 'Bluetooth module', 300.00, 4, '../product_img/p42.png'),
('0005', 'Arduino ', 'DHT11 Temperature and Humidity Sensor', 250.00, 3, '../product_img/p43.png'),
('0006', 'Arduino ', 'GY-906 Infrared Temperature Sensor', 1300.00, 4, '../product_img/p45.png'),
('0007', 'Arduino ', 'Speed Detecting Sensor', 200.00, 3, '../product_img/p46.png'),
('0008', 'Arduino ', 'RF Transmitter Receiver Pair', 150.00, 3, '../product_img/p47.png'),
('0009', 'Arduino ', 'HC-SR04 Ultrasonic Sensor', 100.00, 4, '../product_img/p49.png'),
('0011', 'Arduino ', 'Raspberry Pi 4 Model B 4GB', 12960.00, 4, '../product_img/p51.png'),
('0012', 'Arduino ', 'Night Vision Camera for Raspberry Pi', 2930.00, 4, '../product_img/p52.jpeg'),
('0013', 'Arduino ', 'Acrylic Case for Raspberry Pi 4 Model B', 270.00, 4, '../product_img/p53.jpeg'),
('0014', 'Arduino ', 'WiFi Relay Module ESP8266 5V', 375.00, 5, '../product_img/p54.jpeg');

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

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`sell_id`, `customer_mobile_number`, `price`, `time`, `payment_method`) VALUES
(1, '01788899814', 94, '2025-01-20 00:10:08', 'card'),
(2, '01788899814', 256, '2025-01-20 11:42:26', 'card'),
(3, '01788899814', 256, '2025-01-20 11:46:47', 'bkash'),
(4, '01788899814', 256, '2025-01-20 11:49:12', 'bkash'),
(5, '01788899814', 256, '2025-01-20 11:56:03', 'card'),
(6, '01788899814', 526, '2025-01-20 12:04:00', 'card'),
(7, '01788899814', 94, '2025-01-20 13:30:21', 'card'),
(8, '01788899814', 340, '2025-01-20 15:18:22', 'cash');

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
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

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

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `sell_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
