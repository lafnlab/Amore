--
-- Table structure for table `adm`
--

CREATE TABLE `adm` (
  `adm_id` varchar(10) NOT NULL,
  `adm_level` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for admin/user levels';

--
-- Dumping data for table `adm`
--

INSERT INTO `adm` (`adm_id`, `adm_level`) VALUES
('sеÔÞLÉзBТт', 'USER'),
('ÛГUojЭПEЯÉ', 'MODERATOR'),
('ДÖÍsöÊкÔnц', 'TRANSLATOR'),
('ЗиóВéèàwVO', 'ADMINISTRATOR'),
('ЮêlùсdzЕХР', 'GUIDE');

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
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `msg_id` varchar(10) NOT NULL,
  `msg_by` varchar(10) NOT NULL COMMENT 'who wrote the message',
  `msg_to` varchar(10) NOT NULL COMMENT 'who the message is to',
  `msg_timestamp` datetime NOT NULL,
  `msg_text` text NOT NULL,
  `msg_lang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for (direct/private) messages';

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
-- Table structure for table `pro`
--

CREATE TABLE `pro` (
  `pro_id` varchar(10) NOT NULL COMMENT 'same as usr_id',
  `pro_gen` varchar(10) NOT NULL COMMENT 'from gen table',
  `pro_sxu` varchar(10) NOT NULL COMMENT 'from sxu table',
  `pro_eye` varchar(10) NOT NULL COMMENT 'from eye table',
  `pro_har` varchar(10) NOT NULL COMMENT 'from har table',
  `pro_loc` varchar(10) NOT NULL COMMENT 'from loc table',
  `pro_nat` varchar(10) NOT NULL COMMENT 'from nat table',
  `pro_i18` varchar(10) NOT NULL COMMENT 'from i18 table',
  `pro_spk` varchar(60) NOT NULL COMMENT 'from spk table',
  `pro_tzt` varchar(10) NOT NULL COMMENT 'from tzt table'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for user profiles';

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
('ÓÇfXЦИфЕaù', 'PRIVATE'),
('óСПõöRærÊh', 'FOLLOWERS'),
('ÞБЯÍcOъøДS', 'FRIENDS'),
('щÊдrûOftÐÿ', 'FEDIVERSE');

-- --------------------------------------------------------

--
-- Table structure for table `pst`
--

CREATE TABLE `pst` (
  `pst_id` varchar(10) NOT NULL,
  `pst_by` varchar(10) NOT NULL,
  `pst_timestamp` datetime NOT NULL,
  `pst_text` text NOT NULL,
  `pst_lang` varchar(10) NOT NULL,
  `pst_priv` varchar(10) NOT NULL DEFAULT '6ьötХ5áзÚZ' COMMENT 'default privacy level is for Everyone'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for posts';

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

-- --------------------------------------------------------

--
-- Table structure for table `usr`
--

CREATE TABLE `usr` (
  `usr_id` varchar(10) NOT NULL,
  `usr_name` tinytext NOT NULL,
  `usr_pass` tinytext NOT NULL,
  `usr_email` tinytext NOT NULL,
  `usr_dob` date NOT NULL,
  `usr_outbox` mediumtext NOT NULL COMMENT 'collection of messages by the user',
  `usr_inbox` mediumtext NOT NULL COMMENT 'collection of messages to the user',
  `usr_liked` mediumtext NOT NULL COMMENT 'collection of items the user likes',
  `usr_follows` mediumtext NOT NULL COMMENT 'collection of accts the user follows',
  `usr_followers` mediumtext NOT NULL COMMENT 'collection of accts that follow the user',
  `usr_created` datetime NOT NULL,
  `usr_last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for user accounts';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`adm_id`),
  ADD UNIQUE KEY `adm_level` (`adm_level`(50));

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
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `nat`
--
ALTER TABLE `nat`
  ADD PRIMARY KEY (`nat_id`);

--
-- Indexes for table `pro`
--
ALTER TABLE `pro`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `prv`
--
ALTER TABLE `prv`
  ADD PRIMARY KEY (`prv_id`),
  ADD UNIQUE KEY `prv_name` (`prv_name`(50));

--
-- Indexes for table `pst`
--
ALTER TABLE `pst`
  ADD PRIMARY KEY (`pst_id`);

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

--
-- Indexes for table `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`usr_id`),
  ADD UNIQUE KEY `usr_name` (`usr_name`(50));
COMMIT;
