<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle = "LIST HAIR COLORS TITLE";

include_once "main-header.php";
?>
<!-- gets a list of hair colors -->
		<article>
			<h4><?php echo _('Hair colors'); ?></h4>
<?php
		$harq = "SELECT * FROM har ORDER BY har_color ASC";
		$harquery = mysqli_query($dbconn,$harq);

		while ($haropt = mysqli_fetch_assoc($harquery)) {
			$har_name	= $haropt['har_color'];
			$har_id		= $haropt['har_id'];
			echo "\t\t\t<a href=\"the-hair-color.php?hid=".$har_id."\">".$har_name."</a><br>\n";
		}
?>
		</article>
<?php
include_once "main-footer.php";
?>
