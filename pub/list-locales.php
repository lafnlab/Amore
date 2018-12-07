<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle = "LIST LOCALES TITLE";

include_once "main-header.php";
?>
<!-- gets a list of locales -->
		<article>
			<h4><?php echo _('Locales'); ?></h4>
<?php
		$i18q = "SELECT * FROM i18 ORDER BY i18_language,i18_country ASC";
		$i18query = mysqli_query($dbconn,$i18q);

		while ($i18opt = mysqli_fetch_assoc($i18query)) {
			$i18_lang	= $i18opt['i18_language'];
			$i18_ctry	= $i18opt['i18_country'];
			$i18_id		= $i18opt['i18_id'];
			echo "\t\t\t<a href=\"the-locale.php?i18id=".$i18_id."\">".$i18_language."-".$i18_country."</a>\n";
		}
?>
		</article>
<?php
include_once "main-footer.php";
?>
