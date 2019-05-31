<?php
/*
 * pub/dash/admin/the-time-zone.php
 *
 * Displays a time zone.
 *
 * since Amore version 0.1
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

$pagetitle = $tztname;
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<table class="w3-card-2 w3-theme-l3 w3-padding">
				<caption><?php echo _($pagetitle); ?></caption>
				<tr>
					<th><?php echo _('Name'); ?></th>
					<th><?php echo _('Offset'); ?></th>
					<th><?php echo _('DST offset'); ?></th>
				</tr>
				<tr>
					<td><?php echo _($tztname); ?></td>
					<td><?php echo _($tztoff); ?></td>
					<td><?php echo _($tztdst); ?></td>
				</tr>
			</table>
		</article>
<?php
include_once "admin-footer.php";
?>
