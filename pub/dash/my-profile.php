<?php
/*
 * pub/dash/my-profile.php
 *
 * This is the home page for a logged in user in Amore.
 * It shows recent posts and has a form for them to post.
 *
 * since Amore version 0.1
 *
 */

include_once "../../conn.php";
#include_once "../config.php";
include "../../functions.php";

if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
} else {
	unset($sel_id);
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

/* if a user id is set															*/
if (isset($sel_id)) {


	/* but $_COOKIE['id'] is not set											*/
	if(!isset($_COOKIE['id'])) {
		unset($sel_id);
		redirect("index.php");
	}

	$usrq = "SELECT * FROM users WHERE user_id=\"".$sel_id."\"";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usropt = mysqli_fetch_assoc($usrquery)) {
		$usrid		= $usropt['user_id'];
		$usrname		= $usropt['user_name'];
	}
}
$objdescription = _("Dashboard for ").$usrname;
$visitortitle = $usrname;
$pagetitle = _("Hello, ").$visitortitle;

include_once "dash-header.php";
include_once "dash-nav.php";
?>
			<article class="w3-col w3-panel w3-cell m9">
				<form class="w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom" id="addpost" method="post" action="<?php echo htmlspecialchars("add-post.php?uid=".$usrid); ?>">
					<input type="text" id="addposttext" class="w3-input w3-border w3-margin-bottom" name="addposttext" maxlength="<?php echo $max_post_length; ?>" required placeholder="<?php echo _('What are you doing?'); ?>"><br>
					<input type="radio" class="w3-radio" name="addpostradio" value="6ьötХ5áзÚZ" checked><?php echo _("EVERYONE"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="щÊдrûOftÐÿ" ><?php echo _("FEDIVERSE"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="РЖFÂå1ÔÏúL" ><?php echo _("INSTANCE"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="óСПõöRærÊh" ><?php echo _("FOLLOWERS"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="ÞБЯÍcOъøДS" ><?php echo _("FRIENDS"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="ÓÇfXЦИфЕaù" ><?php echo _("PRIVATE"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="ñToùòхаþOЪ" ><?php echo _("SELF"); ?>&nbsp;&nbsp;
					<input type="submit" id="addpostsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" name="addpostsubmit" value="<?php echo _('Post'); ?>">
				</form>
<?php
// let's see if there are any posts to view
$pst_q = "SELECT * FROM posts WHERE posts_privacy_level=\"6ьötХ5áзÚZ\" ORDER BY posts_timestamp DESC";
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
		echo "\t\t\t\t\t<span class=\"showpostby\">".$byname."&nbsp;";
		echo "<a href=\"../the-post.php?pid=".$postid."\">".$posttime;
		echo "</a></span>\n";
		echo "\t\t\t\t\t<p class=\"showposttext\">".$posttext."</p>\n";
		echo "\t\t\t\t\t<!-- future functionality on span below -->\n";
		echo "\t\t\t\t\t<a href=\"#\" title=\"Reply\">⮪0</a>&nbsp;<a href=\"#\" title=\"Upvote\">⤊0</a>&nbsp;<a href=\"#\" title=\"Downvote\">⤋0</a>&nbsp;<a href=\"#\" title=\"Favorite\">🎔 0</a>&nbsp;…\n";
		echo "\t\t\t\t</div>\n";
	}
} else {
		echo "\t\t\t\t<div class=\"w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom\">\n";
		echo _("There are no posts at the moment");
#		echo $pst_q;
		echo "\t\t\t\t</div>\n";
}
?>
			</article>
<?php
include_once "dash-footer.php";
?>
