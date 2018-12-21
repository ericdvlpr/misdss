-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2018 at 11:09 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_misdss`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(250) NOT NULL,
  `brand_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `category_id`, `brand_name`, `brand_status`) VALUES
(1, 1, 'Finibus', 'active'),
(2, 1, 'Lorem', 'active'),
(3, 1, 'Ipsum', 'active'),
(4, 8, 'Dolor', 'active'),
(5, 8, 'Amet', 'active'),
(6, 6, 'Aliquam', 'active'),
(7, 6, 'Maximus', 'active'),
(8, 10, 'Venenatis', 'active'),
(9, 10, 'Ligula', 'active'),
(10, 3, 'Vitae', 'active'),
(11, 3, 'Auctor', 'active'),
(12, 5, 'Luctus', 'active'),
(13, 5, 'Justo', 'active'),
(14, 2, 'Phasellus', 'active'),
(15, 2, 'Viverra', 'active'),
(16, 4, 'Elementum', 'active'),
(17, 4, 'Odio', 'active'),
(18, 7, 'Tellus', 'active'),
(19, 7, 'Curabitur', 'active'),
(20, 9, 'Commodo', 'active'),
(21, 9, 'Nullam', 'active'),
(22, 11, 'Quisques', 'active'),
(24, 12, 'Sola', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'LED Bulb', 'active'),
(2, 'LED Lights', 'active'),
(3, 'LED Down Lights', 'active'),
(4, 'LED Panel Light', 'active'),
(5, 'LED Lamp', 'active'),
(6, 'LED Concealed Light', 'active'),
(7, 'LED Spot Light', 'active'),
(8, 'LED Ceiling Light', 'active'),
(9, 'LED Tube Light', 'active'),
(10, 'LED Driver', 'active'),
(11, 'Led Floods Light', 'active'),
(13, 'LED Outdoor Lighting', 'active'),
(14, 'LED Indoor Lights', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `dtr`
--

CREATE TABLE `dtr` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `time_in` varchar(11) NOT NULL,
  `time_out` varchar(11) NOT NULL,
  `date` date NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dtr`
--

INSERT INTO `dtr` (`id`, `employee_id`, `password`, `status`, `time_in`, `time_out`, `date`, `remarks`) VALUES
(1, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(2, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(3, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(4, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(5, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(6, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(7, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(8, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(9, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(10, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(11, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(12, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(13, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(14, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(15, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(16, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(17, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(18, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(19, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(20, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(21, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(22, 1, 15234, 'out', '9:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(23, 1, 15234, 'out', '8:30 am', '6:00 pm', '2018-02-23', '\r\n'),
(24, 1, 15234, 'out', '8:20 am', '6:00 pm', '2018-02-23', '\r\n'),
(25, 1, 15234, 'out', '8:10 am', '6:00 pm', '2018-02-23', '\r\n'),
(26, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n'),
(27, 1, 15234, 'out', '8:00 am', '6:00 pm', '2018-02-23', '\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `employee_id` int(11) NOT NULL,
  `employee_name` text NOT NULL,
  `employee_hrrate` int(11) NOT NULL,
  `employee_dlyrate` int(11) NOT NULL,
  `employee_perday` int(11) NOT NULL,
  `employee_passcode` int(11) NOT NULL,
  `employee_status` varchar(50) NOT NULL DEFAULT 'Active',
  `employee_position` varchar(150) NOT NULL,
  `employee_account` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`employee_id`, `employee_name`, `employee_hrrate`, `employee_dlyrate`, `employee_perday`, `employee_passcode`, `employee_status`, `employee_position`, `employee_account`) VALUES
(1, 'Jerome Abonitaa', 50, 500, 8, 15234, 'Active', 'Sales', 1),
(2, 'Joseph Abonitaa', 5, 50, 8, 12346, 'Inactive', '', 0),
(3, 'Joseph Barameda', 8, 80, 8, 12345, 'Active', 'Payroll', 0),
(4, 'testtt', 3, 2, 3, 7502, 'Active', 'Inventory Clerk', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_order`
--

CREATE TABLE `inventory_order` (
  `inventory_order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `inventory_order_total` double(10,2) NOT NULL,
  `inventory_order_date` date NOT NULL,
  `inventory_order_name` varchar(255) NOT NULL,
  `inventory_order_address` text NOT NULL,
  `payment_status` enum('cash','credit') NOT NULL,
  `inventory_order_status` varchar(100) NOT NULL,
  `inventory_order_created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_order`
--

INSERT INTO `inventory_order` (`inventory_order_id`, `user_id`, `inventory_order_total`, `inventory_order_date`, `inventory_order_name`, `inventory_order_address`, `payment_status`, `inventory_order_status`, `inventory_order_created_date`) VALUES
(1, 7, 4939.20, '2017-11-08', 'David Harper', '3188 Straford Park\r\nHarold, KY 41635', 'credit', 'active', '2017-11-08'),
(2, 7, 1310.40, '2017-11-08', 'Trevor Webster', '4275 Indiana Avenue\r\nHonolulu, HI 96816', 'cash', 'active', '2017-11-08'),
(3, 6, 265.65, '2017-11-08', 'Russell Barrett', '4687 Powder House Road\r\nJupiter, FL 33478', 'cash', 'active', '2017-11-08'),
(4, 6, 1546.80, '2017-11-08', 'Doloris Turner', '3057 Collins Avenue\r\nWesterville, OH 43081', 'credit', 'active', '2017-11-08'),
(5, 5, 1409.00, '2017-11-08', 'Georgette Blevins', '863 Simpson Avenue\r\nSteelton, PA 17113', 'cash', 'active', '2017-11-08'),
(6, 5, 558.90, '2017-11-08', 'Nancy Brook', '3460 Viking Drive\r\nBarnesville, OH 43713', 'credit', 'active', '2017-11-08'),
(7, 4, 1286.25, '2017-11-08', 'Joseph Smith', '190 Metz Lane\r\nCharlestown, MA 02129', 'cash', 'active', '2017-11-08'),
(8, 4, 1520.00, '2017-11-08', 'Maria Lafleur', '3878 Elkview Drive\r\nPort St Lucie, FL 33452', 'credit', 'active', '2017-11-08'),
(9, 4, 1604.00, '2017-11-08', 'David Smith', '4757 Little Acres Lane\r\nLoraine, IL 62349', 'cash', 'active', '2017-11-08'),
(10, 3, 1724.80, '2017-11-08', 'Michelle Hayes', '1140 C Street\r\nWorcester, MA 01609', 'cash', 'active', '2017-11-08'),
(11, 3, 1859.40, '2017-11-08', 'Brenna Hamilton', '2845 Davis Avenue\r\nPetaluma, CA 94952', 'cash', 'active', '2017-11-08'),
(12, 3, 2038.40, '2017-11-08', 'Robbie McKenzie', '3016 Horizon Circle\r\nEatonville, WA 98328', 'credit', 'active', '2017-11-08'),
(13, 2, 573.00, '2017-11-08', 'Jonathan Allen', '2426 Evergreen Lane\r\nAlhambra, CA 91801', 'cash', 'active', '2017-11-08'),
(14, 2, 1196.35, '2017-11-08', 'Mildred Paige', '3167 Oakway Lane\r\nReseda, CA 91335', 'cash', 'active', '2017-11-08'),
(15, 2, 1960.00, '2017-11-08', 'Elva Lott', '4032 Aaron Smith Drive\r\nHarrisburg, PA 17111', 'credit', 'active', '2017-11-08'),
(16, 2, 2700.00, '2017-11-08', 'Eric Johnson', '616 Devils Hill Road\r\nJackson, MS 39213', 'cash', 'active', '2017-11-08'),
(17, 1, 5615.20, '2017-11-09', 'Doris Oliver', '2992 Sycamore Fork Road Hopkins, MN 55343', 'cash', 'active', '2017-11-09'),
(26, 1, 2278.50, '2018-02-01', 'Janet Richardsons', '4799 Ryder Avenue Everett, WA 98210', 'credit', 'inactive', '2017-11-27'),
(27, 1, 840.00, '2018-02-27', 'test', 'test', 'cash', 'active', '2018-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_order_product`
--

CREATE TABLE `inventory_order_product` (
  `inventory_order_product_id` int(11) NOT NULL,
  `inventory_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `tax` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_order_product`
--

INSERT INTO `inventory_order_product` (`inventory_order_product_id`, `inventory_order_id`, `product_id`, `quantity`, `price`, `tax`) VALUES
(3, 1, 1, 10, 141.00, 12.00),
(4, 1, 3, 4, 800.00, 5.00),
(5, 2, 2, 3, 350.00, 12.00),
(6, 2, 17, 2, 60.00, 12.00),
(7, 3, 15, 1, 125.00, 5.00),
(8, 3, 17, 2, 60.00, 12.00),
(12, 4, 18, 4, 90.00, 12.00),
(13, 4, 20, 3, 100.00, 18.00),
(14, 4, 1, 5, 141.00, 12.00),
(15, 5, 4, 2, 550.00, 12.00),
(16, 5, 10, 1, 150.00, 18.00),
(17, 6, 8, 5, 15.00, 18.00),
(18, 6, 7, 2, 210.00, 12.00),
(19, 7, 16, 7, 175.00, 5.00),
(23, 8, 19, 5, 120.00, 18.00),
(24, 8, 11, 5, 85.00, 12.00),
(25, 8, 12, 5, 60.00, 12.00),
(26, 9, 13, 3, 200.00, 18.00),
(27, 9, 9, 2, 400.00, 12.00),
(28, 10, 9, 3, 400.00, 12.00),
(29, 10, 11, 4, 85.00, 12.00),
(30, 11, 6, 6, 250.00, 15.00),
(31, 11, 12, 2, 60.00, 12.00),
(32, 12, 2, 4, 350.00, 12.00),
(33, 12, 7, 2, 210.00, 12.00),
(34, 13, 18, 3, 90.00, 12.00),
(35, 13, 7, 1, 210.00, 12.00),
(36, 13, 8, 2, 15.00, 18.00),
(37, 14, 6, 2, 250.00, 15.00),
(38, 14, 13, 1, 200.00, 18.00),
(39, 14, 16, 1, 175.00, 5.00),
(40, 14, 17, 3, 60.00, 12.00),
(41, 15, 2, 5, 350.00, 12.00),
(42, 16, 4, 4, 550.00, 12.00),
(43, 16, 13, 1, 200.00, 18.00),
(46, 17, 21, 2, 500.00, 18.00),
(47, 17, 3, 5, 800.00, 5.00),
(48, 17, 7, 1, 210.00, 12.00),
(49, 0, 23, 5, 30.00, 12.00),
(50, 0, 12, 5, 60.00, 12.00),
(51, 0, 16, 5, 175.00, 5.00),
(52, 0, 6, 5, 250.00, 15.00),
(53, 0, 16, 5, 175.00, 5.00),
(54, 0, 7, 5, 210.00, 12.00),
(55, 0, 7, 5, 210.00, 12.00),
(56, 0, 7, 5, 210.00, 12.00),
(57, 25, 14, 5, 250.00, 18.00),
(58, 25, 11, 5, 85.00, 12.00),
(79, 26, 16, 6, 175.00, 5.00),
(80, 26, 7, 5, 210.00, 12.00),
(81, 27, 3, 1, 800.00, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `employee_name` text NOT NULL,
  `hrsworked` int(11) NOT NULL,
  `daysworked` int(11) NOT NULL,
  `gross_income` int(11) NOT NULL,
  `absent` int(11) NOT NULL,
  `late` int(11) NOT NULL,
  `sss` int(11) NOT NULL,
  `pagibig` int(11) NOT NULL,
  `philhealth` int(11) NOT NULL,
  `netincome` int(11) NOT NULL,
  `monthof` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `employee_id`, `employee_name`, `hrsworked`, `daysworked`, `gross_income`, `absent`, `late`, `sss`, `pagibig`, `philhealth`, `netincome`, `monthof`) VALUES
(1, 1, 'Jerome Abonitaa', 10, 27, 16000, 0, 4, 200, 200, 200, 15400, 'March');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `product_description` text NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_unit` varchar(150) NOT NULL,
  `product_base_price` double(10,2) NOT NULL,
  `product_tax` decimal(4,2) NOT NULL,
  `product_minimum_order` double(10,2) NOT NULL,
  `product_enter_by` int(11) NOT NULL,
  `product_status` enum('active','inactive') NOT NULL,
  `product_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_description`, `product_quantity`, `product_unit`, `product_base_price`, `product_tax`, `product_minimum_order`, `product_enter_by`, `product_status`, `product_date`) VALUES
(1, 1, 1, '4W LED Bulb', 'Base Type	B22, E27\r\nBulb Material	Aluminium\r\nItem Width	5 (cm)\r\nItem Height	10 (cm)\r\nItem Weight	0.07 (kg)', 100, 'Nos', 141.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(2, 1, 3, '17W B22 LED Bulb', 'Item Height	14.2 (cm)\r\nColor Temperature (Kelvin)	6500\r\nItem Weight	0.19 (kg)\r\nBulb Material	Aluminium\r\nBase Color	Aluminium\r\nVoltage	240\r\nUsages	Household, Commercial, Kitchen', 150, 'Nos', 350.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(3, 8, 5, '18W LED Ceiling Light', 'Round Ceiling Light 18w', 74, 'Nos', 800.00, '5.00', 0.00, 1, 'active', '2017-11-08'),
(4, 8, 4, 'Round LED Ceiling Light', 'Relying on our expertise in this domain, we are into offering Round LED Ceiling Light.	', 50, 'Nos', 550.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(5, 6, 6, '7W LED Concealed Light', 'Dimension \'3\" \'\r\n50000 hours burning life\r\ncost effective\r\nhigh quality led', 85, 'Nos', 240.00, '15.00', 0.00, 1, 'active', '2017-11-08'),
(6, 6, 7, '9w LED Concealed Light', 'dimension \'3\" \'\r\n50000 hours burning life\r\ncost effective\r\nhigh quality led', 65, 'Nos', 250.00, '15.00', 0.00, 1, 'active', '2017-11-08'),
(7, 10, 9, '24W Street Light Led Driver', 'Dc Voltage	36v\r\nRated Current	600ma\r\nRated Power	22w', 120, 'Nos', 210.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(8, 10, 8, 'BP1601 ICs', 'Backed by immense industry-experience & latest designing techniques, we are engaged in providing BP1601 ICs.', 200, 'Nos', 15.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(9, 3, 11, '5W LED Square Downlight', 'Wattage: 5 Watt\r\nInput Voltage: 150V to 265V, 50/60Hz\r\nLumens: 500 lumen (approx)\r\nPower Factor: 0.90pf', 50, 'Nos', 400.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(10, 3, 10, '10W LED Square Downlight', 'Wattage: 10 Watt\r\nInput Voltage: 150V to 265V, 50/60Hz\r\nLumens: 1000 lumen (approx)\r\nPower Factor: 0.90pf', 40, 'Nos', 150.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(11, 5, 13, ' 9w Deluxe LED Lamp', 'Lighting Color	Cool Daylight\r\nBase Type	B22', 100, 'Nos', 85.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(12, 5, 12, '5w LED Lamp', 'Lighting Color	Cool Daylight\r\nBody Material	Aluminum\r\nBase Type	B22', 75, 'Nos', 60.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(13, 2, 14, '15W Big LED Bay Light', 'Wattage: 15 Watt\r\nInput Voltage: 100V - 265V, 50/60Hz\r\nLumens: 1500 lumen (approx)\r\nPower Factor: 0.90pf', 60, 'Nos', 200.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(14, 2, 15, '15W Small LED Bay Light', 'Wattage: 15 Watt\r\nInput Voltage: 100V -265V, 50/60Hz\r\nLumens: 1500 lumen (approx)\r\nPower Factor: 0.90pf', 55, 'Nos', 250.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(15, 4, 16, '12W LED Panel Light', 'Body Material	Aluminum\r\nLighting Type	LED\r\nApplications	Hotel, House, etc', 85, 'Nos', 125.00, '5.00', 0.00, 1, 'active', '2017-11-08'),
(16, 4, 17, '15W LED Panel Light', 'IP Rating	IP40\r\nBody Material	Aluminum\r\nLighting Type	LED', 40, 'Nos', 175.00, '5.00', 0.00, 1, 'active', '2017-11-08'),
(17, 7, 19, '3W Round LED Spotlight', 'Lighting Color	Cool White\r\nBody Material	Aluminum\r\nCertification	ISO\r\nInput Voltage(V)	12 V\r\nIP Rating	IP33, IP40, IP44', 100, 'Nos', 60.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(18, 7, 18, '3W Square LED Spotlight', 'Lighting Color	Cool White\r\nBody Material	Aluminum\r\nInput Voltage(V)	12 V\r\nIP Rating	IP33, IP40', 85, 'Nos', 90.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(19, 9, 20, '18W LED Tube Light', 'Tube Base Type	T5\r\nIP Rating	IP66', 180, 'Nos', 120.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(20, 9, 21, '10W Ready Tube Light', 'Body Material	Aluminum, Ceramic\r\nPower	10W', 200, 'Nos', 100.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(21, 11, 22, '90W LED Flood Lights', 'Lighting Color	Cool White, Pure White, Warm White\r\nBody Material	Ceramic, Chrome, Iron\r\nIP Rating	IP33, IP40, IP44, IP55, IP66', 20, 'Nos', 500.00, '18.00', 0.00, 1, 'active', '2017-11-09'),
(23, 1, 3, '15 Watt LED Bulb', '15 Watt LED Bulb', 150, 'Nos', 30.00, '12.00', 0.00, 1, 'active', '2017-11-21'),
(24, 6, 24, 'asdadasd', 'asdassadsa', 15, 'Bags', 40.00, '0.00', 0.00, 1, 'active', '2018-02-24'),
(25, 10, 24, 'twee', 'ddasdas', 5, 'Box', 5.00, '0.00', 0.00, 1, 'active', '2018-02-24');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL,
  `user_assign` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_email`, `user_password`, `user_name`, `user_type`, `user_status`, `user_assign`) VALUES
(1, 'john_smith@gmail.com', '$2y$10$3l2V43IqF8Avv2KUhhKAP.C9XPf3lZMDTNREhhFxdEkMX6Xw212Wq', 'Admin', 'master', 'Active', 0),
(2, 'donahuber@gmail.com', '$2y$10$Ex.JTn6Cu7lCHgaJoCBVeu0qer0cFp2X1qTIpPg2qfIkkuj3LjjMK', 'Dona L. Huber', '', 'Active', 0),
(3, 'roy_hise@gmail.com', '$2y$10$XlyVI9an5B6rHW3SS9vQpesJssKJxzMQYPbSaR7dnpWjDI5fpxJSS', 'Roy Hise', 'user', 'Active', 0),
(4, 'peter_goad@gmail.com', '$2y$10$n1B.FdHNwufTkmzp/pNqc.EiwjB8quQ1tBCEC7nkaldI5pS.et04e', 'Peter Goad', 'user', 'Active', 0),
(5, 'sarah_thomas@gmail.com', '$2y$10$s57SErOPlgkIZf1lxzlX3.hMt8LSSKaYig5rusxghDm7LW8RtQc/W', 'Sarah Thomas', 'user', 'Active', 0),
(6, 'edna_william@gmail.com', '$2y$10$mfMXnH.TCmg5tlYRhqjxu.ILly8s9.qsLKOpyxgUl6h1fZt6x/B5C', 'Edna William', 'user', 'Active', 0),
(8, 'john_parks@gmail.com', '$2y$10$WtsZUxIIz/N4NoIW0Db.pu0VfLWcPs6TyQ8SkpVHLDLGhdNOfALC.', 'John Park', 'user', 'Active', 0),
(10, 'peter_parker@gmail.com', '$2y$10$GoQvEZNTWEibo0FPK7h57eA5UsNkXfIdex1deGsW/CFIY8zqxyu2S', 'Mark Parker', 'user', 'Active', 0),
(11, 'Test@gmail.com', '$2y$10$p4g7hibYEIBSXC0jua5MzOxOs5Pr2KixIuJXiglaUsmws6.b6Hp3K', 'Test', 'payroll', 'Active', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `dtr`
--
ALTER TABLE `dtr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `inventory_order`
--
ALTER TABLE `inventory_order`
  ADD PRIMARY KEY (`inventory_order_id`);

--
-- Indexes for table `inventory_order_product`
--
ALTER TABLE `inventory_order_product`
  ADD PRIMARY KEY (`inventory_order_product_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `dtr`
--
ALTER TABLE `dtr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `inventory_order`
--
ALTER TABLE `inventory_order`
  MODIFY `inventory_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `inventory_order_product`
--
ALTER TABLE `inventory_order_product`
  MODIFY `inventory_order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
