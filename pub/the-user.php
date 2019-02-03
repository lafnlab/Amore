<?php
/*
 * pub/the-user.php
 *
 * Displays a public information about a user
 *
 * since Amore version 0.1
 */

include_once	"../conn.php";
include			"../functions.php";

// see if a session is set and get the username, if so.
if (isset($_COOKIE['uname'])) {
	$visitortitle = $_COOKIE['uname'];
} else {
	$visitortitle = _('Guest');
}

// get the ID for the user whose page this is
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
}

if ($sel_id != '') {

	$usrq = "SELECT * FROM users WHERE user_id=\"".$sel_id."\"";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usr_opt = mysqli_fetch_assoc($usrquery)) {
		$userid		= $usr_opt['user_id'];
		$username	= $usr_opt['user_name'];
		$userstart	= $usr_opt['user_created'];
		$userlast	= $usr_opt['user_last_seen'];
	}

	// get posts from this user
#		$pst_q = "SELECT * FROM posts WHERE posts_by=\"".$postby."\" AND WHERE posts_privacy_level=\"6ьötХ5áзÚZ\" ORDER BY posts_timestamp DESC";
#		$pst_query = mysqli_query($dbconn,$pst_q);
#		while($pst_opt = mysqli_fetch_assoc($pst_query)) {
#			$pstid	= $pst_opt['posts_id'];
#			$psttime	= $pst_opt['posts_timestamp'];
#			$psttext	= $pst_opt['posts_text'];
#		}
}

$pagetitle = $website_name." &gt; ".$username;
include_once 'main-header.php';
include_once 'main-nav.php';
?>
			<article class="w3-col w3-panel w3-cell m8">
<?php
// let's see if there are any posts to view from this user
$pst_q = "SELECT * FROM posts WHERE (posts_privacy_level=\"6ьötХ5áзÚZ\" AND posts_by=\"".$userid."\") ORDER BY posts_timestamp DESC";
$pst_query = mysqli_query($dbconn,$pst_q);
if (mysqli_num_rows($pst_query) <> 0) {
	while ($pst_opt = mysqli_fetch_assoc($pst_query)) {
		$postid		= $pst_opt['posts_id'];
		$postby		= $pst_opt['posts_by'];
		$posttime	= $pst_opt['posts_timestamp'];
		$posttext	= $pst_opt['posts_text'];
		$postlang	= $pst_opt['posts_lang'];
		$postpriv	= $pst_opt['posts_priv'];

		$by_q = "SELECT * FROM users WHERE user_id=\"".$postby."\"";
		$by_query = mysqli_query($dbconn,$by_q);
		while($by_opt = mysqli_fetch_assoc($by_query)) {
			$byname		= $by_opt['user_name'];
		}
			$now = date('Y-m-d H:i:s');

		echo "\t\t\t\t<div class=\"w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom\">\n";
		echo "\t\t\t\t\t<span class=\"showpostby\">".$username."&nbsp;";
		echo "<a href=\"the-post.php?pid=".$postid."\">".$posttime;
		echo "</a></span>\n";
		echo "\t\t\t\t\t<p class=\"showposttext\">".$posttext."</p>\n";
		echo "\t\t\t\t\t<!-- future functionality on span below -->\n";
		echo "\t\t\t\t\t<a href=\"#\" title=\""._('Reply')."\">⮪0</a>&nbsp;<a href=\"#\" title=\""._('Upvote')."\">⤊0</a>&nbsp;<a href=\"#\" title=\""._('Downvote')."\">⤋0</a>&nbsp;<a href=\"#\" title=\""._('Favorite')."\">🎔 0</a>&nbsp;…\n";
		echo "\t\t\t\t</div>\n";
	}
} else {
		echo "\t\t\t\t<div class=\"w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom\">\n";
		echo _("There are no posts at the moment");
		echo $pst_q;
		echo "\t\t\t\t</div>\n";
}
?>
			</article>

			<div class="w3-col w3-cell m3">&nbsp;</div>
		</div> <!-- end THE GRID -->
<?php
include_once "main-footer.php";
?>
