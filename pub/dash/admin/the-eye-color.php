<?php
/*
 * pub/dash/admin/the-eye-color.php
 *
 * Displays an eye color.
 *
 * since Amore version 0.1
 *
 */

 include_once	"../../../conn.php";
 include			"../../../functions.php";
 require			"../../includes/database-connect.php";
 require_once	"../../includes/configuration-data.php";

if (isset($_GET["eid"])) {
	$sel_id = $_GET["eid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$eyeq = "SELECT * FROM eye_colors WHERE eye_color_id=\"".$sel_id."\"";
	$eyequery = mysqli_query($dbconn,$eyeq);
	while($eyeopt = mysqli_fetch_assoc($eyequery)) {
		$eyeid		= $eyeopt['eye_color_id'];
		$eyecolor	= $eyeopt['eye_color_name'];
	}
}

$pagetitle = $eyecolor;
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($eyecolor); ?></h4>
				<!-- in the future, this might be a list of people with this eye color -->
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
