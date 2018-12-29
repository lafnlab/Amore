--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `website_url` tinytext NOT NULL,
  `website_name` tinytext NOT NULL,
  `website_description` text NOT NULL,
  `default_locale` tinytext NOT NULL,
  `open_registrations` BOOLEAN DEFAULT 0 COMMENT 'default is closed',
  `admin_account` tinytext NOT NULL COMMENT 'will be first account created',
  `admin_email` tinytext NOT NULL,
  `posts_are_called` tinytext NOT NULL,
  `post_is_called` tinytext NOT NULL,
  `reposts_are_called` tinytext NOT NULL,
  `repost_is_called` tinytext NOT NULL,
  `users_are_called` tinytext NOT NULL,
  `user_is_called` tinytext NOT NULL,
  `favorites_are_called` tinytext NOT NULL,
  `favorite_is_called` tinytext NOT NULL,
  `max_post_length` smallint NOT NULL DEFAULT 500,
  `banned_user_names` text NOT NULL,
  `list_with_the_federation_info` BOOLEAN NOT NULL DEFAULT 1 COMMENT 'default is yes',
  `list_with_fediverse_network` BOOLEAN NOT NULL DEFAULT 1 COMMENT 'default is yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for website configuration';

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `currencies_id` varchar(10) NOT NULL,
  `currencies_name` tinytext NOT NULL,
  `currencies_iso` tinytext NOT NULL,
  `currencies_symbol` varchar(5) NOT NULL DEFAULT '¤',
  `currencies_digital` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for currencies/money';

-- --------------------------------------------------------

--
-- Table structure for table `eye_colors`
--

