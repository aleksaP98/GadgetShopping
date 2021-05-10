-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2021 at 04:44 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gadgetshopadvanced`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(5, 'Audio'),
(6, 'Computer Accessories'),
(7, 'Lights and Laseres'),
(8, 'Phone and Tablet Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(255) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(34) COLLATE utf8_unicode_ci NOT NULL,
  `class_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `path`, `class_name`) VALUES
(1, 'HOME', 'index.php', 'home'),
(2, 'PRODUCTS', 'index.php?page=products', 'products'),
(3, 'ABOUT', 'index.php?page=about', 'about'),
(4, 'ADMIN ACCOUNT', 'index.php?page=admin', 'admin'),
(5, 'USER ACCOUNT', 'index.php?page=user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(100) NOT NULL,
  `original` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `old_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `original`, `profile`, `old_name`) VALUES
(1, 'assets/images/product_images/1.gif', NULL, 'jspp_8bitdo_dpad_usb_hub.gif'),
(2, 'assets/images/product_images/2.jpg', NULL, 'jsms_ifixit_essential_electronics_toolkit.jpg'),
(3, 'assets/images/product_images/3.jpg', NULL, 'iphv_tos_st_bt_communicator.jpg'),
(4, 'assets/images/product_images/4.jpg', NULL, 'ipqk_sacred_temple_over_ear_headphones.jpg'),
(5, 'assets/images/product_images/5.jpg', NULL, 'ktuv_pac-man_light.jpg'),
(6, 'assets/images/product_images/6.gif', NULL, 'ksil_marvel_infinity_lamp.gif'),
(7, 'assets/images/product_images/7.gif', NULL, 'jqtg_supernova_sphere.gif'),
(8, 'assets/images/product_images/8.jpg', NULL, 'jklk_sw_bb8_usb_wall_charger.jpg'),
(9, 'assets/images/product_images/9.jpg', NULL, 'itst_warcraft_doomhammer_power_bank_v2.jpg'),
(10, 'assets/images/product_images/10.jpg', NULL, 'jtgu_borderlands_claptrap_talking_usb_hub.jpg'),
(25, 'assets/images/product_images/25.png', NULL, 'bg-content.png'),
(26, 'assets/images/user_images/26.png', 'assets/images/user_images/26_profile.png', 'defaultProfile.png'),
(29, 'assets/images/user_images/29.jpg', 'assets/images/user_images/29_profile.jpg', 'itst_warcraft_doomhammer_power_bank_v2.jpg'),
(30, 'assets/images/user_images/30.jpg', 'assets/images/user_images/30_profile.jpg', 'ktuv_pac-man_light.jpg'),
(31, 'assets/images/user_images/31.jpg', 'assets/images/user_images/31_profile.jpg', 'jklk_sw_bb8_usb_wall_charger.jpg'),
(32, 'assets/images/user_images/32.jpg', 'assets/images/user_images/32_profile.jpg', 'download.jpg'),
(33, 'assets/images/user_images/33.jpg', 'assets/images/user_images/33_profile.jpg', '05before-and-after-slide-T6H2-superJumbo.jpg'),
(34, 'assets/images/user_images/34.jpg', 'assets/images/user_images/34_profile.jpg', '05before-and-after-slide-T6H2-superJumbo.jpg'),
(35, 'assets/images/user_images/35.png', 'assets/images/user_images/35_profile.png', 'pinterest-book-covers-weiland.png'),
(36, 'assets/images/product_images/36.jpg', NULL, '05before-and-after-slide-T6H2-superJumbo.jpg'),
(37, 'assets/images/product_images/37.jpg', NULL, 'download.jpg'),
(38, 'assets/images/product_images/38.jpg', NULL, '05before-and-after-slide-T6H2-superJumbo.jpg'),
(48, 'assets/images/user_images/48.jpg', NULL, 'download.jpg'),
(49, 'assets/images/user_images/49.jpg', NULL, 'download.jpg'),
(50, 'assets/images/user_images/50.png', NULL, 'pinterest-book-covers-weiland.png'),
(51, 'assets/images/product_images/51.png', NULL, 'pinterest-book-covers-weiland.png'),
(52, 'assets/images/product_images/52.png', NULL, 'pinterest-book-covers-weiland.png'),
(54, 'assets/images/product_images/54.jpg', NULL, 'download.jpg'),
(55, 'assets/images/product_images/55.png', NULL, 'defaultProfile.png'),
(56, NULL, NULL, 'livemusic.png'),
(57, '/assets/images/product_images/57.png', NULL, 'livemusic.png'),
(58, NULL, NULL, 'jsms_ifixit_essential_electronics_toolkit.jpg'),
(59, '/assets/images/user_images/59.jpg', '/assets/images/user_images/59_profile.jpg', 'itst_warcraft_doomhammer_power_bank_v2.jpg'),
(60, '/assets/images/user_images/60.jpg', '/assets/images/user_images/60_profile.jpg', 'itst_warcraft_doomhammer_power_bank_v2.jpg'),
(61, '/assets/images/user_images/61.jpg', '/assets/images/user_images/61_profile.jpg', 'itst_warcraft_doomhammer_power_bank_v2.jpg'),
(62, '/assets/images/user_images/62.jpg', '/assets/images/user_images/62_profile.jpg', 'itst_warcraft_doomhammer_power_bank_v2.jpg'),
(63, '/assets/images/user_images/63.jpg', '/assets/images/user_images/63_profile.jpg', 'itst_warcraft_doomhammer_power_bank_v2.jpg'),
(64, '/assets/images/user_images/64.jpg', '/assets/images/user_images/64_profile.jpg', 'ipqk_sacred_temple_over_ear_headphones.jpg'),
(65, '/assets/images/user_images/65.jpg', '/assets/images/user_images/65_profile.jpg', 'ipqk_sacred_temple_over_ear_headphones.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `Category_ID` int(255) NOT NULL,
  `picture_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `Category_ID`, `picture_id`) VALUES
