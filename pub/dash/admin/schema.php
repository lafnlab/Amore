<?php
/*
 * pub/dash/admin/schema.php
 *
 * Creates the tables in the database.
 *
 * since Amore version 0.3
 *
 */

/*
 * conn.php may not have been put in its proper spot yet
 */
if (file_exists("../../../conn.php")) {
	include_once  "../../../conn.php";
} else if (file_exists("../../conn.php")) {
	include_once "../../conn.php";
} else die("Unable to find file conn.php. Have you moved it to the correct directory?");
include			"../../../functions.php";
require			"../../includes/database-connect.php";


/*
 * Let's start creating some tables
 */

//
// Create the actor_types table
// FYI: https://www.w3.org/TR/activitystreams-core/#actors
//
  $actor_types_tbl_comment = _("Table for ActivityStreams Actor types.");

  $create_actor_types_tbl = "CREATE TABLE actor_types (
    actor_type_id varchar(10) NOT NULL,
    actor_type_name tinytext NOT NULL,
    PRIMARY KEY (actor_type_id),
    UNIQUE KEY actor_type_name (actor_type_name(20))
  ) DEFAULT CHARSET=utf8 COMMENT='".$actor_types_tbl_comment."'";

  if (mysqli_query($dbconn,$create_actor_types_tbl)) {
    /* translators: Do not translate actor_types in following message */
    echo _("Table <i>actor_types</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate actor_types in following message */
    echo _("Error: Could not create table <i>actor_types</i>.")."<br>\n\n";
  }

//
// Fill the actor_types table with some default data
//
  $fill_actor_types_tbl = "INSERT INTO actor_types (
                  actor_type_id,
                  actor_type_name
                ) VALUES
                ('ЛNgòЧPуùMF', 'APPLICATION'),
                ('ПøÎÐцйþоNT', 'GROUP'),
                ('ХÉdôüzÍГùф', 'PERSON'),
                ('ъÅåCÒ7ÚщSã', 'SERVICE'),
                ('ЪшoеуЦFfиË', 'ORGANIZATION')";

  if (mysqli_query($dbconn,$fill_actor_types_tbl)) {
    /* translators: Do not translate actor_types in following message */
    echo _("Default data added to table <i>actor_types</i>.")."<br>\n\n";
  } else {
    /* translators: Do not translate actor_types in following message */
    echo _("Error: Could not add data to table <i>actor_types</i>.")."<br>\n\n";
  }


