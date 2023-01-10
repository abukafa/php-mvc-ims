-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 11:21 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jupri`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode` varchar(11) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `conv` int(11) NOT NULL,
  `suplier` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode`, `barang`, `jenis`, `satuan`, `conv`, `suplier`, `note`) VALUES
('AIR04', 'Air Galon', 'Beverage', 'Gln', 1, '', '4'),
('AIR64', 'Air Mineral @600Ml', 'Beverage', 'Btl', 1, '', '4'),
('ATI01', 'Ati Ampela ', 'Frozen Food', 'Kg', 1, '', '1'),
('AYK01', 'Ayam Kampung', 'Frozen Food', 'Ekor', 1, '', '1'),
('AYM01', 'Ayam Marinasi', 'Frozen Food', 'Pcs', 1, '', '1'),
('AYP01', 'Ayam Potong Isi 4', 'Frozen Food', 'Pck', 1, '', '1'),
('AYP41', 'Ayam Potong Isi 14', 'Frozen Food', 'Pck', 1, '', '1'),
('AYS01', 'Ayam Slice', 'Frozen Food', 'Kg', 1, '', '1'),
('BAM03', 'Bawang Merah', 'Fresh Food', 'Kg', 1, '', '3'),
('BAP03', 'Bawang Putih Kupas', 'Fresh Food', 'Kg', 1, '', '3'),
('BEP01', 'Bebek Potong 4', 'Frozen Food', 'Ekor', 1, '', '1'),
('BER02', 'Beras', 'Dry Food', 'Kg', 1, '', '2'),
('BIP02', 'Biang Premium', 'Dry Food', 'Kg', 1, '', '2'),
('BLU05', 'Blueberry', 'Pemadam', 'Pcs', 1, '', '5'),
('BNN05', 'Banana', 'Pemadam', 'Pcs', 1, '', '5'),
('BOW06', 'Bowl Nasi Super + Tutup', 'Material', 'Pcs', 1, '', '6'),
('BOX16', 'Box Nasi Agj', 'Material', 'Pcs', 1, '', '6'),
('BOX26', 'Box Agj Kecil', 'Material', 'Pcs', 1, '', '6'),
('BUR02', 'Bumbu Racik ', 'Dry Food', 'Pcs', 1, '', '2'),
('CAD03', 'Cabe Domba', 'Fresh Food', 'Kg', 1, '', '3'),
('CAI03', 'Cabe Ijo', 'Fresh Food', 'Kg', 1, '', '3'),
('CAM03', 'Cabe Merah', 'Fresh Food', 'Kg', 1, '', '3'),
('CAR03', 'Cabe Rawit Hijau', 'Fresh Food', 'Kg', 1, '', '3'),
('CGP05', 'Cup Gelas Pk', 'Pemadam', 'Pcs', 1, '', '5'),
('CLI09', 'Cling', 'Chemical', 'Pck', 1, '', '9'),
('COT04', 'Cool Time', 'Beverage', 'Pcs', 1, '', '4'),
('CUP06', 'Cup Gelas Plastik ', 'Material', 'Pck', 1, '', '6'),
('DAB03', 'Daun Bawang', 'Fresh Food', 'Kg', 1, '', '3'),
('DSA02', 'Daun Salam', 'Dry Food', 'Ikat', 1, '', '2'),
('DSE02', 'Daun Sereh', 'Dry Food', 'Ikat', 1, '', '2'),
('ESK04', 'Es Kristal', 'Beverage', 'Ball', 1, '', '4'),
('GAR02', 'Garam ', 'Dry Food', 'Pck', 1, '', '2'),
('GAS18', 'Gas 5,5 Kg', 'Gas', 'Tab', 1, '', '8'),
('GAS28', 'Gas 12 Kg', 'Gas', 'Tab', 1, '', '8'),
('GAS38', 'Hi-Cook Gas 360Ml', 'Gas', 'Tab', 1, '', '8'),
('GDC04', 'Good Day Cappucino', 'Beverage', 'Pcs', 1, '', '4'),
('GUA04', 'Guava', 'Beverage', 'Pcs', 1, '', '4'),
('GUM02', 'Gula Merah', 'Dry Food', 'Kg', 1, '', '2'),
('GUP02', 'Gula Pasir', 'Dry Food', 'Kg', 1, '', '2'),
('HAN06', 'Hand Glove ', 'Material', 'Pck', 1, '', '6'),
('HIT04', 'Hilo Thaitea', 'Beverage', 'Pcs', 1, '', '4'),
('IKL03', 'Ikan Lele', 'Fresh Food', 'Kg', 1, '', '3'),
('IKM03', 'Ikan Mujaer', 'Fresh Food', 'Kg', 1, '', '3'),
('JAH02', 'Jahe', 'Dry Food', 'Kg', 1, '', '2'),
('JAM02', 'Jamur', 'Dry Food', 'Kg', 1, '', '2'),
('JEP04', 'Jeruk Peras', 'Beverage', 'Kg', 1, '', '4'),
('KAG02', 'Kangkung', 'Dry Food', 'Ikat', 1, '', '2'),
('KAG06', 'Karet Gelang', 'Material', 'Pck', 1, '', '6'),
('KAR09', 'Karbol Jrg 5Ltr', 'Chemical', 'Jrg', 1, '', '9'),
('KAW09', 'Kawat Sabut', 'Chemical', 'Pcs', 1, '', '9'),
('KEC02', 'Kecap Manis ', 'Dry Food', 'Pck', 1, '', '2'),
('KEK02', 'Kerupuk Kaleng', 'Dry Food', 'Pcs', 1, '', '2'),
('KEM01', 'Keju Mozarella', 'Frozen Food', 'Box', 1, '', '1'),
('KEM02', 'Kemiri', 'Dry Food', 'Kg', 1, '', '2'),
('KEM03', 'Kemangi', 'Fresh Food', 'Ikat', 1, '', '3'),
('KEN02', 'Kencur', 'Dry Food', 'Kg', 1, '', '2'),
('KEN03', 'Kentang', 'Fresh Food', 'Kg', 1, '', '3'),
('KER16', 'Kertas Nasi Agj', 'Material', 'Pcs', 1, '', '6'),
('KER26', 'Kertas Nasi Bunga', 'Material', 'Pck', 1, '', '6'),
('KER36', 'Kertas Nasi Kotak', 'Material', 'Pck', 1, '', '6'),
('KKA04', 'Kopi Kapal Api', 'Beverage', 'Pcs', 1, '', '4'),
('KOL03', 'Kol', 'Fresh Food', 'Kg', 1, '', '3'),
('KRP07', 'Kertas Roll Print', 'ATK', 'Pcs', 1, '', '7'),
('KUB02', 'Kunyit Bubuk Sachet', 'Dry Food', 'Pcs', 1, '', '2'),
('KUL01', 'Kulit', 'Frozen Food', 'Kg', 1, '', '1'),
('KUY02', 'Kunyit', 'Dry Food', 'Kg', 1, '', '2'),
('LAD02', 'Ladaku', 'Dry Food', 'Pcs', 1, '', '2'),
('LET04', 'Lemon Tea', 'Beverage', 'Pcs', 1, '', '4'),
('LYC05', 'Lychee Yakult', 'Pemadam', 'Pcs', 1, '', '5'),
('MAG05', 'Mangga', 'Pemadam', 'Pcs', 1, '', '5'),
('MEJ04', 'Meyjus', 'Beverage', 'Pcs', 1, '', '4'),
('MEN03', 'Mendoan', 'Fresh Food', 'Ppn', 1, '', '3'),
('MIB02', 'Minyak Beku', 'Dry Food', 'Box', 1, '', '2'),
('MID04', 'Minuman Dingin', 'Beverage', 'Pcs', 1, '', '4'),
('MIS04', 'Milkshake', 'Beverage', 'Pcs', 1, '', '4'),
('PEP09', 'Pencuci Piring', 'Chemical', 'Jrg', 1, '', '9'),
('PET03', 'Pete', 'Fresh Food', 'Ppn', 1, '', '3'),
('PIP07', 'Pita Printer', 'ATK', 'Pcs', 1, '', '7'),
('PIS05', 'Pink Story', 'Pemadam', 'Pcs', 1, '', '5'),
('PLS16', 'Plastik Gelas Cup', 'Material', 'Pck', 1, '', '6'),
('PLS26', 'Plastik Sambal Uk.9X8', 'Material', 'Pck', 1, '', '6'),
('PLS36', 'Plastik Sampah Hitam', 'Material', 'Pck', 1, '', '6'),
('PLS46', 'Plastik Sealers ', 'Material', 'Pck', 1, '', '6'),
('PLS56', 'Plastik Ukuran 15', 'Material', 'Pck', 1, '', '6'),
('PLS66', 'Plastik Ukuran 24', 'Material', 'Pck', 1, '', '6'),
('PLS76', 'Plastik Ukuran 26', 'Material', 'Pck', 1, '', '6'),
('PLS86', 'Plastik Ukuran 40', 'Material', 'Pck', 1, '', '6'),
('RED05', 'Red Velvet', 'Pemadam', 'Pcs', 1, '', '5'),
('ROY02', 'Royco Renceng', 'Dry Food', 'Pcs', 1, '', '2'),
('SAO02', 'Saos', 'Dry Food', 'Pck', 1, '', '2'),
('SAS02', 'Sasa 250Gr', 'Dry Food', 'Pck', 1, '', '2'),
('SCT09', 'Sabun Cuci Tangan', 'Chemical', 'Jrg', 1, '', '9'),
('SED16', 'Sedotan Bengkok', 'Material', 'Pck', 1, '', '6'),
('SED26', 'Sedotan Bubble', 'Material', 'Pck', 1, '', '6'),
('SEL03', 'Selada', 'Fresh Food', 'Kg', 1, '', '3'),
('SEN06', 'Sendok Plastik', 'Material', 'Pcs', 1, '', '6'),
('SMG02', 'Minyak Goreng', 'Dry Food', 'Box', 1, '', '2'),
('SOR02', 'Saori ', 'Dry Food', 'Btl', 1, '', '2'),
('SPO09', 'Spon Cuci Piring', 'Chemical', 'Pcs', 1, '', '9'),
('STE16', 'Styrofoam Besar', 'Material', 'Pck', 1, '', '6'),
('STE26', 'Styrofoam Kecil', 'Material', 'Ball', 1, '', '6'),
('SUC04', 'Susu Coklat', 'Beverage', 'Klg', 1, '', '4'),
('SUN09', 'Sabun Cuci Piring', 'Chemical', 'Pck', 1, '', '9'),
('SUP04', 'Susu Putih', 'Beverage', 'Klg', 1, '', '4'),
('TAH03', 'Tahu', 'Fresh Food', 'Bks', 1, '', '3'),
('TAR05', 'Taro Latte', 'Pemadam', 'Pcs', 1, '', '5'),
('TCC04', 'Tora Cafe Cappucino', 'Beverage', 'Pcs', 1, '', '4'),
('TCM04', 'Tora Cafe Milky', 'Beverage', 'Pcs', 1, '', '4'),
('TEA03', 'Telor Ayam', 'Fresh Food', 'Kg', 1, '', '3'),
('TEM03', 'Tempe', 'Fresh Food', 'Ppn', 1, '', '3'),
('TEP02', 'Tepung Terigu', 'Dry Food', 'Krg', 1, '', '2'),
('TEP03', 'Telor Puyuh', 'Fresh Food', 'Kg', 1, '', '3'),
('TER02', 'Terasi', 'Dry Food', 'Pcs', 1, '', '2'),
('TET04', 'Teh Tarik', 'Beverage', 'Pcs', 1, '', '4'),
('TEU04', 'Teh Upet', 'Beverage', 'Pck', 1, '', '4'),
('TIM03', 'Timun', 'Fresh Food', 'Kg', 1, '', '3'),
('TIS06', 'Tisu Kotak', 'Material', 'Pcs', 1, '', '6'),
('TOM03', 'Tomat ', 'Fresh Food', 'Kg', 1, '', '3'),
('TUG06', 'Tusuk Gigi', 'Material', 'Pck', 1, '', '6'),
('TUS06', 'Tusuk Sate', 'Material', 'Pck', 1, '', '6'),
('WEJ04', 'Wedang Jahe', 'Beverage', 'Pcs', 1, '', '4'),
('YAK04', 'Yakult', 'Beverage', 'Pcs', 1, '', '4');

-- --------------------------------------------------------

--
-- Table structure for table `dapur`
--

CREATE TABLE `dapur` (
  `id` int(11) NOT NULL,
  `outlet` varchar(11) NOT NULL,
  `kode` varchar(11) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `conv` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` float NOT NULL,
  `minim` float NOT NULL,
  `so` float NOT NULL,
  `suplier` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dapur`
--

INSERT INTO `dapur` (`id`, `outlet`, `kode`, `barang`, `jenis`, `satuan`, `conv`, `harga`, `stok`, `minim`, `so`, `suplier`, `note`, `user`) VALUES
(28, '122', 'ATI01', 'Ati Ampela ', 'Frozen Food', 'Pcs', '1', 11000, 10, 0, 0, 'PT. JUPRI - Distribution Center', '-', 'Anonimous'),
(29, '122', 'AIR04', 'Air Galon', 'Beverage', 'Gln', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(30, '122', 'AIR64', 'Air Mineral @600Ml', 'Beverage', 'Btl', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(31, '122', 'AYK01', 'Ayam Kampung', 'Frozen Food', 'Ekor', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(32, '122', 'AYM01', 'Ayam Marinasi', 'Frozen Food', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(33, '122', 'AYP01', 'Ayam Potong Isi 4', 'Frozen Food', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(34, '122', 'AYP41', 'Ayam Potong Isi 14', 'Frozen Food', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(35, '122', 'AYS01', 'Ayam Slice', 'Frozen Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(36, '122', 'BAM03', 'Bawang Merah', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(37, '122', 'BAP03', 'Bawang Putih Kupas', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(38, '122', 'BEP01', 'Bebek Potong 4', 'Frozen Food', 'Ekor', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(39, '122', 'BER02', 'Beras', 'Dry Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(40, '122', 'BIP02', 'Biang Premium', 'Dry Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(41, '122', 'BLU05', 'Blueberry', 'Pemadam', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(42, '122', 'BNN05', 'Banana', 'Pemadam', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(43, '122', 'BOW06', 'Bowl Nasi Super + Tutup', 'Material', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(44, '122', 'BOX16', 'Box Nasi Agj', 'Material', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(45, '122', 'BOX26', 'Box Agj Kecil', 'Material', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(46, '122', 'BUR02', 'Bumbu Racik ', 'Dry Food', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(47, '122', 'CAD03', 'Cabe Domba', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(48, '122', 'CAI03', 'Cabe Ijo', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(49, '122', 'CAM03', 'Cabe Merah', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(50, '122', 'CAR03', 'Cabe Rawit Hijau', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(51, '122', 'CGP05', 'Cup Gelas Pk', 'Pemadam', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(52, '122', 'CLI09', 'Cling', 'Chemical', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(53, '122', 'COT04', 'Cool Time', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(54, '122', 'CUP06', 'Cup Gelas Plastik ', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(55, '122', 'DAB03', 'Daun Bawang', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(56, '122', 'DSA02', 'Daun Salam', 'Dry Food', 'Ikat', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(57, '122', 'DSE02', 'Daun Sereh', 'Dry Food', 'Ikat', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(58, '122', 'ESK04', 'Es Kristal', 'Beverage', 'Ball', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(59, '122', 'GAR02', 'Garam ', 'Dry Food', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(60, '122', 'GAS18', 'Gas 5,5 Kg', 'Gas', 'Tab', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(61, '122', 'GAS28', 'Gas 12 Kg', 'Gas', 'Tab', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(62, '122', 'GAS38', 'Hi-Cook Gas 360Ml', 'Gas', 'Tab', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(63, '122', 'GDC04', 'Good Day Cappucino', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(64, '122', 'GUA04', 'Guava', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(65, '122', 'GUM02', 'Gula Merah', 'Dry Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(66, '122', 'GUP02', 'Gula Pasir', 'Dry Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(67, '122', 'HAN06', 'Hand Glove ', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(68, '122', 'HIT04', 'Hilo Thaitea', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(69, '122', 'IKL03', 'Ikan Lele', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(70, '122', 'IKM03', 'Ikan Mujaer', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(71, '122', 'JAH02', 'Jahe', 'Dry Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(72, '122', 'JAM02', 'Jamur', 'Dry Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(73, '122', 'JEP04', 'Jeruk Peras', 'Beverage', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(74, '122', 'KAG02', 'Kangkung', 'Dry Food', 'Ikat', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(75, '122', 'KAG06', 'Karet Gelang', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(76, '122', 'KAR09', 'Karbol Jrg 5Ltr', 'Chemical', 'Jrg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(77, '122', 'KAW09', 'Kawat Sabut', 'Chemical', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(78, '122', 'KEC02', 'Kecap Manis ', 'Dry Food', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(79, '122', 'KEK02', 'Kerupuk Kaleng', 'Dry Food', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(80, '122', 'KEM01', 'Keju Mozarella', 'Frozen Food', 'Box', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(81, '122', 'KEM02', 'Kemiri', 'Dry Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(82, '122', 'KEM03', 'Kemangi', 'Fresh Food', 'Ikat', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(83, '122', 'KEN02', 'Kencur', 'Dry Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(84, '122', 'KEN03', 'Kentang', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(85, '122', 'KER16', 'Kertas Nasi Agj', 'Material', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(86, '122', 'KER26', 'Kertas Nasi Bunga', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(87, '122', 'KER36', 'Kertas Nasi Kotak', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(88, '122', 'KKA04', 'Kopi Kapal Api', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(89, '122', 'KOL03', 'Kol', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(90, '122', 'KRP07', 'Kertas Roll Print', 'ATK', 'Pcs', '1', 0, 0, 10, 0, '', '-', 'Anonimous'),
(91, '122', 'KUB02', 'Kunyit Bubuk Sachet', 'Dry Food', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(92, '122', 'KUL01', 'Kulit', 'Frozen Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(93, '122', 'KUY02', 'Kunyit', 'Dry Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(94, '122', 'LAD02', 'Ladaku', 'Dry Food', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(95, '122', 'LET04', 'Lemon Tea', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(96, '122', 'LYC05', 'Lychee Yakult', 'Pemadam', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(97, '122', 'MAG05', 'Mangga', 'Pemadam', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(98, '122', 'MEJ04', 'Meyjus', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(99, '122', 'MEN03', 'Mendoan', 'Fresh Food', 'Ppn', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(100, '122', 'MIB02', 'Minyak Beku', 'Dry Food', 'Box', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(101, '122', 'MID04', 'Minuman Dingin', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(102, '122', 'MIS04', 'Milkshake', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(103, '122', 'PEP09', 'Pencuci Piring', 'Chemical', 'Jrg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(104, '122', 'PET03', 'Pete', 'Fresh Food', 'Ppn', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(105, '122', 'PIP07', 'Pita Printer', 'ATK', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(106, '122', 'PIS05', 'Pink Story', 'Pemadam', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(107, '122', 'PLS16', 'Plastik Gelas Cup', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(108, '122', 'PLS26', 'Plastik Sambal Uk.9X8', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(109, '122', 'PLS36', 'Plastik Sampah Hitam', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(110, '122', 'PLS46', 'Plastik Sealers ', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(111, '122', 'PLS56', 'Plastik Ukuran 15', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(112, '122', 'PLS66', 'Plastik Ukuran 24', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(113, '122', 'PLS76', 'Plastik Ukuran 26', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(114, '122', 'PLS86', 'Plastik Ukuran 40', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(115, '122', 'RED05', 'Red Velvet', 'Pemadam', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(116, '122', 'ROY02', 'Royco Renceng', 'Dry Food', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(117, '122', 'SAO02', 'Saos', 'Dry Food', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(118, '122', 'SAS02', 'Sasa 250Gr', 'Dry Food', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(119, '122', 'SCT09', 'Sabun Cuci Tangan', 'Chemical', 'Jrg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(120, '122', 'SED16', 'Sedotan Bengkok', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(121, '122', 'SED26', 'Sedotan Bubble', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(122, '122', 'SEL03', 'Selada', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(123, '122', 'SEN06', 'Sendok Plastik', 'Material', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(124, '122', 'SMG02', 'Minyak Goreng', 'Dry Food', 'Box', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(125, '122', 'SOR02', 'Saori ', 'Dry Food', 'Btl', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(126, '122', 'SPO09', 'Spon Cuci Piring', 'Chemical', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(127, '122', 'STE16', 'Styrofoam Besar', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(128, '122', 'STE26', 'Styrofoam Kecil', 'Material', 'Ball', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(129, '122', 'SUC04', 'Susu Coklat', 'Beverage', 'Klg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(130, '122', 'SUN09', 'Sabun Cuci Piring', 'Chemical', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(131, '122', 'SUP04', 'Susu Putih', 'Beverage', 'Klg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(132, '122', 'TAH03', 'Tahu', 'Fresh Food', 'Bks', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(133, '122', 'TAR05', 'Taro Latte', 'Pemadam', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(134, '122', 'TCC04', 'Tora Cafe Cappucino', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(135, '122', 'TCM04', 'Tora Cafe Milky', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(136, '122', 'TEA03', 'Telor Ayam', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(137, '122', 'TEM03', 'Tempe', 'Fresh Food', 'Ppn', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(138, '122', 'TEP02', 'Tepung Terigu', 'Dry Food', 'Krg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(139, '122', 'TEP03', 'Telor Puyuh', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(140, '122', 'TER02', 'Terasi', 'Dry Food', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(141, '122', 'TET04', 'Teh Tarik', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(142, '122', 'TEU04', 'Teh Upet', 'Beverage', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(143, '122', 'TIM03', 'Timun', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(144, '122', 'TIS06', 'Tisu Kotak', 'Material', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(145, '122', 'TOM03', 'Tomat ', 'Fresh Food', 'Kg', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(146, '122', 'TUG06', 'Tusuk Gigi', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(147, '122', 'TUS06', 'Tusuk Sate', 'Material', 'Pck', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(148, '122', 'WEJ04', 'Wedang Jahe', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous'),
(149, '122', 'YAK04', 'Yakult', 'Beverage', 'Pcs', '1', 0, 0, 0, 0, '', '-', 'Anonimous');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `kode` varchar(11) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `jual` int(11) NOT NULL,
  `conv` float NOT NULL,
  `stok` float NOT NULL,
  `minim` float NOT NULL,
  `so` float NOT NULL,
  `suplier` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`kode`, `barang`, `jenis`, `satuan`, `harga`, `jual`, `conv`, `stok`, `minim`, `so`, `suplier`, `note`) VALUES
('AIR04', 'Air Galon', 'Beverage', 'Gln', 0, 0, 1, 0, 0, 0, '', '-'),
('AIR64', 'Air Mineral @600Ml', 'Beverage', 'Btl', 0, 0, 1, 0, 0, 0, '', '-'),
('ATI01', 'Ati Ampela ', 'Frozen Food', 'Kg', 5000, 7000, 1, 39, 10, 30, 'Mang Ujang', '-'),
('AYK01', 'Ayam Kampung', 'Frozen Food', 'Ekor', 0, 0, 1, 0, 0, 0, '', '-'),
('AYM01', 'Ayam Marinasi', 'Frozen Food', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('AYP01', 'Ayam Potong Isi 4', 'Frozen Food', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('AYP41', 'Ayam Potong Isi 14', 'Frozen Food', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('AYS01', 'Ayam Slice', 'Frozen Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('BAM03', 'Bawang Merah', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('BAP03', 'Bawang Putih Kupas', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('BEP01', 'Bebek Potong 4', 'Frozen Food', 'Ekor', 0, 0, 1, 0, 0, 0, '', '-'),
('BER02', 'Beras', 'Dry Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('BIP02', 'Biang Premium', 'Dry Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('BLU05', 'Blueberry', 'Pemadam', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('BNN05', 'Banana', 'Pemadam', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('BOW06', 'Bowl Nasi Super + Tutup', 'Material', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('BOX16', 'Box Nasi Agj', 'Material', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('BOX26', 'Box Agj Kecil', 'Material', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('BUR02', 'Bumbu Racik ', 'Dry Food', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('CAD03', 'Cabe Domba', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('CAI03', 'Cabe Ijo', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('CAM03', 'Cabe Merah', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('CAR03', 'Cabe Rawit Hijau', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('CGP05', 'Cup Gelas Pk', 'Pemadam', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('CLI09', 'Cling', 'Chemical', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('COT04', 'Cool Time', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('CUP06', 'Cup Gelas Plastik ', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('DAB03', 'Daun Bawang', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('DSA02', 'Daun Salam', 'Dry Food', 'Ikat', 0, 0, 1, 0, 0, 0, '', '-'),
('DSE02', 'Daun Sereh', 'Dry Food', 'Ikat', 0, 0, 1, 0, 0, 0, '', '-'),
('ESK04', 'Es Kristal', 'Beverage', 'Ball', 0, 0, 1, 0, 0, 0, '', '-'),
('GAR02', 'Garam ', 'Dry Food', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('GAS18', 'Gas 5,5 Kg', 'Gas', 'Tab', 0, 0, 1, 0, 0, 0, '', '-'),
('GAS28', 'Gas 12 Kg', 'Gas', 'Tab', 0, 0, 1, 0, 0, 0, '', '-'),
('GAS38', 'Hi-Cook Gas 360Ml', 'Gas', 'Tab', 0, 0, 1, 0, 0, 0, '', '-'),
('GDC04', 'Good Day Cappucino', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('GUA04', 'Guava', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('GUM02', 'Gula Merah', 'Dry Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('GUP02', 'Gula Pasir', 'Dry Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('HAN06', 'Hand Glove ', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('HIT04', 'Hilo Thaitea', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('IKL03', 'Ikan Lele', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('IKM03', 'Ikan Mujaer', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('JAH02', 'Jahe', 'Dry Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('JAM02', 'Jamur', 'Dry Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('JEP04', 'Jeruk Peras', 'Beverage', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('KAG02', 'Kangkung', 'Dry Food', 'Ikat', 0, 0, 1, 0, 0, 0, '', '-'),
('KAG06', 'Karet Gelang', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('KAR09', 'Karbol Jrg 5Ltr', 'Chemical', 'Jrg', 0, 0, 1, 0, 0, 0, '', '-'),
('KAW09', 'Kawat Sabut', 'Chemical', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('KEC02', 'Kecap Manis ', 'Dry Food', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('KEK02', 'Kerupuk Kaleng', 'Dry Food', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('KEM01', 'Keju Mozarella', 'Frozen Food', 'Box', 0, 0, 1, 0, 0, 0, '', '-'),
('KEM02', 'Kemiri', 'Dry Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('KEM03', 'Kemangi', 'Fresh Food', 'Ikat', 0, 0, 1, 0, 0, 0, '', '-'),
('KEN02', 'Kencur', 'Dry Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('KEN03', 'Kentang', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('KER16', 'Kertas Nasi Agj', 'Material', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('KER26', 'Kertas Nasi Bunga', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('KER36', 'Kertas Nasi Kotak', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('KKA04', 'Kopi Kapal Api', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('KOL03', 'Kol', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('KRP07', 'Kertas Roll Print', 'ATK', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('KUB02', 'Kunyit Bubuk Sachet', 'Dry Food', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('KUL01', 'Kulit', 'Frozen Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('KUY02', 'Kunyit', 'Dry Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('LAD02', 'Ladaku', 'Dry Food', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('LET04', 'Lemon Tea', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('LYC05', 'Lychee Yakult', 'Pemadam', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('MAG05', 'Mangga', 'Pemadam', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('MEJ04', 'Meyjus', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('MEN03', 'Mendoan', 'Fresh Food', 'Ppn', 0, 0, 1, 0, 0, 0, '', '-'),
('MIB02', 'Minyak Beku', 'Dry Food', 'Box', 0, 0, 1, 0, 0, 0, '', '-'),
('MID04', 'Minuman Dingin', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('MIS04', 'Milkshake', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('PEP09', 'Pencuci Piring', 'Chemical', 'Jrg', 0, 0, 1, 0, 0, 0, '', '-'),
('PET03', 'Pete', 'Fresh Food', 'Ppn', 0, 0, 1, 0, 0, 0, '', '-'),
('PIP07', 'Pita Printer', 'ATK', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('PIS05', 'Pink Story', 'Pemadam', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('PLS16', 'Plastik Gelas Cup', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('PLS26', 'Plastik Sambal Uk.9X8', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('PLS36', 'Plastik Sampah Hitam', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('PLS46', 'Plastik Sealers ', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('PLS56', 'Plastik Ukuran 15', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('PLS66', 'Plastik Ukuran 24', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('PLS76', 'Plastik Ukuran 26', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('PLS86', 'Plastik Ukuran 40', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('RED05', 'Red Velvet', 'Pemadam', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('ROY02', 'Royco Renceng', 'Dry Food', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('SAO02', 'Saos', 'Dry Food', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('SAS02', 'Sasa 250Gr', 'Dry Food', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('SCT09', 'Sabun Cuci Tangan', 'Chemical', 'Jrg', 0, 0, 1, 0, 0, 0, '', '-'),
('SED16', 'Sedotan Bengkok', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('SED26', 'Sedotan Bubble', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('SEL03', 'Selada', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('SEN06', 'Sendok Plastik', 'Material', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('SMG02', 'Minyak Goreng', 'Dry Food', 'Box', 0, 0, 1, 0, 0, 0, '', '-'),
('SOR02', 'Saori ', 'Dry Food', 'Btl', 0, 0, 1, 0, 0, 0, '', '-'),
('SPO09', 'Spon Cuci Piring', 'Chemical', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('STE16', 'Styrofoam Besar', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('STE26', 'Styrofoam Kecil', 'Material', 'Ball', 0, 0, 1, 0, 0, 0, '', '-'),
('SUC04', 'Susu Coklat', 'Beverage', 'Klg', 0, 0, 1, 0, 0, 0, '', '-'),
('SUN09', 'Sabun Cuci Piring', 'Chemical', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('SUP04', 'Susu Putih', 'Beverage', 'Klg', 0, 0, 1, 0, 0, 0, '', '-'),
('TAH03', 'Tahu', 'Fresh Food', 'Bks', 0, 0, 1, 0, 0, 0, '', '-'),
('TAR05', 'Taro Latte', 'Pemadam', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('TCC04', 'Tora Cafe Cappucino', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('TCM04', 'Tora Cafe Milky', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('TEA03', 'Telor Ayam', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('TEM03', 'Tempe', 'Fresh Food', 'Ppn', 0, 0, 1, 0, 0, 0, '', '-'),
('TEP02', 'Tepung Terigu', 'Dry Food', 'Krg', 0, 0, 1, 0, 0, 0, '', '-'),
('TEP03', 'Telor Puyuh', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('TER02', 'Terasi', 'Dry Food', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('TET04', 'Teh Tarik', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('TEU04', 'Teh Upet', 'Beverage', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('TIM03', 'Timun', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('TIS06', 'Tisu Kotak', 'Material', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('TOM03', 'Tomat ', 'Fresh Food', 'Kg', 0, 0, 1, 0, 0, 0, '', '-'),
('TUG06', 'Tusuk Gigi', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('TUS06', 'Tusuk Sate', 'Material', 'Pck', 0, 0, 1, 0, 0, 0, '', '-'),
('WEJ04', 'Wedang Jahe', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-'),
('YAK04', 'Yakult', 'Beverage', 'Pcs', 0, 0, 1, 0, 0, 0, '', '-');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `jenis`, `note`) VALUES
(1, 'Frozen Food', 'Bahan Beku'),
(2, 'Dry Food', 'Bahan Kering'),
(3, 'Fresh Food', 'Bahan Sayuran'),
(4, 'Beverage', 'Bahan Minuman'),
(5, 'Pemadam', 'Bahan Minuman Pemadam'),
(6, 'Material', 'Pembungkus'),
(7, 'Gas', 'Gas LPG'),
(8, 'Chemical', 'Bahan Pembersih'),
(9, 'ATK', 'Alat Tulis Kantor'),
(10, 'Tambahan', 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `kode` varchar(11) NOT NULL,
  `outlet` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kordinat` varchar(100) NOT NULL,
  `kepala` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `note` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`kode`, `outlet`, `jenis`, `alamat`, `kordinat`, `kepala`, `status`, `note`) VALUES
