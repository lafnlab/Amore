<?php
/*
 * pub/dash/list-users.php
 *
 * Displays a list of users in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../conn.php";
#include_once	"../config.php";
include			"../../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

// let's get the configuration data

$mysiteq = "SELECT * FROM configuration WHERE primary_key='".SITEKEY."'";
$mysitequery = mysqli_query($dbconn,$mysiteq);
while ($mysiteopt = mysqli_fetch_assoc($mysitequery)) {
	$website_url				= $mysiteopt['website_url'];
	$website_name				= $mysiteopt['website_name'];
	$website_description		= $mysiteopt['website_description'];
	$default_locale			= $mysiteopt['default_locale'];
	$open_registration		= $mysiteopt['open_registrations'];
	$posts_are_called			= $mysiteopt['posts_are_called'];
	$post_is_called			= $mysiteopt['post_is_called'];
	$reposts_are_called		= $mysiteopt['reposts_are_called'];
	$repost_is_called			= $mysiteopt['repost_is_called'];
	$users_are_called			= $mysiteopt['users_are_called'];
	$user_is_called			= $mysiteopt['user_is_called'];
	$favorites_are_called	= $mysiteopt['favorites_are_called'];
	$favorite_is_called		= $mysiteopt['favorite_is_called'];
	$max_post_length			= $mysiteopt['max_post_length'];
}

$pagetitle = "List of users";


include_once "dash-header.php";
include_once "dash-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a user ')."<a href=\"add-user.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo _($pagetitle); ?></h4>
				<table>
<?php
				$usq = "SELECT * FROM users ORDER BY user_name ASC";
				$usquery = mysqli_query($dbconn,$usq);

				while ($usopt = mysqli_fetch_assoc($usquery)) {
					$usrid		= $usopt['user_id'];
					$usrname		= $usopt['user_name'];

					echo "\t\t\t\t\t<tr>\n";
					echo "\t\t\t\t\t\t<td><a href=\"the-user.php?uid=".$usrid."\">".$usrname."</a></td>\n";
					echo "\t\t\t\t\t\t<td><a href=\"edit-user.php?uid=".$usrid."\">"._('Edit')."</a></td>\n";
					echo "\t\t\t\t\t\t<td><a href=\"suspend-user.php?uid=".$usrid."\">"._('Suspend')."</a></td>\n";
					echo "\t\t\t\t\t\t<td><a href=\"ban-user.php?uid=".$usrid."\">"._('Ban')."</a></td>\n";
					echo "\t\t\t\t\t\t<td><a href=\"delete-user.php?uid=".$usrid."\">"._('Delete')."</a></td>\n";
					echo "\t\t\t\t\t</tr>\n";
				}
?>
				</table>
			</div>
		</article>
<?php
include_once "dash-footer.php";
?>