//
// Create the configuration table
//
  $configuration_tbl_comment = _("Table for website configuration.");
  $admin_account_field_comment = _("This will be the first account created.");
  $default_yes = _("The default setting is yes.");
  $default_no	= _("The default setting is no.");

  $create_configuration_tbl = "CREATE TABLE configuration (
    primary_key varchar(10) NOT NULL,
    website_url tinytext NOT NULL,
    website_name tinytext NOT NULL,
    website_description text NOT NULL,
    default_locale tinytext NOT NULL,
    open_registrations BOOLEAN DEFAULT 0 COMMENT '".$default_no."',
    admin_account tinytext NOT NULL COMMENT '".$admin_account_field_comment."',
    admin_email tinytext NOT NULL,
    posts_are_called tinytext NOT NULL,
    post_is_called tinytext NOT NULL,
    reposts_are_called tinytext NOT NULL,
    repost_is_called tinytext NOT NULL,
    users_are_called tinytext NOT NULL,
    user_is_called tinytext NOT NULL,
    favorites_are_called tinytext NOT NULL,
    favorite_is_called tinytext NOT NULL,
    dislikes_are_called tinytext NOT NULL,
    dislike_is_called tinytext NOT NULL,
    max_post_length smallint NOT NULL DEFAULT 500,
    banned_user_names text NOT NULL,
    deleted_user_names text NOT NULL,
    allow_user_age_privacy varchar(10) NOT NULL,
    allow_user_gender_privacy varchar(10) NOT NULL,
    allow_user_sexuality_privacy varchar(10) NOT NULL,
    allow_user_relationship_status_privacy varchar(10) NOT NULL,
    allow_user_location_privacy varchar(10) NOT NULL,
    allow_user_nationality_privacy varchar(10) NOT NULL,
    allow_user_time_zone_privacy varchar(10) NOT NULL,
    display_home_page_login_form BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    display_home_page_users_quantity BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    display_home_page_posts_quantity BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    display_home_page_statistics_link BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    display_home_page_about_link BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    display_home_page_privacy_policy_link BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    display_home_page_site_description BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    display_home_page_meta_description BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    display_home_page_admin_info BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    display_home_page_timeline BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    list_with_the_federation_info BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    list_with_fediverse_network BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    list_with_amore_social BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    list_with_dating_media BOOLEAN DEFAULT 1 COMMENT '".$default_yes."',
    PRIMARY KEY (primary_key)
  ) DEFAULT CHARSET=utf8 COMMENT='".$configuration_tbl_comment."'";

  if (mysqli_query($dbconn,$create_configuration_tbl)) {
    /* translators: Do not translate configuration in following message */
    echo _("Table <i>configuration</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate configuration in following message */
    echo _("Error: Could not create table <i>configuration</i>.")."<br>\n\n";
  }

//
// Fill the configuration table with some default data
//
  $default_website_description = _("Another fine website made with Amore.");

  $fill_configuration_tbl = "INSERT INTO configuration (
                    primary_key,
                    website_name,
                    website_description,
                    default_locale,
                    posts_are_called,
                    post_is_called,
                    reposts_are_called,
                    repost_is_called,
                    users_are_called,
                    user_is_called,
                    favorites_are_called,
                    favorite_is_called
                  ) VALUES (
                    '".$siteid."',
                    'Amore',
                    '".$default_website_description."',
                    'en-US',
                    'posts',
                    'post',
                    'reposts',
                    'repost',
                    'users',
                    'user',
                    'favorites',
                    'favorite')";

  if (mysqli_query($dbconn,$fill_configuration_tbl)) {
    /* translators: Do not translate configuration in following message */
    echo _("Default data added to table <i>configuration</i>.")."<br>\n\n";
  } else {
    /* translators: Do not translate configuration in following message */
    echo _("Error: Could not add data to table <i>configuration</i>.")."<br>\n\n";
  }


