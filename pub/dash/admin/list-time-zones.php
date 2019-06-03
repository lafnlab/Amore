<?php
/*
 * pub/dash/admin/list-time-zones.php
 *
 * Displays a list of time zones in the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


include_once "admin-header.php";
include_once "admin-nav.php";
?>
<!-- gets a list of time zones -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a time zone ')."<a href=\"add-time-zone.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo _("List of time zones"); ?></h4>
				<table>
					<tr>
						<th><?php echo _("Time zone name"); ?></th>
						<th><?php echo _("Offset"); ?></th>
						<th><?php echo _("DST offset"); ?></th>
						<th colspan="2"><?php echo _("Actions"); ?></th>
					</tr>
<?php
		$tztq = "SELECT * FROM time_zones ORDER BY time_zone_name ASC";
		$tztquery = mysqli_query($dbconn,$tztq);

		while ($tztopt = mysqli_fetch_assoc($tztquery)) {
			$tzt_name	= $tztopt['time_zone_name'];
			$tzt_id		= $tztopt['time_zone_id'];
			$tzt_off		= $tztopt['time_zone_offset'];
			$tzt_dst		= $tztopt['time_zone_DST_offset'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-time-zone.php?tzid=".$tzt_id."\">"._($tzt_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td>".$tzt_off."</td>\n";
			echo "\t\t\t\t\t\t<td>".$tzt_dst."</td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-time-zone.php?tzid=".$tzt_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-time-zone.php?tzid=".$tzt_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
