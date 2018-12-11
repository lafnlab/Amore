<?php
#
# $sitetitle is the title of the whole site.
# 'Amore' is default, but you should change it to the name of your site.
# The site title will appear when the page title is unavailable.
$sitetitle = "Amore";

#
# $greeting is a generic greeting for any visitor to the site.
# If a user is logged in, the greeting will change to one appropriate for them.
# 'Hello' is the default, but can be changed to whatever you prefer.
$greeting = "Hello";

#
# $visitortitle is a generic term for a visitor who isn't logged in.
# 'Guest' is default, but can be changed to anything.
$visitortitle = "Guest";

#
# $posts_are_called allows the admin to change the name of the posts on their site.
# Twitter has tweets. Mastodon has toots. This site can define their own name.
$posts_are_called	= "Posts";	// plural form
$post_is_called	= "Post";	// singular form

$reposts_are_called	= "Reposts";	// plural form
$repost_is_called		= "Repost";		// singular form

#
# $users_are_called allows the admin to change the name of the users on their site.
$users_are_called	= "Users";	// plural form
$user_is_called	= "User";	// singular form

#
# $open_registration determines whether potential users can create their own accounts.
# Default is TRUE.
# Change to FALSE if registrations are closed.
$open_registration = TRUE;

#
# $bannednames is an array of banned usernames. Users will not be able to register them, but the site admin can caret them if desired
$bannednames = array(
						"a hitler",
						"a. hitler",
						"adolf hitler",
						"a. hilter",
						"a hilter",
						"mr. hitler",
						"herr hitler",
						"mr. hilter",
						"hitler",
						"admin",
						"administrator",
						"mod",
						"moderator",
						"modmin",
						"daddy",
						"dad",
						"mommy",
						"mom",
						"god",
						"allah",
						"yahweh",
						"buddha",
						"deus",
						"death",
						"morte",
						"muerte",
						"deces",
						"nigger",
						"spic",
						"hebe",
						"kike");
?>
