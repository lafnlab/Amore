<?php
/*
 * pub/dash/admin/repair.php
 *
 * This page is for repairing conn.php.
 *
 * since Amore version 0.3
 *
 */

/**
 *
 * Let us verify that the ../../../conn.php file exists.
 */

if (file_exists("../../../conn.php")) {
	$dbhost	= DBHOST;
	$dbname	= DBNAME;
	$dbuser	= DBUSER;
	$dbpass	= DBPASS;
	$sitekey	= SITEKEY;
	echo "Here for repair";
} else {

	/**
	 * If conn.php does not exist, redirect to install.php
	 */
	header("Location: install.php");
}

?>

this is repair.php
