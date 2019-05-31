<?php
/*
 * pub/dash/admin/edit-time-zone.php
 *
 * Edit a time zone in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["tzid"])) {
	$sel_id = $_GET["tzid"];
} else {
	$sel_id = "";
}

if ($sel_id != '') {

	$tztq = "SELECT * FROM time_zones WHERE time_zone_id=\"".$sel_id."\"";
	$tztquery = mysqli_query($dbconn,$tztq);
	while($tztopt = mysqli_fetch_assoc($tztquery)) {
		$tztid		= $tztopt['time_zone_id'];
		$tztname		= $tztopt['time_zone_name'];
		$tztoff		= $tztopt['time_zone_offset'];
		$tztdst		= $tztopt['time_zone_dst_offset'];
	}
}

// PROCESSING
if (isset($_POST['tztsubmit'])) {

	$tzid				= $_POST['tzid'];
	$tzabbr			= nicetext($_POST['tzabbr']);
	$tzname			= nicetext($_POST['tzname']);
	$tzoffset		= nicetext($_POST['tzoffset']);
	$tzdstoffset	= nicetext($_POST['tzdstoff']);

		$tzupdq 	= "UPDATE time_zones SET time_zone_name='".$tzname."',time_zone_offset='".$tzoffset."',time_zone_dst_offset='".$tzdstoffset."' WHERE time_zone_id='".$tzid."'";
		$tzupdquery	= mysqli_query($dbconn,$tzupdq);
		redirect('list-time-zones.php');

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
				<h4><?php echo _("Edit ").$tztname; ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="tzid" value="<?php echo $tztid; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="tzname"><?php echo _('Time zone name');?></label></td>
							<td><input type="text" name="tzname" id="tzname" class="w3-input w3-border w3-margin-bottom" required value="<?php echo _($tztname); ?>" maxlength="100"></td>
						</tr>
						<tr>
							<td class="inputlabel"><label for="tzoffset"><?php echo _('Time zone offset');?></label></td>
							<td><input type="text" name="tzoffset" id="tzoffset" class="w3-input w3-border w3-margin-bottom" required value="<?php echo $tztoff; ?>" maxlength="100"></td>
						</tr>
						<tr>
							<td class="inputlabel"><label for="tzdstoff"><?php echo _('Time zone DST offset');?></label></td>
							<td><input type="text" name="tzdstoff" id="tzdstoff" class="w3-input w3-border w3-margin-bottom" required value="<?php echo $tztdst; ?>" maxlength="100"></td>
						</tr>
					</table>
					<input type="submit" name="tztsubmit" id="tztsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
