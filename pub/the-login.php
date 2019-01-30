<?php
/*
 * pub/the-login.php
 *
 * The main login page for Amore. Also provides functionality for login widget on main page
 *
 * since Amore version 0.1
 */

include_once	"../conn.php";
#include			"../config.php"; // use the configuration table instead
include			"../functions.php";

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

/* if $_POST['loginsubmit'] is set                  */
if(isset($_POST['loginsubmit'])) {

	$uname = $_POST['loginuser'];
	$upass = $_POST['loginpass'];

	$acc_query  = "SELECT * FROM users WHERE user_name='".$uname."'";
	$acc_q      = mysqli_query($dbconn,$acc_query);

/* is the user in the database?             			*/
	if (mysqli_num_rows($acc_q) <> 0) {

/* the user IS in the db									*/
		while ($acc_cic = mysqli_fetch_assoc($acc_q)) {
			$pass	= $acc_cic["user_pass"];
			$id     = $acc_cic["user_id"];

/* let us check if the password is correct			*/
 			if (password_verify($upass,$pass)) {
 				session_start();
				setcookie("id",$id,0);
				setcookie("uname",$uname,0);
				$loginq = "UPDATE users SET user_last_login='".date('Y-m-d H:i:s')."' WHERE user_id='".$id."'";
				$loginquery = mysqli_query($dbconn,$loginq);
				redirect("dash/my-profile.php?uid=".$id);

/* if the password is incorrect							*/
			} else {
				$message = _("There was a problem. Please try again.");
			} /* end if password verify 					*/
		} /* end while $acc_cic								*/

/* the user IS NOT in the db								*/
	} else {
		$message = _("User not found");

	}


/* else if $_post['loginsubmit'] is not set     	*/
/* probably when someone first visits the page		*/
} else {
    unset($uid);
    session_destroy();
}

$pagetitle = _("Login to ").$website_name;
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
			<div class="w3-col w3-cell m3 l4">&nbsp;</div>

			<div class="w3-col w3-panel w3-cell m6 l4">
				<form id="basicform" method="post" class="w3-card-2 w3-theme-l3 w3-padding maincard" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<h2 class="w3-center"><?php echo  $pagetitle; ?></h2>
					<p>
						<label for="loginuser"><?php echo _('Username'); ?></label>
						<input type="text" name="loginuser" id="loginuser" class="w3-input w3-border w3-margin-bottom" required maxlength="50">
					</p>
					<p>
						<label for="loginpass"><?php echo _('Passphrase'); ?></label>
						<input type="password" name="loginpass" id="loginpass" class="w3-input w3-border w3-margin-bottom" required>
					</p>
					<input type="submit" name="loginsubmit" id="loginsubmit" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('Login'); ?>">
				</form>
	<?php
				if($open_registration == TRUE) {
					echo "\t\t\t<a href=\"the-registration.php\">"._('Create an account')."</a>\n";
				} else {
					echo "\n\n\t\t\t<!-- registrations are closed -->\n\n";
				}
	?>
			</div>
			<div class="w3-col w3-cell m3 l4">&nbsp;</div>
		</div> <!-- end THE GRID -->
<?php
include_once "main-footer.php";
?>
