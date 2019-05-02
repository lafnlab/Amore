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
include "../../functions.php";

// get the ID of the user whose profile this is
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

	include "localization.php";
}


// get the ID of a post from this page
if (isset($_GET["pid"])) {
	$post_id = $_GET["pid"];
} else {
	$post_id = "";
}

// get information about this post
if ($post_id != '') {

	$pstq = "SELECT * FROM posts WHERE posts_id=\"".$post_id."\"";
	$pstquery = mysqli_query($dbconn,$pstq);
	while($pst_opt = mysqli_fetch_assoc($pstquery)) {
		$postid		= $pst_opt['posts_id'];
		$postby		= $pst_opt['posts_by'];
		$posttime	= $pst_opt['posts_timestamp'];
		$posttext	= $pst_opt['posts_text'];
		$postlang	= $pst_opt['posts_language'];
		$postpriv	= $pst_opt['posts_privacy_level'];
		$postshar	= $pst_opt['posts_shares'];
		$postlike	= $pst_opt['posts_likes'];
		$postdisl	= $pst_opt['posts_dislikes'];
	}

		$by_q = "SELECT * FROM users WHERE user_id=\"".$postby."\"";
		$by_query = mysqli_query($dbconn,$by_q);
		while($by_opt = mysqli_fetch_assoc($by_query)) {
			$byname		= $by_opt['user_name'];
		}
}

