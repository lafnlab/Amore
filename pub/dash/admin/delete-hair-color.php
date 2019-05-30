<?php
/*
 * pub/dash/admin/delete-hair-color.php
 *
 * Delete a hair color from the database.
 *
 * since Amore version 0.2
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
	$hardelq = "DELETE FROM hair_colors WHERE hair_color_id='".$sel_id."'";
	$hardelquery = mysqli_query($dbconn,$hardelq);
	redirect("list-hair-colors.php");
}
?>
