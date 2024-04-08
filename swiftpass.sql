-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 09:09 AM
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
-- Database: `demo`
--
CREATE DATABASE IF NOT EXISTS `demo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `demo`;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `salary` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `salary`) VALUES
(2, 'Levi', 'rtyuio', 4567.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Database: `fitness`
--
CREATE DATABASE IF NOT EXISTS `fitness` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fitness`;

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `difficulty` enum('Easy','Medium','Hard') NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `description`, `difficulty`, `image_url`) VALUES
(7, 'Swimming: ', 'Provides a full-body workout, improving cardiovascular health, muscle strength, and endurance while being low-impact on the joints.', 'Easy', 'uploads/swimming.jpeg'),
(8, 'Running:', ' A classic cardiovascular exercise that strengthens the heart and lungs, burns calories, and improves overall endurance.', 'Medium', 'uploads/running.jpeg'),
(9, 'Cycling: ', 'Whether outdoors or on a stationary bike, cycling builds leg strength, improves cardiovascular fitness, and can be a great way to explore your surroundings.', 'Medium', 'uploads/cycling.jpeg'),
(10, 'Walking:', ' A simple yet effective way to improve cardiovascular health, maintain weight, and boost mood, especially for beginners or those with joint issues.', 'Easy', 'uploads/walking.jpeg'),
(11, 'Yoga:', ' Combines physical postures, breathing exercises, and meditation to improve flexibility, balance, strength, and mental well-being.', 'Hard', 'uploads/yoga.jpeg'),
(12, 'Jump Rope: ', 'Offers a high-intensity cardiovascular workout that improves coordination, agility, and bone density while burning calories.', 'Medium', 'uploads/jumprope.jpeg'),
(13, 'Rowing:', ' Utilizes a rowing machine or watercraft to engage multiple muscle groups, improve cardiovascular endurance, and enhance posture.', 'Medium', 'uploads/rowing.jpeg'),
(14, 'Hiking: ', 'Provides a challenging cardiovascular workout while enjoying nature, improving lower body strength, and reducing stress levels.', 'Easy', 'uploads/hiking.jpeg'),
(15, 'Martial Arts:', ' Includes various disciplines like karate, taekwondo, judo, or kickboxing. Martial arts training improves strength, flexibility, agility, and mental focus while teaching self-defense techniques and discipline.', 'Hard', 'uploads/martialart.jpeg'),
(16, 'Strength Training with Weights:', ' Involves lifting weights to build muscle strength, improve bone density, and enhance overall body composition.', 'Medium', 'uploads/weight-lift.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"swiftpass\",\"table\":\"users\"},{\"db\":\"school\",\"table\":\"admission\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-02-24 09:59:20', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `school`
--
CREATE DATABASE IF NOT EXISTS `school` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `school`;

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `std_name` text NOT NULL,
  `std_id` text NOT NULL,
  `gender` text NOT NULL,
  `dob` date NOT NULL,
  `course` text NOT NULL,
  `email` text NOT NULL,
  `phone_number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Database: `soma nasi`
--
CREATE DATABASE IF NOT EXISTS `soma nasi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `soma nasi`;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publishedDate` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `isbn_10` varchar(20) DEFAULT NULL,
  `isbn_13` varchar(20) DEFAULT NULL,
  `pageCount` int(11) DEFAULT NULL,
  `reading_status` varchar(20) DEFAULT '''Not Started''',
  `averageRating` float DEFAULT NULL,
  `ratingsCount` int(11) DEFAULT NULL,
  `smallThumbnail` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `smallImage` varchar(255) DEFAULT NULL,
  `mediumImage` varchar(255) DEFAULT NULL,
  `largeImage` varchar(255) DEFAULT NULL,
  `extraLargeImage` varchar(255) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `infoLink` varchar(255) DEFAULT NULL,
  `canonicalVolumeLink` varchar(255) DEFAULT NULL,
  `isEbook` tinyint(1) DEFAULT NULL,
  `retailPrice` decimal(10,2) DEFAULT NULL,
  `pdfDownloadLink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `publisher`, `publishedDate`, `description`, `isbn_10`, `isbn_13`, `pageCount`, `reading_status`, `averageRating`, `ratingsCount`, `smallThumbnail`, `thumbnail`, `smallImage`, `mediumImage`, `largeImage`, `extraLargeImage`, `language`, `infoLink`, `canonicalVolumeLink`, `isEbook`, `retailPrice`, `pdfDownloadLink`) VALUES
