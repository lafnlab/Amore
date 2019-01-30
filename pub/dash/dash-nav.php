<?php
/*
 * pub/dash/dash-nav.php
 *
 * This is a navigation menu for all dashboard pages in Amore.
 *
 * since Amore version 0.1
 *
 */
?>
	<!-- THE CONTAINER for the main content -->
	<main class="w3-container w3-content" style="max-width:1400px;margin-top:40px;">

		<!-- THE GRID -->
		<div class="w3-cell-row w3-container">

			<nav class="w3-col w3-panel w3-cell m3">
				<div class="w3-card-2 w3-theme-l3 w3-padding">
					<ul>
						<li><a href="#" title="<?php echo _("Home will show posts from everyone the user is following, including their own."); ?>"><?php echo _("Home"); ?></a></li>
						<li><a href="#" title="<?php echo _("Mentions will show any posts where the user is mentioned."); ?>"><?php echo _("Mentions"); ?></a></li>
						<li><a href="#" title="<?php echo _("Messages will be private/direct messages between friends."); ?>"><?php echo _("Messages"); ?></a></li>
						<li><a href="#" title="<?php echo _("A list of the user's friends (Friends follow each other)."); ?>"><?php echo _("Friends"); ?></a></li>
						<li><a href="#" title="<?php echo _("A list of accounts the user follows."); ?>"><?php echo _("Following"); ?></a></li>
						<li><a href="#" title="<?php echo _("A list of accounts that follow this user."); ?>"><?php echo _("Followers"); ?></a></li>
						<li><a href="#" title="<?php echo _("Lists created by the user."); ?>"><?php echo _("Lists"); ?></a></li>
						<li><a href="#" title="<?php echo _("A list of the user's favorites."); ?>"><?php echo _("Favorites"); ?></a></li>
					</ul>
				</div>
<?php
// if the user is an admin, let them see an additional menu
if(isset($_COOKIE['id'])) {
	$idq = "SELECT * FROM users WHERE user_id='".$_COOKIE['id']."'";
	$idquery = mysqli_query($dbconn,$idq);
	while($idopt = mysqli_fetch_assoc($idquery)) {
		$level	= $idopt['user_level'];
		if ($level === 'ЗиóВéèàwVO') {
			echo "\t\t\t\t<div class=\"w3-card-2 w3-theme-l3 w3-padding w3-margin-top\">\n";
			echo "\t\t\t\t\t<ul>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-currencies.php\">"._('List currencies')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-eye-colors.php\">"._('List eye colors')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-genders.php\">"._('List genders')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-hair-colors.php\">"._('List hair colors')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-locales.php\">"._('List locales')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-nationalities.php\">"._('List nationalities')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-places.php\">"._('List places')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-sexualities.php\">"._('List sexualities')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-spoken-languages.php\">"._('List spoken languages')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-time-zones.php\">"._('List time zones')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-users.php\">"._('List users')."</a></li>\n";
			echo "\t\t\t\t\t</ul>\n";
			echo "\t\t\t\t</div>\n";
		}
	}
}
?>
			</nav>

<?php

// messages should appear in <main> only, not in <nav>
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
