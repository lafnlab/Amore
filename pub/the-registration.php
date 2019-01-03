<?php
/*
 * pub/the-registration.php
 *
 * The main registration page for Amore. Also provides functionality for registration widget on main page
 *
 * since Amore version 0.1
 */

include_once	"../conn.php";
#include_once	"../config.php"; // use the configuration table instead
include			"../functions.php";

// see if a session is set and get the username, if so.
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
	$banned_user_names		= $mysiteopt['banned_user_names'];
}

if($open_registration == FALSE) {

// if registrations are closed, redirect to main page
	redirect("index.php");

} else if(isset($_POST['acctsubmit'])) {
/* if $_POST['acctsubmit'] is set                  */

/* if a user id is set                          	*/
    if(isset($uid)) {

        // uncomment for testing
        #session_start();

/* and session is not set                      		*/
        if(!session_id()) {

/* if a userid is set, but a session is not, unset the user id and send them to the home page */
            unset($uid);
            redirect("index.php");
        } else {

/* if a userid is set and a session is set, go to the profile page */
            redirect("dash/my-profile.php?uid=".$uid);
        }

/* else a user id is not set                    */
    } else {
        $uname			= $_POST['acctname'];
        $upass1		= $_POST['acctpass1'];
        $upass2		= $_POST['acctpass2'];
        $udob			= $_POST['acctdob'];

/* if the username is set                       */
        if(isset($uname)) {

/* check if the username is banned             */
            $unamel = strtolower($uname);
            if(in_array($unamel,$banned_user_names)) {

/* if it's banned, show an error                */
                $message = "Username is banned";

            } else {

/* check if username is already being used      */
                $origuname     = "SELECT * FROM users WHERE user_name='".$uname."'";
                $origuname_q   = mysqli_query($dbconn, $origuname);
                if (mysqli_num_rows($origuname_q) <> 0) {

/* error if it's already taken                  */
                    $message = "username is taken";
                    unset($uname);
                } #else {
                  #  $name = "ok";
                #}
            }

/* if username is not set, something is wrong. redirect them to main page */
        } else {
            redirect("index.php");
        }

/* if a password is set                         */
        if(isset($upass1)) {

/* if a password is verified							*/
				if(isset($upass2)) {
					if($upass1 !== $upass2) {
						$message = "Passphrases do not match";
					}
				} else {
					$message = "Please verify the passphrase";
				}

/* if it is too short, error                    */
            if(strlen($upass1) < 16) {
                $message = "Passphrase is too short.";

/* Is the password complex enough?              */
            } else if (!preg_match("/^(?=\P{Ll}*\p{Ll})(?=\P{Lu}*\p{Lu})(?=\P{N}*\p{N})(?=[\p{L}\p{N}]*[^\p{L}\p{N}])[\s\S]{8,}$/",$upass1)){
                $message = "Password is not complex";
            } else {
/* encrypt the password                         */
                $hash_pass = password_hash($upass1,PASSWORD_DEFAULT);
            }

/* if the password is not set, something is wrong. redirect them to the main page */
        } else {
            redirect("index.php");
        }

/* if a date of birth is set                    */
        if(isset($udob)) {

/* if age < 18, show an error                   */
            if(user_age($udob) < 18) {
                $message = "You are too young";
            } else if (user_age($udob) > 110) {
                $message = "Your date of birth had a typo. Try again";
            }
        }

/* if we made it this far, start a session, create an id, enter user in DB, and go to the profile page */
        if (!isset($message)) {
            $uid 				= makeid($newid);
            $udatecreate	= date('Y-m-d H:i:s');
            $new_query = "INSERT INTO users (user_id, user_name, user_pass, user_email, user_dob, user_outbox, user_inbox, user_liked, user_follows, user_followers, user_created, user_last_login) VALUES ('$uid', '$uname', '$hash_pass', '', '$udob', '', '', '', '', '', '$udatecreate', '$udatecreate')";
#		$message = $new_query;
				$new_add = mysqli_query($dbconn,$new_query);
				session_start();
				redirect("dash/my-profile.php?uid=".$uid);
        }
    }

/* else if $_post['acctsubmit'] is not set      */
} else {
    unset($uid);
    session_destroy();
}

$pagetitle = "Create an account";
include_once "main-header.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
	<!-- THE CONTAINER for the main content -->
	<main class="w3-container w3-content" style="max-width:1400px;margin-top:40px;">

		<!-- THE GRID -->
		<div class="w3-cell-row w3-container">
			<div class="w3-col w3-cell m3 l4">
				<p>
					<?php echo _('Password must be at least 16 characters long'); ?>.<br><br>
					<?php echo _('Password must have:'); ?>
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
					<h2 class="w3-center"><?php echo _($pagetitle); ?></h2>
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
				<input type="submit" name="acctsubmit" id="acctsubmit" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('Register'); ?>">
			</form>
			</div>
			<div class="w3-col w3-cell m3 l4">&nbsp;</div> <!-- empty div for the purpose of positioning -->
		</div> <!-- end THE GRID -->
<?php
include_once "main-footer.php";
?>
