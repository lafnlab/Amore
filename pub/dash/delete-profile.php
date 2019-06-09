<?php
/*
 * pub/dash/delete-profile.php
 *
 * User can delete their own profile.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../conn.php";
include			"../../functions.php";
require			"../includes/database-connect.php";
require_once	"../includes/configuration-data.php";

if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$userq = "SELECT * FROM users WHERE user_id=\"".$sel_id."\"";
	$userquery = mysqli_query($dbconn,$userq);
	while($useropt = mysqli_fetch_assoc($userquery)) {
		$userid				= $useropt['user_id'];
		$username			= $useropt['user_name'];
		$userdname			= $useropt['user_display_name'];
	}
}


// PROCESSING THE FORM
if (isset($_POST['userdelete'])) {

	// get the form data
	$uid			= $_POST['userid'];
	$uname		= $_POST['username'];
	$udname		= $_POST['userdname'];

	// delete all of the user's posts
	$delpostsq = "DELETE * FROM posts WHERE post_by='".$uid."'";
	$delpostsquery = mysqli_query($dbconn,$delpostsq);

	// add them to list of deleted usernames
	$delnameq = "SELECT * FROM configuration";
	$delnamequery = mysqli_query($dbconn,$delnameq);
	while ($delnameopt = mysqli_fetch_assoc($delnamequery)) {

	// turns a comma separated string into an array
	$deleted = explode(",",$delnameopt["deleted_user_names"]);

	// push the user name into the array
	$deleted[] = $uname;

	// join the array into a string
	$deletedjoin = implode(",",$deleted);

	// put the joined string into user_liked for this user
	$deletedaddq = "UPDATE configuration SET deleted_user_names='".$deletedjoin."'";
	$deletedaddquery = mysqli_query($dbconn,$deletedaddq);
	} // end while delnameopt

	$userdelq = "DELETE FROM users WHERE user_id='".$uid."'";
	$userdelquery = mysqli_query($dbconn,$usrdelq);
	session_destroy();
	unset($_COOKIE['id']);
	unset($_COOKIE['uname']);
	redirect($website_url);

} else if (isset($_POST['usercancel'])) {

	// still must get the form data, even if we cancel
	$uid			= $_POST['userid'];

	redirect("index.php?uid=".$uid);
}


if ($userdname !== "") {
	$pagetitle = _("Delete $userdname?");
} else {
	$pagetitle = _("Delete $username?");
}

include_once "dash-header.php";
include_once "dash-nav.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($pagetitle); ?></h4>
				❗ <i><?php echo _("NOTE: Deleting your profile will remove your profile and all of your posts from our database. You will not be able to login to $website_name again. Your username - $username - will not be made available to other users."); ?></i>
				<p><?php echo _("Are you sure you want to delete your profile?"); ?></p>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="userid" value="<?php echo $userid; ?>">
				<input type="hidden" name="username" id="username" value="<?php echo $username; ?>">
				<input type="hidden" name="userdname" id="userdname" value="<?php echo $userdname; ?>">
				<table>
					<tr>
						<td><input type="submit" name="userdelete" id="userdelete" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('YES'); ?>"></td>
						<td><input type="submit" name="usercancel" id="usercancel" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('NO'); ?>"></td>
					</tr>
				</table>
				</form>
			</div>
		</article>
<?php
include_once "dash-footer.php";
?>
