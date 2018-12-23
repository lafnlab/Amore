<?php
// the-login.php
include_once	"../conn.php";
include			"../config.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

/* if $_POST['loginsubmit'] is set                  */
if(isset($_POST['loginsubmit'])) {

	$uname = $_POST['loginuser'];
	$upass = $_POST['loginpass'];

	$acc_query  = "SELECT * FROM usr WHERE usr_name='".$uname."'";
	$acc_q      = mysqli_query($dbconn,$acc_query);

/* is the user in the database?             			*/
	if (mysqli_num_rows($acc_q) <> 0) {

/* the user IS in the db									*/
		while ($acc_cic = mysqli_fetch_assoc($acc_q)) {
			$pass	= $acc_cic["usr_pass"];
			$id     = $acc_cic["usr_id"];

/* let us check if the password is correct			*/
 			if (password_verify($upass,$pass)) {
 				session_start();
				setcookie("id",$id,0);
				redirect("my-profile.php?uid=".$id);

/* if the password is incorrect							*/
			} else {
				$message = _("There was a problem. Please try again.");
			} /* end if password verify 					*/
		} /* end while $acc_cic								*/

/* the user IS NOT in the db								*/
	} else {
		$message = "User not found";

	}


/* else if $_post['loginsubmit'] is not set     	*/
/* probably when someone first visits the page		*/
} else {
    unset($uid);
    session_destroy();
}

$pagetitle = "Login to ".$sitetitle;
include_once "main-header.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
		<article>
			<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<table>
					<caption><?php echo _($pagetitle); ?></caption>
					<tr>
						<td class="inputlabel"><label for="loginuser"><?php echo _('Username');?></label></td>
						<td><input type="text" name="loginuser" id="loginuser" class="inputtext" required maxlength="50"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="loginpass"><?php echo _('Passphrase');?></label></td>
						<td><input type="password" name="loginpass" id="loginpass" class="inputtext" required></td>
					</tr>

				</table>
				<input type="submit" name="loginsubmit" id="loginsubmit" class="button" value="<?php echo _('Login'); ?>">
			</form>
<?php
			if($open_registration == TRUE) {
				echo "\t\t\t<a href=\"the-registration.php\">"._('Create an account')."</a>\n";
			} else {
				echo "\n\n\t\t\t<!-- registrations are closed -->\n\n";
			}
?>
		</article>
<?php
include_once "main-footer.php";
?>
