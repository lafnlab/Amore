<?php
/*
 * pub/dash/the-relationship-status.php
 *
 * Displays a relationship-status.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../conn.php";
include			"../../functions.php";

if (isset($_GET["rid"])) {
	$sel_id = $_GET["rid"];
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

	$relq = "SELECT * FROM relationship_statuses WHERE relationship_status_id=\"".$sel_id."\"";
	$relquery = mysqli_query($dbconn,$relq);
	while($relopt = mysqli_fetch_assoc($relquery)) {
		$relid    = $relopt['relationship_status_id'];
		$relname  = $relopt['relationship_status_name'];
	}
}

$pagetitle = $relname;
include_once "dash-header.php";
include_once "dash-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($relname); ?></h4>
				<!-- in the future, this might be a list of people with this relationship status -->
			</div>
		</article>
<?php
include_once "dash-footer.php";
?>
