<?php
/*
 * pub/dash/admin/delete-post.php
 *
 * Delete a post.
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
	$postdelq = "DELETE FROM posts WHERE post_id='".$sel_id."'";
	$postdelquery = mysqli_query($dbconn,$postdelq);
	redirect("../index.php?uid=".$_COOKIE['id']);
}
?>
