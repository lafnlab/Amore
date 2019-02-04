<?php
/*
 * pub/the-post.php
 *
 * Displays a post
 *
 * since Amore version 0.1
 */

include_once	"../conn.php";
#include_once	"../config.php"; // use the configuration table instead
include			"../functions.php";


// get the ID of the post that is on this page
if (isset($_GET["pid"])) {
	$sel_id = $_GET["pid"];
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

	$pstq = "SELECT * FROM posts WHERE posts_id=\"".$sel_id."\"";
	$pstquery = mysqli_query($dbconn,$pstq);
	while($pst_opt = mysqli_fetch_assoc($pstquery)) {
		$postid		= $pst_opt['posts_id'];
		$postby		= $pst_opt['posts_by'];
		$posttime	= $pst_opt['posts_timestamp'];
		$posttext	= $pst_opt['posts_text'];
		$postlang	= $pst_opt['posts_language'];
		$postpriv	= $pst_opt['posts_privacy_level'];
	}

		$by_q = "SELECT * FROM users WHERE user_id=\"".$postby."\"";
		$by_query = mysqli_query($dbconn,$by_q);
		while($by_opt = mysqli_fetch_assoc($by_query)) {
			$byname		= $by_opt['user_name'];
		}
}

$pagetitle = $byname." &middot; ".$posttext;
include_once 'main-header.php';
?>
	<!-- THE CONTAINER for the main content -->
	<main class="w3-container w3-content" style="max-width:1400px;margin-top:40px;">

		<!-- THE GRID -->
		<div class="w3-cell-row w3-container">
			<div class="w3-col w3-cell m3">&nbsp;</div>

			<article class="w3-col w3-panel w3-cell m6">
				<div class="w3-card-2 w3-theme-l3 w3-padding maincard">
<?php
		echo "\t\t\t\t<span class=\"showpostby\"><a href=\"the-user.php?uid=".$postby."\">".$byname."</a>&nbsp;";
		echo $posttime."</span>\n";
		echo "\t\t\t\t<p class=\"showposttext\">".$posttext."</p>\n";
		echo "\t\t\t\t<!-- future functionality on span below -->\n";
		echo "\t\t\t\t<a href=\"#\" title=\""._('Reply')."\">⮪0</a>&nbsp;<a href=\"#\" title=\""._('Upvote')."\">⤊0</a>&nbsp;<a href=\"#\" title=\""._('Downvote')."\">⤋0</a>&nbsp;<a href=\"#\" title=\""._('Favorite')."\">🎔 0</a>&nbsp;…\n";
?>
				</div>
			</article>

			<div class="w3-col w3-cell m3">&nbsp;</div>
		</div> <!-- end THE GRID -->

<?php
include_once "main-footer.php";
?>
