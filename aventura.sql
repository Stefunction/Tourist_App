-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 05:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aventura`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `accessID` int(11) NOT NULL,
  `userName` varchar(25) NOT NULL,
  `login_Time` datetime NOT NULL,
  `logout_Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`accessID`, `userName`, `login_Time`, `logout_Time`) VALUES
(1, 'admin_steph', '2022-04-05 13:57:55', '2022-04-05 16:51:54'),
(2, 'jackie', '2022-04-05 14:48:32', '2022-04-05 16:55:20'),
(3, 'VickyNova', '2022-04-05 14:52:01', '2022-04-05 15:03:07'),
(4, 'Cynty', '2022-04-05 15:03:24', '2022-04-05 15:12:43'),
(5, 'Stewart', '2022-04-05 15:13:34', '2022-04-05 15:23:13'),
(6, 'Jackie', '2022-04-05 15:51:11', '2022-04-05 16:55:20'),
(7, 'jackie', '2022-04-05 15:51:22', '2022-04-05 16:55:20'),
(8, 'jackie', '2022-04-05 16:01:33', '2022-04-05 16:55:20'),
(9, 'jackie', '2022-04-05 16:16:17', '2022-04-05 16:55:20'),
(10, 'admin_Steph', '2022-04-05 16:19:07', '2022-04-05 16:51:54'),
(11, 'jackie', '2022-04-05 16:52:05', '2022-04-05 16:55:20'),
(12, 'jackie', '2022-04-05 16:54:47', '2022-04-05 16:55:20'),
(13, 'jackie', '2022-04-05 16:55:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` varchar(10) NOT NULL,
  `categoryName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
('C1', 'Food'),
('C2', 'Culture'),
('C3', 'Adventure'),
('C4', 'History'),
('C5', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `genderID` char(1) NOT NULL,
  `genderName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`genderID`, `genderName`) VALUES
('F', 'Female'),
('M', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(11) NOT NULL,
  `role_Name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `role_Name`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `uploadID` int(11) NOT NULL,
  `userName` varchar(25) NOT NULL,
  `uploadPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `description` text NOT NULL,
  `categoryID` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `url` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`uploadID`, `userName`, `uploadPath`, `description`, `categoryID`, `date`, `url`) VALUES
(1, 'Jackie', 'Assets/uploads/85fec45180fcee9a5642262049d983df.jpeg', 'Zanzibar, Pellentesque non massa enim. Aliquam consequat nibh vitae velit aliquet, eget volutpat orci finibus. Aenean eu elit vel nibh pulvinar auctor. Phasellus dapibus sem a luctus venenatis. Mauris vehicula sem lacus.', 'C5', '2021-02-14', ''),
(2, 'Jackie', 'Assets/uploads/761a82420423d2e5d682ad7949d51d06.jpg', 'Seafood: Pellentesque non massa enim. Aliquam consequat nibh vitae velit aliquet, eget volutpat orci finibus. Aenean eu elit vel nibh pulvinar auctor. Phasellus dapibus sem a luctus venenatis. Mauris vehicula sem lacus', 'C1', '2021-09-29', ''),
(3, 'vickyNova', 'Assets/uploads/802f3fdb882355a1e25014ef977fbece.jpg', 'Culture, Pellentesque non massa enim. Aliquam consequat nibh vitae velit aliquet, eget volutpat orci finibus. Aenean eu elit vel nibh pulvinar auctor. Phasellus dapibus sem a luctus venenatis. Mauris vehicula sem lacus', 'C2', '2022-01-10', ''),
(6, 'vickyNova', 'Assets/uploads/c4af0eefa90806a68050dcf81ba3bfc5.jpg', 'Pellentesque non massa enim. Aliquam consequat nibh vitae velit aliquet, eget volutpat orci finibus. Aenean eu elit vel nibh pulvinar auctor.', 'C3', '2022-03-15', 'https://www.highlandsafaris.net/our-safaris/mountain-safaris/'),
(7, 'Cynty', 'Assets/uploads/b968742b7371db0ac64a8ff648b2d28c.jpeg', 'Pellentesque non massa enim. Aliquam consequat nibh vitae velit aliquet, eget volutpat orci finibus. Aenean eu elit vel', 'C4', '2021-12-27', ''),
(9, 'Cynty', 'Assets/uploads/da6c1ab419c63a4a74b03351d8c44b73.jpeg', 'Pellentesque non massa enim. Aliquam consequat nibh vitae velit aliquet, eget volutpat orci finibus. Aenean eu elit vel nibh pulvinar auctor. Phasellus dapibus sem a luctus venenatis. Mauris vehicula sem lacus, Pellentesque non massa enim.', 'C3', '2021-07-20', 'https://www.tripadvisor.com/'),
(11, 'Stewart', 'Assets/uploads/d173753e9974377fc72caa3af3225a5e.jpeg', 'Pellentesque non massa enim. Aliquam consequat nibh vitae velit aliquet, eget volutpat orci finibus. Aenean eu elit vel nibh pulvinar auctor.', 'C5', '2022-04-04', ''),
(12, 'Stewart', 'Assets/uploads/30af29d7041304733600c32bee562442.jpeg', 'Pellentesque non massa enim. Aliquam consequat nibh vitae velit aliquet, eget volutpat orci finibus. Aenean eu elit vel nibh pulvinar auctor.', 'C2', '2020-06-17', ''),
(14, 'Stewart', 'Assets/uploads/9323405f10ac4ceb9d0340223e4eaaad.jpeg', 'Pellentesque non massa enim. Aliquam consequat nibh vitae velit aliquet, eget volutpat orci finibus. Aenean eu elit vel nibh pulvinar auctor.', 'C4', '1966-08-05', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `genderID` char(1) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `roleID` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstname`, `lastname`, `username`, `genderID`, `email`, `password`, `roleID`) VALUES
(1, 'Stephanie', 'Udejiofor', 'Admin_Steph', 'F', 's.udejiofor@rgu.ac.uk', '$2y$12$P3QCsw9WAUQpliDQ9FlRou53J6HVjzjVcQ9Rg.V/SCr0tEWBJTEuK', 2),
(3, 'Cynthia', 'James', 'Cynty', 'F', 'cynty.james@yahoo.com', '$2y$12$xEA7atcuvtJR0li9uvsjX.JRdurt6bzDIqKAJJa20NGGV/fey3T.y', 1),
(2, 'Jack', 'Arthur', 'Jackie', 'M', 'jackie.arthur@hotmail.com', '$2y$12$hjJqe6coObmPEpbKJUM68eYm4J5E5SE8JKUUlPE4FzGPJ5BgFG66a', 1),
(4, 'Stewart', 'Massie', 'Stewart', 'M', 's.massie@rgu.ac.uk', '$2y$12$3y44VLBv83wPFAQnz92/6eYjsA.vqSfYL2Y/9ZksUFp1WO9qUU2/6', 1),
(5, 'Victoria', 'Nova', 'vickyNova', 'F', 'vickynova@yahoo.com', '$2y$12$3WJOtZFwiuxsLYxXjPGWW.OddlmZWxUW5p/4N9VOeqDKhBSnsI8zu', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`accessID`),
  ADD KEY `name` (`userName`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`genderID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`uploadID`),
  ADD KEY `category` (`categoryID`),
  ADD KEY `user_remove` (`userName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `gender` (`genderID`),
  ADD KEY `role_priviledge` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `accessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `uploadID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `name` FOREIGN KEY (`userName`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `category` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_remove` FOREIGN KEY (`userName`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `gender` FOREIGN KEY (`genderID`) REFERENCES `gender` (`genderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_priviledge` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
