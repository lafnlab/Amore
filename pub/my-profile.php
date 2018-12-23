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
		</article>
<?php
include_once "dash-footer.php";
?>
