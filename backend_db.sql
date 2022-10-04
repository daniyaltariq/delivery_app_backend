-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2022 at 03:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backend_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` varchar(255) NOT NULL,
  `sending_location` varchar(255) NOT NULL,
  `receiving_location` varchar(255) NOT NULL,
  `consignee` int(255) NOT NULL,
  `user` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `sending_location`, `receiving_location`, `consignee`, `user`) VALUES
('83a86473-cfcf-4f5c-8e2d-378702a80e6a', 'Lahore', 'Okara', 2, 1),
('c6b4a51f-d89b-49fe-95c6-d36827f1e9b0', 'ISB', 'OKA', 2, 1),
('f89769c1-d861-4b89-a3a8-aab22ba9bcb4', 'Okara', 'Lahore', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `parcels_tracking_history`
--

CREATE TABLE `parcels_tracking_history` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `parcel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parcels_tracking_history`
--

INSERT INTO `parcels_tracking_history` (`id`, `status`, `date`, `parcel`) VALUES
(8, 'Parcel Added', '10/1/2022, 10:16:01 PM', 'c6b4a51f-d89b-49fe-95c6-d36827f1e9b0'),
(9, 'Parcel Added', '10/2/2022, 12:05:00 AM', '83a86473-cfcf-4f5c-8e2d-378702a80e6a'),
(11, 'Picked Up', '10/2/2022, 12:58:30 AM', '83a86473-cfcf-4f5c-8e2d-378702a80e6a'),
(12, 'Delivered', '10/2/2022, 12:59:18 AM', '83a86473-cfcf-4f5c-8e2d-378702a80e6a'),
(13, 'Picked Up', '10/2/2022, 1:26:44 AM', 'c6b4a51f-d89b-49fe-95c6-d36827f1e9b0'),
(14, 'Delivered', '10/2/2022, 1:26:47 AM', 'c6b4a51f-d89b-49fe-95c6-d36827f1e9b0'),
(19, 'Parcel Added', '10/3/2022, 8:49:01 PM', 'f89769c1-d861-4b89-a3a8-aab22ba9bcb4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `role`) VALUES
(1, 'admin@admin.com', 'admin', 'seller 1', 'seller'),
(2, 'dispatcher1@deliver.com', 'dispatcher1', 'Boy 1', 'dispatcher'),
(3, 'dispatcher2@deliver.com', 'dispatcher2', 'Boy 2', 'dispatcher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `consignee` (`consignee`);

--
-- Indexes for table `parcels_tracking_history`
--
ALTER TABLE `parcels_tracking_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcel` (`parcel`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parcels_tracking_history`
--
ALTER TABLE `parcels_tracking_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parcels`
--
ALTER TABLE `parcels`
  ADD CONSTRAINT `parcels_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `parcels_ibfk_2` FOREIGN KEY (`consignee`) REFERENCES `users` (`id`);

--
-- Constraints for table `parcels_tracking_history`
--
ALTER TABLE `parcels_tracking_history`
  ADD CONSTRAINT `parcels_tracking_history_ibfk_1` FOREIGN KEY (`parcel`) REFERENCES `parcels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
