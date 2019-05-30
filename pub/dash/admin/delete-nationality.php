<?php
/*
 * pub/dash/admin/delete-nationality.php
 *
 * Delete a nationality from the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["nid"])) {
	$sel_id = $_GET["nid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {
	$natdelq = "DELETE FROM nationalities WHERE nationality_id='".$sel_id."'";
	$natdelquery = mysqli_query($dbconn,$natdelq);
	redirect("list-nationalities.php");
}
?>
