<?php
/*
 * pub/dash/admin/delete-spoken-language.php
 *
 * Delete a spoken language from the database.
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
	$spdelq = "DELETE FROM spoken_languages WHERE spoken_language_id='".$sel_id."'";
	$spdelquery = mysqli_query($dbconn,$spdelq);
	redirect("list-spoken-languages.php");
}
?>
