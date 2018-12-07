<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle = "LIST GENDERS TITLE";

include_once "main-header.php";
?>
<!-- gets a list of genders -->
		<article>
			<h4><?php echo _('Genders'); ?></h4>
<?php
		$genq = "SELECT * FROM gen ORDER BY gen_name ASC";
		$genquery = mysqli_query($dbconn,$genq);

		while ($genopt = mysqli_fetch_assoc($genquery)) {
			$gen_name	= $genopt['gen_name'];
			$gen_id		= $genopt['gen_id'];
			echo "\t\t\t<a href=\"the-gender.php?gid=".$gen_id."\">".$gen_name."</a>\n";
		}
?>
		</article>
<?php
include_once "main-footer.php";
?>
