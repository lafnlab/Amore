<?php
/*
 * pub/dash/list-genders.php
 *
 * Displays a list of genders in the database.
 *
 * since Amore version 0.1
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

$pagetitle = "List of genders";


include_once "dash-header.php";
include_once "dash-nav.php";
?>
<!-- gets a list of genders -->
		<article class="w3-col w3-panel w3-cell m9">
			<table class="w3-card-2 w3-theme-l3 w3-padding">
				<caption><?php echo _('Genders'); ?></caption>
<?php
		$genq = "SELECT * FROM genders ORDER BY genders_name ASC";
		$genquery = mysqli_query($dbconn,$genq);

		while ($genopt = mysqli_fetch_assoc($genquery)) {
			$gen_name	= $genopt['genders_name'];
			$gen_id		= $genopt['genders_id'];
			echo "\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t<td><a href=\"the-gender.php?gid=".$gen_id."\">"._($gen_name)."</a></td>\n";
			echo "\t\t\t\t\t<td><a href=\"edit-gender.php?gid=".$gen_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t<td><a href=\"delete-gender.php?gid=".$gen_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t</tr>\n";
		}
?>
			</table>
		</article>
<?php
include_once "dash-footer.php";
?>
