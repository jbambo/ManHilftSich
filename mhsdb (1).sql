-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 02:05 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mhsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `helper_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` set('to do','in progress','done') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `helper_id`, `user_id`, `status`) VALUES
(3, 7, 435, 'to do'),
(4, 12, 435, 'done'),
(5, 8, 446, 'done'),
(6, 8, 449, 'in progress'),
(7, 8, 443, 'done'),
(8, 7, 435, 'to do'),
(9, 7, 442, 'to do');

-- --------------------------------------------------------

--
-- Table structure for table `helper`
--

CREATE TABLE `helper` (
  `id` int(11) NOT NULL,
  `vname` text NOT NULL,
  `nname` text NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `cat1` text NOT NULL,
  `cat2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `helper`
--

INSERT INTO `helper` (`id`, `vname`, `nname`, `latitude`, `longitude`, `cat1`, `cat2`) VALUES
(7, 'Martin', 'Martinez', 50.11, 7.3, 'zu Hause', 'beim Einkaufen'),
(8, 'Frank', 'Bob', 52.33, 14.54, 'Garten', 'Garten'),
(10, 'Frank', 'Bob', 49.77, 8.38, 'im Hof', 'Garten'),
(11, 'Frank', 'Bob', 52.51, 13.37, 'beim Einkaufen', 'beim Einkaufen'),
(12, 'Cristiano', 'Ronaldo', 47.15, 8.16, 'zu Hause', 'zu Hause'),
(13, 'test1', 'test1', 49.86, 8.33, 'beim Einkaufen', 'beim Einkaufen'),
(14, 'Frank', 'Bob', 49.98, 8.26, 'zu Hause', 'Garten');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `vname` text NOT NULL,
  `nname` text NOT NULL,
  `lat` int(11) NOT NULL,
  `lng` int(11) NOT NULL,
  `category` text NOT NULL,
  `urgency` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `vname`, `nname`, `lat`, `lng`, `category`, `urgency`) VALUES
(1, 'abc', 'abc', 4, 5, 'abc', 'abc'),
(2, 'abc', 'abc', 4, 5, 'abc', 'abc'),
(3, 'abc', 'abc', 4, 5, 'abc', 'abc'),
(4, 'abc', 'abc', 4, 5, 'abc', 'abc'),
(6, 'john', 'b', 5, 6, 'garten', '9'),
(7, 'bambo', 'jihn', 332, 45, 'garten', '3'),
(8, 'bambo', 'john', 10, 24, 'Garten', '1'),
(9, 'bambo', 'john', 33, 24, 'Garten', '1'),
(10, 'martinsky', 'martino', 98, 45, 'im Hof', '4'),
(11, 'bambo', 'john2', 34, 12, 'Garten', '1'),
(12, 'bambo', 'john2', 34, 12, 'Garten', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `vname` text NOT NULL,
  `nname` text NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `category` text NOT NULL,
  `urgency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `vname`, `nname`, `latitude`, `longitude`, `category`, `urgency`) VALUES
(435, 'Hans', 'Mandelbaum', 50.14, 7.34, 'Garten', 1),
(442, 'Adam', 'Opel', 49.76, 8.34, 'Garten', 4),
(443, 'Adam', 'Opel', 50.11, 7.3, 'im Hof', 4),
(444, 'Adam', 'Einstein', 49.76, 8.34, 'im Hof', 3),
(445, 'Adam', 'Vierstein', 49.76, 8.34, 'im Hof', 1),
(446, 'Adam', 'Zweistein', 49.76, 8.34, 'im Hof', 2),
(447, 'Mark ', 'Scooter', 49.79, 8.34, 'Garten', 2),
(448, 'Mark ', 'Scooter', 49.79, 8.34, 'Garten', 3),
(449, 'Mark ', 'Scooter', 49.79, 8.34, 'Garten', 4),
(450, 'Mark ', 'Scooter', 49.79, 8.34, 'Garten', 4),
(451, 'Mark ', 'Scooter', 49.79, 8.34, 'Garten', 4),
(452, 'Bob', 'Frank', 50.11, 7.3, 'zu Hause', 2),
(453, 'Enrique', 'Mokebe', 39.46, -0.37, 'zu Hause', 4),
(454, 'Rodrigo', 'Mokebe', 41.38, 2.17, 'zu Hause', 4),
(455, 'James', 'Bond', 55.75, 37.61, 'zu Hause', 4),
(456, 'John', 'Tester', 50.11, 7.3, 'Garten', 1),
(457, 'John', 'Tester', 50.11, 7.3, 'Garten', 1),
(458, 'John', 'Tester', 50.11, 7.3, 'Garten', 1),
(459, 'John', 'Tester', 50.11, 7.3, 'Garten', 1),
(460, 'John', 'Tester', 50.11, 7.3, 'Garten', 1),
(461, 'Ronaldinho', 'Tak', 50.94, 6.95, 'im Hof', 3),
(462, 'Ronaldinho', 'Tak', 50.94, 6.95, 'zu Hause', 3),
(463, 'Ronaldinho', 'Tak', 50.94, 6.95, 'Garten', 3),
(464, 'Ronaldinho', 'Tak', 50.94, 6.95, 'beim Einkaufen', 3),
(465, 'Ronaldinho', 'Tak', 50.94, 6.95, 'Garten', 3),
(466, 'Ronaldinho', 'Tak', 50.94, 6.95, 'Garten', 3),
(467, 'Ronaldinho', 'Tak', 50.94, 6.95, 'beim Einkaufen', 3),
(468, 'Ronaldinho', 'Tak', 50.94, 6.95, 'zu Hause', 3),
(469, 'Ronaldinho', 'Tak', 50.94, 6.95, 'im Hof', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `helper`
--
ALTER TABLE `helper`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `helper`
--
ALTER TABLE `helper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=470;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
