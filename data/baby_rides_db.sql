-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2021 at 01:48 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baby_rides_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id_basket` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basket_details`
--

CREATE TABLE `basket_details` (
  `id_basket_details` int(10) NOT NULL,
  `id_basket` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id_brand` int(10) NOT NULL,
  `brand_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_brand`, `brand_name`) VALUES
(1, 'Chicco'),
(5, 'Graco'),
(14, 'Kurneta'),
(28, 'Joovy'),
(29, 'Britax');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(10) NOT NULL,
  `category` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `category`) VALUES
(1, 'Baby stroller'),
(3, 'Carriers'),
(5, 'Car Seats');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(10) NOT NULL,
  `href` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `href`, `title`) VALUES
(1, 'index.php', 'Home'),
(2, 'products.php', 'Product'),
(3, 'contact.php', 'Contact Us');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id_picture` int(10) NOT NULL,
  `href` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_product` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id_picture`, `href`, `alt`, `id_product`) VALUES
(1, 'Urban_01.jpg', 'Baby stroller', 1),
(2, 'Urban_02.jpg', 'Urban', 2),
(48, '1614861683connect_bottlecap.jpeg', 'connect_bottlecap ', 63),
(49, '1614813538chicco+echo_carlet.jpeg', 'chicco+echo_carlet ', 64),
(50, '1614813772connect_bottlecap.jpeg', 'connect_bottlecap ', 65),
(51, '1614814097Britax_USA.jpeg', 'Britax_USA ', 66),
(52, '1614814254graco_booster.jpeg', 'graco_booster ', 67);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(10) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` int(10) NOT NULL,
  `active` int(10) NOT NULL,
  `id_brand` int(10) NOT NULL,
  `id_category` int(10) NOT NULL,
  `date_public` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `product_name`, `description`, `price`, `active`, `id_brand`, `id_category`, `date_public`) VALUES
(1, 'Urban Verso', 'The Urban is a European-style stroller that easily transforms from car seat carrier, to carriage, to stroller to accommodate growing children. Baby can ride frontwards or backwards in any configuration, providing six unique strolling modes and the option to face mom/dad or explore the world instead. A large storage basket, folding frame, one-touch parking brake, locking front swivels, and leatherette handle with sliding height adjustment make it a smart choice for parents too.', 120, 1, 1, 1, '2021-01-06 12:35:02'),
(2, 'Viaro Quick-Fold Stroller - Graphite', 'Lightweight & Maneuverable\r\nFor ultimate convenience, the Viaro® has a sleek three-wheel design, lightweight aluminum frame, and one-hand quick fold. A pull-strap and button are conveniently tucked under the seat and easy to activate simultaneously for a compact, free-standing fold. The stroller is even easier to open again after closing.', 200, 1, 1, 1, '2021-01-06 16:56:18'),
(63, 'Chicco Multiway Evo Stroller Fire Stroller', ' Seat is Extremely Large and Cosy and Can be Also Compatible with Extensively Padded Winter Clothing, Stable and Solid, it is the Off Road Stroller, Features an Umbrella Type Folding System, without the Need to Remove the Bumper Bar, Stroller is Practical to Carry Thanks to the Lateral Handle, 8 Wheels are Sturdy and Feature Suspensions which Ensure a Perfect Grip on Any Terrain, Large Hood Offers Total Protection to the Child, also in Colder and Windy Days, Backrest Can be Reclined with Just One Hand to 4-positions for Comfortable for Naps During Strolls', 147, 1, 1, 1, '2021-03-04 00:16:39'),
(64, 'Chicco Echo Scarlet Stroller', ' Chicco Echo Stroller is a stylish and modern stroller for the mums who like to be in trend. Matching frame and fabric colors, lightweight with agility is what gives this stroller a contemporary style but with the practicality of usage. Wide seat with padded backrest that can be adjusted in 4 different positions with full recline according to baby’s comfort during strolls. Umbrella fold design makes this stroller compact and easy to drag or carry anywhere with a handle. Front wheels are designed with suspension, toe-tap linked rear-wheel brakes, and swivel lock on front wheels make strolling through crowded places a breeze. Padded bumper bar safeguards the baby and an extendible canopy gives ample protection from sun. With additional accessories like storage basket with capacity up to 3 kg and rain cover, this Chicco’s Echo stroller is the best choice for every mother.\r\n', 235, 1, 1, 1, '2021-03-04 00:18:58'),
(65, 'Graco Lite Rider Click Connect Bottlecap Stroller', ' For comfortable rides from newborn through toddler, the Cortina CX Stroller has an adjustable backrest with 8 recline positions. The innovative Memory Recline function retains the backrest position during folding/unfolding, eliminating the need to readjust between trips. Front-wheel suspension and optional toe-tap swivels make it easy to maintain a smooth ride on any surface. An adjustable canopy with a peek-a-boo window offers shade from the sun. For use as a travel system, the Cortina CX Stroller accommodates all KeyFit infant car seats with easy click-in attachment.', 110, 1, 5, 1, '2021-03-04 00:22:52'),
(66, 'Britax Anti Rebound Bar Convertible Car Seat', ' keeps your child happy and comfortable for travel in cars, airplanes, buses, boats. Kids like them so much they\'ll even walk around with them in the house Soft cozy material helps support a child\'s neck. - not stiff memory foam so this travel pillow for kids easily molds around the seatback or car seat gently supporting their head without awkwardly pushing it forward Curved design cradles the neck and provides support Fun animal design The softness and fine quality of this pillow won’t hurt your kid’s neck and keep them fuss-free while on the go\r\n', 80, 1, 29, 5, '2021-03-04 00:28:17'),
(67, 'Graco Booster Car Seat Baby Car Seat', ' The Atlas 65 2-in-1 harness booster car seat is designed to grow with your child as a harness booster from 22 to 65 pounds to a high back booster 30 to 100 pounds. The ultra-easy Simply Safe Adjust Harness System adjusts the harness and headrest together - with no time-consuming rethreading - to 10 height positions, making it simple to keep your child properly positioned. It features a handy harness storage compartment, which allows you to keep the harness with the seat, even when you\'ve transitioned to high back booster mode. It features dual cupholders and a machine washable seat pad, buckle cover and harness covers.', 60, 1, 5, 5, '2021-03-04 00:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(30) NOT NULL,
  `role_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Privileged user');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(10) NOT NULL,
  `href` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id_slider`, `href`, `alt`) VALUES
(17, '1612205588slider2.jpg', 'slider2 '),
(18, '1612205743slider3.jpg', 'slider3 '),
(20, '16122664375.jpg', '5 '),
(21, '1612266452slider4.jpg', 'slider4 ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `fName` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lName` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fName`, `lName`, `email`, `address`, `pass`, `role_id`) VALUES
(7, 'Nebojsa', 'Causic', 'nebojsa@yahoo.com', 'Nebojsina', '5d5510d65a2810897467134a953fc424', 1),
(8, 'Nevena', 'Jovanovic', 'nevena@yahoo.com', 'Nevenina', '31794e5670aac7d0f8664648db4b7775', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id_basket`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `basket_details`
--
ALTER TABLE `basket_details`
  ADD PRIMARY KEY (`id_basket_details`),
  ADD KEY `id_basket` (`id_basket`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id_picture`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_brand` (`id_brand`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id_basket` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basket_details`
--
ALTER TABLE `basket_details`
  MODIFY `id_basket_details` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id_picture` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `basket_details`
--
ALTER TABLE `basket_details`
  ADD CONSTRAINT `basket_details_ibfk_1` FOREIGN KEY (`id_basket`) REFERENCES `basket` (`id_basket`),
  ADD CONSTRAINT `basket_details_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id_brand`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
