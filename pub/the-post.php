<?php
/*
 * pub/the-post.php
 *
 * Displays a post
 *
 * since Amore version 0.1
 */

include_once	"../conn.php";
include			"../functions.php";
require			"includes/database-connect.php";
require_once	"includes/configuration-data.php";


// get the ID of the post that is on this page
if (isset($_GET["pid"])) {
	$sel_id = $_GET["pid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$pstq = "SELECT * FROM posts WHERE post_id=\"".$sel_id."\"";
	$pstquery = mysqli_query($dbconn,$pstq);
	while($pst_opt = mysqli_fetch_assoc($pstquery)) {
		$postid		= $pst_opt['post_id'];
		$postby		= $pst_opt['post_by'];
		$posttime	= $pst_opt['post_timestamp'];
		$posttext	= htmlspecialchars_decode($pst_opt['post_text']);
		$postpriv	= $pst_opt['post_privacy_level'];
	}

		$by_q = "SELECT * FROM users WHERE user_id=\"".$postby."\"";
		$by_query = mysqli_query($dbconn,$by_q);
		while($by_opt = mysqli_fetch_assoc($by_query)) {
			$byname		= $by_opt['user_name'];
		}
}

$pagetitle = $byname." &middot; ".$posttext;
include_once "main-header.php";

?>
	<!-- THE CONTAINER for the main content -->
	<main class="w3-container w3-content" style="max-width:1400px;margin-top:40px;">

		<!-- THE GRID -->
		<div class="w3-cell-row w3-container">
			<div class="w3-col w3-cell m3">&nbsp;</div>

			<article class="w3-col w3-panel w3-cell m6">
				<div class="w3-card-2 w3-theme-l3 w3-padding maincard">
<?php
		echo "\t\t\t\t<span class=\"showpostby\"><a href=\"".$website_url."/user/".$byname."/\">".$byname."</a>&nbsp;";
		echo $posttime."</span>\n";
		echo "\t\t\t\t<p class=\"showposttext\">".$posttext."</p>\n";
		echo "\t\t\t\t<!-- future functionality on span below -->\n";
		echo "\t\t\t\t<a href=\"#\" title=\""._('Reply')."\">⮪</a>&nbsp;<a href=\"#\" title=\""._('Share')."\">🔁</a>&nbsp;<a href=\"#\" title=\""._('Like')."\">🎔</a>&nbsp;<a href=\"#\" title=\""._('Dislike')."\">💔</a>&nbsp;\n";
?>
				</div>
			</article>

			<div class="w3-col w3-cell m3">&nbsp;</div>
		</div> <!-- end THE GRID -->

<?php
include_once "main-footer.php";
?>
