<?php
/*
 * pub/dash/add-sexuality.php
 *
 * Adds a sexuality to the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../conn.php";
include			"../../functions.php";

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
	$max_post_length			= $mysiteopt['max_post_length'];
}

// PROCESSING
if (isset($_POST['sxusubmit'])) {

	$sxid			= makeid($newid);
	$sxname		= nicetext($_POST['sxuname']);

	// is the id unique in this table?
	$idq = "SELECT * FROM sexualities WHERE sexualities_id=\'".$naid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$sxaddq 	= "INSERT INTO sexualities (sexualities_id, sexualities_name) VALUES ('$sxid','$sxname')";
		$sxaddquery	= mysqli_query($dbconn,$sxaddq);
#		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
		redirect('list-sexualities.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'sxusubmit'

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
				<h4><?php echo _("Add a sexuality"); ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="sxuname"><?php echo _('Sexuality name');?></label></td>
							<td><input type="text" name="sxuname" id="sxuname" class="w3-input w3-border w3-margin-bottom" required maxlength="100"></td>
						</tr>
					</table>
					<input type="submit" name="sxusubmit" id="sxusubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Submit'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "dash-footer.php";
?>
