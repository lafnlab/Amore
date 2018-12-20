<?php
include_once	"../conn.php";
include_once "../config.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle 	= "Add a post";
#$message		= 'test message';

// PROCESSING
if (isset($_POST['addpostsubmit'])) {

	$postid			= makeid($newid);
	$postby			= $_GET['uid']; // this needs to be set to work (hopefully)

	// is this a post or a message? A message will start with DM (or is marked private privacy level)

		// if a post do stuff

		// else if a message do some other stuff

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
			<form id="addpost" method="post" action="<?php echo htmlspecialchars("add-post.php"); ?>">
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
