<?php
/*
 * pub/dash/add-place.php
 *
 * Adds a place to the database.
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
if (isset($_POST['placesubmit'])) {

	$plid			= makeid($newid);
	$plname		= nicetext($_POST['placename']);
	$plparent	= join(',',$_POST['placeparent']); // allows for multiple options

	// is the id unique in this table?
	$idq = "SELECT * FROM locations WHERE locations_id=\'".$plid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$pladdq 	= "INSERT INTO locations (locations_id, locations_name, locations_parent) VALUES ('$plid','$plname','$plparent')";
		$pladdquery	= mysqli_query($dbconn,$pladdq);
#		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
		redirect('list-places.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'placesubmit'

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
				<h4><?php echo _("Add a place/location)"; ?></h4>
			<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<table>
					<tr>
						<td class="inputlabel"><label for="placename"><?php echo _('Place name');?></label></td>
						<td><input type="text" name="placename" id="placename" class="w3-input w3-border w3-margin-bottom" required maxlength="100"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="placeparent"><?php echo _('Place parent'); ?></label></td>
						<!-- this list is an imperfect mess, at best. It will be improved at some point -->
						<td>
							<select multiple name="placeparent[]" id="placeparent" class="w3-input w3-border w3-margin-bottom">
<?php
		$parentq = "SELECT * FROM locations ORDER BY locations_parent,locations_name ASC";
		$parentquery = mysqli_query($dbconn,$parentq);
		while ($parentopt = mysqli_fetch_assoc($parentquery)) {
			echo "\t\t\t\t\t\t\t\t\t<option value=\"".$parentopt['locations_id']."\">".$parentopt['locations_name']."</option>\n";
		}
?>
							</select>
						</td>
					</tr>
				</table>
				<input type="submit" name="placesubmit" id="placesubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Submit'); ?>">
			</form>
</div>
		</article>

<?php
include_once "dash-footer.php";
?>
