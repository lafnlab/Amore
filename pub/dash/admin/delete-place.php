<?php
/*
 * pub/dash/admin/delete-place.php
 *
 * Delete a place from the database.
 *
 * since Amore version 0.2
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
	$pldelq = "DELETE FROM locations WHERE location_id='".$sel_id."'";
	$pldelquery = mysqli_query($dbconn,$pldelq);
	redirect("list-places.php");
}
?>
