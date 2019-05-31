<?php
/*
 * pub/dash/admin/the-sexuality.php
 *
 * Displays a sexuality.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["sid"])) {
	$sel_id = $_GET["sid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$sexq = "SELECT * FROM sexualities WHERE sexuality_id=\"".$sel_id."\"";
	$sexquery = mysqli_query($dbconn,$sexq);
	while($sexopt = mysqli_fetch_assoc($sexquery)) {
		$sexid		= $sexopt['sexuality_id'];
		$sexname		= $sexopt['sexuality_name'];
	}
}

$pagetitle = $sexname;
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($sexname); ?></h4>
				<!-- in the future, this might be a list of people with this sexuality -->
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
