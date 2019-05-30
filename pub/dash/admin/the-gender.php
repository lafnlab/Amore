<?php
/*
 * pub/dash/admin/the-gender.php
 *
 * Displays a gender.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["gid"])) {
	$sel_id = $_GET["gid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$genq = "SELECT * FROM genders WHERE gender_id=\"".$sel_id."\"";
	$genquery = mysqli_query($dbconn,$genq);
	while($genopt = mysqli_fetch_assoc($genquery)) {
		$genid		= $genopt['gender_id'];
		$genname		= $genopt['gender_name'];
	}
}

$pagetitle = $genname;
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($genname); ?></h4>
			</div>
				<!-- in the future, this might be a list of people with this gender -->
		</article>
<?php
include_once "admin-footer.php";
?>
