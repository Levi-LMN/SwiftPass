-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 03:05 PM
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
-- Database: `swiftpass`
--

-- --------------------------------------------------------

--
-- Table structure for table `sacco`
--

CREATE TABLE `sacco` (
                         `id` int(11) NOT NULL,
                         `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sacco`
--

INSERT INTO `sacco` (`id`, `name`) VALUES
                                       (1, 'Super Metro'),
                                       (2, 'Super Metro'),
                                       (3, 'Super Metro'),
                                       (4, 'Super Metro'),
                                       (5, ''),
                                       (6, 'Super Metro'),
                                       (7, 'Super Metro'),
                                       (8, 'Githurai 44'),
                                       (9, 'Githurai 44'),
                                       (10, 'Githurai 44'),
                                       (11, 'Githurai 44'),
                                       (12, 'Githurai 44'),
                                       (13, 'Super Metro tran'),
                                       (14, 'Githurai 44');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
                          `id` int(11) NOT NULL,
                          `ticket_number` varchar(20) NOT NULL,
                          `user_id` int(11) NOT NULL,
                          `travel_schedule_id` int(11) NOT NULL,
                          `booking_time` datetime NOT NULL DEFAULT current_timestamp(),
                          `seat_number` varchar(20) DEFAULT NULL,
                          `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `ticket_number`, `user_id`, `travel_schedule_id`, `booking_time`, `seat_number`, `price`) VALUES
                                                                                                                          (57, '5433383612', 12, 7, '2024-03-01 12:13:16', '2', 500),
                                                                                                                          (58, 'D0C60F2096', 12, 7, '2024-03-01 12:14:07', '3', 500),
                                                                                                                          (59, 'E1CD31FE90', 12, 7, '2024-03-01 12:14:07', '4', 500),
                                                                                                                          (60, 'A8192B63E0', 12, 7, '2024-03-01 12:19:03', '1', 500),
                                                                                                                          (61, '21BF933AAD', 12, 8, '2024-03-01 12:20:09', '4', 500),
                                                                                                                          (62, '987B2EDDD2', 12, 8, '2024-03-01 15:12:21', '17', 500),
                                                                                                                          (63, 'D54E621516', 12, 8, '2024-03-01 16:11:14', '9', 500),
                                                                                                                          (64, 'DBC77435C2', 12, 8, '2024-03-01 16:14:29', '11', 500),
                                                                                                                          (65, '2C8C4B7EA7', 12, 8, '2024-03-01 16:14:29', '13', 500),
                                                                                                                          (66, '78D114E2B0', 12, 8, '2024-03-01 16:14:29', '19', 500),
                                                                                                                          (67, 'EDF4A7C9BA', 12, 8, '2024-03-01 16:22:52', '15', 500),
                                                                                                                          (68, '35094A24EE', 12, 8, '2024-03-01 16:23:55', '7', 500),
                                                                                                                          (69, '270F690E34', 12, 8, '2024-03-01 17:02:01', '5', 500),
                                                                                                                          (70, '15A94ABCE3', 12, 8, '2024-03-01 17:02:01', '8', 500),
                                                                                                                          (71, 'A707EA3653', 12, 8, '2024-03-01 17:02:01', '12', 500),
                                                                                                                          (72, '6DD730CB13', 12, 8, '2024-03-01 17:02:01', '1', 500),
                                                                                                                          (73, '64D2687E72', 12, 8, '2024-03-01 17:02:01', '3', 500),
                                                                                                                          (74, 'BA30CA5124', 12, 8, '2024-03-01 17:02:01', '2', 500),
                                                                                                                          (75, 'C40F61DD50', 12, 8, '2024-03-01 17:02:01', '14', 500),
                                                                                                                          (76, '619453D174', 12, 8, '2024-03-01 17:02:23', '6', 500);

-- --------------------------------------------------------

--
-- Table structure for table `travelschedule`
--

CREATE TABLE `travelschedule` (
                                  `id` int(11) NOT NULL,
                                  `departure_location` varchar(255) NOT NULL,
                                  `destination` varchar(255) NOT NULL,
                                  `departure_time` datetime NOT NULL DEFAULT current_timestamp(),
                                  `price` float NOT NULL,
                                  `vehicle_id` int(11) NOT NULL,
                                  `is_done` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travelschedule`
--

INSERT INTO `travelschedule` (`id`, `departure_location`, `destination`, `departure_time`, `price`, `vehicle_id`, `is_done`) VALUES
                                                                                                                                 (7, 'Muranga', 'Githurai', '2024-03-30 11:52:00', 500, 5, 1),
                                                                                                                                 (8, 'Nyeri', 'Kabarak', '2024-03-23 12:19:00', 500, 7, 0),
                                                                                                                                 (9, 'Kisumu', 'Kitengela', '2024-03-30 20:26:00', 600, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
                        `id` int(11) NOT NULL,
                        `first_name` varchar(255) NOT NULL,
                        `last_name` varchar(255) NOT NULL,
                        `email` varchar(120) NOT NULL,
                        `password` varchar(60) NOT NULL,
                        `role` varchar(20) NOT NULL,
                        `date_created` datetime DEFAULT current_timestamp(),
                        `token` varchar(100) DEFAULT NULL,
                        `is_verified` tinyint(1) DEFAULT 0,
                        `driver_license` varchar(20) DEFAULT NULL,
                        `sacco_role` varchar(20) DEFAULT NULL,
                        `sacco_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `date_created`, `token`, `is_verified`, `driver_license`, `sacco_role`, `sacco_id`) VALUES
                                                                                                                                                                          (1, 'Levi', 'Mukuha', 'Mukuhalevi@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2024-02-29 18:49:37', NULL, 0, NULL, NULL, NULL),
                                                                                                                                                                          (5, 'Michael', 'Mwangi', '1049411@cuea.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'sacco admin', '2024-02-29 19:26:55', NULL, 0, NULL, NULL, 13),
                                                                                                                                                                          (6, 'pis', 'Mwendwa', 'Loreumipsum@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'sacco admin', '2024-02-29 20:12:32', NULL, 0, NULL, NULL, 14),
                                                                                                                                                                          (10, 'james', 'Gatubi', 'levimukuh@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'driver', '2024-02-29 21:20:53', NULL, 0, '1234', NULL, NULL),
                                                                                                                                                                          (11, 'alex', 'Nyamberi', 'alex@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'driver', '2024-02-29 21:21:37', NULL, 0, '1234', NULL, NULL),
                                                                                                                                                                          (12, 'Jamrick', 'malev', 'levi@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2024-03-01 00:17:31', NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
                           `id` int(11) NOT NULL,
                           `make` varchar(50) NOT NULL,
                           `model` varchar(50) NOT NULL,
                           `registration_plate` varchar(20) NOT NULL,
                           `capacity` int(11) NOT NULL,
                           `sacco_id` int(11) NOT NULL,
                           `driver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `make`, `model`, `registration_plate`, `capacity`, `sacco_id`, `driver_id`) VALUES
                                                                                                             (5, 'Toyota', 'HIace', 'KDN 234A', 4, 14, 10),
                                                                                                             (6, 'Isuzu', 'NQR', 'KBH 293Q', 5, 13, 11),
                                                                                                             (7, 'Hino', 'H65', 'KAA', 20, 13, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sacco`
--
ALTER TABLE `sacco`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_number` (`ticket_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ticket_ibfk_2` (`travel_schedule_id`);

--
-- Indexes for table `travelschedule`
--
ALTER TABLE `travelschedule`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vehicle` (`vehicle_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `sacco_id` (`sacco_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_plate` (`registration_plate`),
  ADD KEY `sacco_id` (`sacco_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sacco`
--
ALTER TABLE `sacco`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `travelschedule`
--
ALTER TABLE `travelschedule`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
    ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`travel_schedule_id`) REFERENCES `travelschedule` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travelschedule`
--
ALTER TABLE `travelschedule`
    ADD CONSTRAINT `fk_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travelschedule_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
    ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`sacco_id`) REFERENCES `sacco` (`id`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
    ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`sacco_id`) REFERENCES `sacco` (`id`),
  ADD CONSTRAINT `vehicle_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
