<?php
/*
 * pub/dash/admin/list-locales.php
 *
 * Displays a list of locales in the database.
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
<!-- gets a list of locales -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a locale ')."<a href=\"add-locale.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo _("List of locales"); ?></h4>
				<table>
<?php
		$i18q = "SELECT * FROM locales ORDER BY locale_language,locale_country ASC";
		$i18query = mysqli_query($dbconn,$i18q);

		while ($i18opt = mysqli_fetch_assoc($i18query)) {
			$i18_lang	= $i18opt['locale_language'];
			$i18_ctry	= $i18opt['locale_country'];
			$i18_id		= $i18opt['locale_id'];
			echo "\t\t\t\t<tr>\n";
			if ($i18_ctry != '') {
				echo "\t\t\t\t\t\t<td><a href=\"the-locale.php?i18id=".$i18_id."\">".$i18_lang."_".$i18_ctry."</a></td>\n";
			} else {
				echo "\t\t\t\t\t\t<td><a href=\"the-locale.php?i18id=".$i18_id."\">".$i18_lang."</a></td>\n";
			}
			echo "\t\t\t\t\t\t<td><a href=\"edit-locale.php?i18id=".$i18_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-locale.php?i18id=".$i18_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
