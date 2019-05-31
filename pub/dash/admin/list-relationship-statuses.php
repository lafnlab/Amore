<?php
/*
 * pub/dash/admin/list-relationship-statuses.php
 *
 * Displays a list of relationship statuses in the database.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


include_once "admin-header.php";
include_once "admin-nav.php";
?>
<!-- gets a list of relationship statuses -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a relationship status ')."<a href=\"add-relationship-status.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4><?php echo _("List of relationship statuses"); ?></h4>
				<table>
<?php
		$rstq = "SELECT * FROM relationship_statuses ORDER BY relationship_status_name ASC";
		$rstquery = mysqli_query($dbconn,$rstq);

		while ($rstopt = mysqli_fetch_assoc($rstquery)) {
			$rst_name	= $rstopt['relationship_status_name'];
			$rst_id		= $rstopt['relationship_status_id'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-relationship-status.php?rid=".$rst_id."\">"._($rst_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-relationship-status.php?rid=".$rst_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-relationship-status.php?rid=".$rst_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
