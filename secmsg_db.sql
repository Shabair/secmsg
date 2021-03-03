-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2017 at 10:27 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `secmsg_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `email`) VALUES
('5ad8978c61a9977e39f81e1deb48e89d', 'secmsg', '827ccb0eea8a706c4c34a16891f84e7b', 'Secure', 'Message', 'shabair143@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE IF NOT EXISTS `admin_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(2000) NOT NULL,
  `userId` varchar(200) NOT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `msgUrl` varchar(20) NOT NULL,
  `delete` enum('0','1') NOT NULL DEFAULT '0',
  `commentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `userId`, `nickname`, `msgUrl`, `delete`, `commentDate`) VALUES
(33, 'sdcs sdcs sdcsdc', 'd14774b9bb57ebbaaeaeb00fd2ced963', NULL, '2BBXPV5N', '1', '2017-10-06 18:14:19'),
(34, 'dcsdc sdcsd sdsdcsc', 'd14774b9bb57ebbaaeaeb00fd2ced963', NULL, '2BBXPV5N', '0', '2017-10-06 18:14:28'),
(35, 'asasxasx', 'd14774b9bb57ebbaaeaeb00fd2ced963', NULL, '2BBXPV5N', '1', '2017-10-06 21:55:30'),
(36, 'asxxsx', 'd14774b9bb57ebbaaeaeb00fd2ced963', NULL, '2BBXPV5N', '0', '2017-10-06 21:55:51'),
(37, 'asasc', 'd14774b9bb57ebbaaeaeb00fd2ced963', NULL, '2BBXPV5N', '1', '2017-10-06 22:01:33'),
(38, 'asxaxsa', 'd14774b9bb57ebbaaeaeb00fd2ced963', NULL, '2BBXPV5N', '1', '2017-10-06 22:02:42'),
(39, 'baskchs', 'f7768cee72d3587e9f2084f1cdff5307', 'ali', '2BBXPV5N', '0', '2017-10-06 22:03:06'),
(40, 'axsasx', 'f7768cee72d3587e9f2084f1cdff5307', 'asxasx', '2BBXPV5N', '1', '2017-10-06 22:03:39'),
(41, 'hello', 'f7768cee72d3587e9f2084f1cdff5307', 'asxasx', '2BBXPV5N', '1', '2017-10-06 22:03:46'),
(42, 'what the rong', 'f7768cee72d3587e9f2084f1cdff5307', 'asxasx', '2BBXPV5N', '1', '2017-10-06 22:03:54'),
(43, 'ascac asad efd sdhcjsdj sdj sjd jldc lsjdc lsjdc', 'f7768cee72d3587e9f2084f1cdff5307', 'shabair@gmail.com', '2BBXPV5N', '0', '2017-10-06 22:25:36'),
(44, 'kdchsludcvsdc sdjjsdc', 'f7768cee72d3587e9f2084f1cdff5307', 'hello', '2BBXPV5N', '0', '2017-10-06 22:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE IF NOT EXISTS `cookies` (
  `id` varchar(100) NOT NULL,
  `machine` varchar(500) DEFAULT NULL,
  `ipaddress` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cookies`
--

