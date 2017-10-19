
-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 13, 2017 at 03:10 AM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 7.0.20-2~ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `email`, `hash`) VALUES
(1, 'Azeez', 'Gafar', 'azegaf@gmail.com', '$2y$10$w7/q77a3pzk8Q7wc0i3.Uu6AFLJhYSmBhWe71IQbE6RjH/ZQ0xSKu'),
(3, 'femi', 'femo', 'fem@d.cm', '$2y$10$e3eR5C96a/1a8EpH6TYwUeglFNDMYlq.BmX5RhBVagVftFrMTWNfq'),
(9, 'Oluwafemi', 'Gafar', 'femi@gmail.com', '$2y$10$p8f4Xaz3Xm6lidgjh5N53OghTaViKRoXfT7ymQQkGZ6led73ckg9.'),
(10, 'Aishat', 'Gafar', 'aishat@gmail.com', '$2y$10$UIuEaCfUGZAdf6tjtHn0z.0q00fDMTHc5vuh9bBjlUN8IG8wMAhYG'),
(11, 'alimah', 'Gafar', 'alimah@gmail.com', '$2y$10$4g/Eu32sIK7oJpXSaU39hek1qatOmORGc7236jBLAtfX30hvRymai'),
(12, 'hauwa', 'Gafar', 'hauwa@gmail.com', '$2y$10$zbWSF8ArQGggDSdy9Kf.jO5OF/tQTVLf.uxSRUCUXkHTsS8Z8ViN2'),
(13, 'hauwa', 'Gafar', 'jhcjachja', '$2y$10$Gwgmh0XdhRkZ2MLddxk58OUz5tr.Y5tnwFUMLs9S9L7VE6m3X2j12'),
(14, 'hauwa', 'Gafar', 'kjskjdsjkdjkad', '$2y$10$sHnUL7s1FXvZkX4mKY72PegfsmhXD/F0GBE76BbjZiE54sgfEF1IO'),
(15, 'mama', 'Gafar', 'mama', '$2y$10$yiQlgf.FMY.MNE1O1/r8fe7zx4wbqr6XTvfbke9osjiXzvdq9tfbe'),
(16, 'mama', 'Gafar', '1', '$2y$10$/qSVJ8oUgImo87DQw3ak..zpncV/neVZw2MLibX6MF3izc9xPXQvq'),
(17, 'mama', 'mama', '2', '$2y$10$G57sTbimq1WFrJdGCpoBD.Cv6twvlY957Gka.rJ7aQX3fZVcmK30S'),
(18, 'mama', 'mama', '3', '$2y$10$7ysPQEL3n6BJu4urMR/Zuebi/RJO6Z7hzwsiR40DKErPlbtEmLgzK'),
(19, 'mama', 'mama', '4', '$2y$10$rJXsSWpdMbFyivVe.Y82t.ey/n63avyFNOduDptNaZy04jf1TnOdq'),
(20, 'mama', 'mama', '5', '$2y$10$1t30uCO2LRcD3rkqn6jTPuifIQlfJfoTuTSLZi05qTtm83mqE6K72'),
(21, 'as', 'as', 'as@g.com', '$2y$10$5QkldDrBZpEoWefjs.O4Le1kt65vx62/FNi0Ppj3E.9Y25rYiTpXC');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `year` char(4) NOT NULL,
  `ISBN` char(12) NOT NULL,
  `filepath` varchar(200) NOT NULL,
  `flag` varchar(100) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `title`, `author`, `category_id`, `price`, `year`, `ISBN`, `filepath`, `flag`) VALUES
