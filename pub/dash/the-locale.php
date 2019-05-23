<?php
/*
 * pub/dash/the-locale.php
 *
 * Displays a locale.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../conn.php";
include			"../../functions.php";

if (isset($_GET["i18id"])) {
	$sel_id = $_GET["i18id"];
} else {
	$sel_id = "";
}

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

if ($sel_id != '') {

	$i18q = "SELECT * FROM locales WHERE locales_id=\"".$sel_id."\"";
	$i18query = mysqli_query($dbconn,$i18q);
	while($i18opt = mysqli_fetch_assoc($i18query)) {
		$i18id		= $i18opt['locales_id'];
		$i18lang		= $i18opt['locales_language'];
		$i18ctry		= $i18opt['locales_country'];
	}
}
if ($i18_ctry != '') {
	$pagetitle = $i18lang."_".$i18ctry;
} else {
	$pagetitle = $i18lang;
}
include_once "dash-header.php";
include_once "dash-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<table class="w3-card-2 w3-theme-l3 w3-padding">
				<caption><?php echo _($pagetitle); ?></caption>
				<tr>
					<th><?php echo _('Language'); ?></th>
					<th><?php echo _('Country'); ?></th>
				</tr>
				<tr>
					<td><?php echo _($i18lang); ?></td>
					<td><?php echo _($i18ctry); ?></td>
				</tr>
			</table>
		</article>
<?php
include_once "dash-footer.php";
?>
