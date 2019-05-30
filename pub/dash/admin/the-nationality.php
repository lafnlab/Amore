<?php
/*
 * pub/dash/admin/the-nationality.php
 *
 * Displays a nationality.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["nid"])) {
	$sel_id = $_GET["nid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$natq = "SELECT * FROM nationalities WHERE nationality_id=\"".$sel_id."\"";
	$natquery = mysqli_query($dbconn,$natq);
	while($natopt = mysqli_fetch_assoc($natquery)) {
		$natid		= $natopt['nationality_id'];
		$natname		= $natopt['nationality_name'];
	}
}

$pagetitle = $natname;
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($natname); ?></h4>
				<!-- in the future, this might be a list of people with this nationality -->
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
