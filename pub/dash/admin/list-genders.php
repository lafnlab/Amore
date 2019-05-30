<?php
/*
 * pub/dash/admin/list-genders.php
 *
 * Displays a list of genders in the database.
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
<!-- gets a list of genders -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a gender ')."<a href=\"add-gender.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo _("List of genders"); ?></h4>
				<table>
<?php
		$genq = "SELECT * FROM genders ORDER BY gender_name ASC";
		$genquery = mysqli_query($dbconn,$genq);

		while ($genopt = mysqli_fetch_assoc($genquery)) {
			$gen_name	= $genopt['gender_name'];
			$gen_id		= $genopt['gender_id'];
			echo "\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-gender.php?gid=".$gen_id."\">"._($gen_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-gender.php?gid=".$gen_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-gender.php?gid=".$gen_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
