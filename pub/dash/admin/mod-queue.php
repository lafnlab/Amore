<?php
/*
 * pub/dash/mod-queue.php
 *
 * Displays a list of posts that have been flagged for moderation.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

$pagetitle = _("Moderation queue");
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo $pagetitle; ?></h4>
<?php
// let's see if any posts have been flagged
// posts should be moderated fairly quickly, so they are listed on a 'first come, first served' basis
$modqueq = "SELECT * FROM posts WHERE post_flagged=\"1\" ORDER BY post_timestamp ASC";
$modquequery = mysqli_query($dbconn,$modqueq);
if (mysqli_num_rows($modquequery) <> 0) {
	while ($modqueopt = mysqli_fetch_assoc($modquequery)) {
		$postid		= $modqueopt['post_id'];
		$postby		= $modqueopt['post_by'];
		$posttime	= $modqueopt['post_timestamp'];
		$posttext	= htmlspecialchars_decode($modqueopt['post_text']);
		$postpriv	= $modqueopt['post_privacy_level'];
		$postshar	= $modqueopt['post_shares'];
		$postlike	= $modqueopt['post_likes'];
		$postdisl	= $modqueopt['post_dislikes'];
		$postflag	= $modqueopt['post_flagged'];
		$postflby	= $modqueopt['post_flagged_by'];
		$postflon	= $modqueopt['post_flagged_on'];


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

		$flagbyq = "SELECT * FROM users WHERE user_id=\"".$postflby."\"";
		$flagbyquery = mysqli_query($dbconn,$flagbyq);
		while($flagbyopt = mysqli_fetch_assoc($flagbyquery)) {
			$flagbyname		= $flagbyopt['user_name'];
		}

		echo "\t\t\t\t<div class=\"w3-panel w3-theme-l4 w3-padding w3-margin-bottom\">\n";
		echo "\t\t\t\t\t<span class=\"showpostby\">".$byname."&nbsp;";
		echo "<a href=\"../the-post.php?pid=".$postid."\">".$posttime;
		echo "</a></span>\n";
		echo "\t\t\t\t\t<p class=\"showposttext\">".$posttext."</p>\n";
		echo "\t\t\t\t\t<!-- future functionality on span below -->\n";
		echo "\t\t\t\t\t<a href=\"#\" title=\""._('Reply')."\">⮪</a>&nbsp;<a href=\"#\" title=\""._('Share')."\">🔁</a>&nbsp;<a href=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?uid=".$usrid."&pid=".$postid."&type=like\" title=\""._('Like')."\">🎔&nbsp;".$likes."</a>&nbsp;<a href=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?uid=".$usrid."&pid=".$postid."&type=dislike\" title=\""._('Dislike')."\">💔&nbsp;".$dislikes."</a>&nbsp;\n";
		echo "\t\t\t\t\t<div class=\"w3-card-2 w3-theme-l5 w3-padding w3-margin-bottom w3-margin-top\">\n";
		echo "\t\t\t\t\t\t"._('Flagged for moderation by ')."<a href=\"the-user.php?uid=".$postflby."\">".$flagbyname."</a>"._(' on ').$postflon."\n";
		echo "\t\t\t\t\t\t<a href=\"moderate-post.php?pid=".$postid."\">"._('Approve post')."</a>\n";
		echo "\t\t\t\t\t\t<a href=\"delete-post.php?pid=".$postid."\">"._('Delete post')."</a>\n";
		echo "\t\t\t\t\t</div>\n";
		echo "\t\t\t\t</div>\n";
	} // end while $modqueopt
} else {
		echo "\t\t\t\t<div class=\"w3-card-2 w3-theme-l4 w3-padding w3-margin-bottom\">\n";
		echo "\t\t\t\t\t"._("There are no posts awaiting moderation at this time.")."\n";
		echo "\t\t\t\t</div>\n";
}
?>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
