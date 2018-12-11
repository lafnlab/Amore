<!DOCTYPE html>
<html>
<head>
	<title><?php echo _($pagetitle); ?></title>
	<link href="style/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header class="headerbar">
		<div class="headerleft"><a href="/"><?php echo $sitetitle; // $sitetitle doesn't get i18n ?></a></div>
		<div class="headermiddle">🖤</div>
		<div class="headerright"><?php
		echo $greeting;
		echo ", ";
		// if a user is logged in, display their username
		// if a user isn't logged in, display $visitortitle
		echo "<a href=\"the-login.php\">";
		echo $visitortitle;
		echo "</a>";
?>
</div>
	</header>
	<main>
