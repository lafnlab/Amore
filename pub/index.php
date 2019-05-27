<?php
/*
 * pub/index.php
 *
 * This is the main page for Amore and serves several purposes.
 * It offers a login and/or registration panel. It shows recent posts.
 * And it triggers creation of nodeinfo.
 *
 * since Amore version 0.1
 *
 */

 /**
  * If ../conn.php does not exist...
  */
 if(!file_exists("../conn.php")) {

 	/**
 	 * ...and conn.php does not exist...
 	 */
 	if (!file_exists("conn.php")) {

 		/**
 		 * redirect user to install page.
 		 */
 		header("Location: dash/admin/install.php");
 	} else {

 		/**
 		 * conn.php does exist
 		 * redirect user to post-install page
 		 */
 		header("Location: dash/admin/post-install.php");
 	}
 } else {

 	/**
 	 * ../conn.php does exist
 	 * Let us include it, then verify its constants
 	 */

 	include "../conn.php";

 	/**
 	 * if $global_count === 5 at the end then all global variables are set.
 	 * if $global_count < 5 then something is missing.
 	 */

 	$global_count = 0;

 	if (DBHOST != "") {
 		#echo DBHOST;
 	 	$global_count++;
 	}

 	if (DBNAME != "") {
 		$global_count++;
 	}

 	if (DBUSER != "") {
 		$global_count++;
 	}

 	if (DBPASS != "") {
 		$global_count++;
 	}

 	if (SITEKEY != "") {
 		$global_count++;
 	}

 	/**
 	 *
 	 * If all of the global variables are set, move forward
 	 * If some of the global variables are missing, redirect to dash/admin/repair.php.
 	 */
 	if ($global_count < 5) {
 		header("Location: dash/admin/repair.php");
 	}
 	#echo $global_count;
 }

include "../functions.php";

// see if a session is set. If so, redirect them to their dashboard.

if (isset($_COOKIE['id'])) {
	redirect("dash/my-profile.php?uid=".$_COOKIE['id']);
} else {
	$visitortitle = _('Guest');
}


$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

// let's get the configuration data

$mysiteq = "SELECT * FROM configuration WHERE primary_key='".SITEKEY."'";
$mysitequery = mysqli_query($dbconn,$mysiteq);
while ($mysiteopt = mysqli_fetch_assoc($mysitequery)) {
	$website_url				= $mysiteopt['website_url'];
	$website_name				= $mysiteopt['website_name'];
	$website_description		= $mysiteopt['website_description'];
	$default_locale			= $mysiteopt['default_locale'];
	$open_registration		= $mysiteopt['open_registrations'];
	$posts_are_called			= $mysiteopt['posts_are_called'];
	$post_is_called			= $mysiteopt['post_is_called'];
	$reposts_are_called		= $mysiteopt['reposts_are_called'];
	$repost_is_called			= $mysiteopt['repost_is_called'];
	$users_are_called			= $mysiteopt['users_are_called'];
	$user_is_called			= $mysiteopt['user_is_called'];
	$favorites_are_called	= $mysiteopt['favorites_are_called'];
	$favorite_is_called		= $mysiteopt['favorite_is_called'];
}


if ($open_registration == FALSE) {
	$open = "false";
} else {
	$open = "true";
}


$pagetitle = _("Home");
$objdescription = $website_description;

include_once "main-header.php";
?>
	<!-- The Container for the main content -->
	<main class="w3-container w3-content" style="max-width:1400px;margin-top:40px;">

<?php

// messages should appear in <main> only, not in <nav>
if ($message != '' || NULL) {
	echo header_message($message);
}
include "the-feeds.php";
?>

		<!-- The Grid -->
		<div class="w3-row w3-container">

			<!-- LEFT COLUMN -->
<?php

