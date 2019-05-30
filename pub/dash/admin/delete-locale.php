<?php
/*
 * pub/dash/admin/delete-locale.php
 *
 * Delete a locale from the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["i18id"])) {
	$sel_id = $_GET["i18id"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {
	$i18delq = "DELETE FROM locales WHERE locale_id='".$sel_id."'";
	$i18delquery = mysqli_query($dbconn,$i18delq);
	redirect("list-locales.php");
}
?>
