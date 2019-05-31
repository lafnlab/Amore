<?php
/*
 * pub/dash/admin/add-time-zone.php
 *
 * Adds a time zone to the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


// PROCESSING
if (isset($_POST['tztsubmit'])) {

	$tzid				= makeid($newid);
	$tzname			= nicetext($_POST['tzname']);
	$tzoffset		= nicetext($_POST['tzoffset']);
	$tzdstoffset	= nicetext($_POST['tzdstoff']);

	// is the id unique in this table?
	$idq = "SELECT * FROM time_zones WHERE time_zone_id=\'".$loid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$tzaddq 	= "INSERT INTO time_zones (time_zone_id, time_zone_name, time_zone_offset, time_zone_dst_offset) VALUES ('$tzid','$tzabbr','$tzname','$tzoffset','$tzdstoffset')";
		$tzaddquery	= mysqli_query($dbconn,$tzaddq);
#		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
		redirect('list-time-zones.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'tztsubmit'

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
				<h4><?php echo _("Add a time zone"); ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="tzname"><?php echo _('Time zone name');?></label></td>
							<td><input type="text" name="tzname" id="tzname" class="w3-input w3-border w3-margin-bottom" required maxlength="100"></td>
						</tr>
						<tr>
							<td class="inputlabel"><label for="tzoffset"><?php echo _('Time zone offset');?></label></td>
							<td><input type="text" name="tzoffset" id="tzoffset" class="w3-input w3-border w3-margin-bottom" required value="+00:00" maxlength="100"></td>
						</tr>
						<tr>
							<td class="inputlabel"><label for="tzdstoff"><?php echo _('Time zone DST offset');?></label></td>
							<td><input type="text" name="tzdstoff" id="tzdstoff" class="w3-input w3-border w3-margin-bottom" required value="+00:00"maxlength="100"></td>
						</tr>
					</table>
					<input type="submit" name="tztsubmit" id="tztsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Submit'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