('122', 'AGJ Juanda', 'Ayam Geprek Juara', 'Panglayungan, Kec. Cipedes, Kab. Tasikmalaya, Jawa Barat 46134', '-7.3182656660106815, 108.1986917119624', 'Yayat', 'Aktif', '-'),
('140', 'AGJ Baleendah', 'Ayam Geprek Juara', 'Jl. Jaksa Naranata, Baleendah, Kec. Baleendah, Kabupaten Bandung, Jawa Barat 40375', '-7.004954966189314, 107.63103763894696', 'Rahmat', 'Aktif', '-'),
('146', 'AGJ Banjar', 'Ayam Geprek Juara', 'Jl. Dr. Husein Kartasasmita No.3, Banjar, Kec. Banjar, Kota Banjar, Jawa Barat 46311', '-7.369501069884787, 108.53540808128', 'Romi', 'Aktif', '-'),
('156', 'AGJ Singaparna', 'Ayam Geprek Juara', 'Jl. Raya Singaparna Garut No.78, Sukamulya, Kec. Singaparna, Kabupaten Tasikmalaya, Jawa Barat 46416', '-7.349528721619862, 108.11672896778597', 'Andri', 'Aktif', '-'),
('172', 'AGJ Ciamis', 'Ayam Geprek Juara', 'Jl. Ir. H. Juanda Jl. Alun - Alun Timur No.180, Ciamis, Kec. Ciamis, Kabupaten Ciamis, Jawa Barat 46', '-7.326937227356534, 108.35293715318846', 'Adin', 'Aktif', '-'),
('22', 'AGJ Yudha', 'Ayam Geprek Juara', 'Jl. Yudanegara No.37a, Yudanagara, Kec. Cihideung, Kab. Tasikmalaya, Jawa Barat 46121', '-7.32592796341779, 108.21774148127957', 'Isan', 'Aktif', '-'),
('222', 'AGJ Siliwangi', 'Ayam Geprek Juara', 'Jl. Siliwangi No.137, Kuningan, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45511', '-6.980879162512211, 108.47846816778197', 'Dadi', 'Aktif', '-'),
('234', 'AGJ Kircon', 'Ayam Geprek Juara', 'Jl. Ibrahim Adjie No.430, Binong, Kec. Batununggal, Kota Bandung, Jawa Barat 40275', '-6.943870141806428, 107.64179396778164', 'Darus', 'Aktif', '-'),
('256', 'AGJ Antapani', 'Ayam Geprek Juara', 'Jl. Purwakarta No.200, Antapani Kidul, Kec. Antapani, Kota Bandung, Jawa Barat 40291', '-6.917362478783162, 107.66033302545208', 'Ali', 'Aktif', '-'),
('263', 'AGJ Majalengka', 'Ayam Geprek Juara', 'Jl. Letkol Abd. Gani No.5, Majalengka Kulon, Kec. Majalengka, Kabupaten Majalengka, Jawa Barat 45411', '-6.837488670649569, 108.2296384133538', 'Arul', 'Aktif', '-'),
('62', 'AGJ Pangandaran', 'Ayam Geprek Juara', 'Pananjung, Kec. Pangandaran, Kabupaten Ciamis, Jawa Barat 46396', '-7.68432090969229, 108.65347186778965', 'Deden', 'Aktif', '-');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `inv` varchar(11) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `tempo` varchar(100) NOT NULL,
  `kode` varchar(11) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `qty` float NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `bayar` varchar(100) NOT NULL,
  `suplier` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`inv`, `tanggal`, `tempo`, `kode`, `barang`, `jenis`, `satuan`, `harga`, `qty`, `jumlah`, `bayar`, `suplier`, `note`, `user`) VALUES
