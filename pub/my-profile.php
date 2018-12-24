<?php
include_once "../conn.php";
include_once "../config.php";
include "../functions.php";

if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
} else {
	unset($sel_id);
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

/* if a user id is set															*/
if (isset($sel_id)) {


	/* but $_COOKIE['id'] is not set											*/
	if(!isset($_COOKIE['id'])) {
		unset($sel_id);
		redirect("index.php");
	}

	$usrq = "SELECT * FROM usr WHERE usr_id=\"".$sel_id."\"";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usropt = mysqli_fetch_assoc($usrquery)) {
		$usrid		= $usropt['usr_id'];
		$usrname		= $usropt['usr_name'];
	}
}
$objdescription = _("Dashboard for ").$usrname;
$visitortitle = $usrname;
$pagetitle = $greeting.", ".$visitortitle;

include_once "dash-header.php";
include_once "dash-nav.php";
?>
		<article>
			<form id="addpost" method="post" action="<?php echo htmlspecialchars("add-post.php?uid=".$usrid); ?>">
				<input type="text" id="addposttext" name="addposttext" maxlength="<?php echo $maxlength; ?>" required placeholder="<?php echo _('What are you doing?'); ?>"><br>
				<input type="radio" class="addpostradio" name="addpostradio" value="6ьötХ5áзÚZ" checked><?php echo _("EVERYONE"); ?>&nbsp;&nbsp;
				<input type="radio" class="addpostradio" name="addpostradio" value="щÊдrûOftÐÿ" ><?php echo _("FEDIVERSE"); ?>&nbsp;&nbsp;
				<input type="radio" class="addpostradio" name="addpostradio" value="РЖFÂå1ÔÏúL" ><?php echo _("INSTANCE"); ?>&nbsp;&nbsp;
				<input type="radio" class="addpostradio" name="addpostradio" value="óСПõöRærÊh" ><?php echo _("FOLLOWERS"); ?>&nbsp;&nbsp;
				<input type="radio" class="addpostradio" name="addpostradio" value="ÞБЯÍcOъøДS" ><?php echo _("FRIENDS"); ?>&nbsp;&nbsp;
				<input type="radio" class="addpostradio" name="addpostradio" value="ÓÇfXЦИфЕaù" ><?php echo _("PRIVATE"); ?>&nbsp;&nbsp;
				<input type="radio" class="addpostradio" name="addpostradio" value="ñToùòхаþOЪ" ><?php echo _("SELF"); ?>&nbsp;&nbsp;
				<input type="submit" id="addpostsubmit" name="addpostsubmit" value="<?php echo _('Post'); ?>">
			</form>
<?php
// let's see if there are any posts to view
$pst_q = "SELECT * FROM pst WHERE pst_priv=\"6ьötХ5áзÚZ\" ORDER BY pst_timestamp DESC";
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
include_once "dash-footer.php";
?>
