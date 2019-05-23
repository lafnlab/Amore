<?php
/*
 * pub/dash/the-time-zone.php
 *
 * Displays a time zone.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../conn.php";
include			"../../functions.php";

if (isset($_GET["tzid"])) {
	$sel_id = $_GET["tzid"];
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

	$tztq = "SELECT * FROM time_zones WHERE time_zones_id=\"".$sel_id."\"";
	$tztquery = mysqli_query($dbconn,$tztq);
	while($tztopt = mysqli_fetch_assoc($tztquery)) {
		$tztid		= $tztopt['time_zones_id'];
		$tztabbr		= $tztopt['time_zones_abbreviation'];
		$tztname		= $tztopt['time_zones_name'];
		$tztoff		= $tztopt['time_zones_offset'];
		$tztdst		= $tztopt['time_zones_dst_offset'];
	}
}

$pagetitle = $tztname;
include_once "dash-header.php";
include_once "dash-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<table class="w3-card-2 w3-theme-l3 w3-padding">
				<caption><?php echo _($pagetitle); ?></caption>
				<tr>
					<th><?php echo _('Name'); ?></th>
					<th><?php echo _('Offset'); ?></th>
					<th><?php echo _('DST offset'); ?></th>
				</tr>
				<tr>
					<td><?php echo _($tztname); ?></td>
					<td><?php echo _($tztoff); ?></td>
					<td><?php echo _($tztdst); ?></td>
				</tr>
			</table>
		</article>
<?php
include_once "dash-footer.php";
?>
