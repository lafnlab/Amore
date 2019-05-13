<?php
/*
 * pub/main-nav.php
 *
 * This is a navigation menu for some public facing webpages in Amore.
 *
 * since Amore version 0.1
 *
 */

 // get number of posts
# this function below isn't working at the moment. Try the variables below that.
# $postsbyqty = user_post_quantity($userid);
$postsbyq = "SELECT * FROM posts WHERE posts_by='".$userid."'";
$postsbyquery = mysqli_query($dbconn,$postsbyq);
$postsbyqty = mysqli_num_rows($postsbyquery);

// get number of followers and number of accounts being followed
$followersq = "SELECT * FROM users where user_id='".$userid."'";
$followersquery = mysqli_query($dbconn,$followersq);
while ($followersopt = mysqli_fetch_assoc($followersquery)) {
	$followersqty = count(explode(",",$followersopt['user_followers']));
	$followingqty = count(explode(",",$followersopt['user_follows']));
}

?>
	<!-- THE CONTAINER for the main content -->
	<main class="w3-container w3-content" style="max-width:1400px;margin-top:40px;">

		<!-- THE GRID -->
		<div class="w3-cell-row w3-container">

			<nav class="w3-col w3-panel w3-cell m3">
				<div class="w3-card-2 w3-theme-l3 w3-padding">
					<p>
					<?php echo "@".$username; ?><br>
					<?php echo "@".$username."@".short_url($website_url); ?><br>
					<?php echo $userbio; ?><br>
					<?php echo _("Posts:")." ".$postsbyqty; ?><br>
					<?php echo _("Friends:"); ?> ###<br>
					<?php echo _("Followers:")." ".$followersqty; ?><br>
					<?php echo _("Following:")." ".$followingqty; ?><br>
					</p>
					<ul>
						<li><a href="#" title="<?php echo _("Home will show all of the user's posts."); ?>"><?php echo _("Home"); ?></a></li>
						<li><a href="#" title="<?php echo _("Mentions will show any posts where the user is mentioned."); ?>"><?php echo _("Mentions"); ?></a></li>
						<li><a href="#" title="<?php echo _("A list of the user's friends (Friends follow each other)."); ?>"><?php echo _("Friends"); ?></a></li>
						<li><a href="#" title="<?php echo _("A list of accounts the user follows."); ?>"><?php echo _("Following"); ?></a></li>
						<li><a href="#" title="<?php echo _("A list of accounts that follow this user."); ?>"><?php echo _("Followers"); ?></a></li>
						<li><a href="#" title="<?php echo _("Lists created by the user."); ?>"><?php echo _("Lists"); ?></a></li>
						<li><a href="#" title="<?php echo _("A list of the user's favorites."); ?>"><?php echo _("Favorites"); ?></a></li>
					</ul>
				</div>
			</nav>

<?php

// messages should appear in <main> only, not in <nav>
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