('-72QAgAAQBAJ', 'Time and Media Markets', 'Alan B. Albarran, Angel Arrese Reca', '', '2003-01-30', '', '', '', 192, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=-72QAgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=-72QAgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=-72QAgAAQBAJ&dq=time&hl=&as_pt=ALLTYPES&source=gbs_api', 'https://books.google.com/books/about/Time_and_Media_Markets.html?hl=&id=-72QAgAAQBAJ', 0, 0.00, ''),
('2bCdaZ7KvDsC', 'The Language of Flowers', 'Henrietta Dumont', '', '1995', '', '', '', 330, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=2bCdaZ7KvDsC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=2bCdaZ7KvDsC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'https://play.google.com/store/books/details?id=2bCdaZ7KvDsC&source=gbs_api', 'https://play.google.com/store/books/details?id=2bCdaZ7KvDsC', 0, 0.00, ''),
('2hl5bva-vSQC', 'The Language of Flowers', 'Frederic Shoberl', '', '1995', '', '', '', 414, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=2hl5bva-vSQC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=2hl5bva-vSQC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'https://play.google.com/store/books/details?id=2hl5bva-vSQC&source=gbs_api', 'https://play.google.com/store/books/details?id=2hl5bva-vSQC', 0, 0.00, ''),
('2L9rY4w2n-AC', 'Flowers and Flower Lore', 'Hilderic Friend', '', '1855', '', '', '', 382, 'Not Started', 5, 1, 'http://books.google.com/books/content?id=2L9rY4w2n-AC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=2L9rY4w2n-AC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'https://play.google.com/store/books/details?id=2L9rY4w2n-AC&source=gbs_api', 'https://play.google.com/store/books/details?id=2L9rY4w2n-AC', 0, 0.00, ''),
('7G5GAgAAQBAJ', 'Last Days and Times', 'Stephan Loy', '', NULL, '', '', '', 343, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=7G5GAgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=7G5GAgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=7G5GAgAAQBAJ&dq=time&hl=&as_pt=ALLTYPES&source=gbs_api', 'https://books.google.com/books/about/Last_Days_and_Times.html?hl=&id=7G5GAgAAQBAJ', 0, 0.00, ''),
('7nysAwAAQBAJ', 'Time Management for the Entrepreneur', 'Richard Lopez', '', NULL, '', '', '', 42, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=7nysAwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=7nysAwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=7nysAwAAQBAJ&dq=time&hl=&as_pt=ALLTYPES&source=gbs_api', 'https://books.google.com/books/about/Time_Management_for_the_Entrepreneur.html?hl=&id=7nysAwAAQBAJ', 0, 0.00, ''),
('92gZCgAAQBAJ', 'Israel and the Covenants in New Testament Times', 'Peter Williams', '', NULL, '', '', '', 351, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=92gZCgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=92gZCgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=92gZCgAAQBAJ&dq=time&hl=&as_pt=ALLTYPES&source=gbs_api', 'https://books.google.com/books/about/Israel_and_the_Covenants_in_New_Testamen.html?hl=&id=92gZCgAAQBAJ', 0, 0.00, ''),
('a-aY0AEACAAJ', 'Growing Flowers for Beginners', 'Maria Francis', '', '2004', '', '', '', 0, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=a-aY0AEACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 'http://books.google.com/books/content?id=a-aY0AEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=a-aY0AEACAAJ&dq=flowers&hl=&source=gbs_api', 'https://books.google.com/books/about/Growing_Flowers_for_Beginners.html?hl=&id=a-aY0AEACAAJ', 0, 0.00, ''),
('AG75EAAAQBAJ', 'How to Grow Flowers in Small Spaces', 'Stephanie Walker', '', '2018', '', '', '', 144, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=AG75EAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=AG75EAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=AG75EAAAQBAJ&dq=flowers&hl=&source=gbs_api', 'https://books.google.com/books/about/How_to_Grow_Flowers_in_Small_Spaces.html?hl=&id=AG75EAAAQBAJ', 0, 0.00, ''),
('AVzaAAAAQBAJ', 'Time and the Literary', 'Karen Newman, Jay Clayton, Marianne Hirsch', '', '2013-09-13', '', '', '', 288, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=AVzaAAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=AVzaAAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=AVzaAAAAQBAJ&dq=time&hl=&as_pt=ALLTYPES&source=gbs_api', 'https://books.google.com/books/about/Time_and_the_Literary.html?hl=&id=AVzaAAAAQBAJ', 0, 0.00, ''),
('BgDYEAAAQBAJ', 'A Garden of Flowers', 'Michael Rosenblum', '', '1999', '', '', '', 36, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=BgDYEAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=BgDYEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=BgDYEAAAQBAJ&dq=flowers&hl=&source=gbs_api', 'https://books.google.com/books/about/A_Garden_of_Flowers.html?hl=&id=BgDYEAAAQBAJ', 0, 0.00, ''),
('ezbPAAAAMAAJ', 'The Language of Flowers', 'Henrietta Dumont', '', '1995', '', '', '', 334, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=ezbPAAAAMAAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=ezbPAAAAMAAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'https://play.google.com/store/books/details?id=ezbPAAAAMAAJ&source=gbs_api', 'https://play.google.com/store/books/details?id=ezbPAAAAMAAJ', 0, 0.00, ''),
('F1bGEAAAQBAJ', 'A Short History of Flowers', 'Advolly Richmond', '', '2016', '', '', '', 210, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=F1bGEAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=F1bGEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=F1bGEAAAQBAJ&dq=flowers&hl=&source=gbs_api', 'https://books.google.com/books/about/A_Short_History_of_Flowers.html?hl=&id=F1bGEAAAQBAJ', 0, 0.00, ''),
('gisSBgAAQBAJ', 'A Brief Moment in Time', 'T. W. Spencer', '', '2014-07-27', '', '', '', 155, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=gisSBgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=gisSBgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=gisSBgAAQBAJ&dq=time&hl=&as_pt=ALLTYPES&source=gbs_api', 'https://books.google.com/books/about/A_Brief_Moment_in_Time.html?hl=&id=gisSBgAAQBAJ', 0, 0.00, ''),
('GVbGEAAAQBAJ', 'A Short History of Flowers', 'Advolly Richmond', '', '2016', '', '', '', 210, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=GVbGEAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=GVbGEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=GVbGEAAAQBAJ&dq=flowers&hl=&source=gbs_api', 'https://books.google.com/books/about/A_Short_History_of_Flowers.html?hl=&id=GVbGEAAAQBAJ', 0, 0.00, ''),
('hmFHAAAAYAAJ', 'The Language of Flowers', 'Henrietta Dumont', '', '1834', '', '', '', 340, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=hmFHAAAAYAAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=hmFHAAAAYAAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'https://play.google.com/store/books/details?id=hmFHAAAAYAAJ&source=gbs_api', 'https://play.google.com/store/books/details?id=hmFHAAAAYAAJ', 0, 0.00, ''),
('I8OBEAAAQBAJ', 'Flower Magic of the Druids', 'Jon G. Hughes', '', '2016', '', '', '', 207, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=I8OBEAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=I8OBEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=I8OBEAAAQBAJ&dq=flowers&hl=&source=gbs_api', 'https://books.google.com/books/about/Flower_Magic_of_the_Druids.html?hl=&id=I8OBEAAAQBAJ', 0, 0.00, ''),
('kc57BwAAQBAJ', 'Time Travel in Popular Media', 'Matthew Jones, Joan Ormrod', '', '2015-03-13', '', '', '', 337, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=kc57BwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=kc57BwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=kc57BwAAQBAJ&dq=time&hl=&as_pt=ALLTYPES&source=gbs_api', 'https://books.google.com/books/about/Time_Travel_in_Popular_Media.html?hl=&id=kc57BwAAQBAJ', 0, 0.00, ''),
('ktkDAAAAQAAJ', 'Flowers and their associations', 'Anne Pratt', '', '1995', '', '', '', 448, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=ktkDAAAAQAAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=ktkDAAAAQAAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'https://play.google.com/store/books/details?id=ktkDAAAAQAAJ&source=gbs_api', 'https://play.google.com/store/books/details?id=ktkDAAAAQAAJ', 0, 0.00, ''),
('Nyo3AAAAMAAJ', 'Thoughts Among Flowers', '', '', '1995', '', '', '', 164, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=Nyo3AAAAMAAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=Nyo3AAAAMAAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'https://play.google.com/store/books/details?id=Nyo3AAAAMAAJ&source=gbs_api', 'https://play.google.com/store/books/details?id=Nyo3AAAAMAAJ', 0, 0.00, ''),
('tjqsEAAAQBAJ', 'The Encyclopedia of Cut Flowers', 'Calvert Crary', '', '2003', '', '', '', 366, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=tjqsEAAAQBAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 'http://books.google.com/books/content?id=tjqsEAAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=tjqsEAAAQBAJ&dq=flowers&hl=&source=gbs_api', 'https://books.google.com/books/about/The_Encyclopedia_of_Cut_Flowers.html?hl=&id=tjqsEAAAQBAJ', 0, 0.00, ''),
('u1FAAQAAMAAJ', 'Language and Poetry of Flowers', 'Henry Gardiner Adams', '', '1835', '', '', '', 298, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=u1FAAQAAMAAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=u1FAAQAAMAAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'https://play.google.com/store/books/details?id=u1FAAQAAMAAJ&source=gbs_api', 'https://play.google.com/store/books/details?id=u1FAAQAAMAAJ', 0, 0.00, ''),
('uJvEEAAAQBAJ', 'How to Grow Flowers in Small Spaces', 'Stephanie Walker', '', '2002', '', '', '', 190, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=uJvEEAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=uJvEEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=uJvEEAAAQBAJ&dq=flowers&hl=&source=gbs_api', 'https://books.google.com/books/about/How_to_Grow_Flowers_in_Small_Spaces.html?hl=&id=uJvEEAAAQBAJ', 0, 0.00, ''),
('uS-Q0AEACAAJ', 'Book of Stunning Crochet Flower Patterns', 'Rodolfo R Mendez', '', '1992', '', '', '', 0, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=uS-Q0AEACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 'http://books.google.com/books/content?id=uS-Q0AEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=uS-Q0AEACAAJ&dq=flowers&hl=&source=gbs_api', 'https://books.google.com/books/about/Book_of_Stunning_Crochet_Flower_Patterns.html?hl=&id=uS-Q0AEACAAJ', 0, 0.00, ''),
('UxgN0AEACAAJ', 'Origami Paper 100 Sheets Japanese Flowers 6 Inches (15 Cm)', 'Tuttle Studio', '', '2002', '', '', '', 0, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=UxgN0AEACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 'http://books.google.com/books/content?id=UxgN0AEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=UxgN0AEACAAJ&dq=flowers&hl=&source=gbs_api', 'https://books.google.com/books/about/Origami_Paper_100_Sheets_Japanese_Flower.html?hl=&id=UxgN0AEACAAJ', 0, 0.00, ''),
('v7beBgAAQBAJ', 'Fall Down Nine Times, Get Up Ten', 'Martin Avery', '', '2014-07-06', '', '', '', 528, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=v7beBgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=v7beBgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=v7beBgAAQBAJ&dq=time&hl=&as_pt=ALLTYPES&source=gbs_api', 'https://books.google.com/books/about/Fall_Down_Nine_Times_Get_Up_Ten.html?hl=&id=v7beBgAAQBAJ', 0, 0.00, ''),
('VAgAAAAAMBAJ', 'Vegetarian Times', '', '', '1970', '', '', '', 72, 'Not Started', 4, 1, 'http://books.google.com/books/content?id=VAgAAAAAMBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=VAgAAAAAMBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=VAgAAAAAMBAJ&dq=time&hl=&as_pt=ALLTYPES&source=gbs_api', 'https://books.google.com/books/about/Vegetarian_Times.html?hl=&id=VAgAAAAAMBAJ', 0, 0.00, ''),
('WsFoYjpZZQwC', 'Beating the Time Bandits How to Transform Time Into Success, Wealth & Happiness', 'Robert Hartung', '', '1995', '', '', '', 126, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=WsFoYjpZZQwC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=WsFoYjpZZQwC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'http://books.google.com/books?id=WsFoYjpZZQwC&dq=time&hl=&as_pt=ALLTYPES&source=gbs_api', 'https://books.google.com/books/about/Beating_the_Time_Bandits_How_to_Transfor.html?hl=&id=WsFoYjpZZQwC', 0, 0.00, ''),
('z9M1AAAAMAAJ', 'Flowers and Flower-gardens', 'David Lester Richardson', '', '1995', '', '', '', 296, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=z9M1AAAAMAAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=z9M1AAAAMAAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'https://play.google.com/store/books/details?id=z9M1AAAAMAAJ&source=gbs_api', 'https://play.google.com/store/books/details?id=z9M1AAAAMAAJ', 0, 0.00, ''),
('_kEuAAAAYAAJ', 'Our Garden Flowers', 'Harriet Louise Keeler', '', '1995', '', '', '', 596, 'Not Started', 0, 0, 'http://books.google.com/books/content?id=_kEuAAAAYAAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'http://books.google.com/books/content?id=_kEuAAAAYAAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', NULL, NULL, NULL, NULL, 'en', 'https://play.google.com/store/books/details?id=_kEuAAAAYAAJ&source=gbs_api', 'https://play.google.com/store/books/details?id=_kEuAAAAYAAJ', 0, 0.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `book_id`, `quantity`, `created_at`) VALUES
(5, 1, 2, 1, '2024-03-28 17:41:22'),
(6, 1, 0, 1, '2024-03-28 17:43:05'),
(7, 1, 0, 1, '2024-03-28 17:46:31'),
(8, 1, 0, 1, '2024-03-28 17:46:35'),
(9, 1, 0, 1, '2024-03-28 17:46:39'),
(10, 1, 0, 1, '2024-03-28 17:47:13'),
(11, 1, -72, 1, '2024-03-28 17:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hashedpassword` varchar(255) DEFAULT NULL,
  `bookid` varchar(255) DEFAULT NULL,
  `booktitle` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `reading_status` enum('Not Started','Currently Reading','Finished') DEFAULT NULL,
  `recommendedbooks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`recommendedbooks`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `hashedpassword`, `bookid`, `booktitle`, `thumbnail`, `reading_status`, `recommendedbooks`) VALUES
(1, 'jorja ', 'smith', 'jorja@gmail.com', '$2y$10$UKEhoffF91ZrbiCUwtLIPuohecnKz8/JtETCCFJELIxYnCKyCnkXG', NULL, NULL, NULL, NULL, NULL),
(2, 'ERIC', 'NZOMO', 'ericnzomo17@gmail.com', '$2y$10$4AuhbeaKfdR9TiXrrBxkVuiOE0VaMB0CCtrXBdLgk5PWSfNWc1FAC', NULL, NULL, NULL, NULL, NULL),
(3, 'Levi', 'Mukuha', 'Mukuhalevi@gmail.com', '$2y$10$vQCqcYeJKg.8xpGMbmQfJuoYSG1ewpEfO7a/sGAa9O7lEuqWw9sYa', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookid` (`bookid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `books` (`id`);
--
-- Database: `swiftpass`
--
CREATE DATABASE IF NOT EXISTS `swiftpass` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `swiftpass`;

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
(13, 'Super Metro tran'),
(14, 'Githurai 44'),
(15, 'Super Metro'),
(16, 'Super Metro'),
(18, 'Lopha travels');

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
(100, '9EB8E3178F', 20, 12, '2024-03-18 13:55:00', '6', 700),
(101, '6E7B90C2C2', 20, 12, '2024-03-18 14:30:07', '41', 700),
(102, 'F56622CC96', 20, 12, '2024-03-18 14:30:07', '36', 700),
(103, '52E078CDCA', 20, 12, '2024-03-18 14:30:07', '12', 700),
(104, '04986A5F16', 20, 12, '2024-03-18 14:32:35', '16', 700),
(105, '7EFCD1E592', 20, 12, '2024-03-18 14:46:43', '13', 700),
(106, '31A9D13DAB', 20, 13, '2024-03-25 22:01:43', '9', 5678),
(107, '3044AC0D24', 20, 13, '2024-03-26 12:18:35', '13', 5678),
(108, 'AAECDE3FC7', 20, 13, '2024-04-04 14:02:39', '16', 5678),
(109, '042BFC569C', 20, 13, '2024-04-04 14:04:33', '2', 5678),
(110, '13D06AFA9E', 20, 13, '2024-04-04 14:05:35', '10', 5678),
(111, 'C5D7E396B7', 20, 13, '2024-04-04 15:57:52', '11', 5678),
(112, 'F72C91AE6A', 20, 13, '2024-04-07 20:48:04', '7', 5678),
(113, '4D184B42F5', 20, 13, '2024-04-07 21:55:14', '4', 5678),
(114, '832AA62FD4', 20, 13, '2024-04-07 22:26:18', '6', 5678),
(115, '4713EB623F', 20, 13, '2024-04-07 22:32:54', '5', 5678),
(116, 'F5A984A704', 20, 13, '2024-04-07 23:19:37', '12', 5678),
(117, 'BFC1DA25DB', 21, 13, '2024-04-07 23:25:49', '41', 5678),
(118, 'CF48C55EA0', 21, 13, '2024-04-08 09:34:57', '8', 5678);

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
(12, 'Nairobi', 'Kisumu', '2024-03-30 19:52:00', 700, 9, 1),
(13, 'Kitui', 'Kitui', '2024-03-30 14:49:00', 5678, 9, 0);

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
(16, 'Levi', 'mwendwa', '1049412@cuea.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'driver', '2024-03-18 13:16:52', NULL, 0, NULL, NULL, NULL),
(17, 'john', 'mwendwa', 'Mukuhalevi@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2024-03-18 13:35:42', NULL, 0, NULL, NULL, NULL),
(19, 'Abraham', 'Mwangi', 'pis@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'sacco admin', '2024-03-18 13:49:42', NULL, 0, NULL, NULL, 18),
(20, 'Samuel', 'maina', 'alex@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2024-03-18 13:53:42', NULL, 0, NULL, NULL, NULL),
(21, 'Alex', 'awino', 'stevehuko@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2024-04-07 23:25:05', NULL, 0, NULL, NULL, NULL);

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
(9, 'Isuzu', 'NQR', 'KCK 262N', 51, 18, 16),
(10, 'Hino', 'HT5', 'KCD 989J', 7, 18, 16);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `travelschedule`
--
ALTER TABLE `travelschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`sacco_id`) REFERENCES `sacco` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`sacco_id`) REFERENCES `sacco` (`id`),
  ADD CONSTRAINT `vehicle_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `user` (`id`);
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(0, 'levi', '81dc9bdb52d04dc20036dbd8313ed055'),
(0, 'toto', '81dc9bdb52d04dc20036dbd8313ed055');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
