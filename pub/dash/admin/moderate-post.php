<?php
/*
 * pub/dash/admin/moderate-post.php
 *
 * Removes flag from an approved post.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["pid"])) {
	$sel_id = $_GET["pid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {
	$postokq = "UPDATE posts SET post_flagged=0, post_flagged_by='', post_flagged_on='' WHERE post_id='".$sel_id."'";
	$postokquery = mysqli_query($dbconn,$postokq);
	redirect("../index.php?uid=".$_COOKIE['id']);
}
?>