CREATE TABLE `eye_colors` (
  `eye_colors_id` varchar(10) NOT NULL,
  `eye_colors_color` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for eye colors';

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `genders_id` varchar(10) NOT NULL,
  `genders_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for genders';

-- --------------------------------------------------------

--
-- Table structure for table `hair_colors`
--

CREATE TABLE `hair_colors` (
  `hair_colors_id` varchar(10) NOT NULL,
  `hair_colors_color` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for hair colors';

-- --------------------------------------------------------

--
-- Table structure for table `locales`
--

CREATE TABLE `locales` (
  `locales_id` varchar(10) NOT NULL,
  `locales_language` tinytext NOT NULL,
  `locales_country` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for locales';

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locations_id` varchar(10) NOT NULL,
  `locations_name` tinytext NOT NULL,
  `locations_parent` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for locations/places';

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locations_id`, `locations_name`, `locations_parent`) VALUES
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
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `nationalities_id` varchar(10) NOT NULL,
  `nationalities_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for nationalities';

-- --------------------------------------------------------

--
-- Table structure for table `privacy_levels`
--

CREATE TABLE `privacy_levels` (
  `privacy_levels_id` varchar(10) NOT NULL,
  `privacy_levels_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for privacy levels';

--
-- Dumping data for table `privacy_levels`
--

INSERT INTO `privacy_levels` (`privacy_levels_id`, `privacy_levels_name`) VALUES
('РЖFÂå1ÔÏúL', 'INSTANCE'),
('6ьötХ5áзÚZ', 'EVERYONE'),
('ñToùòхаþOЪ', 'SELF'),
('ÓÇfXЦИфЕaù', 'PRIVATE'),
('óСПõöRærÊh', 'FOLLOWERS'),
('ÞБЯÍcOъøДS', 'FRIENDS'),
('щÊдrûOftÐÿ', 'FEDIVERSE');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `posts_id` varchar(10) NOT NULL,
  `posts_by` varchar(10) NOT NULL,
  `posts_timestamp` datetime NOT NULL,
  `posts_text` text NOT NULL,
  `posts_language` varchar(10) NOT NULL,
  `posts_privacy_level` varchar(10) NOT NULL DEFAULT '6ьötХ5áзÚZ' COMMENT 'default privacy level is for Everyone'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for posts';

-- --------------------------------------------------------

--
-- Table structure for table `spoken_languages`
--

CREATE TABLE `spoken_languages` (
  `spoken_languages_id` varchar(10) NOT NULL,
  `spoken_languages_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for spoken languages';

-- --------------------------------------------------------

--
-- Table structure for table `sexualities`
--

CREATE TABLE `sexualities` (
  `sexualities_id` varchar(10) NOT NULL,
  `sexualities_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for sexualities';

-- --------------------------------------------------------

--
-- Table structure for table `time_zones`
--

CREATE TABLE `time_zones` (
  `time_zones_id` varchar(10) NOT NULL,
  `time_zones_abbreviation` tinytext NOT NULL,
  `time_zones_name` tinytext NOT NULL,
  `time_zones_offset` tinytext NOT NULL,
  `time_zones_dst_offset` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for time zones';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(10) NOT NULL,
  `user_name` tinytext NOT NULL,
  `user_pass` tinytext NOT NULL,
  `user_email` tinytext NOT NULL,
  `user_date_of_birth` date NOT NULL,
  `user_outbox` mediumtext NOT NULL COMMENT 'collection of messages by the user',
  `user_inbox` mediumtext NOT NULL COMMENT 'collection of messages to the user',
  `user_liked` mediumtext NOT NULL COMMENT 'collection of items the user likes',
  `user_follows` mediumtext NOT NULL COMMENT 'collection of accts the user follows',
  `user_followers` mediumtext NOT NULL COMMENT 'collection of accts that follow the user',
  `user_created` datetime NOT NULL,
  `user_last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for user accounts';

-- --------------------------------------------------------

--
-- Table structure for table `user_levels`
--

CREATE TABLE `user_levels` (
  `user_levels_id` varchar(10) NOT NULL,
  `user_levels_level` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for admin/user levels';

--
-- Dumping data for table `user_levels`
--

INSERT INTO `user_levels` (`user_levels_id`, `user_levels_level`) VALUES
('sеÔÞLÉзBТт', 'USER'),
('ÛГUojЭПEЯÉ', 'MODERATOR'),
('ДÖÍsöÊкÔnц', 'TRANSLATOR'),
('ЗиóВéèàwVO', 'ADMINISTRATOR'),
('ЮêlùсdzЕХР', 'GUIDE');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `user_profiles_id` varchar(10) NOT NULL COMMENT 'same as user_id',
  `user_profiles_gender` varchar(10) NOT NULL COMMENT 'from genders table',
  `user_profiles_sexuality` varchar(10) NOT NULL COMMENT 'from sexualities table',
  `user_profiles_eye_color` varchar(10) NOT NULL COMMENT 'from eye_colors table',
  `user_profiles_hair_color` varchar(10) NOT NULL COMMENT 'from hair_colors table',
  `user_profiles_location` varchar(10) NOT NULL COMMENT 'from locations table',
  `user_profiles_nationality` varchar(10) NOT NULL COMMENT 'from nationalities table',
  `user_profiles_locale` varchar(10) NOT NULL COMMENT 'from locales table',
  `user_profiles_spoken_language` varchar(60) NOT NULL COMMENT 'from spoken_languages table',
  `user_profiles_time_zone` varchar(10) NOT NULL COMMENT 'from time_zones table',
  `user_profiles_description` tinytext NOT NULL COMMENT 'small bio of user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for user profiles';


--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`currencies_id`);
  ADD UNIQUE KEY `currencies_iso` (`currencies_iso`(5));

--
-- Indexes for table `eye_colors`
--
ALTER TABLE `eye_colors`
  ADD PRIMARY KEY (`eye_colors_id`);
  ADD UNIQUE KEY `eye_colors_color` (`eye_colors_color`(25));

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`genders_id`);
  ADD UNIQUE KEY `genders_name` (`genders_name`(25));

--
-- Indexes for table `hair_colors`
--
ALTER TABLE `hair_colors`
  ADD PRIMARY KEY (`hair_colors_id`);
  ADD UNIQUE KEY `hair_colors_color` (`hair_colors_color`(25));

--
-- Indexes for table `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`locales_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locations`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`nationalities_id`);
    ADD UNIQUE KEY `nationalities_name` (`nationalities_name`(25));

--
-- Indexes for table `privacy_levels`
--
ALTER TABLE `privacy_levels`
  ADD PRIMARY KEY (`privacy_levels_id`),
  ADD UNIQUE KEY `privacy_levels_name` (`privacy_levels_name`(50));

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`posts_id`);

--
-- Indexes for table `spoken_languages`
--
ALTER TABLE `spoken_languages`
  ADD PRIMARY KEY (`spoken_languages_id`);
  ADD UNIQUE KEY `spoken_languages_name` (`spoken_languages_name`(50));

--
-- Indexes for table `sexualities`
--
ALTER TABLE `sexualities`
  ADD PRIMARY KEY (`sexualities_id`);
  ADD UNIQUE KEY `sexualities_name` (`sexualities_name`(50));

--
-- Indexes for table `time_zones`
--
ALTER TABLE `time_zones`
  ADD PRIMARY KEY (`time_zones_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`(50));

--
-- Indexes for table `user_levels`
--
ALTER TABLE `user_levels`
  ADD PRIMARY KEY (`user_levels_id`),
  ADD UNIQUE KEY `user_levels_level` (`user_levels_level`(50));

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`user_profiles_id`);

COMMIT;
