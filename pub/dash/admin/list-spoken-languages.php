<?php
/*
 * pub/dash/admin/list-spoken-languages.php
 *
 * Displays a list of spoken languages in the database.
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
<!-- gets a list of spoken languages -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a spoken language ')."<a href=\"add-spoken-language.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo _("List of spoken languages"); ?></h4>
				<table>
<?php
		$spkq = "SELECT * FROM spoken_languages ORDER BY spoken_language_name ASC";
		$spkquery = mysqli_query($dbconn,$spkq);

		while ($spkopt = mysqli_fetch_assoc($spkquery)) {
			$spk_name	= $spkopt['spoken_language_name'];
			$spk_id		= $spkopt['spoken_language_id'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-spoken-language.php?spid=".$spk_id."\">"._($spk_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-spoken-language.php?spid=".$spk_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-spoken-language.php?spid=".$spk_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
