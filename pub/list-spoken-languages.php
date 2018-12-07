<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle = "LIST SPOKEN LANGUAGES TITLE";

include_once "main-header.php";
?>
<!-- gets a list of spoken languages -->
		<article>
			<h4><?php echo _('Spoken languages'); ?></h4>
<?php
		$spkq = "SELECT * FROM spk ORDER BY spk_name ASC";
		$spkquery = mysqli_query($dbconn,$spkq);

		while ($spkopt = mysqli_fetch_assoc($spkquery)) {
			$spk_name	= $spkopt['spk_name'];
			$spk_id		= $spkopt['spk_id'];
			echo "\t\t\t<a href=\"the-spoken-language.php?spid=".$spk_id."\">".$spk_name."</a><br>\n";
		}
?>
		</article>
<?php
include_once "main-footer.php";
?>
