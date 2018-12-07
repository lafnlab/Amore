<?php
include_once "../conn.php";
$pagetitle = "🖤";

include_once "main-header.php";
?>

		<ul>
			<li><a href="list-currencies.php"><?php echo _("List of social.media.dating currencies"); ?></a></li>
			<li><a href="list-eye-colors.php"><?php echo _("List of social.media.dating eye colors"); ?></a></li>
			<li><a href="list-genders.php"><?php echo _("List of social.media.dating genders"); ?></a></li>
			<li><a href="list-hair-colors.php"><?php echo _("List of social.media.dating hair colors"); ?></a></li>
			<li><a href="list-locales.php"><?php echo _("List of social.media.dating locales"); ?></a></li>
			<li><a href="list-nationalities.php"><?php echo _("List of social.media.dating nationalities"); ?></a></li>
			<li><a href="list-places.php"><?php echo _("List of social.media.dating places"); ?></a></li>
			<li><a href="list-sexualities.php"><?php echo _("List of social.media.dating sexualities"); ?></a></li>
			<li><a href="list-spoken-languages.php"><?php echo _("List of social.media.dating spoken languages"); ?></a></li>
			<li><a href="list-time-zones.php"><?php echo _("List of social.media.dating time zones"); ?></a></li>
		</ul>

<?php
include_once "main-footer.php";
?>
