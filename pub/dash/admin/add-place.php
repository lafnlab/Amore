<?php
/*
 * pub/dash/admin/add-place.php
 *
 * Adds a place to the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


// PROCESSING
if (isset($_POST['placesubmit'])) {

	$plid			= makeid($newid);
	$plname		= nicetext($_POST['placename']);
	$plparent	= join(',',$_POST['placeparent']); // allows for multiple options

	// is the id unique in this table?
	$idq = "SELECT * FROM locations WHERE location_id=\'".$plid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$pladdq 	= "INSERT INTO locations (location_id, location_name, location_parent) VALUES ('$plid','$plname','$plparent')";
		$pladdquery	= mysqli_query($dbconn,$pladdq);
#		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
		redirect('list-places.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'placesubmit'

include_once "admin-header.php";
include_once "admin-nav.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4><?php echo _("Add a place/location"); ?></h4>
			<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<table>
					<tr>
						<td class="inputlabel"><label for="placename"><?php echo _('Place name');?></label></td>
						<td><input type="text" name="placename" id="placename" class="w3-input w3-border w3-margin-bottom" required maxlength="100"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="placeparent"><?php echo _('Place parent'); ?></label></td>
						the-relationship-status<!-- this list is an imperfect mess, at best. It will be improved at some point -->
						<td>
							<select multiple name="placeparent[]" id="placeparent" class="w3-input w3-border w3-margin-bottom">
<?php
		$parentq = "SELECT * FROM locations ORDER BY location_parent,location_name ASC";
		$parentquery = mysqli_query($dbconn,$parentq);
		while ($parentopt = mysqli_fetch_assoc($parentquery)) {
			echo "\t\t\t\t\t\t\t\t\t<option value=\"".$parentopt['location_id']."\">".$parentopt['location_name']."</option>\n";
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
include_once "admin-footer.php";
?>
