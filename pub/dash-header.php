<!DOCTYPE html>
<html lang="<?php echo $metalang; ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="shortcut icon" href="favicon.ico">
	<title><?php echo _($pagetitle); ?></title>
	<meta name="description" content="<?php echo $metadescription; ?>">
	<meta property="og:title" content="<?php echo $pagetitle; ?>">
	<meta property="og:description" content="<?php echo $objdescription; ?>">
	<meta property="og:type" content="website">
	<meta property="og:site_title" content="<?php echo $sitetitle; ?>">
	<link href="style/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header class="headerbar">
		<div class="headerleft"><a href="/"><?php echo $sitetitle; // $sitetitle doesn't get i18n ?></a></div>
		<div class="headermiddle">🖤</div>
		<div class="headerright"><?php
		echo $greeting;
		echo ", ";
		echo $visitortitle;
?>
</div>
	</header>
