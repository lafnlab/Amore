<?php
/*
 * pub/dash/the-eye-color.php
 *
 * Displays an eye color.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../conn.php";
include			"../../functions.php";

if (isset($_GET["eid"])) {
	$sel_id = $_GET["eid"];
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

	$eyeq = "SELECT * FROM eye_colors WHERE eye_colors_id=\"".$sel_id."\"";
	$eyequery = mysqli_query($dbconn,$eyeq);
	while($eyeopt = mysqli_fetch_assoc($eyequery)) {
		$eyeid		= $eyeopt['eye_colors_id'];
		$eyecolor	= $eyeopt['eye_colors_color'];
	}
}

$pagetitle = $eyecolor;
include_once "dash-header.php";
include_once "dash-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($eyecolor); ?></h4>
				<!-- in the future, this might be a list of people with this eye color -->
			</div>
		</article>
<?php
include_once "dash-footer.php";
?>
