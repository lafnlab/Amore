<?php
/*
 * pub/dash/list-locales.php
 *
 * Displays a list of locales in the database.
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

include_once "dash-header.php";
include_once "dash-nav.php";
?>
<!-- gets a list of locales -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a locale ')."<a href=\"add-locale.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo _("List of locales"); ?></h4>
				<table>
<?php
		$i18q = "SELECT * FROM locales ORDER BY locales_language,locales_country ASC";
		$i18query = mysqli_query($dbconn,$i18q);

		while ($i18opt = mysqli_fetch_assoc($i18query)) {
			$i18_lang	= $i18opt['locales_language'];
			$i18_ctry	= $i18opt['locales_country'];
			$i18_id		= $i18opt['locales_id'];
			echo "\t\t\t\t<tr>\n";
			if ($i18_ctry != '') {
				echo "\t\t\t\t\t\t<td><a href=\"the-locale.php?i18id=".$i18_id."\">".$i18_lang."_".$i18_ctry."</a></td>\n";
			} else {
				echo "\t\t\t\t\t\t<td><a href=\"the-locale.php?i18id=".$i18_id."\">".$i18_lang."</a></td>\n";
			}
			echo "\t\t\t\t\t\t<td><a href=\"edit-locale.php?i18id=".$i18_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-locale.php?i18id=".$i18_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "dash-footer.php";
?>
