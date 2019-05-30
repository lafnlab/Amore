<?php
/*
 * pub/dash/admin/delete-currency.php
 *
 * Delete a currency from the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["did"])) {
	$sel_id = $_GET["did"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {
	$dindelq = "DELETE FROM currencies WHERE currency_id='".$sel_id."'";
	$dindelquery = mysqli_query($dbconn,$dindelq);
	redirect("list-currencies.php");
}
?>
