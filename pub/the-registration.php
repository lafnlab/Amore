<?php
/*
 * pub/the-registration.php
 *
 * The main registration page for Amore. Also provides functionality for registration widget on main page
 *
 * since Amore version 0.1
 */

include_once	"../conn.php";
include			"../functions.php";

/**
 * see if cookie is set
 * if so, send them to their profile page.
 */
if (isset($_COOKIE['id'])) {
	redirect("dash/my-profile.php?uid=".$_COOKIE['id']);
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
	$banned_user_names		= $mysiteopt['banned_user_names'];
}

if($open_registration == FALSE) {

// if registrations are closed, redirect to main page
	redirect("index.php");

} else if(isset($_POST['acctsubmit'])) {
/* if $_POST['acctsubmit'] is set                  */
#	$message = "Testing registration";

	$regname		= nicetext($_POST["acctname"]);
	$regpass1	= $_POST["acctpass1"];
	$regpass2	= $_POST["acctpass2"];
	$regdob		= $_POST["acctdob"];

/**
 * If the username is set, see if it is already being used
 */
	if (isset($regname)) {
		$origuname		= "SELECT * FROM users WHERE user_name='".$regname."'";
      $origunameq		= mysqli_query($dbconn, $origuname);
		while ($orignameopt = mysqli_fetch_assoc($orignameq)) {

			$nametest = $orignameopt["user_name"];

			if ($regname === $nametest) {
				$message = "USERNAME_TAKEN";
				unset($regname);
			}
     }
	} // end if isset $regname

/**
 * Time to see if the passphrase works well
 */
	if (isset($regpass1)) {
		if (isset($regpass2)) {

			// Can the user type the same passphrase twice without typos?
			if ($regpass1 !== $regpass2) {
				$message	= "PASSPHRASE_MISMATCH";
			}
		}

		// Is the passphrase at least 16 characters long?
		if (strlen($regpass1) < 16) {
			$message = "SHORT_PASSPHRASE";

		// Is the passphrase complex?
		} else if (!preg_match("/^(?=\P{Ll}*\p{Ll})(?=\P{Lu}*\p{Lu})(?=\P{N}*\p{N})(?=[\p{L}\p{N}]*[^\p{L}\p{N}])[\s\S]{8,}$/",$regpass1)) {
			$message = "NOT_COMPLEX";
		} else {

			// if it gets this far without errors, we're good
			$hash_pass = password_hash($regpass1,PASSWORD_DEFAULT);
		}

	} // end if isset $regpass1

/**
 * Let's see if the user is old enough to join
 */
	if (isset($regdob)) {

		if (user_age($regdob) < 18) {
			$message = "TOO_YOUNG";
		} else if (user_age($regdob) > 110) {
			$message = "TOO_OLD";
		}
	} // end if isset $regdob

/**
 * If we made it this far, create an ID, start a session, set cookies, etc.
 */
	if (!isset($message)) {
		$uid				= makeid($newid);
		$udatecreate	= date('Y-m-d H:i:s');
		$newq1			= "INSERT INTO users (user_id, user_name, user_pass, user_date_of_birth, user_created, user_last_login) VALUES ('$uid', '$regname', '$hash_pass', '$regdob', '$udatecreate', '$udatecreate')";
		$newq2			= "INSERT INTO user_profiles (user_profiles_id) VALUES ('$uid')";
#$message = "SQL";
		$newquery1		= mysqli_query($dbconn,$newq1);
		$newquery2		= mysqli_query($dbconn,$newq2);
		session_start();
		setcookie("uname",$regname,0);
		setcookie("id",$uid,0);
		redirect("dash/my-profile.php?uid=".$uid);
	}
/* else if $_post['acctsubmit'] is not set      */
} else {
    unset($uid);
    session_destroy();
}

include_once "main-header.php";
?>
	<!-- THE CONTAINER for the main content -->
	<main class="w3-container w3-content" style="max-width:1400px;margin-top:40px;">
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
	case "TOO_YOUNG":
		echo _("You are too young to join this website");
		break;
	case "TOO_OLD":
		echo _("There was a typo in your date of birth. Please try again.");
		break;
	case "SQL":
		echo $newq1;
		break;
}
?>
	<!-- THE GRID -->
		<div class="w3-cell-row w3-container">
			<div class="w3-col w3-cell m3 l4">
				<p>
					<?php echo _('Passphrase must be at least 16 characters long.'); ?><br><br>
					<?php echo _('Passphrase must have:')."\n"; ?>
					<ul>
						<li><?php echo _('at least one lowercase letter'); ?></li>
						<li><?php echo _('at least one uppercase letter'); ?></li>
						<li><?php echo _('at least one numeral'); ?></li>
						<li><?php echo _('at least one character that is not a number or a letter.'); ?></li>
					</ul>
				</p>
			</div>
			<div class="w3-col w3-panel w3-cell m6 l4">
			<form id="basicform" method="post" class="w3-card-2 w3-theme-l3 w3-padding maincard" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<h2 class="w3-center"><?php echo _("Create an account"); ?></h2>
					<p>
						<label for="acctname"><?php echo _('Username');?></label>
						<input type="text" name="acctname" id="acctname" class="w3-input w3-border w3-margin-bottom" required maxlength="50">
					</p>
					<p>
						<label for="acctpass1"><?php echo _('Passphrase');?></label>
						<input type="password" name="acctpass1" id="acctpass1" class="w3-input w3-border w3-margin-bottom" required>
					</p>
					<p>
						<label for="acctpass2"><?php echo _('Verify passphrase');?></label>
						<input type="password" name="acctpass2" id="acctpass2" class="w3-input w3-border w3-margin-bottom" required>
					</p>
					<p>
						<label for="acctdob"><?php echo _('Date of birth');?></label>
						<input type="date" name="acctdob" id="acctdob" class="w3-input w3-border w3-margin-bottom" required min="1900-01-01">
					</p>
				<input type="submit" name="acctsubmit" id="acctsubmit" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('TO REGISTER'); ?>">
			</form>
			</div>
			<div class="w3-col w3-cell m3 l4">&nbsp;</div> <!-- empty div for the purpose of positioning -->
		</div> <!-- end THE GRID -->
<?php
include_once "main-footer.php";
?>
