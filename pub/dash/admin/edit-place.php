<?php
/*
 * pub/dash/admin/edit-place.php
 *
 * Edit a place in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["plid"])) {
	$sel_id = $_GET["plid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$plaq = "SELECT * FROM locations WHERE location_id=\"".$sel_id."\"";
	$plaquery = mysqli_query($dbconn,$plaq);
	while($plaopt = mysqli_fetch_assoc($plaquery)) {
		$plaid		= $plaopt['location_id'];
		$planame		= $plaopt['location_name'];
		$plaparent 	= $plaopt['location_parent'];
		$parents		= mb_split(',', $plaparent);
	}
}

// PROCESSING
if (isset($_POST['placesubmit'])) {

	$plid			= $_POST['placeid'];
	$plname		= nicetext($_POST['placename']);
	$plparent	= join(',',$_POST['placeparent']); // allows for multiple options


		$plupdq 	= "UPDATE locations SET location_name='".$plname."',location_parent='".$plparent."' WHERE location_id='".$plid."'";
		$plupdquery	= mysqli_query($dbconn,$plupdq);
		redirect('list-places.php');

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
				<h4><?php echo _("Edit ").$planame; ?></h4>
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
		$parentq = "SELECT * FROM locations ORDER BY location_parent,location_name ASC";
		$parentquery = mysqli_query($dbconn,$parentq);
		while ($parentopt = mysqli_fetch_assoc($parentquery)) {
			if (in_array($parentopt['location_id'],$parents)) {
				echo "\t\t\t\t\t\t\t\t\t<option selected value=\"".$parentopt['location_id']."\">".$parentopt['location_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t\t<option value=\"".$parentopt['location_id']."\">".$parentopt['location_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
				</table>
				<input type="submit" name="placesubmit" id="placesubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
			</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
