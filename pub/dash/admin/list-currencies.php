<?php
/*
 * pub/dash/admin/list-currencies.php
 *
 * Displays a list of currencies in the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


include_once "admin-header.php";
include_once "../dash-nav.php";
?>

<!-- gets a list of currencies -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a currency ')."<a href=\"add-currency.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4><?php echo _("List of currencies"); ?></h4>
				<table>
					<tr>
						<td><?php echo _('ISO code'); ?></td>
						<td><?php echo _('Currency name'); ?></td>
						<td><?php echo _('Symbol'); ?></td>
						<td><?php echo _('Digital?'); ?></td>
					</tr>
<?php
		$dinq = "SELECT * FROM currencies ORDER BY currency_name ASC";
		$dinquery = mysqli_query($dbconn,$dinq);

		while ($dinopt = mysqli_fetch_assoc($dinquery)) {
			$din_digi	= $dinopt['currency_digital'];
			$din_sym		= $dinopt['currency_symbol'];
			$din_name	= $dinopt['currency_name'];
			$din_iso		= $dinopt['currency_iso'];
			$din_id		= $dinopt['currency_id'];

			if ($din_digi == 0) {
				$digital = _("No");
			} else {
				$digital = _('Yes');
			}
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td>".$din_iso."</td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-currency.php?did=".$din_id."\">"._($din_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td>".$din_sym."</td>\n";
			echo "\t\t\t\t\t\t<td>".$digital."</td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-currency.php?did=".$din_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-currency.php?did=".$din_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
