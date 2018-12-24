<?php
include_once	"../conn.php";
include_once "../config.php";
include			"../functions.php";

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

$visitortitle = $usrname;
$pagetitle 	= "Add a post";
#$message		= 'test message';

// PROCESSING
if (isset($_POST['addpostsubmit'])) {

	$postid			= makeid($newid);
	$postby			= $_GET['uid']; // despite the form being posted, we get the ID via GET
	$posttime		= date('Y-m-d H:i:s');
	$postmsg			= $_POST['addposttext'];
	$postprv			= $_POST['addpostradio'];

	// is this a post or a message? A message will start with DM (or is marked private privacy level)
	if ($postprv == "ÓÇfXЦИфЕaù" or substr($postmsg,0,3) === "DM " or substr($postmsg,0,3) === "dm ") {
#		$message = "message is private";

		// a message need to be addressed to someone

	} else {
#		$message = "message is not private";
		$postq = "INSERT INTO pst (pst_id, pst_by, pst_timestamp, pst_text, pst_lang, pst_priv) VALUES ('$postid','$postby','$posttime','$postmsg','en','$postprv')";
		$postadd	= mysqli_query($dbconn,$postq);
		redirect("my-profile.php?uid=".$uid);
	}

} // if isset $_POST 'addpostsubmit'

include_once "dash-header.php";
include_once "dash-nav.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
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
