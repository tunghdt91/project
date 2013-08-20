CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL,
  `id_province` int(11) DEFAULT NULL,
  `city_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `id_province`, `city_name`) VALUES
(1101, 11, 'city A'),
(1102, 11, 'City B');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `param_id` int(11) DEFAULT NULL,
  `period_id` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `dttm_input` datetime DEFAULT NULL,
  `dttm_update` datetime DEFAULT NULL,
  `user_input` int(11) DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `value1` varchar(45) DEFAULT NULL,
  `value2` varchar(45) DEFAULT NULL,
  `value3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_data_item_idx` (`item_id`),
  KEY `fk_data_param1_idx` (`param_id`),
  KEY `fk_data_period1_idx` (`period_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `item_id`, `param_id`, `period_id`, `year`, `dttm_input`, `dttm_update`, `user_input`, `user_update`, `status`, `value1`, `value2`, `value3`) VALUES
(1, 1, 2, 2, 2013, '2013-08-15 07:00:00', '2013-08-17 13:00:00', 1, 1, 2, '10', '12', '24'),
(2, 1, 3, 2, 2013, '2013-08-15 08:00:00', '2013-08-17 13:00:00', 1, 1, 2, '32', '11', '9'),
(3, 1, 4, 2, 2013, '2013-08-16 10:00:00', '2013-08-17 13:00:00', 1, 1, 2, '22', '31', '16');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `id` int(11) NOT NULL,
  `id_province` int(11) DEFAULT NULL,
  `id_city` int(11) DEFAULT NULL,
  `district_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `id_province`, `id_city`, `district_name`) VALUES
(110101, 11, 1101, 'District X'),
(110102, 11, 1101, 'District Y');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period_id` int(11) DEFAULT NULL,
  `param_id` int(11) DEFAULT NULL,
  `item_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_period1_idx` (`period_id`),
  KEY `fk_item_param1_idx` (`param_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `period_id`, `param_id`, `item_name`) VALUES
(1, 1, 1, 'Fruit sales report');

-- --------------------------------------------------------

--
-- Table structure for table `param`
--

CREATE TABLE IF NOT EXISTS `param` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `param_name` varchar(50) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `grup` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `param`
--

INSERT INTO `param` (`id`, `parent`, `param_name`, `tipe`, `grup`, `status`) VALUES
(1, 0, 'Fruit', NULL, NULL, 1),
(2, 1, 'Apple', NULL, 'fresh', 1),
(3, 1, 'Mango', NULL, 'fresh', 1),
(4, 1, 'Strawberry', NULL, 'fresh', 1),
(5, 0, 'Snacks', NULL, NULL, 1),
(6, 5, 'Candy Bar', NULL, 'frozen', 1),
(7, 5, 'Frozen Berries', NULL, 'frozen', 1);

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE IF NOT EXISTS `period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `period_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`id`, `parent`, `period_name`) VALUES
(1, 0, 'quartal'),
(2, 1, 'quartal 1'),
(3, 1, 'quartal 2'),
(4, 1, 'quartal 3'),
(5, 0, 'Semester'),
(6, 5, 'Semester 1'),
(7, 5, 'Semester 2');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `id` int(11) NOT NULL,
  `province_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `province_name`) VALUES
(11, 'Province 1'),
(12, 'Province 2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `address` text,
  `hobby` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_city1_idx` (`city_id`),
  KEY `fk_users_province1_idx` (`province_id`),
  KEY `fk_users_district1_idx` (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `birthday`, `gender`, `province_id`, `city_id`, `district_id`, `address`, `hobby`) VALUES
(0, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'administrator', '1975-03-17', 'M', 11, 1101, 110102, 'Address street', '1|3');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data`
--

ALTER TABLE `data`
  ADD CONSTRAINT `fk_data_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_param1` FOREIGN KEY (`param_id`) REFERENCES `param` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_data_period1` FOREIGN KEY (`period_id`) REFERENCES `period` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item`
--

ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_param1` FOREIGN KEY (`param_id`) REFERENCES `param` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_period1` FOREIGN KEY (`period_id`) REFERENCES `period` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--

ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;