('GM-30343203', '2022-06-14', '2022-06-21', 'ATI01', 'Ati Ampela ', 'Frozen Food', 'Kg', '5000', 50, '250000', '250000', 'Mang Ujang', '-', 'Abdul Aziz');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan`
--

CREATE TABLE `penerimaan` (
  `id` int(11) NOT NULL,
  `inv` varchar(11) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `outlet` varchar(100) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `qty` float NOT NULL,
  `terima` float NOT NULL,
  `conv` float NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `suplier` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerimaan`
--

INSERT INTO `penerimaan` (`id`, `inv`, `tanggal`, `pengirim`, `outlet`, `kode`, `barang`, `jenis`, `satuan`, `qty`, `terima`, `conv`, `harga`, `jumlah`, `suplier`, `note`, `user`) VALUES
(33, 'IN-334323', '2022-06-14', 'aceng', '122', 'ATI01', 'Ati Ampela ', 'Frozen Food', 'Kg', 10, 10, 1, 7000, 70000, 'PT. JUPRI - Distribution Center', '-', 'Anonimous');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id` int(11) NOT NULL,
  `inv` varchar(11) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `tempo` varchar(100) NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `outlet` varchar(100) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` float NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id`, `inv`, `tanggal`, `tempo`, `pengirim`, `outlet`, `kode`, `barang`, `jenis`, `satuan`, `harga`, `qty`, `jumlah`, `ket`, `note`, `user`) VALUES
(33, 'IN-334323', '2022-06-21', '2022-06-21', 'aceng', '122', 'ATI01', 'Ati Ampela ', 'Frozen Food', 'Kg', 7000, 10, 70000, 'Lunas', 'DITERIMA', 'Abdul Aziz'),
(35, 'IN-334323', '2022-06-21', '2022-06-21', 'aceng', '122', 'ATI01', 'Ati Ampela ', 'Frozen Food', 'Kg', 7000, 1, 7000, 'Lunas', '-', 'Abdul Aziz');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`, `note`) VALUES
(1, 'Pcs', 'Pieces'),
(2, 'Kg', 'Kilogram'),
(3, 'Pck', 'Paket'),
(4, 'Box', 'Kotak'),
(5, 'Ikat', 'Sayuran'),
(6, 'Btl', 'Botol'),
(7, 'Krg', 'Karung'),
(8, 'Bks', 'Bungkus'),
(9, 'Ppn', 'Papan'),
(10, 'Klg', 'Kaleng'),
(11, 'Gln', 'Galon'),
(12, 'Ball', 'Bungkus Besar'),
(13, 'Jrg', 'Jerigen'),
(14, 'Ekor', 'Ayam per ekor');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id` int(11) NOT NULL,
  `suplier` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id`, `suplier`, `alamat`, `telepon`, `jenis`, `note`) VALUES
