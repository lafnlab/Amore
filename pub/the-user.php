<?php
/*
 * pub/the-user.php
 *
 * Displays a public information about a user
 *
 * since Amore version 0.1
 */

include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

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

$pagetitle = $sitetitle." &gt; ".$username;
include_once 'main-header.php';
include_once 'main-nav.php';
?>
	<article>
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

		echo "\t\t\t<div class=\"showpost\">\n";
		echo "\t\t\t\t<span class=\"showpostby\">".$byname."&nbsp;";
		echo "<a href=\"the-post.php?pid=".$postid."\">".$posttime;
		echo "</a></span>\n";
		echo "\t\t\t\t<p class=\"showposttext\">".$posttext."</p>\n";
		echo "\t\t\t\t<!-- future functionality on span below -->\n";
		echo "\t\t\t\t<a href=\"#\" title=\"Reply\">⮪0</a>&nbsp;<a href=\"#\" title=\"Upvote\">⤊0</a>&nbsp;<a href=\"#\" title=\"Downvote\">⤋0</a>&nbsp;<a href=\"#\" title=\"Favorite\">🎔 0</a>&nbsp;…\n";
		echo "\t\t\t</div>\n";
	}
} else {
		echo "\t\t\t<div class=\"showpost\">\n";
		echo _("There are no posts at the moment");
		echo $pst_q;
		echo "\t\t\t</div>\n";
}
?>
	</article>
<?php
include_once "main-footer.php";
?>
