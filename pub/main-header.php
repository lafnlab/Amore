<?php
/*
 * pub/main-header.php
 *
 * This header starts the HTML for each public facing webpage in Amore.
 *
 * since Amore version 0.1
 *
 */
?>
<!DOCTYPE html>
<html lang="<?php echo $default_locale; ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="shortcut icon" href="favicon.ico">
	<title><?php echo _($pagetitle); ?></title>
	<meta name="description" content="<?php echo $website_description; ?>">
	<meta property="og:title" content="<?php echo $pagetitle; ?>">
	<meta property="og:description" content="<?php echo $$website_description; ?>">
	<meta property="og:type" content="website">
	<meta property="og:site_title" content="<?php echo $website_name; ?>">
	<link href="style/amore.css" rel="stylesheet" type="text/css">
	<script type="application/json">
		{
			"@context": "https://www.w3.org/ns/activitystreams",
			"summary": "<?php echo $website_description; ?>",
			"type": "Page",
			"name": "<?php echo $website_name." | ".$pagetitle; ?>",
			"url": "<?php echo $website_url.$_SERVER['PHP_SELF']; ?>"
		}
	</script>
</head>
<body class="w3-theme-l5">
	<div class="w3-top">
	<header class="w3-container w3-bar w3-large w3-theme-d1">
		<div class="w3-left w3-padding"><a href="<?php echo $website_url; ?>/index.php"><?php echo $website_name; // $sitetitle doesn't get i18n ?></a></div>
		<div class="w3-right w3-padding"><?php
		echo _('Hello, ');
		// if a user is logged in, display their username and link to dash/my-profile.php
		// if a user isn't logged in, display $visitortitle and link to the-login.php
		if (isset($_COOKIE['uname'])) {
			echo "<a href=\"dash/my-profile.php?uid=".$_COOKIE['id']."\">";
		} else {
			echo "<a href=\"the-login.php\">";
		}
		echo $visitortitle;
		echo "</a>&nbsp;|&nbsp;";
		echo "<a href=\"\#\">&#9776;</a>";
?>
</div>
		<div class="w3-center w3-padding">🖤</div>
	</header>
	</div> <!-- .w3-top -->
