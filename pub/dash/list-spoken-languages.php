<?php
/*
 * pub/dash/list-spoken-languages.php
 *
 * Displays a list of spoken languages in the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../conn.php";
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
<!-- gets a list of spoken languages -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a spoken language ')."<a href=\"add-spoken-language.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo _("List of spoken languages"); ?></h4>
				<table>
<?php
		$spkq = "SELECT * FROM spoken_languages ORDER BY spoken_languages_name ASC";
		$spkquery = mysqli_query($dbconn,$spkq);

		while ($spkopt = mysqli_fetch_assoc($spkquery)) {
			$spk_name	= $spkopt['spoken_languages_name'];
			$spk_id		= $spkopt['spoken_languages_id'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-spoken-language.php?spid=".$spk_id."\">"._($spk_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-spoken-language.php?spid=".$spk_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-spoken-language.php?spid=".$spk_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "dash-footer.php";
?>
