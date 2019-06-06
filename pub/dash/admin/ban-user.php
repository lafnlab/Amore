<?php
/*
 * pub/dash/admin/ban-user.php
 *
 * Permanently bans a user and prevents their username from being used again.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {
	$userq = "SELECT * FROM users WHERE user_id='".$sel_id."'";
	$userquery = mysqli_query($dbconn,$userq);
	while($useropt = mysqli_fetch_assoc($userquery)) {
		$userid				= $useropt['user_id'];
		$username			= $useropt['user_name'];
		$userdname			= $useropt['user_display_name'];
	}
}

if (isset($_POST['userban'])) {
	// delete all of their posts
	$delpostsq = "DELETE * FROM posts WHERE post_by='".$_POST['userid']."'";
	$delpostsquery = mysqli_query($dbconn,$delpostsq);

	// make a random passphrase and scramble it
	$permaban = password_hash(makeid($newid),PASSWORD_DEFAULT);

	// add them to list of banned usernames
	$bannameq = "SELECT * FROM configuration";
	$bannamequery = mysqli_query($dbconn,$bannameq);
	while ($bannameopt = mysqli_fetch_assoc($bannamequery)) {

	// turns a comma separated string into an array
	$banned = explode(",",$bannameopt["banned_user_names"]);

	// push the user name into the array
	$banned[] = $_POST['username'];

	// join the array into a string
	$bannedjoin = implode(",",$banned);

	// put the joined string into user_liked for this user
	$bannedaddq = "UPDATE configuration SET banned_user_names='".$bannedjoin."'";
	$bannedaddquery = mysqli_query($dbconn,$bannedaddq);
	} // end while bannameopt

	// clear their profile
	$usrbanq = "UPDATE users SET user_display_name='', user_pass='".$permaban."', user_email='', user_date_of_birth='', user_date_of_birth_privacy='', user_level='', user_actor_type='', user_outbox='', user_inbox='', user_liked='', user_disliked='', user_follows='', user_followers='', user_priv_key='', user_pub_key='', user_avatar='', user_gender='', user_gender_privacy='', user_sexuality='', user_sexuality_privacy='', user_relationship_status='', user_relationship_status_privacy='', user_eye_color='', user_hair_color='', user_location='', user_location_privacy='', user_nationality='', user_nationality_privacy='', user_locale='', user_spoken_language='', user_time_zone='', user_time_zone_privacy='', user_bio='', user_is_banned=1, user_banned_on='".strtotime('now')."', user_banned_by='".$_COOKIE['id']."' WHERE user_id='".$_POST['userid']."'";

	$usrbanquery = mysqli_query($dbconn,$usrbanq);
	redirect("list-users.php");
} else if (isset($_POST['usercancel'])) {
	redirect["list-users.php"];
}


if ($userdname !== "") {
	$pagetitle = _("Permanently ban ".$userdname."?");
} else {
	$pagetitle = _("Permanently ban ".$username."?");
}

include_once "admin-header.php";
include_once "admin-nav.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($pagetitle); ?></h4>
				<i><?php echo _("NOTE: Banning a user will delete their posts, clear their profile, scramble their passphrase, and prevent the username from being used again."); ?></i>
				<p><?php echo _("Are you sure you want to ban this user?"); ?></p>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>">
					<input type="hidden" name="username" id="username" value="<?php echo $username; ?>">
					<input type="hidden" name="userdname" id="userdname" value="<?php echo $userdname; ?>">
					<table>
						<tr>
							<td><input type="submit" name="userban" id="userban" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('YES'); ?>"></td>
							<td><input type="submit" name="usercancel" id="usercancel" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('NO'); ?>"></td>
						</tr>
					</table>
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
