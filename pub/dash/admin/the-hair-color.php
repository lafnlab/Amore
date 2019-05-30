<?php
/*
 * pub/dash/admin/the-hair-color.php
 *
 * Displays a hair color.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["hid"])) {
	$sel_id = $_GET["hid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$harq = "SELECT * FROM hair_colors WHERE hair_color_id=\"".$sel_id."\"";
	$harquery = mysqli_query($dbconn,$harq);
	while($haropt = mysqli_fetch_assoc($harquery)) {
		$harid		= $haropt['hair_color_id'];
		$harcolor	= $haropt['hair_color_name'];
	}
}

$pagetitle = $harcolor;
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($harcolor); ?></h4>
				<!-- in the future, this might be a list of people with this hair color -->
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
