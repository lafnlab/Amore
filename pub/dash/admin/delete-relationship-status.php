<?php
/*
 * pub/dash/admin/delete-relationship-status.php
 *
 * Delete a relationship status from the database.
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
	$rsdelq = "DELETE FROM relationship_statuses WHERE relationship_status_id='".$sel_id."'";
	$rsdelquery = mysqli_query($dbconn,$rsdelq);
	redirect("list-relationship-statuses.php");
}
?>
