<?php
/*
 * pub/dash/admin/list-nationalities.php
 *
 * Displays a list of nationalities in the database.
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
<!-- gets a list of nationalities -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a nationality ')."<a href=\"add-nationality.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4><?php echo _("List of nationalities"); ?></h4>
				<table>
<?php
		$natq = "SELECT * FROM nationalities ORDER BY nationality_name ASC";
		$natquery = mysqli_query($dbconn,$natq);

		while ($natopt = mysqli_fetch_assoc($natquery)) {
			$nat_name	= $natopt['nationality_name'];
			$nat_id		= $natopt['nationality_id'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-nationality.php?nid=".$nat_id."\">"._($nat_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-nationality.php?nid=".$nat_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-nationality.php?nid=".$nat_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
