<?php
include_once "../conn.php";
$pagetitle = "🖤";

include_once "main-header.php";
?>

		<ul>
			<li><a href="list-currencies.php"><?php echo _("List of currencies"); ?></a></li>
			<li><a href="list-eye-colors.php"><?php echo _("List of eye colors"); ?></a></li>
			<li><a href="list-genders.php"><?php echo _("List of genders"); ?></a></li>
			<li><a href="list-hair-colors.php"><?php echo _("List of hair colors"); ?></a></li>
			<li><a href="list-locales.php"><?php echo _("List of locales"); ?></a></li>
			<li><a href="list-nationalities.php"><?php echo _("List of nationalities"); ?></a></li>
			<li><a href="list-places.php"><?php echo _("List of places"); ?></a></li>
			<li><a href="list-sexualities.php"><?php echo _("List of sexualities"); ?></a></li>
			<li><a href="list-spoken-languages.php"><?php echo _("List of spoken languages"); ?></a></li>
			<li><a href="list-time-zones.php"><?php echo _("List of time zones"); ?></a></li>
		</ul>

<?php
include_once "main-footer.php";
?>
