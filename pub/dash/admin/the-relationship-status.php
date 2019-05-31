<?php
/*
 * pub/dash/admin/the-relationship-status.php
 *
 * Displays a relationship-status.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["rid"])) {
	$sel_id = $_GET["rid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$relq = "SELECT * FROM relationship_statuses WHERE relationship_status_id=\"".$sel_id."\"";
	$relquery = mysqli_query($dbconn,$relq);
	while($relopt = mysqli_fetch_assoc($relquery)) {
		$relid    = $relopt['relationship_status_id'];
		$relname  = $relopt['relationship_status_name'];
	}
}

$pagetitle = $relname;
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($relname); ?></h4>
				<!-- in the future, this might be a list of people with this relationship status -->
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
