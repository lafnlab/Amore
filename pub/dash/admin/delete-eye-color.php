<?php
/*
 * pub/dash/admin/delete-eye-color.php
 *
 * Delete an eye color from the database.
 *
 * since Amore version 0.2
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
	$eyedelq = "DELETE FROM eye_colors WHERE eye_color_id='".$sel_id."'";
	$eyedelquery = mysqli_query($dbconn,$eyedelq);
	redirect("list-eye-colors.php");
}
?>
