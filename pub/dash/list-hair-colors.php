<?php
/*
 * pub/dash/list-hair-colors.php
 *
 * Displays a list of hair colors in the database.
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

$pagetitle = _("List of hair colors");


include_once "dash-header.php";
include_once "dash-nav.php";
?>
<!-- gets a list of hair colors -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a hair color ')."<a href=\"add-hair-color.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo $pagetitle; ?></h4>
				<table>
<?php
		$harq = "SELECT * FROM hair_colors ORDER BY hair_colors_color ASC";
		$harquery = mysqli_query($dbconn,$harq);

		while ($haropt = mysqli_fetch_assoc($harquery)) {
			$har_name	= $haropt['hair_colors_color'];
			$har_id		= $haropt['hair_colors_id'];
			echo "\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-hair-color.php?hid=".$har_id."\">"._($har_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-hair-color.php?hid=".$har_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-hair-color.php?hid=".$har_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "dash-footer.php";
?>
