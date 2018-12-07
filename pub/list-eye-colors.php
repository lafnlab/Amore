<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle = "LIST EYE COLORS TITLE";

include_once "main-header.php";
?>
<!-- gets a list of eye colors -->
		<article>
			<h4><?php echo _('Eye colors'); ?></h4>
<?php
		$eyeq = "SELECT * FROM eye ORDER BY eye_color ASC";
		$eyequery = mysqli_query($dbconn,$eyeq);

		while ($eyeopt = mysqli_fetch_assoc($eyequery)) {
			$eye_name	= $eyeopt['eye_color'];
			$eye_id		= $eyeopt['eye_id'];
			echo "\t\t\t<a href=\"the-eye-color.php?eid=".$eye_id."\">".$eye_name."</a><br>\n";
		}
?>
		</article>
<?php
include_once "main-footer.php";
?>
