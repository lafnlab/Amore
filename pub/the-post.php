<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

if (isset($_GET["pid"])) {
	$sel_id = $_GET["pid"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

if ($sel_id != '') {

	$pstq = "SELECT * FROM pst WHERE pst_id=\"".$sel_id."\"";
	$pstquery = mysqli_query($dbconn,$pstq);
	while($pst_opt = mysqli_fetch_assoc($pstquery)) {
		$postid		= $pst_opt['pst_id'];
		$postby		= $pst_opt['pst_by'];
		$posttime	= $pst_opt['pst_timestamp'];
		$posttext	= $pst_opt['pst_text'];
		$postlang	= $pst_opt['pst_lang'];
		$postpriv	= $pst_opt['pst_priv'];
	}

		$by_q = "SELECT * FROM usr WHERE usr_id=\"".$postby."\"";
		$by_query = mysqli_query($dbconn,$by_q);
		while($by_opt = mysqli_fetch_assoc($by_query)) {
			$byname		= $by_opt['usr_name'];
		}
}

$pagetitle = $byname." &middot; ".$posttext;
include_once 'main-header.php';
?>

	<article>
		<div id="showpost">
<?php
		echo "\t\t\t<span class=\"showpostby\"><a href=\"the-user.php?uid=".$postby."\">".$byname."</a>&nbsp;";
		echo $posttime."</span>\n";
		echo "\t\t\t<p class=\"showposttext\">".$posttext."</p>\n";
		echo "\t\t\t<!-- future functionality on span below -->\n";
		echo "\t\t\t<a href=\"#\" title=\"Reply\">⮪0</a>&nbsp;<a href=\"#\" title=\"Upvote\">⤊0</a>&nbsp;<a href=\"#\" title=\"Downvote\">⤋0</a>&nbsp;<a href=\"#\" title=\"Favorite\">🎔 0</a>&nbsp;…\n";
?>
		</div>
	</article>
<?php
include_once "main-footer.php";
?>
