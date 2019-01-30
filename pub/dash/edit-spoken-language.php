<?php
/*
 * pub/dash/edit-spoken-language.php
 *
 * Edit a spoken language in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../conn.php";
#include_once	"../config.php";
include			"../../functions.php";

if (isset($_GET["spid"])) {
	$sel_id = $_GET["spid"];
} else {
	$sel_id = "";
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
	$max_post_length			= $mysiteopt['max_post_length'];
}

if ($sel_id != '') {

	$spkq = "SELECT * FROM spoken_languages WHERE spoken_languages_id=\"".$sel_id."\"";
	$spkquery = mysqli_query($dbconn,$spkq);
	while($spkopt = mysqli_fetch_assoc($spkquery)) {
		$spkid		= $spkopt['spoken_languages_id'];
		$spkname		= $spkopt['spoken_languages_name'];
	}
}

// PROCESSING
if (isset($_POST['spksubmit'])) {

	$spid			= $_POST['spkid'];
	$spname		= nicetext($_POST['spkname']);

		$spupdq 	= "UPDATE spoken_languages SET spoken_languages_name='".$spname."' WHERE spoken_languages_id='".$spid."'";
		$spupdquery	= mysqli_query($dbconn,$spupdq);
		redirect('list-spoken-languages.php');

} // if isset $_POST 'spksubmit'

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
				<h4><?php echo _("Edit ").$spkname; ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="spkid" value="<?php echo $spkid; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="spkname"><?php echo _('Spoken language name');?></label></td>
							<td><input type="text" name="spkname" id="spkname" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $spkname; ?>"></td>
						</tr>
					</table>
					<input type="submit" name="spksubmit" id="spksubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Update'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "dash-footer.php";
?>