(1, 'CV. Amanah', 'Gn. Asih', '08567567567', 'Frozen Food', '-'),
(2, 'PT. Setia', 'Gn. Asih', '089123412345', 'Dry Food', '-'),
(4, 'Mang Ujang', 'Pasar Cikurubuk', '089123412345', 'Fresh Food', '-');

-- --------------------------------------------------------

--
-- Table structure for table `terbuang`
--

CREATE TABLE `terbuang` (
  `id` int(11) NOT NULL,
  `outlet` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `keluar` varchar(100) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `kode` varchar(11) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `qty` float NOT NULL,
  `note` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `terpakai`
--

CREATE TABLE `terpakai` (
  `id` int(11) NOT NULL,
  `outlet` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `keluar` varchar(100) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `kode` varchar(11) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `qty` float NOT NULL,
  `note` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(11) NOT NULL,
  `cabang` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `akses` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `pass`, `nama`, `kode`, `cabang`, `jabatan`, `akses`, `note`) VALUES
(0, 'abu.kafa', '$2y$10$9D8mA845doW.Y8f/8ZL3t.R.m4TmotLJwAhNF0uvUS/YlMgG..XZO', 'Abdul Aziz', 'Office', 'Juara Priangan', 'Programmer', 'Superuser', 'Maintain'),
(3, 'super.admin', '$2y$10$xnnGImomsjBNfNv.SceUIORWUwz60H8OqxYj41V.yxPoSiS99jPhy', 'Anonimous', 'Office', 'Juara Priangan', 'Admin', 'Superuser', 'User Test'),
(4, 'admin', '$2y$10$GwYLmhtgxdZcWfq2Tqnk5.B4vTk5l.Kz/cIt6y11MJJW0EJY1PjH.', 'Anonimous', 'Office', 'Juara Priangan', 'Admin', 'User', 'User Test'),
(5, 'user122', '$2y$10$pThnipYVC37hfWnMnO7OH.7LU.fzIIXbkO2.1Ppr6XPR1hi.01FB6', 'Anonimous', '122', 'AGJ Juanda', 'Leader', 'User', 'User Test'),
(6, 'user140', '$2y$10$O0EJdRP4l4Xjc.eCHd.3Ou/kE4jAkauFKIzsu2SbgShJ6gRG.MzSW', 'Anonimous', '140', 'AGJ Baleendah', 'Leader', 'User', 'User Test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `dapur`
--
ALTER TABLE `dapur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`inv`);

--
-- Indexes for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terbuang`
--
ALTER TABLE `terbuang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terpakai`
--
ALTER TABLE `terpakai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dapur`
--
ALTER TABLE `dapur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `terbuang`
--
ALTER TABLE `terbuang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `terpakai`
--
ALTER TABLE `terpakai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
