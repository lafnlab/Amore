<?php
/*
 * pub/main-nav.php
 *
 * This is a navigation menu for some public facing webpages in Amore.
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
					<p>
					<?php echo "@".$username; ?><br>
					Lorem ipsum biographical information<br>
					Posts: ###<br>
					Friends: ###<br>
					Followers: ###<br>
					Following: ###<br>
					</p>
					<ul>
						<li><a href="#" title="Home will show all of the user's posts own.">Home</a></li>
						<li><a href="#" title="Mentions will show any posts where the user is mentioned.">Mentions</a></li>
						<li><a href="#" title="A list of the user's friends (Friends follow each other).">Friends</a></li>
						<li><a href="#" title="A list of accounts the user follows.">Following</a></li>
						<li><a href="#" title="A list of accounts that follow this user.">Followers</a></li>
						<li><a href="#" title="Lists created by the user">Lists</a></li>
						<li><a href="#" title="A list of the user's favorites">Favorites</a></li>
					</ul>
				</div>
			</nav>

<?php

// messages should appear in <main> only, not in <nav>
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
