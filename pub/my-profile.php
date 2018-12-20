<?php
include_once "../conn.php";
include_once "../config.php";
include "../functions.php";

if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

/* if a user id is set															*/
if ($sel_id != '') {

	/* but a session id is not set											*/
#	if (!session_id()) {
		#unset($sel_id);
		#redirect("index.php");
#		$message = "Why is session_id not set?";
#	}

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
			<form id="addpost" method="post" action="<?php echo htmlspecialchars("add-post.php"); ?>">
				<input type="text" id="addposttext" name="addposttext" maxlength="<?php echo $maxlength; ?>" required placeholder="<?php echo _('What are you doing?'); ?>">
				<input type="submit" id="addpostsubmit" name="addpostsubmit" value="<?php echo _('Post'); ?>">
			</form>
		</article>
<?php
include_once "dash-footer.php";
?>
