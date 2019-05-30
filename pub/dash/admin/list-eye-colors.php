<?php
/*
 * pub/dash/admin/list-eye-colors.php
 *
 * Displays a list of eye colors in the database.
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
<!-- gets a list of eye colors -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add an eye color ')."<a href=\"add-eye-color.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo _("List of eye colors"); ?></h4>
				<table>
<?php
		$eyeq = "SELECT * FROM eye_colors ORDER BY eye_colors_color ASC";
		$eyequery = mysqli_query($dbconn,$eyeq);

		while ($eyeopt = mysqli_fetch_assoc($eyequery)) {
			$eye_name	= $eyeopt['eye_color_name'];
			$eye_id		= $eyeopt['eye_color_id'];
			echo "\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-eye-color.php?eid=".$eye_id."\">"._($eye_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-eye-color.php?eid=".$eye_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-eye-color.php?eid=".$eye_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
