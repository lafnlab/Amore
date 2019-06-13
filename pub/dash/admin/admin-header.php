<?php
/*
 * pub/dash/admin/admin-header.php
 *
 * This page provides the header code for the pre-installation admin pages.
 *
 * since Amore version 0.3
 *
 */

 if(isset($_COOKIE['loc'])) {
	$user_locale = $_COOKIE['loc'];
 } else {
	$user_locale = "en";
 }

  	// have Amore use the right localization
	putenv("LC_MESSAGES=".$user_locale);
	setlocale(LC_MESSAGES, $user_locale);

	// set the textdomain
	$textdomain = "amore";
	bindtextdomain($textdomain, "../locale");
	bind_textdomain_codeset($textdomain, 'UTF-8');
	textdomain($textdomain);
?>
<!DOCTYPE html>
<html lang="<?php echo $user_locale; ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="shortcut icon" href="../../favicon.ico">
	<title><?php echo $pagetitle; ?></title>
	<meta name="description" content="<?php echo $website_description; ?>">
	<link href="admin.css" rel="stylesheet" type="text/css">
</head>
<body class="w3-theme-l5">
	<div class="w3-top">
	<header class="w3-container w3-bar w3-large w3-theme-d1">
		<div class="w3-left w3-padding"><a href="<?php echo $website_url; ?>"><?php echo $website_name; // $sitetitle doesn't get i18n ?></a></div>
		<div class="w3-right w3-padding"><?php
		echo _('Hello, ');
		// if a user is logged in, display their username
		// if a user isn't logged in, they shouldn't be in the dashboard, so redirect them to the front page.
		if (isset($_COOKIE['uname'])) {
			echo "<a href=\"../index.php?uid=".$_COOKIE['id']."\">".$_COOKIE['uname']."</a>";
		} else {
			#redirect("../../index.php");
		}
		echo "&nbsp;|&nbsp;";
		echo "<a href=\"\#\">&#9776;</a>";
?>
</div>
		<div class="w3-center w3-padding">🖤</div>
	</header>
	</div> <!-- .w3-top -->
