<?php
/*
 * pub/dash/change-passphrase.php
 *
 * User can change their passphrase.
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
		$userpass			= $useropt['user_pass'];
	}
}


// PROCESSING THE FORM
if (isset($_POST['passphrases'])) {

	// get the form data
	$uid			= $_POST['userid'];
	$oldp			= $_POST['oldpass'];
	$newp1		= $_POST['newpass1'];
	$newp2		= $_POST['newpass2'];

/**
 * Time to see if the passphrase works well
 */
	if (isset($newp1)) {
		if (isset($newp2)) {

			// Can the user type the same passphrase twice without typos?
			if ($newp1 !== $newp2) {
				$message	= "PASSPHRASE_MISMATCH";
			}
		}

		// Is the passphrase at least 16 characters long?
		if (strlen($newp1) < 16) {
			$message = "SHORT_PASSPHRASE";

		// Is the passphrase complex?
		} else if (!preg_match("/^(?=\P{Ll}*\p{Ll})(?=\P{Lu}*\p{Lu})(?=\P{N}*\p{N})(?=[\p{L}\p{N}]*[^\p{L}\p{N}])[\s\S]{8,}$/",$newp1)) {
			$message = "NOT_COMPLEX";
		} else {

			// if it gets this far without errors, we're good
			$hash_pass = password_hash($newp1,PASSWORD_DEFAULT);
		}

/**
 * If we made it this far, create an ID, start a session, set cookies, etc.
 */
	if (!isset($message)) {
		$passq = "UPDATE users SET user_pass='".$hash_pass."' WHERE user_id='".$uid."'";
		$passquery = mysqli_query($dbconn,$passq);
		redirect("dash/index.php?uid=".$uid);
	}
}

$pagetitle = _("Change your passphrase");

include_once "dash-header.php";
include_once "dash-nav.php";
?>
<?php
switch ($message) {
	case "PASSPHRASE_MISMATCH":
		echo _("The passphrases do not match. Please try again.");
		break;
	case "SHORT_PASSPHRASE":
		echo _("The passphrase is too short. Please try again.");
		break;
	case "NOT_COMPLEX":
		echo _("The passphrase is not complex. Please try again.");
		break;
}
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($pagetitle); ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="userid" value="<?php echo $userid; ?>">
				<table>
					<tr>
						<td><?php echo _('Old passphrase');?></td>
						<td><input type="password" name="oldpass" id="oldpass" class="w3-input w3-border w3-margin-bottom" required></td>
					</tr>
					<tr>
						<td><?php echo _('New passphrase');?></td>
						<td><input type="password" name="newpass1" id="newoldpass1" class="w3-input w3-border w3-margin-bottom" required></td>
					</tr>
					<tr>
						<td><?php echo _('Verify new passphrase');?></td>
						<td><input type="password" name="newpass2" id="newpass2" class="w3-input w3-border w3-margin-bottom" required></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="passphrases" id="passphrases" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('CHANGE PASSPHRASES'); ?>"></td>
					</tr>
				</table>
				</form>
			</div>
		</article>
<?php
include_once "dash-footer.php";
?>
