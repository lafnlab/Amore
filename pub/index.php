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

include_once "../conn.php";
#include_once "../config.php"; // use the configuration table instead.
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

// trigger nodeinfo creation
	$nodeinfometa = fopen(".well-known/nodeinfo", "w") or die("Unable to open or create nodeinfo file");

	$json0 = "{\"links\":[{\"rel\":\"http://nodeinfo.diaspora.software/ns/schema/1.0\",\"href\":\"".$website_url."/nodeinfo/1.0\"},{\"rel\":\"http://nodeinfo.diaspora.software/ns/schema/2.0\",\"href\":\"".$website_url."/nodeinfo/2.0\"}]}";

	// let's try to write to it.
	fwrite($nodeinfometa,$json0);
	fclose($nodeinfometa);

// create or update the nodeinfo/1.0 file
	$nodeinfo1 = fopen("nodeinfo/1.0", "w") or die("Unable to open or create nodeinfo 1.0 file");

	$json1 = "{\"version\":\"1.0\",\"software\":{\"name\":\"amore\",\"version\":\"v0.2\"},\"protocols\":{\"inbound\":[],\"outbound\":[]},\"services\":{\"inbound\":[],\"outbound\":[]},\"openRegistrations\":".$open.",\"usage\":{\"users\":{\"total\":".user_quantity($users).",\"activeHalfyear\":".users_half_year($sometimes_users).",\"activeMonth\":".users_past_month($active_users)."},\"localPosts\":".post_quantity($posts).",\"localComments\":},\"metadata\":{\"nodeName\":\"".$website_name."\"}}";

	fwrite($nodeinfo1,$json1);
	fclose($nodeinfo1);

// create or update nodeinfo/2.0 file
	$nodeinfo2 = fopen("nodeinfo/2.0", "w") or die("Unable to open or create nodeinfo 2.0 file");

	$json2 = "{\"version\":\"2.0\",\"software\":{\"name\":\"amore\",\"version\":\"v0.2\"},\"protocols\":{\"inbound\":[],\"outbound\":[]},\"services\":{\"inbound\":[],\"outbound\":[]},\"openRegistrations\":".$open.",\"usage\":{\"users\":{\"total\":".user_quantity($users).",\"activeHalfyear\":".users_half_year($sometimes_users).",\"activeMonth\":".users_past_month($active_users)."},\"localPosts\":".post_quantity($posts).",\"localComments\":},\"metadata\":{\"nodeName\":\"".$website_name."\"}}";

	fwrite($nodeinfo2,$json2);
	fclose($nodeinfo2);
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
		$pst_q = "SELECT * FROM posts WHERE posts_privacy_level=\"6ьötХ5áзÚZ\" ORDER BY posts_timestamp DESC LIMIT 50";
		$pst_query = mysqli_query($dbconn,$pst_q);
		while ($pst_opt = mysqli_fetch_assoc($pst_query)) {
			$postid		= $pst_opt['posts_id'];
			$postby		= $pst_opt['posts_by'];
			$posttime	= $pst_opt['posts_timestamp'];
			$posttext	= $pst_opt['posts_text'];
			$postlang	= $pst_opt['posts_language'];
			$postpriv	= $pst_opt['posts_privacy_level'];

			$by_q = "SELECT * FROM users WHERE user_id=\"".$postby."\"";
			$by_query = mysqli_query($dbconn,$by_q);
			while($by_opt = mysqli_fetch_assoc($by_query)) {
				$byname		= $by_opt['user_name'];
			}
			$now = date('Y-m-d H:i:s');

			echo "\t\t\t<div class=\"w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom\">\n";
			echo "\t\t\t\t<span class=\"mainpagepostby\"><a href=\"the-user.php?uid=".$postby."\">".$byname."</a>&nbsp;";
			echo "<a href=\"the-post.php?pid=".$postid."\">".$posttime;
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
