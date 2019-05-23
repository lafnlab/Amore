<?php
/*
 * pub/dash/the-user.php
 *
 * Displays a user.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../conn.php";
include			"../../functions.php";

if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
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

	$userq = "SELECT * FROM users WHERE user_id=\"".$sel_id."\"";
	$userquery = mysqli_query($dbconn,$userq);
	while($useropt = mysqli_fetch_assoc($userquery)) {
		$userid			= $useropt['user_id'];
		$username		= $useropt['user_name'];
		$useremail		= $useropt['user_email'];
		$userdob			= $useropt['user_date_of_birth'];
		$usersince		= $useropt['user_created'];
		$userlast		= $useropt['user_last_login'];
	}
}

$pagetitle = $dinname;
include_once "dash-header.php";
include_once "dash-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($username); ?></h4>
				<table>
					<tr>
						<td><?php echo _('ID'); ?></td><td><?php echo $userid;?></td>
					</tr>
					<tr>
						<td><?php echo _('Email'); ?></td><td><?php echo $useremail;?></td>
					</tr>
					<tr>
						<td><?php echo _('Date of birth'); ?></td><td><?php echo $userdob;?></td>
					</tr>
					<tr>
						<td><?php echo _('Joined'); ?></td><td><?php echo $usersince;?></td>
					</tr>
					<tr>
						<td><?php echo _('Last login'); ?></td><td><?php echo $userlast;?></td>
					</tr>
				</table>
			</div>
		</article>
<?php
include_once "dash-footer.php";
?>
