<?php
/*
 * pub/dash/edit-place.php
 *
 * Edit a place in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../conn.php";
#include_once	"../config.php";
include			"../../functions.php";

if (isset($_GET["plid"])) {
	$sel_id = $_GET["plid"];
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

	$plaq = "SELECT * FROM locations WHERE locations_id=\"".$sel_id."\"";
	$plaquery = mysqli_query($dbconn,$plaq);
	while($plaopt = mysqli_fetch_assoc($plaquery)) {
		$plaid		= $plaopt['locations_id'];
		$planame		= $plaopt['locations_name'];
		$plaparent 	= $plaopt['locations_parent'];
		$parents		= mb_split(',', $plaparent);
	}
}

$pagetitle 	= "Edit ".$planame;
#$message		= 'test message';

// PROCESSING
if (isset($_POST['placesubmit'])) {

	$plid			= $_POST['placeid'];
	$plname		= nicetext($_POST['placename']);
	$plparent	= join(',',$_POST['placeparent']); // allows for multiple options


		$plupdq 	= "UPDATE locations SET locations_name='".$plname."',locations_parent='".$plparent."' WHERE locations_id='".$plid."'";
		$plupdquery	= mysqli_query($dbconn,$plupdq);
		redirect('list-places.php');

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
				<h4><?php echo _($pagetitle); ?></h4>
			<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<input type="hidden" name="placeid" value="<?php echo $plaid; ?>">
				<table>
					<tr>
						<td class="inputlabel"><label for="placename"><?php echo _('Place name');?></label></td>
						<td><input type="text" name="placename" id="placename" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $planame; ?>"></td>
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
			if (in_array($parentopt['locations_id'],$parents)) {
				echo "\t\t\t\t\t\t\t\t\t<option selected value=\"".$parentopt['locations_id']."\">".$parentopt['locations_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t\t<option value=\"".$parentopt['locations_id']."\">".$parentopt['locations_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
				</table>
				<input type="submit" name="placesubmit" id="placesubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Update'); ?>">
			</form>
</div>
		</article>

<?php
include_once "dash-footer.php";
?>