if (isset($_GET["type"])) {
	if ($_GET["type"] === "like") {
		#$message = "Liked";

		// check if the user is logged in (is there a session ID?)
			if (!isset($_COOKIE['id'])) {
				// if the user is not logged in, refer them to the login page
				// then bring them back here afterwards.
				setcookie('referer',$_SERVER['SERVER_NAME']."/post/".$post_id);
				redirect('the-login.php');
			} else {
				// if the user is logged in
				$uid = urldecode($_COOKIE['id']);
				$uname = $_COOKIE['uname'];

				/*
				 * add this posts to the user's likes
				 */

				// get user_liked from this user's record
				$ulikedq = "SELECT * FROM users WHERE user_id='".$uid."'";
				$ulikedquery = mysqli_query($dbconn,$ulikedq);

				while ($ulikedopt = mysqli_fetch_assoc($ulikedquery)) {

					// turns a comma separated string into an array
					$uliked = explode(",",$ulikedopt["user_liked"]);

					// encode the url for this post
					$ulikedurl = urlencode($website_url."/post/".$post_id);

					// push the encoded url into the array
					$uliked[] = $ulikedurl;

					// join the array into a string
					$ulikedjoin = implode(",",$uliked);

					// put the joined string into user_liked for this user
					$ulikedaddq = "UPDATE users SET user_liked='".$ulikedjoin."' WHERE user_id='".$uid."'";
					$ulikedaddquery = mysqli_query($dbconn,$ulikedaddq);

				} // end while $ulikedopt

				/*
				 * add this user to the post's likes
				 */

				// get the posts_likes for this post
				$plikesq = "SELECT * FROM posts WHERE posts_id='".$post_id."'";
				$plikesquery = mysqli_query($dbconn,$plikesq);
				while ($plikesopt = mysqli_fetch_assoc($plikesquery)) {

					// returns an array
					$plikes = preg_split(',',$plikesopt['posts_likes']);

					// encode the url for this post
					$plikesuser = "@".$uname."@".short_url($website_url);

					// push the encoded url into the array
					$plikes[] = $plikesuser;

					// join the array into a string
					$plikesjoin = join(',',$plikes);

					// put the joined string into user_liked for this user
					$plikesaddq = "UPDATE posts SET posts_likes='".$plikesjoin."' WHERE posts_id='".$post_id."'";
					$plikesaddquery = mysqli_query($dbconn,$plikesaddq);

				} // end while $plikesopt
			}
	} else if ($_GET["type"] === "dislike") {
		#$message = "Disliked";

		// check if the user is logged in (is there a session ID?)
			if (!isset($_COOKIE['id'])) {
				// if the user is not logged in, refer them to the login page
				// then bring them back here afterwards.
				setcookie('referer',$_SERVER['SERVER_NAME']."/post/".$post_id);
				redirect('the-login.php');
			} else {
				// if the user is logged in
				$uid = urldecode($_COOKIE['id']);
				$uname = $_COOKIE['uname'];

				/*
				 * add this posts to the user's dislikes
				 */

				// get user_liked from this user's record
				$dlikedq = "SELECT * FROM users WHERE user_id='".$uid."'";
				$dlikedquery = mysqli_query($dbconn,$dlikedq);

				while ($dlikedopt = mysqli_fetch_assoc($dlikedquery)) {

					// turns a comma separated string into an array
					$dliked = explode(",",$dlikedopt["user_disliked"]);

					// encode the url for this post
					$dlikedurl = urlencode($website_url."/post/".$post_id);

					// push the encoded url into the array
					$dliked[] = $dlikedurl;

					// join the array into a string
					$dlikedjoin = implode(",",$dliked);

					// put the joined string into user_liked for this user
					$dlikedaddq = "UPDATE users SET user_disliked='".$dlikedjoin."' WHERE user_id='".$uid."'";
					$dlikedaddquery = mysqli_query($dbconn,$dlikedaddq);

				} // end while $dlikedopt

				/*
				 * add this user to the post's dislikes
				 */

				// get the posts_likes for this post
				$pdislikesq = "SELECT * FROM posts WHERE posts_id='".$post_id."'";
				$pdislikesquery = mysqli_query($dbconn,$pdislikesq);
				while ($pdislikesopt = mysqli_fetch_assoc($pdislikesquery)) {

					// returns an array
					$pdislikes = preg_split(',',$pdislikesopt['posts_dislikes']);

					// encode the url for this post
					$pdislikesuser = "@".$uname."@".short_url($website_url);

					// push the encoded url into the array
					$pdislikes[] = $pdislikesuser;

					// join the array into a string
					$pdislikesjoin = join(',',$pdislikes);

					// put the joined string into user_liked for this user
					$pdislikesaddq = "UPDATE posts SET posts_dislikes='".$pdislikesjoin."' WHERE posts_id='".$post_id."'";
					$pdislikesaddquery = mysqli_query($dbconn,$pdislikesaddq);

				} // end while $pdislikesopt
			}

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
		$posttext	= htmlspecialchars_decode($pst_opt['posts_text']);
		$postlang	= $pst_opt['posts_lang'];
		$postpriv	= $pst_opt['posts_priv'];
		$postshar	= $pst_opt['posts_shares'];
		$postlike	= $pst_opt['posts_likes'];
		$postdisl	= $pst_opt['posts_dislikes'];

		$by_q = "SELECT * FROM users WHERE user_id=\"".$postby."\"";
		$by_query = mysqli_query($dbconn,$by_q);
		while($by_opt = mysqli_fetch_assoc($by_query)) {
			$byname		= $by_opt['user_name'];
		}
			$now = date('Y-m-d H:i:s');

		// get the number of likes
		if ($postlike !== '') {
			$post_likes = preg_split('/,/',$postlike);
			if (count($post_likes) > 0) {
				$likes = count($post_likes);
			}
		} else {
			$likes = 0;
		}

		if ($postdisl !== '') {
			$post_dislikes = preg_split('/,/',$postdisl);
			if (count($post_dislikes) > 0) {
				$dislikes = count($post_dislikes);
			}
		} else {
			$dislikes = 0;
		}

		echo "\t\t\t\t<div class=\"w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom\">\n";
		echo "\t\t\t\t\t<span class=\"showpostby\">".$byname."&nbsp;";
		echo "<a href=\"../the-post.php?pid=".$postid."\">".$posttime;
		echo "</a></span>\n";
		echo "\t\t\t\t\t<p class=\"showposttext\">".$posttext."</p>\n";
		echo "\t\t\t\t\t<!-- future functionality on span below -->\n";
		echo "\t\t\t\t\t<a href=\"#\" title=\""._('Reply')."\">⮪</a>&nbsp;<a href=\"#\" title=\""._('Share')."\">🔁</a>&nbsp;<a href=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?uid=".$usrid."&pid=".$postid."&type=like\" title=\""._('Like')."\">🎔&nbsp;".$likes."</a>&nbsp;<a href=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?uid=".$usrid."&pid=".$postid."&type=dislike\" title=\""._('Dislike')."\">💔&nbsp;".$dislikes."</a>&nbsp;\n";
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
