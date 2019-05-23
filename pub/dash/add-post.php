<?php
/*
 * pub/dash/add-post.php
 *
 * Allows a logged in user to create a post.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../conn.php";
include			"../../functions.php";

if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
} else {
	unset($sel_id);
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
	$max_post_length			= $mysiteopt['max_post_length'];
}

/* if a user id is set															*/
if (isset($sel_id)) {


	/* but $_COOKIE['id'] is not set											*/
	if(!isset($_COOKIE['id'])) {
		unset($sel_id);
		redirect("index.php");
	}

	$usrq = "SELECT * FROM users WHERE user_id=\"".$sel_id."\"";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usropt = mysqli_fetch_assoc($usrquery)) {
		$usrid		= $usropt['user_id'];
		$usrname		= $usropt['user_name'];
	}

	// get the user's preferred locale and have Amore use that localization
	$usrpq = "SELECT * FROM user_profiles WHERE user_profiles_id=\"".$sel_id."\"";
	$usrpquery = mysqli_query($dbconn,$usrpq);
	while($usrpopt = mysqli_fetch_assoc($usrpquery)) {

		// get the user's locale from the user_profiles table
		$usrploc = $usrpopt['user_profiles_locale'];

		// since that only returns the locale ID, we need to get the language and country from the locales table
		$usrlocq = "SELECT * FROM locales WHERE locales_id=\"".$usrploc."\"";
		$usrlocquery = mysqli_query($dbconn,$usrlocq);
		while($usrlocopt = mysqli_fetch_assoc($usrlocquery)) {
			$uloclang = $usrlocopt['locales_language'];
			$ulocctry = $usrlocopt['locales_country'];

			// if the country exists in this locale, separate it from the language with and underscore
			if ($ulocctry != '') {
				$user_locale = $uloclang."_".$ulocctry;
			} else {

				// otherwise just use the language code
				$user_locale = $uloclang;
			} // end if $ulocctry != ''

		} // end while $usrlocopt

	} // end while $usrpopt

}

$visitortitle = $usrname;

// PROCESSING
if (isset($_POST['addpostsubmit'])) {

	$postid			= makeid($newid);
	$postby			= $_GET['uid']; // despite the form being posted, we get the ID via GET
	$posttime		= date('Y-m-d H:i:s');
	$postmsg			= nicetext($_POST['addposttext']);
	$postprv			= $_POST['addpostradio'];

	// is this a post or a message? A message will start with DM (or is marked private privacy level)
	if ($postprv == "ÓÇfXЦИфЕaù" or substr($postmsg,0,3) === "DM " or substr($postmsg,0,3) === "dm ") {
#		$message = "message is private";

		// a message need to be addressed to someone

	} else {
#		$message = "message is not private";
		$postq = "INSERT INTO posts (posts_id, posts_by, posts_timestamp, posts_text, posts_language, posts_privacy_level) VALUES ('$postid','$postby','$posttime','$postmsg','en','$postprv')";
		$postadd	= mysqli_query($dbconn,$postq);
		redirect("my-profile.php?uid=".$sel_id);
	}

} // if isset $_POST 'addpostsubmit'

include_once "dash-header.php";
include_once "dash-nav.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
			<article class="w3-col w3-panel w3-cell m9">
				<form class="w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom" id="addpost" method="post" action="<?php echo htmlspecialchars("add-post.php?uid=".$usrid); ?>">
					<input type="text" id="addposttext" class="w3-input w3-border w3-margin-bottom" name="addposttext" maxlength="<?php echo $max_post_length; ?>" required placeholder="<?php echo _('What are you doing?'); ?>"><br>
					<input type="radio" class="w3-radio" name="addpostradio" value="6ьötХ5áзÚZ" checked><?php echo _("EVERYONE"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="щÊдrûOftÐÿ" ><?php echo _("FEDIVERSE"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="РЖFÂå1ÔÏúL" ><?php echo _("INSTANCE"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="óСПõöRærÊh" ><?php echo _("FOLLOWERS"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="ÞБЯÍcOъøДS" ><?php echo _("FRIENDS"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="ÓÇfXЦИфЕaù" ><?php echo _("PRIVATE"); ?>&nbsp;&nbsp;
					<input type="radio" class="w3-radio" name="addpostradio" value="ñToùòхаþOЪ" ><?php echo _("SELF"); ?>&nbsp;&nbsp;
					<input type="submit" id="addpostsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" name="addpostsubmit" value="<?php echo _('Post'); ?>">
				</form>
			</article>
<?php
include_once "dash-footer.php";
?>