// if registration is closed display a login panel
	if ($open_registration == FALSE) {
		echo "\t\t\t<div class=\"w3-col m3 w3-row-padding w3-panel\">\n";
		echo "\t\t\t\t<div class=\"w3-card-2 w3-padding w3-theme-l3\">\n";
		echo "\t\t\t\t\t<form method=\"post\" action=\"".htmlspecialchars("the-login.php")."\">\n";
		echo "\t\t\t\t\t<h2 class=\"w3-center\">"._("Login to ").$website_name."</h2>\n";
		echo "\t\t\t\t\t\t<p>\n";
		echo "\t\t\t\t\t\t\t<label for=\"loginuser\">"._('Username')."</label>\n";
		echo "\t\t\t\t\t\t\t<input type=\"text\" name=\"loginuser\" id=\"loginuser\" class=\"w3-input w3-border w3-margin-bottom\" required maxlength=\"50\">\n";
		echo "\t\t\t\t\t\t</p>\n";
		echo "\t\t\t\t\t\t<p>\n";
		echo "\t\t\t\t\t\t\t<label for=\"loginpass\">"._('Passphrase')."</label>\n";
		echo "\t\t\t\t\t\t\t<input type=\"password\" name=\"loginpass\" id=\"loginpass\" class=\"w3-input w3-border w3-margin-bottom\" required>\n";
		echo "\t\t\t\t\t\t</p>\n";
		echo "\t\t\t\t\t\t<input type=\"submit\" name=\"loginsubmit\" id=\"loginsubmit\" class=\"w3-button w3-block w3-theme-d3 w3-section w3-padding\" value=\""._('TO LOGIN')."\">\n";
		echo "\t\t\t\t\t</form>\n";
		echo "\t\t\t\t</div>\n";
		echo "\t\t\t</div> <!-- end LEFT COLUMN -->\n\n";
	} else {

	// if registration is open, display a registration/login panel
		echo "\t\t\t<div class=\"w3-col m3 w3-row-padding w3-panel\">\n";
		echo "\t\t\t\t<div class=\"w3-card-2 w3-padding w3-theme-l3\">\n";
		echo "\t\t\t\t\t<form method=\"post\" action=\"".htmlspecialchars("the-registration.php")."\">\n";
		echo "\t\t\t\t\t<h2>"._("Registration for ").$website_name."</h2>\n";
		echo "\t\t\t\t\t\t<p>\n";
		echo "\t\t\t\t\t\t\t<label for=\"acctuser\">"._('Username')."</label>\n";
		echo "\t\t\t\t\t\t\t<input type=\"text\" name=\"acctuser\" id=\"acctuser\" class=\"w3-input w3-border w3-margin-bottom\" required maxlength=\"50\">\n";
		echo "\t\t\t\t\t\t</p>\n";
		echo "\t\t\t\t\t\t<p>\n";
		echo "\t\t\t\t\t\t\t<label for=\"acctpass1\">"._('Passphrase')."</label>\n";
		echo "\t\t\t\t\t\t\t<input type=\"password\" name=\"acctpass1\" id=\"acctpass1\" class=\"w3-input w3-border w3-margin-bottom\" required>\n";
		echo "\t\t\t\t\t\t</p>\n";
		echo "\t\t\t\t\t\t<p>\n";
		echo "\t\t\t\t\t\t\t<label for=\"acctpass2\">"._('Verify passphrase')."</label>\n";
		echo "\t\t\t\t\t\t\t<input type=\"password\" name=\"acctpass2\" id=\"acctpass2\" class=\"w3-input w3-border w3-margin-bottom\" required>\n";
		echo "\t\t\t\t\t\t</p>\n";
		echo "\t\t\t\t\t\t<p>\n";
		echo "\t\t\t\t\t\t\t<label for=\"acctdob\">"._('Date of birth')."</label>\n";
		echo "\t\t\t\t\t\t\t<input type=\"date\" name=\"acctdob\" id=\"acctdob\" class=\"w3-input w3-border w3-margin-bottom\" required min=\"1900-01-01\">\n";
		echo "\t\t\t\t\t\t</p>\n";
		echo "\t\t\t\t\t\t<input type=\"submit\" name=\"acctsubmit\" id=\"acctsubmit\" class=\"w3-button w3-block w3-theme-d3 w3-section w3-padding\" value=\""._('TO REGISTER')."\">\n";
		echo "\t\t\t\t\t</form>\n";
		echo "\t\t\t\t\t<hr>\n";
		echo "\t\t\t\t\t<p>\n";
		echo "\t\t\t\t\t\t"._('Already a user?')."\n";
		echo "\t\t\t\t\t\t<a href=\"the-login.php\">"._('TO LOGIN')."</a>\n";
		echo "\t\t\t\t\t</p>\n";
		echo "\t\t\t\t</div>\n";
		echo "\t\t\t</div> <!-- end LEFT COLUMN -->\n\n";
	}
	echo "\t\t\t\t<!-- MIDDLE COLUMN -->\n";
	echo "\t\t\t<div class=\"w3-col m6 w3-row-padding w3-panel\">\n";
	echo "\t\t\t\t<div class=\"w3-card-2 w3-padding w3-margin-bottom w3-theme-l3\">\n";
	echo "\t\t\t\t<h2>".$website_name."</h2>\n";
	echo "\t\t\t\t<p><b>".$website_description."</b></p>\n";
	echo "\t\t\t\t<p>".$metadescription."</p>\n";
	echo "\t\t\t\t</div>\n";
	echo "\t\t\t\t<!-- statistics section -->\n";
	echo "\t\t\t\t<div class=\"w3-card-2 w3-padding w3-theme-l3\">\n";
	echo "\t\t\t\t<span>"._("Number of ").$users_are_called." = ".user_quantity($user)."</span><br>\n";
	echo "\t\t\t\t<span>"._("Number of ").$posts_are_called." = ".post_quantity($post)."</span><br>\n";
	echo "\t\t\t\t</div>\n";
	echo "\t\t\t</div> <!-- end MIDDLE COLUMN -->\n\n";

	// if we have posts, display the most recent ones in a div on the right side of the page
	if (post_quantity($posts) > 0) {
		echo "\t\t\t<div class=\"w3-col m3 w3-row-padding w3-panel\">\n";
		echo "\t\t\t<h2 class=\"w3-center\">"._('Recent posts')."</h2>\n";
		$pst_q = "SELECT * FROM posts WHERE post_privacy_level=\"6ьötХ5áзÚZ\" ORDER BY post_timestamp DESC LIMIT 50";
		$pst_query = mysqli_query($dbconn,$pst_q);
		while ($pst_opt = mysqli_fetch_assoc($pst_query)) {
			$postid		= $pst_opt['post_id'];
			$postby		= $pst_opt['post_by'];
			$posttime	= $pst_opt['post_timestamp'];
			$posttext	= htmlspecialchars_decode($pst_opt['post_text']);
			$postpriv	= $pst_opt['post_privacy_level'];

			$by_q = "SELECT * FROM users WHERE user_id=\"".$postby."\"";
			$by_query = mysqli_query($dbconn,$by_q);
			while($by_opt = mysqli_fetch_assoc($by_query)) {
				$byname		= $by_opt['user_name'];
			}
			$now = date('Y-m-d H:i:s');

			echo "\t\t\t<div class=\"w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom\">\n";
			echo "\t\t\t\t<span class=\"mainpagepostby\"><a href=\"".$website_url."/user/".$byname."/\">".$byname."</a>&nbsp;";
			echo "<a href=\"".$website_url."/post/".$postid."/\">".$posttime;
			echo "</a></span>\n";
			echo "\t\t\t\t<p class=\"mainpageposttext\">".$posttext."</p>\n";
			echo "\t\t\t</div>\n";
		}
		echo "\t\t</div>\n\n";
	}

?>
	</div> <!-- end w3-row -->
<?php
include_once "main-footer.php";
?>
