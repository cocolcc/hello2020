-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2020-07-25 15:18:12
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_zpw2000a`
--

-- --------------------------------------------------------

--
-- 表的结构 `account`
--

CREATE TABLE `account` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `id` int(20) NOT NULL,
  `authority` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `account`
--

INSERT INTO `account` (`username`, `password`, `id`, `authority`) VALUES
('a65394385', 'a123456', 2019112000, 0);

-- --------------------------------------------------------

--
-- 表的结构 `report`
--

CREATE TABLE `report` (
  `sensorgroup` varchar(10) CHARACTER SET latin1 NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `samplecode` varchar(20) CHARACTER SET latin1 NOT NULL,
  `sensorid` int(10) NOT NULL,
  `reason` text NOT NULL,
  `pic` varchar(20) CHARACTER SET latin1 DEFAULT 'Auto'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `report`
--

INSERT INTO `report` (`sensorgroup`, `timestamp`, `samplecode`, `sensorid`, `reason`, `pic`) VALUES
('A01', 20191121145402, 'A01T20191121145347', 20201003, 'ä¼ æ„Ÿå™¨å€¼è¯¯å·®è¿‡å¤§', 'a65394385'),
('A01', 20191121145405, 'A01T20191121145347', 20201004, 'ä¼ æ„Ÿå™¨é‡‡é›†å¼‚å¸¸', 'a65394385'),
('A01', 20191121145400, 'A01T20191121145347', 20201005, 'ä¼ æ„Ÿå™¨é‡‡é›†å¼‚å¸¸', 'a65394385'),
('A02', 20191121145400, 'A01T20191121145347', 20201004, 'ä¼ æ„Ÿå™¨å€¼è¯¯å·®è¿‡å¤§', 'a65394385');

-- --------------------------------------------------------

--
-- 表的结构 `sample`
--

CREATE TABLE `sample` (
  `sensorid` int(10) NOT NULL,
  `sensorgroup` varchar(10) NOT NULL,
  `timestamp` bigint(20) DEFAULT NULL,
  `value` int(10) NOT NULL,
  `samplecode` varchar(20) NOT NULL,
  `error` int(5) NOT NULL,
  `pic` varchar(20) NOT NULL DEFAULT 'Auto'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `sample`
--

INSERT INTO `sample` (`sensorid`, `sensorgroup`, `timestamp`, `value`, `samplecode`, `error`, `pic`) VALUES
(20201001, 'A01', 20191121145359, 178056, 'A01T20191121145347', 0, 'a65394385'),
(20201003, 'A01', 20191121145402, 179003, 'A01T20191121145347', 1, 'a65394385'),
(20201004, 'A01', 20191121145405, 168902, 'A01T20191121145347', 1, 'a65394385'),
(20201005, 'A01', 20191121145400, 168888, 'A01T20191121145347', 1, 'a65394385'),
(20201004, 'A02', 20191121145400, 178666, 'A01T20191121145347', 1, 'a65394385');

-- --------------------------------------------------------

--
-- 表的结构 `sensor`
--

CREATE TABLE `sensor` (
  `sensorid` int(10) NOT NULL,
  `sensorgroup` varchar(20) NOT NULL,
  `error` int(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `sensor`
--

INSERT INTO `sensor` (`sensorid`, `sensorgroup`, `error`) VALUES
(20201001, 'A01', 0),
(20201002, 'B01', 0),
(20201003, 'A01', 0),
(20201004, 'A01', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
