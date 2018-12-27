
	<nav class="mainnav">
		<div class="bio">
			<p>
			<?php echo "@".$username; ?><br>
			Lorem ipsum biographical information<br>
			Posts: ###<br>
			Friends: ###<br>
			Followers: ###<br>
			Following: ###<br>
			</p>
		</div>
		<ul>
			<li><a href="#" title="Home will show posts from everyone the user is following, including their own.">Home</a></li>
			<li><a href="#" title="Mentions will show any posts where the user is mentioned.">Mentions</a></li>
			<li><a href="#" title="A list of the user's friends (Friends follow each other).">Friends</a></li>
			<li><a href="#" title="A list of accounts the user follows.">Following</a></li>
			<li><a href="#" title="A list of accounts that follow this user.">Followers</a></li>
			<li><a href="#" title="Lists created by the user">Lists</a></li>
			<li><a href="#" title="A list of the user's favorites">Favorites</a></li>
		</ul>
	</nav>
	<main>
<?php

// messages should appear in <main> only, not in <nav>
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
