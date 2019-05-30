<?php
/*
 * pub/dash/admin/list-hair-colors.php
 *
 * Displays a list of hair colors in the database.
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
<!-- gets a list of hair colors -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a hair color ')."<a href=\"add-hair-color.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo _("List of hair colors"); ?></h4>
				<table>
<?php
		$harq = "SELECT * FROM hair_colors ORDER BY hair_color_name ASC";
		$harquery = mysqli_query($dbconn,$harq);

		while ($haropt = mysqli_fetch_assoc($harquery)) {
			$har_name	= $haropt['hair_color_name'];
			$har_id		= $haropt['hair_color_id'];
			echo "\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-hair-color.php?hid=".$har_id."\">"._($har_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-hair-color.php?hid=".$har_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-hair-color.php?hid=".$har_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "dash-footer.php";
?>
