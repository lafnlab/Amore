<?php
/*
 * pub/dash/admin/delete-time-zone.php
 *
 * Delete a time zone from the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["tzid"])) {
	$sel_id = $_GET["tzid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {
	$tzdelq = "DELETE FROM time_zones WHERE time_zone_id='".$sel_id."'";
	$tzdelquery = mysqli_query($dbconn,$tzdelq);
	redirect("list-time-zones.php");
}
?>
