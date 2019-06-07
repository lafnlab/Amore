<?php
/*
 * pub/dash/admin/suspend-user.php
 *
 * Suspends a user for a period of time and prevents them from logging in while they are suspended.
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

if (isset($_POST['usersusp'])) {
	$id		= $_POST['userid'];
	$susdate	= $_POST['usersuspdate']." 00:00:00";

	$usrsuspq = "UPDATE users SET user_is_suspended='".$susdate."', user_suspended_on='".strtotime('now')."', user_suspended_by='".$_COOKIE['id']."'";
	$usrsuspquery = mysqli_query($dbconn,$usrsuspq);
	redirect("list-users.php");
} else if (isset($_POST['usercancel'])) {
	redirect["list-users.php"];
}


if ($userdname !== "") {
	$pagetitle = _("Suspend ".$userdname."?");
} else {
	$pagetitle = _("Suspend ".$username."?");
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
				<i><?php echo _("NOTE: Suspending this user will prevent them from logging in while they are suspended. They will not be able to create new posts, respond to posts, or read direct messages."); ?></i>
				<p><?php echo _("If you wish to proceed, the user will be suspended until midnight of the selected date."); ?></p>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>">
					<table>
						<tr>
							<td><input type="date" name="usersuspdate" id="usersuspdate"></td>
						</tr>
						<tr>
							<td><input type="submit" name="usersusp" id="usersusp" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('SUSPEND'); ?>"></td>
							<td><input type="submit" name="usercancel" id="usercancel" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('NO'); ?>"></td>
						</tr>
					</table>
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