(1, '8Bitdo DPad USB Hub', 'POWER UP THE FUNDAMENTALS', '9.99', 6, 1),
(2, 'iFixit Essential Electronics Toolkit', 'OPEN UP AND SAY AAAA!', '19.99', 6, 2),
(3, 'Star Trek TOS Bluetooth Communicator', 'ONE TO BEAM UP', '154.99', 5, 3),
(4, 'Sacred Temple Over-the-Ear Passive Headphones', 'JOURNEY TO THE SACRED TEMPLE\r\n', '99.99', 5, 4),
(5, 'Pac-Man Lamp with Sound', 'PAC-MAN LIGHT\r\n', '25.99', 7, 5),
(6, 'Marvel Thanos Gauntlet Mood Lamp', 'OH SNAP\r\n', '49.99', 7, 6),
(7, 'Supernova Sphere', 'STAR STUFF\r\n', '39.99', 7, 7),
(8, 'Star Wars USB Wall Charger - BB-8', 'UNLIMITED POWER!\r\n', '9.99', 8, 8),
(9, 'Warcraft Doomhammer Power Bank', 'BRING DOOM TO YOUR ENEMIES, NOT YOUR DEVICES', '77.89', 8, 9),
(10, 'Borderlands Claptrap Talking USB Hub - Exclusive\r\n', 'JUST FOLLOW THE SOOTHING SOUND OF MY VOICE!!!', '37.89', 8, 10);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(255) NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Role_ID` int(10) NOT NULL,
  `id_profile_pic` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `Role_ID`, `id_profile_pic`) VALUES
(1, 'AdminAleksa', 'adminAleksa@gmail.com', '2637a5c30af69a7bad877fdb65fbd78b', 1, 26),
(10, 'korisnik', 'korisnik@gmail.com', '87f7e47336de54567c55dbf9b57f8b82', 2, 26);

-- --------------------------------------------------------

--
-- Table structure for table `user_pictures`
--

CREATE TABLE `user_pictures` (
  `id_user_picture` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `id_picture` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_pictures`
--

INSERT INTO `user_pictures` (`id_user_picture`, `id_user`, `id_picture`) VALUES
(1, 1, 26),
(2, 10, 26),
(20, 10, 65);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Category_ID` (`Category_ID`),
  ADD KEY `picture_id` (`picture_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleID` (`Role_ID`),
  ADD KEY `id_profile_pic` (`id_profile_pic`);

--
-- Indexes for table `user_pictures`
--
ALTER TABLE `user_pictures`
  ADD PRIMARY KEY (`id_user_picture`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_picture` (`id_picture`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_pictures`
--
ALTER TABLE `user_pictures`
  MODIFY `id_user_picture` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`Category_ID`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`picture_id`) REFERENCES `pictures` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Role_ID`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_profile_pic`) REFERENCES `pictures` (`id`);

--
-- Constraints for table `user_pictures`
--
ALTER TABLE `user_pictures`
  ADD CONSTRAINT `user_pictures_ibfk_1` FOREIGN KEY (`id_picture`) REFERENCES `pictures` (`id`),
  ADD CONSTRAINT `user_pictures_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