//
// Create the currencies table
// Table will be filled via data-fill.php
//
  $currencies_tbl_comment = _("Table for currencies/money.");

  $create_currencies_tbl = "CREATE TABLE currencies (
    currency_id varchar(10) NOT NULL,
    currency_name tinytext NOT NULL,
    currency_iso tinytext NOT NULL,
    currency_symbol varchar(15) NOT NULL DEFAULT '¤',
    currency_digital tinyint(1) NOT NULL,
    PRIMARY KEY (currency_id),
    UNIQUE KEY currency_iso (currency_iso(5))
  ) DEFAULT CHARSET=utf8 COMMENT='".$currencies_tbl_comment."'";

  if (mysqli_query($dbconn,$create_currencies_tbl)) {
    /* translators: Do not translate currencies in following message */
    echo _("Table <i>currencies</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate currencies in following message */
    echo _("Error: Could not create table <i>currencies</i>.")."<br>\n\n";
  }


//
// Create the eye_colors table
// Table will be filled via data-fill.php
//
  $eye_colors_tbl_comment = _("Table for eye colors.");

  $create_eye_colors_tbl = "CREATE TABLE eye_colors (
    eye_color_id varchar(10) NOT NULL,
    eye_color_name tinytext NOT NULL,
    PRIMARY KEY (eye_color_id),
    UNIQUE KEY eye_color_name (eye_color_name(20))
  ) DEFAULT CHARSET=utf8 COMMENT='".$eye_colors_tbl_comment."'";

  if (mysqli_query($dbconn,$create_eye_colors_tbl)) {
    /* translators: Do not translate eye_colors in following message */
    echo _("Table <i>eye_colors</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate eye_colors in following message */
    echo _("Error: Could not create table <i>eye_colors</i>.")."<br>\n\n";
  }


//
// Create the genders table
// Table will be filled via data-fill.php
//
  $genders_tbl_comment = _("Table for genders.");

  $create_genders_tbl = "CREATE TABLE genders (
    gender_id varchar(10) NOT NULL,
    gender_name tinytext NOT NULL,
    PRIMARY KEY (gender_id),
    UNIQUE KEY gender_name (gender_name(20))
  ) DEFAULT CHARSET=utf8 COMMENT='".$genders_tbl_comment."'";

  if (mysqli_query($dbconn,$create_genders_tbl)) {
    /* translators: Do not translate genders in following message */
    echo _("Table <i>genders</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate genders in following message */
    echo _("Error: Could not create table <i>genders</i>.")."<br>\n\n";
  }


//
// Create the hair_colors table
// Table will be filled via data-fill.php
//
  $hair_colors_tbl_comment = _("Table for hair colors.");

  $create_hair_colors_tbl = "CREATE TABLE hair_colors (
    hair_color_id varchar(10) NOT NULL,
    hair_color_name tinytext NOT NULL,
    PRIMARY KEY (hair_color_id),
    UNIQUE KEY hair_color_name (hair_color_name(20))
  ) DEFAULT CHARSET=utf8 COMMENT='".$hair_colors_tbl_comment."'";

  if (mysqli_query($dbconn,$create_hair_colors_tbl)) {
    /* translators: Do not translate hair_colors in following message */
    echo _("Table <i>hair_colors</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate hair_colors in following message */
    echo _("Error: Could not create table <i>hair_colors</i>.")."<br>\n\n";
  }


//
// Create the locales table
// Table will be filled as new locales are added
//
  $locales_tbl_comment = _("Table for i18n/l10n locales.");

  $create_locales_tbl = "CREATE TABLE locales (
    locale_id varchar(10) NOT NULL,
    locale_language tinytext NOT NULL,
    locale_country tinytext NOT NULL,
    PRIMARY KEY (locale_id)
  ) DEFAULT CHARSET=utf8 COMMENT='".$locales_tbl_comment."'";

  if (mysqli_query($dbconn,$create_locales_tbl)) {
    /* translators: Do not translate locales in following message */
    echo _("Table <i>locales</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate locales in following message */
    echo _("Error: Could not create table <i>locales</i>.")."<br>\n\n";
  }

//
// Fill the locales table with a locale
//
  $fill_locales_tbl = "INSERT INTO locales (
                  locale_id,
                  locale_language,
                  locale_country
                ) VALUES ('vsЙZñùÒÕСВ', 'en', 'US')";

  if (mysqli_query($dbconn,$fill_locales_tbl)) {
    /* translators: Do not translate locales in following message */
    echo _("Default data added to table <i>locales</i>.")."<br>\n\n";
  } else {
    /* translators: Do not translate locales in following message */
    echo _("Error: Could not add data to table <i>locales</i>.")."<br>\n\n";
  }


//
// Create the locations table
// Table will be filled via data-fill.php
//
  $locations_tbl_comment = _("Table for locations/places.");

  $create_locations_tbl = "CREATE TABLE locations (
    location_id varchar(10) NOT NULL,
    location_name tinytext NOT NULL,
    location_parent varchar(60) NOT NULL,
    PRIMARY KEY (location_id)
  ) DEFAULT CHARSET=utf8 COMMENT='".$locations_tbl_comment."'";

  if (mysqli_query($dbconn,$create_locations_tbl)) {
    /* translators: Do not translate locations in following message */
    echo _("Table <i>locations</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate locations in following message */
    echo _("Error: Could not create table <i>locations</i>.")."<br>\n\n";
  }


//
// Create the nationalities table
// Table will be filled via data-fill.php
//
  $nationalities_tbl_comment = _("Table for nationalities.");

  $create_nationalities_tbl = "CREATE TABLE nationalities (
    nationality_id varchar(10) NOT NULL,
    nationality_name tinytext NOT NULL,
    PRIMARY KEY (nationality_id),
    UNIQUE KEY nationality_name (nationality_name(20))
  ) DEFAULT CHARSET=utf8 COMMENT='".$nationalities_tbl_comment."'";

  if (mysqli_query($dbconn,$create_nationalities_tbl)) {
    /* translators: Do not translate nationalities in following message */
    echo _("Table <i>nationalities</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate nationalities in following message */
    echo _("Error: Could not create table <i>nationalities</i>.")."<br>\n\n";
  }


//
// Create the privacy levels table
//
  $privacy_levels_tbl_comment = _("Table for Amore privacy levels");

  $create_privacy_levels_tbl = "CREATE TABLE privacy_levels (
    privacy_level_id varchar(10) NOT NULL,
    privacy_level_name tinytext NOT NULL,
    PRIMARY KEY (privacy_level_id),
    UNIQUE KEY privacy_level_name (privacy_level_name(20))
  ) DEFAULT CHARSET=utf8 COMMENT='".$privacy_levels_tbl_comment."'";

  if (mysqli_query($dbconn,$create_privacy_levels_tbl)) {
    /* translators: Do not translate privacy_levels in following message */
    echo _("Table <i>privacy_levels</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate privacy_levels in following message */
    echo _("Error: Could not create table <i>privacy_levels</i>.")."<br>\n\n";
  }

//
// Fill the privacy_levels table with some default data
// Some of these are aspirational
//
  $fill_privacy_levels_tbl = "INSERT INTO privacy_levels (
                            privacy_level_id,
                            privacy_level_name
                          ) VALUES
                          ('РЖFÂå1ÔÏúL','INSTANCE'),
                          ('6ьötХ5áзÚZ','EVERYONE'),
                          ('ñToùòхаþOЪ','SELF'),
                          ('ÓÇfXЦИфЕaù','PRIVATE'),
                          ('óСПõöRærÊh','FOLLOWERS'),
                          ('ÞБЯÍcOъøДS','FRIENDS'),
                          ('щÊдrûOftÐÿ','FEDIVERSE')";

  if (mysqli_query($dbconn,$fill_privacy_levels_tbl)) {
    /* translators: Do not translate privacy_levels in following message */
    echo _("Default data added to table <i>privacy_levels</i>.")."<br>\n\n";
  } else {
    /* translators: Do not translate privacy_levels in following message */
    echo _("Error: Could not add data to table <i>privacy_levels</i>.")."<br>\n\n";
  }


