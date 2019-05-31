<?php
/*
 * pub/dash/admin/delete-sexuality.php
 *
 * Delete a sexuality from the database.
 *
 * since Amore version 0.2
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
	$sxdelq = "DELETE FROM sexualities WHERE sexuality_id='".$sel_id."'";
	$sxdelquery = mysqli_query($dbconn,$sxdelq);
	redirect("list-sexualities.php");
}
?>
