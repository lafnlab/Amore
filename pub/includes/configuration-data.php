<?php
/*
 * pub/includes/configuration-data.php
 *
 * This page is a template to get the website's configuration from the database.
 *
 * since Amore version 0.3
 *
 */

// let's get the configuration data

$mysiteq = "SELECT * FROM configuration WHERE primary_key='".SITEKEY."'";
$mysitequery = mysqli_query($dbconn,$mysiteq);
while ($mysiteopt = mysqli_fetch_assoc($mysitequery)) {
	$website_url										= $mysiteopt['website_url'];
	$website_name										= $mysiteopt['website_name'];
	$website_description								= $mysiteopt['website_description'];
	$default_locale									= $mysiteopt['default_locale'];
	$open_registration								= $mysiteopt['open_registrations'];
	$posts_are_called									= $mysiteopt['posts_are_called'];
	$post_is_called									= $mysiteopt['post_is_called'];
	$reposts_are_called								= $mysiteopt['reposts_are_called'];
	$repost_is_called									= $mysiteopt['repost_is_called'];
	$users_are_called									= $mysiteopt['users_are_called'];
	$user_is_called									= $mysiteopt['user_is_called'];
	$favorites_are_called							= $mysiteopt['favorites_are_called'];
	$favorite_is_called								= $mysiteopt['favorite_is_called'];
	$dislikes_are_caled								= $mysiteopt['dislikes_are_called'];
	$dislike_is_called								= $mysiteopt['dislike_is_called'];
	$max_post_length									= $mysiteopt['max_post_length'];
	$allow_user_age_privacy							= $mysiteopt['allow_user_age_privacy'];
	$allow_user_gender_privacy						= $mysiteopt['allow_user_gender_privacy'];
	$allow_user_sexuality_privacy					= $mysiteopt['allow_user_sexuality_privacy'];
	$allow_user_relationship_status_privacy	= $mysiteopt['allow_user_relationship_status_privacy'];
	$allow_user_location_privacy					= $mysiteopt['allow_user_location_privacy'];
	$allow_user_nationality_privacy				= $mysiteopt['allow_user_nationality_privacy'];
	$allow_user_time_zone_privacy					= $mysiteopt['allow_user_time_zone_privacy'];
	$display_home_page_login_form					= $mysiteopt['display_home_page_login_form'];
	$display_home_page_users_quantity			= $mysiteopt['display_home_page_users_quantity'];
	$display_home_page_posts_quantity			= $mysiteopt['display_home_page_posts_quantity'];
	$display_home_page_statistics_link			= $mysiteopt['display_home_page_statistics_link'];
	$display_home_page_about_link					= $mysiteopt['display_home_page_about_link'];
	$display_home_page_privacy_policy_link		= $mysiteopt['display_home_page_privacy_policy_link'];
	$display_home_page_site_description			= $mysiteopt['display_home_page_site_description'];
	$display_home_page_meta_description			= $mysiteopt['display_home_page_meta_description'];
	$display_home_page_admin_info					= $mysiteopt['display_home_page_admin_info'];
	$display_home_page_timeline					= $mysiteopt['display_home_page_timeline'];
	$list_with_the_federation_info				= $mysiteopt['list_with_the_federation_info'];
	$list_with_fediverse_network					= $mysiteopt['list_with_fediverse_network'];
	$list_with_amore_social							= $mysiteopt['list_with_amore_social'];
	$list_with_dating_media							= $mysiteopt['list_with_dating_media'];
}
?>
