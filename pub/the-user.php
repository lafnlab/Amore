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
require			"includes/database-connect.php";
require_once	"includes/configuration-data.php";


// get the ID for the user whose page this is
#if (isset($_GET["uid"])) {
#	$sel_id = $_GET["uid"];
#} else {
#	$sel_id = "";
#}

// get the user info
if (isset($_GET["uname"])) {
	$name = $_GET["uname"];
} else {
	$name = "";
}


if ($name != '') {

	$usrq = "SELECT * FROM users WHERE user_name=\"".$name."\"";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usr_opt = mysqli_fetch_assoc($usrquery)) {
		$userid		= $usr_opt['user_id'];
		$username	= $usr_opt['user_name'];
		$userstart	= $usr_opt['user_created'];
		$userlast	= $usr_opt['user_last_seen'];
	}

	$usrq2 = "SELECT * FROM user_profiles WHERE user_profiles_id=\"".$userid."\"";
	$usrquery2 = mysqli_query($dbconn,$usrq2);
	while($usropt2 = mysqli_fetch_assoc($usrquery2)) {
		$userbio = $usropt2['user_profiles_description'];
	}
}

$pagetitle = $website_name." &gt; ".$username;
include_once 'main-header.php';
include_once 'main-nav.php';
include_once "the-user-feeds.php";
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
		echo "<a href=\"".$website_url."/post/".$postid."/\">".$posttime;
		echo "</a></span>\n";
		echo "\t\t\t\t\t<p class=\"showposttext\">".$posttext."</p>\n";
		echo "\t\t\t\t\t<!-- future functionality on span below -->\n";
		echo "\t\t\t\t\t<a href=\"#\" title=\""._('Reply')."\">⮪</a>&nbsp;<a href=\"#\" title=\""._('Share')."\">🔁</a>&nbsp;<a href=\"#\" title=\""._('Like')."\">🎔</a>&nbsp;<a href=\"#\" title=\""._('Dislike')."\">💔</a>&nbsp;\n";
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
