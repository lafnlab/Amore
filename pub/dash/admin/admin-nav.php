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
						<li><a href="#" title="<?php echo _("Messages will be private/direct messages."); ?>"><?php echo _("Messages"); ?></a></li>
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
			echo "\t\t\t\t\t<h5>"._('Users')."</h5>\n";
			echo "\t\t\t\t\t<ul>\n";
			echo "\t\t\t\t\t\t<li><a href=\"list-users.php\">"._('All users')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"add-user.php\">"._('Add a user')."</a></li>\n";
			echo "\t\t\t\t\t\t<li><a href=\"../my-profile.php?uid=".$_COOKIE['id']."\">"._('My profile')."</a></li>\n";
			echo "\t\t\t\t\t\t\t<ul>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"../edit-profile.php?uid=".$_COOKIE['id']."\">"._('Edit profile')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"../delete-profile.php?uid=".$_COOKIE['id']."\">"._('Delete profile')."</a></li>\n";
			echo "\t\t\t\t\t\t\t</ul>\n";
			echo "\t\t\t\t\t</ul>\n";
			echo "\t\t\t\t\t<h5>"._('Settings')."</h5>\n";
			echo "\t\t\t\t\t<ul>\n";
			echo "\t\t\t\t\t\t<li>"._('General')."\n";
			echo "\t\t\t\t\t\t\t<ul>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"settings-configure.php\">"._('Configuration')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"settings-home-page.php\">"._('Home page')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"settings-privacy.php\">"._('Privacy')."</a></li>\n";
			echo "\t\t\t\t\t\t\t</ul>\n";
			echo "\t\t\t\t\t\t</li>\n";
			echo "\t\t\t\t\t\t<li>"._('Metadata')."\n";
			echo "\t\t\t\t\t\t\t<ul>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"list-currencies.php\">"._('Currencies')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"list-eye-colors.php\">"._('Eye colors')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"list-genders.php\">"._('Genders')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"list-hair-colors.php\">"._('Hair colors')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"list-locales.php\">"._('Locales')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"list-nationalities.php\">"._('Nationalities')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"list-places.php\">"._('Places')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"list-relationship-statuses.php\">"._('Relationship statuses')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"list-sexualities.php\">"._('Sexualities')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"list-spoken-languages.php\">"._('Spoken languages')."</a></li>\n";
			echo "\t\t\t\t\t\t\t\t<li><a href=\"list-time-zones.php\">"._('Time zones')."</a></li>\n";
			echo "\t\t\t\t\t\t\t</ul>\n";
			echo "\t\t\t\t\t\t</li>\n";
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
