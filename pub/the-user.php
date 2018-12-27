<?php
/*
 *
 * the-user.php is a publicly viewable page of a user.
 * It will show their username and posts. If they so choose, it will also have
 * a bio, their location, links to their profile, friends, followers, following
 * favorites, and lists.
 *
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

	$usrq = "SELECT * FROM usr WHERE usr_id=\"".$sel_id."\"";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usr_opt = mysqli_fetch_assoc($usrquery)) {
		$userid		= $usr_opt['usr_id'];
		$username	= $usr_opt['usr_name'];
		$userstart	= $usr_opt['usr_created'];
		$userlast	= $usr_opt['usr_last_seen'];
	}

	// get posts from this user
		$pst_q = "SELECT * FROM pst WHERE pst_by=\"".$postby."\" AND WHERE pst_priv=\"6ьötХ5áзÚZ\" ORDER BY pst_timestamp DESC";
		$pst_query = mysqli_query($dbconn,$pst_q);
		while($pst_opt = mysqli_fetch_assoc($pst_query)) {
			$pstid	= $pst_opt['pst_id'];
			$psttime	= $pst_opt['pst_timestamp'];
			$psttext	= $pst_opt['pst_text'];
		}
}

$pagetitle = $sitetitle." &gt; ".$username;
include_once 'main-header.php';
include_once 'main-nav.php';
?>
	<article>
<?php
// let's see if there are any posts to view from this user
$pst_q = "SELECT * FROM pst WHERE (pst_priv=\"6ьötХ5áзÚZ\" AND pst_by=\"".$userid."\") ORDER BY pst_timestamp DESC";
$pst_query = mysqli_query($dbconn,$pst_q);
if (mysqli_num_rows($pst_query) <> 0) {
	while ($pst_opt = mysqli_fetch_assoc($pst_query)) {
		$postid		= $pst_opt['pst_id'];
		$postby		= $pst_opt['pst_by'];
		$posttime	= $pst_opt['pst_timestamp'];
		$posttext	= $pst_opt['pst_text'];
		$postlang	= $pst_opt['pst_lang'];
		$postpriv	= $pst_opt['pst_priv'];

		$by_q = "SELECT * FROM usr WHERE usr_id=\"".$postby."\"";
		$by_query = mysqli_query($dbconn,$by_q);
		while($by_opt = mysqli_fetch_assoc($by_query)) {
			$byname		= $by_opt['usr_name'];
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
