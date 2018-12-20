--
-- Table structure for table `din`
--

CREATE TABLE `din` (
  `din_id` varchar(10) NOT NULL,
  `din_name` tinytext NOT NULL,
  `din_iso` tinytext NOT NULL,
  `din_symbol` varchar(5) NOT NULL DEFAULT '¤',
  `din_digital` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for currencies/money';

-- --------------------------------------------------------

--
-- Table structure for table `eye`
--

CREATE TABLE `eye` (
  `eye_id` varchar(10) NOT NULL,
  `eye_color` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for eye colors';

-- --------------------------------------------------------

--
-- Table structure for table `gen`
--

CREATE TABLE `gen` (
  `gen_id` varchar(10) NOT NULL,
  `gen_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for genders';

-- --------------------------------------------------------

--
-- Table structure for table `har`
--

CREATE TABLE `har` (
  `har_id` varchar(10) NOT NULL,
  `har_color` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for hair colors';

-- --------------------------------------------------------

--
-- Table structure for table `i18`
--

CREATE TABLE `i18` (
  `i18_id` varchar(10) NOT NULL,
  `i18_language` tinytext NOT NULL,
  `i18_country` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for locales';

-- --------------------------------------------------------

--
-- Table structure for table `loc`
--

CREATE TABLE `loc` (
  `loc_id` varchar(10) NOT NULL,
  `loc_name` tinytext NOT NULL,
  `loc_parent` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for locations/places';

--
-- Dumping data for table `loc`
--

INSERT INTO `loc` (`loc_id`, `loc_name`, `loc_parent`) VALUES
('0000000000', 'WORLD', ''),
('0000000001', 'AFRICA', '0000000000'),
('0000000002', 'ANTARCTICA', '0000000000'),
('0000000003', 'ASIA', '0000000000'),
('0000000004', 'CARIBBEAN', '0000000000'),
('0000000005', 'EUROPE', '0000000000'),
('0000000006', 'NAMERICA', '0000000000'),
('0000000007', 'OCEANIA', '0000000000'),
('0000000008', 'SAMERICA', '0000000000'),

-- --------------------------------------------------------

--
-- Table structure for table `nat`
--

CREATE TABLE `nat` (
  `nat_id` varchar(10) NOT NULL,
  `nat_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for Nationalities';

-- --------------------------------------------------------

--
-- Table structure for table `prv`
--

CREATE TABLE `prv` (
  `prv_id` varchar(10) NOT NULL,
  `prv_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for privacy levels';

--
-- Dumping data for table `prv`
--

INSERT INTO `prv` (`prv_id`, `prv_name`) VALUES
('РЖFÂå1ÔÏúL', 'INSTANCE'),
('6ьötХ5áзÚZ', 'EVERYONE'),
('ñToùòхаþOЪ', 'SELF'),
('óСПõöRærÊh', 'FOLLOWERS'),
('ÞБЯÍcOъøДS', 'FRIENDS'),
('щÊдrûOftÐÿ', 'FEDIVERSE');

-- --------------------------------------------------------

--
-- Table structure for table `spk`
--

CREATE TABLE `spk` (
  `spk_id` varchar(10) NOT NULL,
  `spk_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for spoken languages';

-- --------------------------------------------------------

--
-- Table structure for table `sxu`
--

CREATE TABLE `sxu` (
  `sxu_id` varchar(10) NOT NULL,
  `sxu_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for sexualities';

-- --------------------------------------------------------

--
-- Table structure for table `tzt`
--

CREATE TABLE `tzt` (
  `tzt_id` varchar(10) NOT NULL,
  `tzt_abbr` tinytext NOT NULL,
  `tzt_name` tinytext NOT NULL,
  `tzt_offset` tinytext NOT NULL,
  `tzt_dst_offset` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for time zones';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `din`
--
ALTER TABLE `din`
  ADD PRIMARY KEY (`din_id`);

--
-- Indexes for table `eye`
--
ALTER TABLE `eye`
  ADD PRIMARY KEY (`eye_id`);

--
-- Indexes for table `gen`
--
ALTER TABLE `gen`
  ADD PRIMARY KEY (`gen_id`);

--
-- Indexes for table `har`
--
ALTER TABLE `har`
  ADD PRIMARY KEY (`har_id`);

--
-- Indexes for table `i18`
--
ALTER TABLE `i18`
  ADD PRIMARY KEY (`i18_id`);

--
-- Indexes for table `loc`
--
ALTER TABLE `loc`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `nat`
--
ALTER TABLE `nat`
  ADD PRIMARY KEY (`nat_id`);

--
-- Indexes for table `prv`
--
ALTER TABLE `prv`
  ADD PRIMARY KEY (`prv_id`),
  ADD UNIQUE KEY `prv_name` (`prv_name`(50));

--
-- Indexes for table `spk`
--
ALTER TABLE `spk`
  ADD PRIMARY KEY (`spk_id`);

--
-- Indexes for table `sxu`
--
ALTER TABLE `sxu`
  ADD PRIMARY KEY (`sxu_id`);

--
-- Indexes for table `tzt`
--
ALTER TABLE `tzt`
  ADD PRIMARY KEY (`tzt_id`);
COMMIT;
