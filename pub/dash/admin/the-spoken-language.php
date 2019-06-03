<?php
/*
 * pub/dash/admin/the-spoken-language.php
 *
 * Displays a spoken language.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["spid"])) {
	$sel_id = $_GET["spid"];
} else {
	$sel_id = "";
}

if ($sel_id != '') {

	$spkq = "SELECT * FROM spoken_languages WHERE spoken_language_id=\"".$sel_id."\"";
	$spkquery = mysqli_query($dbconn,$spkq);
	while($spkopt = mysqli_fetch_assoc($spkquery)) {
		$spkid		= $spkopt['spoken_language_id'];
		$spkname		= $spkopt['spoken_language_name'];
	}
}

$pagetitle = $spkname;
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($spkname); ?></h4>
				<!-- in the future, this might be a list of people who speak this language -->
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