//
// Create the posts table
//
  $posts_tbl_comment = _("Table for posts.");
  $post_privacy_level_comment = _("Default privacy level is for Everyone.");

  $create_posts_tbl = "CREATE TABLE posts (
    post_id varchar(10) NOT NULL,
    post_by varchar(10) NOT NULL,
    post_timestamp datetime NOT NULL,
    post_text text NOT NULL,
    post_privacy_level varchar(10) NOT NULL DEFAULT '6ьötХ5áзÚZ' COMMENT '".$post_privacy_level_comment."',
    post_shares text NOT NULL,
    post_likes text NOT NULL,
    post_dislikes text NOT NULL,
    post_flagged BOOLEAN DEFAULT 0,
    post_flagged_by varchar(10),
    post_flagged_on datetime,
    post_deleted_by varchar(10),
    post_deleted_on datetime,
    PRIMARY KEY (post_id)
  ) DEFAULT CHARSET=utf8 COMMENT='".$posts_tbl_comment."'";

  if (mysqli_query($dbconn,$create_posts_tbl)) {
    /* translators: Do not translate posts in following message */
    echo _("Table <i>posts</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate posts in following message */
    echo _("Error: Could not create table <i>posts</i>.")."<br>\n\n";
  }


//
// Create the relationship_statuses table
//
  $relationship_statuses_tbl_comment = _("Table for relationship statuses");

  $create_relationship_statuses_tbl = "CREATE TABLE relationship_statuses (
    relationship_status_id varchar(10) NOT NULL,
    relationship_status_name tinytext NOT NULL,
    PRIMARY KEY (relationship_status_id),
    UNIQUE KEY relationship_status_name (relationship_status_name(30))
  ) DEFAULT CHARSET=utf8 COMMENT='".$relationship_statuses_tbl_comment."'";

  if (mysqli_query($dbconn,$create_relationship_statuses_tbl)) {
    /* translators: Do not translate relationship_statuses in following message */
    echo _("Table <i>relationship_statuses</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate relationship_statuses in following message */
    echo _("Error: Could not create table <i>relationship_statuses</i>.")."<br>\n\n";
  }

//
// Fill the relationship_statuses table
//
  $fill_relationship_statuses_tbl = "INSERT INTO relationship_statuses (
                              relationship_status_id,
                              relationship_status_name
                            ) VALUES
                            ('9PÄå0kÃúeÔ', 'SEEING SOMEONE'),
                            ('ÄÆäxndО8оÀ', 'DIVORCED'),
                            ('àйuÛаÌзЬÀE', 'PREFER NOT TO ANSWER'),
                            ('jвÜлæûАюцY', 'SEEING MORE THAN ONE PERSON'),
                            ('QÃLHХЬrзÏç', 'WIDOWED'),
                            ('ûÁAéøhЩпâэ', 'IN A RELATIONSHIP WITH MORE THEN ONE PERSON'),
                            ('ùУçÕÒýАхhI', 'SEPARATED'),
                            ('vOЪÒóоÎðЕõ', 'COMPLICATED'),
                            ('зХÏcÝЧiпHÔ', 'IN MORE THAN ONE RELATIONSHIP'),
                            ('мøYТPАä4зÂ', 'SINGLE'),
                            ('ОГî2tçqW9Ø', 'IN A RELATIONSHIP'),
                            ('щЮМфОÓþÐÕâ', 'ENGAGED'),
                            ('ъyлØøЪАẞCe', 'MARRIED')";

  if (mysqli_query($dbconn,$fill_relationship_statuses_tbl)) {
    /* translators: Do not translate relationship_statuses in following message */
    echo _("Default data added to table <i>relationship_statuses</i>.")."<br>\n\n";
  } else {
    /* translators: Do not translate relationship_statuses in following message */
    echo _("Error: Could not add data to table <i>relationship_statuses</i>.")."<br>\n\n";
  }


