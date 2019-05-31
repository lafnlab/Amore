<?php
/*
 * pub/dash/admin/list-sexualities.php
 *
 * Displays a list of sexualities in the database.
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
<!-- gets a list of sexualities -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a sexuality ')."<a href=\"add-sexuality.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4><?php echo _("List of sexualities"); ?></h4>
				<table>
<?php
		$sxuq = "SELECT * FROM sexualities ORDER BY sexualities_name ASC";
		$sxuquery = mysqli_query($dbconn,$sxuq);

		while ($sxuopt = mysqli_fetch_assoc($sxuquery)) {
			$sxu_name	= $sxuopt['sexuality_name'];
			$sxu_id		= $sxuopt['sexuality_id'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-sexuality.php?sid=".$sxu_id."\">"._($sxu_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-sexuality.php?sid=".$sxu_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-sexuality.php?sid=".$sxu_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
