<?php
/*
 * pub/dash/admin/the-place.php
 *
 * Displays a place/location.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["plid"])) {
	$sel_id = $_GET["plid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$plaq = "SELECT * FROM locations WHERE location_id=\"".$sel_id."\"";
	$plaquery = mysqli_query($dbconn,$plaq);
	while($plaopt = mysqli_fetch_assoc($plaquery)) {
		$plaid		= $plaopt['location_id'];
		$planame		= $plaopt['location_name'];
		$plaparent 	= $plaopt['location_parent'];
		$parents		= mb_split(',', $plaparent);
	}
}

$pagetitle = $planame;
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($natname); ?></h4>
				<!-- display the parent(s) -->
<?php
		echo "\t\t\t\t"._($planame)." "._('is part of');

		foreach($parents as $parent) {
			$pareq = "SELECT * FROM locations WHERE location_id=\"".$parent."\"";
			$parequery = mysqli_query($dbconn,$pareq);
			while($pareopt = mysqli_fetch_assoc($parequery)) {
				$parename	= $pareopt['location_name'];
				$pareid		= $pareopt['location_id'];
				echo " <a href=\"the-place.php?plid=".$pareid."\">".$parename."</a>";
			}
		}
?>
			<!-- display the children, if any -->
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