INSERT INTO `cookies` (`id`, `machine`, `ipaddress`) VALUES
('1e47987a15ce9e02852e61321fe9f939', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '::1'),
('262b857154ed9c5778a871178aab3c64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '::1'),
('6810f7567851f57a3cf5abfbfa781d34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '::1'),
('0a32fadb4c8ad1f1a95269ba11fa0799', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '::1'),
('bbab821d1ff05d8d7a82e985ba859431', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '::1'),
('9c9593be850e09273fee1ccfec88c1c4', NULL, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `count` int(11) NOT NULL DEFAULT '0',
  `subject` varchar(1000) NOT NULL,
  `message` longtext NOT NULL,
  `url` varchar(50) NOT NULL,
  `msgpassword` varchar(3000) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `block_countries` varchar(1500) DEFAULT NULL,
  `starttime` varchar(30) DEFAULT NULL,
  `endtime` varchar(30) DEFAULT NULL,
  `commentstate` enum('no','global','private') NOT NULL DEFAULT 'no',
  `no_of_views` int(11) DEFAULT '-1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bookmark` enum('0','1','','') NOT NULL DEFAULT '0',
  `no_of_per_views` int(11) NOT NULL DEFAULT '-1',
  `msgaccess` enum('global','local','','') NOT NULL DEFAULT 'global',
  `status` set('del','pdel','') NOT NULL DEFAULT '',
  `saved` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=427 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `count`, `subject`, `message`, `url`, `msgpassword`, `user_id`, `block_countries`, `starttime`, `endtime`, `commentstate`, `no_of_views`, `create_date`, `bookmark`, `no_of_per_views`, `msgaccess`, `status`, `saved`) VALUES
(420, 0, 'shaib', '6efcbfaf9f03b3c2d0ece54a343a221a8dd7f24ab481489eae0b6bcae4f0ad92e6cde2c8bbc10b26a0c8a141e920be4d0865a473b3b4082b11e7c98d730e917dwL5grhBu+3iHdm4zWQ0ans1wpK+PA+TYC9nloKrgYq1X/JCAWf4l8KYDXuyyQIRx', '5G6UIGAO', '', 'd14774b9bb57ebbaaeaeb00fd2ced963', 'PK', '1507301424', '', 'no', -1, '2017-10-06 14:50:24', '0', -1, 'global', '', '0'),
(421, 0, 'shaib', 'bc31f1340c94615934e06e7e4026bb5a4eb6aed8a04940cee1342ca5638774f3fdf52176e93cfe4df3e59959099adfd1a84ca2b92b4ac01a39fcb9d69630a4efQC8KrueRl23aifj7M2vSBMd1SGtpv4jNQMOGRMCTxpC8moawHrEOKOSbZXmtZvtNcjZdFH9ok2gQfpgnQ2zHEw==', '2NMB4TXS', '', 'd14774b9bb57ebbaaeaeb00fd2ced963', NULL, '1507301682', '', 'no', -1, '2017-10-06 14:54:42', '0', 1, 'global', '', '0'),
(422, 0, 'this is the message for comments', '19e7dc5ebcc18745d6cd2cb57784578b9463984900346dd94d6c88f2bb389bc3251c7f72417f22c230db332188706483b9e4712cd5370359ffb7e517f9180a55SpFBdCzvVRZdxZhZFQPblGi0EmCpml7TZDn84nt5+ssjCoc36EKVHsSySUQEjxS5/MI09Dj4I4RaEtOAs+bsOA==', '2BBXPV5N', '', 'd14774b9bb57ebbaaeaeb00fd2ced963', NULL, '1507304827', '', 'global', -1, '2017-10-06 15:45:19', '0', -1, 'global', '', '0'),
(423, 0, 'shaib', '9f591bd7840bba87b031faa2a903f62e3b632371a770df1730b549139da0c3cbaced53bd5fec72ff3cf32ba297d6fbcbf667f8235552d1aae705298fda145fd0Ly4IZhSwBQwsB5n/+F7NfNuihwTkbjMgJ8/hUh8IVRfVs0MbBjJ4NvbHNJfv/wy3', 'WWE722JY', 'fb147dbf2b047ef50c4303008147b5aa5f6eb0cb171fe2a4b2636bba6a98eec6f3c1636ff9476cca6548b8f01480f13a81bda0f1bc9f9f3e284ceae2eab2c38eOK+yygNxCf2nTcADTtU109fGfd5B+gbWeVNYa1LDYEk=', 'f7768cee72d3587e9f2084f1cdff5307', NULL, '1507334945', '', 'no', -1, '2017-10-07 00:09:05', '0', -1, 'global', '', '0'),
(424, 0, 'shaib', '522df76992849badf8b6d60fcf9e4552f215bd5207e9aa46d092d549395e817f1d6e667042015f25c3c1ec84bccdb677128bff89d1e0fcb6be1ad0d9dfbe9fa177jUqPtZ+0KL77xlN9jvmPwqvDVq4e4vEEliXyIeXa2p3kFG2Fewvneb+iUVcwEv', 'J6UPAG9N', '7eb4b0e25151775a5ce1f2b3234418142e4652b4b35fc0d383e68acf3b37cc7477006cfc1670632d5311047d0a4386bb979c8ba9e2ecdba7b7451eeca5531f98y/myOml2+0qKaytmNuJm1bkoox95f2ee0IWC7OgG0Do=', 'd14774b9bb57ebbaaeaeb00fd2ced963', NULL, '1507338198', '', 'no', -1, '2017-10-07 01:03:18', '0', -1, 'global', '', '0'),
(425, 0, 'loream', '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', 'WZY258RT', '', 'd14774b9bb57ebbaaeaeb00fd2ced963', NULL, '1507368499', '', 'no', -1, '2017-10-07 07:00:10', '0', -1, 'global', '', '0'),
(426, 0, 'What is Lorem Ipsum', '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', 'HDRGUL0Q', 'b21cd1edfaa5df52485184106dd19811a1a4d3f668e8db7832b8eb35f37f02d0488e9c33efc8b1b68c57083e61bd5b161e72fd9ba81198a94e79328a78044453CZzPz/OVqLV8K73eQg2BN0/II/xpVko6axBOW1M+5a4=', 'd14774b9bb57ebbaaeaeb00fd2ced963', NULL, '1507376879', '', 'no', -1, '2017-10-07 11:35:56', '0', -1, 'global', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `message_meta`
--

CREATE TABLE IF NOT EXISTS `message_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(20) NOT NULL,
  `key` varchar(1000) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msgvisitors`
--

CREATE TABLE IF NOT EXISTS `msgvisitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msgUrl` varchar(255) DEFAULT NULL,
  `userIp` varchar(20) DEFAULT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT '0',
  `loc` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `msgvisitors`
--

INSERT INTO `msgvisitors` (`id`, `msgUrl`, `userIp`, `userId`, `count`, `loc`) VALUES
(59, '2NMB4TXS', '103.255.4.6', 'd14774b9bb57ebbaaeaeb00fd2ced963', 1, '31.5497,74.3436'),
(60, '2BBXPV5N', '103.255.4.6', 'd14774b9bb57ebbaaeaeb00fd2ced963', 77, '31.5497,74.3436'),
(61, '2BBXPV5N', '103.255.4.12', 'f7768cee72d3587e9f2084f1cdff5307', 35, '31.5497,74.3436'),
(62, 'WWE722JY', '103.255.4.12', 'f7768cee72d3587e9f2084f1cdff5307', 1, '31.5497,74.3436'),
(63, 'WZY258RT', '103.255.5.81', 'd14774b9bb57ebbaaeaeb00fd2ced963', 2, '31.4888,74.3686'),
(64, 'HDRGUL0Q', '103.255.4.64', 'd14774b9bb57ebbaaeaeb00fd2ced963', 1, '31.5497,74.3436');

-- --------------------------------------------------------

--
-- Table structure for table `temp_data`
--

CREATE TABLE IF NOT EXISTS `temp_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `temp_data`
--

INSERT INTO `temp_data` (`id`, `user_id`, `key`, `value`) VALUES
(1, 'd14774b9bb57ebbaaeaeb00fd2ced963', 'pro_hash', '3648a2dd8fd82186e9449883975412c4'),
(2, 'd14774b9bb57ebbaaeaeb00fd2ced963', 'pro_hash', 'd41d8cd98f00b204e9800998ecf8427e'),
(6, 'd14774b9bb57ebbaaeaeb00fd2ced963', 'pro_hash', '8514392249481242961d55781a1dab23'),
(7, 'd14774b9bb57ebbaaeaeb00fd2ced963', 'pro_hash', '433f85019d112c3110ff70a94055cc6a'),
(8, 'd14774b9bb57ebbaaeaeb00fd2ced963', 'pro_hash', 'e19012d5dfe23f99629b79108be7f741');

-- --------------------------------------------------------

--
-- Table structure for table `temp_user_reg`
--

CREATE TABLE IF NOT EXISTS `temp_user_reg` (
  `userId` varchar(255) NOT NULL,
  `reg_link` int(11) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `username` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `profile_img` varchar(300) DEFAULT NULL,
  `type` set('basic','pro') NOT NULL DEFAULT 'basic',
  `date_reg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `gender`, `username`, `email`, `password`, `dob`, `country`, `state`, `address`, `status`, `profile_img`, `type`, `date_reg`, `active`) VALUES
('73ffb3fddc27908a82ceb47f9005d660', 'saad', 'ali', NULL, 'saadii', 'shabair@h.acjgv', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, 'basic', '2017-10-06 15:01:09', '0'),
('76ad2b3a64d2ee8a1c510c3609e8b77e', 'saddi', 'sakba', NULL, 'dil', 'kjbdckdc@bcdj.ckjbc', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, '7228260b1f5b3c95c69a5fb5725654eb.png', 'basic', '2017-10-06 15:01:39', '1'),
('8aeaf9f031eb6c2b3dea000476ef922d', 'saad', 'ali', NULL, 'saadi', 'ajshdu@gmail.com', '347602146a923872538f3803eb5f3cef', NULL, NULL, NULL, NULL, NULL, '6f42379909e6e005880b17427003851c.jpg', 'basic', '2017-08-11 14:27:18', '1'),
('8fabf3a7c0d2e26ffc8ef5ff273c450f', 'saad', 'ali', NULL, 'saad', 'xyz@gmail.com', '347602146a923872538f3803eb5f3cef', NULL, 'PAKISTAN', NULL, NULL, NULL, '14ef0767d081813a6edb52fc6324f72b.jpg', 'basic', '2017-08-11 10:26:10', '1'),
('94b593288b9ce9688d834e2cda0e155f', 'zumbish', 'majeed', NULL, 'zumbish23', 'zumbishmajeed@gmail.com', '72a5f3c177b02f0af28d765c7ac0f416', NULL, NULL, NULL, NULL, NULL, 'a4603472c054d4e08c1333108307ad5d.jpg', 'basic', '2017-08-11 13:47:17', '1'),
('a978b273c5d0d83daf82d0f89f1e37a0', 'ali', 'ahmed', NULL, 'ali23', 'aliahmed@gmail.com', '86318e52f5ed4801abe1d13d509443de', NULL, NULL, NULL, NULL, NULL, 'c52bec6e64ee78c66cde6d5810d6c59e.jpg', 'basic', '2017-08-11 13:48:19', '1'),
('cf1854e267611c42bcd1611b8cf3c6cb', 'zumbish', 'majeed', NULL, 'zumbish', 'zumbishmajeed@anti.com', 'face3d7fe9fdcc4ee855b7759be18ea0', NULL, NULL, NULL, NULL, NULL, NULL, 'basic', '2017-08-11 05:57:21', '1'),
('cf71f82cf2b02d094d68e915c78334dc', 'anti', 'anti', NULL, 'antig', 'anti@anti.com', 'face3d7fe9fdcc4ee855b7759be18ea0', NULL, NULL, NULL, NULL, NULL, NULL, 'basic', '2017-08-11 06:07:52', '1'),
('d14774b9bb57ebbaaeaeb00fd2ced963', 'Shabair', 'Abdulg', 'm', 'shaib', 'shaib@gmail.com', '997dda724cc614ef4548be291139ffe1', '1996-09-26', 'PAKISTAN', 'Punjab', 'Lodhi Street Islam Pura Fathe Garh', 'This is My status', '9a57a2700b61dd4cc0f5cedf1c2f97e2.png', 'pro', '2017-08-01 03:38:19', '1'),
('e1509c906e9d6b6f482f6813a8b4387f', 'anti', 'majeed', 'm', 'anti', 'as@gamil.com', 'face3d7fe9fdcc4ee855b7759be18ea0', '2017-12-31', 'PAKISTAN', NULL, NULL, NULL, '6c44f4f142aaecb2dd95cd3e8979b077.jpg', 'basic', '2017-08-11 05:53:50', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
  `umeta_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_key` varchar(255) NOT NULL,
  `user_value` varchar(1000) NOT NULL,
  PRIMARY KEY (`umeta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
