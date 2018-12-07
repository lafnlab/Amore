<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle = "LIST TIME ZONES TITLE";

include_once "main-header.php";
?>
<!-- gets a list of time zones -->
		<article>
			<h4><?php echo _('Time zones'); ?></h4>
<?php
		$tztq = "SELECT * FROM tzt ORDER BY tzt_name ASC";
		$tztquery = mysqli_query($dbconn,$tztq);

		while ($tztopt = mysqli_fetch_assoc($tztquery)) {
			$tzt_name	= $tztopt['tzt_name'];
			$tzt_id		= $tztopt['tzt_id'];
			echo "\t\t\t<a href=\"the-time-zone.php?tzid=".$tzt_id."\">".$tzt_name."</a>\n";
		}
?>
		</article>
<?php
include_once "main-footer.php";
?>
