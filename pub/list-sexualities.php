<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle = "LIST SEXUALITIES TITLE";

include_once "main-header.php";
?>
<!-- gets a list of sexualities -->
		<article>
			<h4><?php echo _('Sexualities'); ?></h4>
<?php
		$sxuq = "SELECT * FROM sxu ORDER BY sxu_name ASC";
		$sxuquery = mysqli_query($dbconn,$sxuq);

		while ($sxuopt = mysqli_fetch_assoc($sxuquery)) {
			$sxu_name	= $sxuopt['sxu_name'];
			$sxu_id		= $sxuopt['sxu_id'];
			echo "\t\t\t<a href=\"the-sexuality.php?sid=".$sxu_id."\">".$sxu_name."</a>\n";
		}
?>
		</article>
<?php
include_once "main-footer.php";
?>