(3, 'Things Fall Apart', 'Chinua Achebe', '2', '5000', '1989', '100005', '../admin/uploads/7364423745IMG-20170526-WA0000.jpg', 'top-selling'),
(5, 'JAVASCRIPT EVERYWHERE', 'DAVID FLANAGAN', '2', '6000', '2015', '7US8755', '../admin/uploads/7364423745IMG-20170526-WA0000.jpg', 'trending'),
(6, 'HTML5 JAVASCRIPT & JQUERY', 'DANE cameron', '2', '7000', '2016', '678902hb', '../admin/uploads/60142187404.jpg', 'top-selling'),
(9, 'ELOQUENT JAVASCRIPT', 'MARIJN HAVERBEKE', '1', '9500', '2017', '100928JS', '../admin/uploads/1671274881big.jpg', 'top-selling'),
(10, 'JAVASCRIPT & JQUERY', 'JON DUCKETT', '1', '4930', '2016', '82639', '../admin/uploads/85945594351.jpg', 'trending'),
(11, 'JAVASCRIPT O''REILLY', 'DAVID FLANAGAN', '1', '5020', '2016', '20293IW', '../admin/uploads/95860598702.jpg', 'trending'),
(12, 'HTML5 JAVASCRIPT $ JQUERY', 'DANE CAMERON', '1', '4000', '2017', '092773J', '../admin/uploads/52764026164.jpg', 'trending'),
(13, 'PROFESSIONAL JAVASCRIPT FOR WEB', 'NKBOLES C. ZAL', '1', '3000', '2017', '928377', '../admin/uploads/744500475.jpg', 'top-selling'),
(14, 'UP & GOING', 'KYLE SIMPSON', '1', '2700', '2014', '92877SHJ', '../admin/uploads/76025500473.jpg', 'trending'),
(15, 'ELOQUENT', 'jkdjkfskj', '2', '78349', '1990', '1234', '../admin/uploads/1019529746Copy_of_2.jpg', 'trending'),
(16, 'kjdjksd', 'kjsdkjad', '1', '4567', '2345', '34789', '../admin/uploads/1176328905Copy_of_3.jpg', 'trending'),
(17, 'Make Hay While the Sun Shine', 'oluko', '14', '8900', '2017', 'jhsjh', '../uploads/70938396404.jpg', 'trending'),
(18, 'Move', 'move', '3', '2990', '1900', 'NJKDX', '../admin/uploads/5429224045Copy_of_3.jpg', 'top-selling'),
(19, 'Belle', 'belle', '2', '8000', '2016', 'kjndbx6', '../admin/uploads/4855484385Copy_of_3.jpg', 'top-selling');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `admin_id`, `upload_date`) VALUES
(2, 'HTML', 0, '2017-07-22 23:21:33'),
(3, 'History', 0, '2017-07-22 23:21:45'),
(4, 'Literature', 0, '2017-07-22 23:21:59'),
(5, 'Mathematics', 0, '2017-07-22 23:22:08'),
(6, 'Engineering', 0, '2017-07-22 23:22:17'),
(7, 'Politics', 0, '2017-07-23 00:15:44'),
(8, 'Music', 0, '2017-07-23 00:15:52'),
(9, 'Literature', 0, '2017-07-23 00:15:59'),
(10, 'Mathematics', 0, '2017-07-23 00:16:06'),
(11, 'Engineering', 0, '2017-07-23 00:16:13'),
(12, 'Politics', 0, '2017-07-23 00:16:22'),
(13, 'Music', 0, '2017-07-23 00:16:29'),
(14, 'JavaScript', 0, '2017-08-14 09:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `price` int(20) NOT NULL,
  `short_dsrp` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `seller` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `filepath` varchar(200) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `upload_time` datetime NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `firstname`, `lastname`, `email`, `hash`) VALUES
(1, 'zee', 'Azeez', 'Gafar', 'azegaf@gmail.com', '$2y$10$tZpPvT.r5vf/Oza/PE5bZeGx9A4xNtBF2MQ7ybfzR2q7QcTk1wgGm'),
(2, 'shasha', 'Aishat', 'Gafar', 'aishat@gmail.com', '$2y$10$dap0l7y4M47coClDsWM4..yNTmvlu5TqL/C54wBvJaaVQxWpyswMS'),
(3, 'mama', 'mama', 'mama', 'mama@m.m', '$2y$10$9aUF5Ut4WPY9LlecIBjj/OGbGXEvHHum0DzqCTmRz5QVVPFKeZnI.'),
(4, 'momo', 'momo', 'momo', 'momo@m.m', '$2y$10$ID6hb19qEs/K3XRPjL4oqO2XoGQQYkkhzDtybpZvwskKjNfhQckl6'),
(5, 'bayo', 'bayo', 'bayo', 'bayo@g.m', '$2y$10$hIonXh0uN.WB/VEec286veM2gb2EzRrUOyp1N1JSapPhggqus1ZC.'),
(6, 'femi', 'femi', 'femi', 'femi@gmail.com', '$2y$10$/Z2njOqC31tpqbAhFfOsS.eM5.XrFkCtGVb87WpAN5Gbaza3lgWQu'),
(7, 'femi', 'femi', 'femi', 'femi@k.k', '$2y$10$qztbHdfTSJOhpaCtGCkSIO/ezUuMX4.gCzRYT/jQ1FBUE9rGn6I6q'),
(8, '', 'oluwafemi', 'femo', 'femo@', '$2y$10$a2xrKHHxFFduh8F9Fo2KfuKI7qQsYAd06lRopfupEIp34ETtZifNa');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
