<?php
/*
 * pub/dash/admin/add-user.php
 *
 * Adds a new user.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


// PROCESSING
if (isset($_POST['usersubmit'])) {

	$usrid			= makeid($newid);
	$usrname			= nicetext($_POST['username']);
	$usrdname		= nicetext($_POST['userdname']);
	$usrpass1		= $_POST['userpass1'];
	$usrpass2		= $_POST['userpass2'];
	$usremail		= $_POST['useremail'];
	$usrlevel		= $_POST['userlevel'];
	$usrtype			= $_POST['usertype'];
	$usrcreate		= date('Y-m-d H:i:s');

/**
 * If the username is set, see if it is already being used
 */
	if (isset($usrname)) {
		$origuname		= "SELECT * FROM users WHERE user_name='".$usrname."'";
      $origunameq		= mysqli_query($dbconn, $origuname);
		while ($orignameopt = mysqli_fetch_assoc($orignameq)) {

			$nametest = $orignameopt["user_name"];

			if ($usrname === $nametest) {
				$message = "USERNAME_TAKEN";
				unset($usrname);
			}
     }
	} // end if isset $usrname

/**
 * Time to see if the passphrase works well
 */
	if (isset($usrpass1)) {
		if (isset($usrpass2)) {

			// Can the user type the same passphrase twice without typos?
			if ($usrpass1 !== $usrpass2) {
				$message	= "PASSPHRASE_MISMATCH";
			}
		}

		// Is the passphrase at least 16 characters long?
		if (strlen($usrpass1) < 16) {
			$message = "SHORT_PASSPHRASE";

		// Is the passphrase complex?
		} else if (!preg_match("/^(?=\P{Ll}*\p{Ll})(?=\P{Lu}*\p{Lu})(?=\P{N}*\p{N})(?=[\p{L}\p{N}]*[^\p{L}\p{N}])[\s\S]{8,}$/",$usrpass1)) {
			$message = "NOT_COMPLEX";
		} else {

			// if it gets this far without errors, we're good
			$hash_pass = password_hash($usrpass1,PASSWORD_DEFAULT);
		}

	} // end if isset $usrpass1


	// if $message is not set, then move forward
	if (!isset($message)) {

		// is the id unique in this table?
		$idq = "SELECT * FROM users WHERE user_id=\'".$usrid."\'";
		$idquery = mysqli_query($dbconn,$idq);
		$message = $idq;
		if ($idquery == FALSE) {

			$usraddq 	= "INSERT INTO users (user_id, user_name, user_display_name, user_pass, user_email, user_level, user_actor_type, user_created) VALUES ('".$usrid."','".$usrname."','".$usrdname."', '".$hash_pass."', '".$usremail."', '".$usrlevel."', '".$usrtype."', '".$usrcreate."')";
			$usraddquery	= mysqli_query($dbconn,$usraddq);
			redirect('list-users.php');
		} else {
			#$message 	= "There was an error while processing. Please try again.";
	#		redirect('index.html');
		}

	} // if !isset $message
} // if isset $_POST 'usersubmit'

include_once "admin-header.php";
include_once "admin-nav.php";
?>
<?php
switch ($message) {
	case "USERNAME_TAKEN":
		echo _("That username is already taken. Please choose another.");
		break;
	case "PASSPHRASE_MISMATCH":
		echo _("The passphrases do not match. Please try again.");
		break;
	case "SHORT_PASSPHRASE":
		echo _("The passphrase is too short. Please try again.");
		break;
	case "NOT_COMPLEX":
		echo _("The passphrase is not complex. Please try again.");
		break;
	case "SQL":
		echo $newq1;
		break;
}
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4><?php echo _("Add a new user"); ?></h4>
			<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<table class="w3-table">
					<tr>
						<td class="inputlabel"><label for="username"><?php echo _('Username');?></label></td>
						<td><input type="text" name="username" id="username" class="w3-input w3-border w3-margin-bottom" required maxlength="50"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="userdname"><?php echo _('Display name');?></label></td>
						<td><input type="text" name="userdname" id="userdname" class="w3-input w3-border w3-margin-bottom" required maxlength="100"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="userpass1"><?php echo _('Passphrase');?></label></td>
						<td><input type="password" name="userpass1" id="userpass1" class="w3-input w3-border w3-margin-bottom" required></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="userpass2"><?php echo _('Verify passphrase');?></label></td>
						<td><input type="password" name="userpass2" id="userpass2" class="w3-input w3-border w3-margin-bottom" required></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="useremail"><?php echo _('Email'); ?></label></td>
						<td><input type="email" name="useremail" id="useremail" class="w3-input w3-border w3-margin-bottom" maxlength="255"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="userlevel"><?php echo _('User level'); ?></label></td>
						<td>
							<select name="userlevel" id="userlevel" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		$lvlq = "SELECT * FROM user_levels ORDER BY user_level_name ASC";
		$lvlquery = mysqli_query($dbconn,$lvlq);
		while ($lvlopt = mysqli_fetch_assoc($lvlquery)) {
			echo "\t\t\t\t\t\t\t\t\t<option value=\"".$lvlopt['user_level_id']."\">".$lvlopt['user_level_name']."</option>\n";
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="usertype"><?php echo _('Account type'); ?></label></td>
						<td>
							<select name="usertype" id="usertype" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		$actq = "SELECT * FROM actor_types ORDER BY actor_type_name ASC";
		$actquery = mysqli_query($dbconn,$actq);
		while ($actopt = mysqli_fetch_assoc($actquery)) {
			echo "\t\t\t\t\t\t\t\t\t<option value=\"".$actopt['actor_type_id']."\">".$actopt['actor_type_name']."</option>\n";
		}
?>
							</select>
						</td>
					</tr>
				</table>
				<input type="submit" name="usersubmit" id="usersubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Submit'); ?>">
			</form>
</div>
		</article>

<?php
include_once "admin-footer.php";
?>
