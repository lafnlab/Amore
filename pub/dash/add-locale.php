<?php
/*
 * pub/dash/add-locale.php
 *
 * Adds a locale to the database.
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
if (isset($_POST['i18submit'])) {

	$loid			= makeid($newid);
	$lolang		= strtolower(nicetext($_POST['i18lang'])); // must be lowercase
	$loctry		= strtoupper(nicetext($_POST['i18ctry'])); // must be uppercase

	// is the id unique in this table?
	$idq = "SELECT * FROM locales WHERE locales_id=\'".$loid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$i18addq 	= "INSERT INTO locales (locales_id, locales_language, locales_country) VALUES ('$loid','$lolang','$loctry')";
		$i18addquery	= mysqli_query($dbconn,$i18addq);
#		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
		redirect('list-locales.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'i18submit'

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
				<h4><?php echo _("Add a locale"); ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="i18lang"><?php echo _('Locale language');?></label></td>
							<td><input type="text" name="i18lang" id="i18lang" class="w3-input w3-border w3-margin-bottom" required maxlength="3"></td>
						</tr>
						<tr>
							<td class="inputlabel"><label for="i18ctry"><?php echo _('Locale country');?></label></td>
							<td><input type="text" name="i18ctry" id="i18ctry" class="w3-input w3-border w3-margin-bottom" maxlength="5"></td>
						</tr>
					</table>
					<input type="submit" name="i18submit" id="i18submit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Submit'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "dash-footer.php";
?>
