<?php
/*
 * pub/dash/admin/delete-user.php
 *
 * Delete a user after a warning.
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

if (isset($_POST['userdelete'])) {
	// remove the user from the users table
	$usrdelq = "DELETE FROM users WHERE user_id='".$_POST['userid']."'";
	$usrdelquery = mysqli_query($dbconn,$usrdelq);

	// remove them from the list of banned usernames
	$bannameq = "SELECT * FROM configuration";
	$bannamequery = mysqli_query($dbconn,$bannameq);
	while ($bannameopt = mysqli_fetch_assoc($bannamequery)) {

	// turns a comma separated string into an array
	$banned = explode(",",$bannameopt["banned_user_names"]);

	// push the user name into the array
	if (($key = array_search($username, $banned)) !== false) {
    unset($banned[$key]);
}

	// join the array into a string
	$bannedjoin = implode(",",$banned);

	// put the joined string into user_liked for this user
	$bannedaddq = "UPDATE configuration SET banned_user_names='".$bannedjoin."'";
	$bannedaddquery = mysqli_query($dbconn,$bannedaddq);
	} // end while bannameopt

	redirect("list-users.php");
} else if (isset($_POST['usercancel'])) {
	redirect["list-users.php"];
}


if ($userdname !== "") {
	$pagetitle = _("Delete ".$userdname."?");
} else {
	$pagetitle = _("Delete ".$username."?");
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
				<i><?php echo _("NOTE: Deleting a user will make the name available to be used again."); ?></i>
				<p><?php echo _("Are you sure you want to delete this user?"); ?></p>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>">
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
include_once "admin-footer.php";
?>
