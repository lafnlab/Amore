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

if ($sel_id != '') {

	$usrq = "SELECT * FROM usr WHERE usr_id=\"".$sel_id."\"";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usropt = mysqli_fetch_assoc($usrquery)) {
		$usrid		= $usropt['usr_id'];
		$usrname		= $usropt['usr_name'];
	}
}

$visitortitle = $usrname;
$pagetitle = $greeting.", ".$visitortitle;

include_once "main-header.php";
?>

		<ul>
			<li><a href="list-currencies.php"><?php echo _("List of social.media.dating currencies"); ?></a></li>
			<li><a href="list-eye-colors.php"><?php echo _("List of social.media.dating eye colors"); ?></a></li>
			<li><a href="list-genders.php"><?php echo _("List of social.media.dating genders"); ?></a></li>
			<li><a href="list-hair-colors.php"><?php echo _("List of social.media.dating hair colors"); ?></a></li>
			<li><a href="list-locales.php"><?php echo _("List of social.media.dating locales"); ?></a></li>
			<li><a href="list-nationalities.php"><?php echo _("List of social.media.dating nationalities"); ?></a></li>
			<li><a href="list-places.php"><?php echo _("List of social.media.dating places"); ?></a></li>
			<li><a href="list-sexualities.php"><?php echo _("List of social.media.dating sexualities"); ?></a></li>
			<li><a href="list-spoken-languages.php"><?php echo _("List of social.media.dating spoken languages"); ?></a></li>
			<li><a href="list-time-zones.php"><?php echo _("List of social.media.dating time zones"); ?></a></li>
		</ul>

<?php
include_once "main-footer.php";
?>
