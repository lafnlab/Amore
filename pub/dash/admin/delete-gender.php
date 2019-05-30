<?php
/*
 * pub/dash/admin/delete-gender.php
 *
 * Delete a gender from the database.
 *
 * since Amore version 0.2
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
	$gendelq = "DELETE FROM genders WHERE gender_id='".$sel_id."'";
	$gendelquery = mysqli_query($dbconn,$gendelq);
	redirect("list-genders.php");
}
?>