//
// Create the spoken_languages table
// Table will be filled via data-fill.php
//
  $spoken_languages_tbl_comment = _("Table for spoken languages");

  $create_spoken_languages_tbl = "CREATE TABLE spoken_languages (
    spoken_language_id varchar(10) NOT NULL,
    spoken_language_name tinytext NOT NULL,
    PRIMARY KEY (spoken_language_id),
    UNIQUE KEY spoken_language_name (spoken_language_name(20))
  ) DEFAULT CHARSET=utf8 COMMENT='".$spoken_languages_tbl_comment."'";

  if (mysqli_query($dbconn,$create_spoken_languages_tbl)) {
    /* translators: Do not translate spoken_languages in following message */
    echo _("Table <i>spoken_languages</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate spoken_languages in following message */
    echo _("Error: Could not create table <i>spoken_languages</i>.")."<br>\n\n";
  }


//
// Create the sexualities tables
// Table will be filled via data-fill.php
//
  $sexualities_tbl_comment = _("Table for sexualities");

  $create_sexualities_tbl = "CREATE TABLE sexualities (
    sexuality_id varchar(10) NOT NULL,
    sexuality_name tinytext NOT NULL,
    PRIMARY KEY (sexuality_id),
    UNIQUE KEY sexuality_name (sexuality_name(20))
  ) DEFAULT CHARSET=utf8 COMMENT='".$sexualities_tbl_comment."'";

  if (mysqli_query($dbconn,$create_sexualities_tbl)) {
    /* translators: Do not translate sexualities in following message */
    echo _("Table <i>sexualities</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate sexualities in following message */
    echo _("Error: Could not create table <i>sexualities</i>.")."<br>\n\n";
  }


//
// Create the time zones table
// Table will be filled via data-fill.php
//
  $time_zones_tbl_comment = _("Table for time zones");
  $DST_offset_comment = _("Offset if Daylight Savings Time is used");

  $create_time_zones_tbl = "CREATE TABLE time_zones (
    time_zone_id varchar(10) NOT NULL,
    time_zone_name tinytext NOT NULL,
    time_zone_offset tinytext NOT NULL,
    time_zone_DST_offset tinytext NOT NULL COMMENT '".$DST_offset_comment."',
    PRIMARY KEY (time_zone_id),
    UNIQUE KEY time_zone_name (time_zone_name(30))
  ) DEFAULT CHARSET=utf8 COMMENT='".$time_zones_tbl_comment."'";

  if (mysqli_query($dbconn,$create_time_zones_tbl)) {
    /* translators: Do not translate time_zones in following message */
    echo _("Table <i>time_zones</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate time_zones in following message */
    echo _("Error: Could not create table <i>time_zones</i>.")."<br>\n\n";
  }


//
// Create the users table
//
  $users_tbl_comment = _("Table for users");
  $display_name_field_comment = _("This is the same as the ActivityPub preferredUsername");

  $create_users_tbl = "CREATE TABLE users (
    user_id varchar(10) NOT NULL,
    user_name tinytext NOT NULL,
    user_display_name tinytext NOT NULL COMMENT '".$display_name_field_comment."',
    user_pass tinytext NOT NULL,
    user_email tinytext NOT NULL,
    user_date_of_birth date NOT NULL,
    user_date_of_birth_privacy varchar(10) NOT NULL,
    user_level varchar(10) NOT NULL,
    user_actor_type varchar(10) NOT NULL,
    user_outbox text NOT NULL,
    user_inbox text NOT NULL,
    user_liked text NOT NULL,
    user_disliked text NOT NULL,
    user_follows text NOT NULL,
    user_followers text NOT NULL,
    user_priv_key text NOT NULL,
    user_pub_key text NOT NULL,
    user_avatar tinytext,
    user_gender varchar(10) NOT NULL,
    user_gender_privacy varchar(10) NOT NULL,
    user_sexuality varchar(10) NOT NULL,
    user_sexuality_privacy varchar(10) NOT NULL,
    user_relationship_status varchar(10) NOT NULL,
    user_relationship_status_privacy varchar(10) NOT NULL,
    user_eye_color varchar(10) NOT NULL,
    user_hair_color varchar(10) NOT NULL,
    user_location varchar(10) NOT NULL,
    user_location_privacy varchar(10) NOT NULL,
    user_nationality varchar(10) NOT NULL,
    user_nationality_privacy varchar(10) NOT NULL,
    user_locale varchar(10) NOT NULL,
    user_spoken_language varchar(60) NOT NULL,
    user_time_zone varchar(10) NOT NULL,
    user_time_zone_privacy varchar(10) NOT NULL,
    user_bio tinytext NOT NULL,
    user_is_suspended datetime,
    user_suspended_on datetime,
    user_suspended_by varchar(10),
    user_is_banned BOOLEAN DEFAULT 0,
    user_banned_on datetime,
    user_banned_by varchar(10),
    user_created datetime NOT NULL,
    user_last_login datetime NOT NULL,
    PRIMARY KEY (user_id),
    UNIQUE KEY user_name (user_name(20))
  ) DEFAULT CHARSET=utf8 COMMENT='".$users_tbl_comment."'";

  if (mysqli_query($dbconn,$create_users_tbl)) {
    /* translators: Do not translate users in following message */
    echo _("Table <i>users</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate users in following message */
    echo _("Error: Could not create table <i>users</i>.")."<br>\n\n";
  }


//
// Create the user_levels table
//
  $user_levels_tbl_comment = _("Table for user levels");

  $create_user_levels_tbl = "CREATE TABLE user_levels (
    user_level_id varchar(10) NOT NULL,
    user_level_name tinytext NOT NULL,
    PRIMARY KEY (user_level_id),
    UNIQUE KEY user_level_name (user_level_name(20))
  ) DEFAULT CHARSET=utf8 COMMENT='".$user_levels_tbl_comment."'";

  if (mysqli_query($dbconn,$create_user_levels_tbl)) {
    /* translators: Do not translate user_levels in following message */
    echo _("Table <i>user_levels</i> successfully created.")."<br>\n\n";
  } else {
    /* translators: Do not translate user_levels in following message */
    echo _("Error: Could not create table <i>user_levels</i>.")."<br>\n\n";
  }

//
// Fill the user_levels table with some default data
//
  $fill_user_levels_tbl = "INSERT INTO user_levels (
                      user_level_id,
                      user_level_name
                    ) VALUES
                    ('sеÔÞLÉзBТт', 'USER'),
                    ('ÛГUojЭПEЯÉ', 'MODERATOR'),
                    ('ДÖÍsöÊкÔnц', 'TRANSLATOR'),
                    ('ЗиóВéèàwVO', 'ADMINISTRATOR'),
                    ('ЮêlùсdzЕХР', 'GUIDE')";

  if (mysqli_query($dbconn,$fill_user_levels_tbl)) {
    /* translators: Do not translate user_levels in following message */
    echo _("Default data added to table <i>user_levels</i>.")."<br>\n\n";
  } else {
    /* translators: Do not translate user_levels in following message */
    echo _("Error: Could not add data to table <i>user_levels</i>.")."<br>\n\n";
  }

//
// Now that the tables are created, let's fill most of them
//
redirect("data-fill.php");
?>
