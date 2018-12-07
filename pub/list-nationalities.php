<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle = "LIST NATIONALITIES TITLE";

include_once "main-header.php";
?>
<!-- gets a list of nationalities -->
		<article>
			<h4><?php echo _('Nationalities'); ?></h4>
<?php
		$natq = "SELECT * FROM nat ORDER BY nat_name ASC";
		$natquery = mysqli_query($dbconn,$natq);

		while ($natopt = mysqli_fetch_assoc($natquery)) {
			$nat_name	= $natopt['nat_name'];
			$nat_id		= $natopt['nat_id'];
			echo "\t\t\t<a href=\"the-nationality.php?nid=".$nat_id."\">".$nat_name."</a>\n";
		}
?>
		</article>
<?php
include_once "main-footer.php";
?>
