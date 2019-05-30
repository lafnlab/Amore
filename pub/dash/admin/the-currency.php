<?php
/*
 * pub/dash/admin/the-currency.php
 *
 * Displays a currency.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["did"])) {
	$sel_id = $_GET["did"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$dinq = "SELECT * FROM currencies WHERE currency_id=\"".$sel_id."\"";
	$dinquery = mysqli_query($dbconn,$dinq);
	while($dinopt = mysqli_fetch_assoc($dinquery)) {
		$dinid		= $dinopt['currency_id'];
		$dinname		= $dinopt['currency_name'];
		$diniso		= $dinopt['currency_iso'];
		$dinsym		= $dinopt['currency_symbol'];
		$dindig		= $dinopt['currency_digital'];
	}
}

$pagetitle = $dinname;
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<table class="w3-card-2 w3-theme-l3 w3-padding">
				<caption><?php echo _($dinname); ?></caption>
				<tr>
					<th><?php echo _('Currency name'); ?></th>
					<th><?php echo _('ISO code'); ?></th>
					<th><?php echo _('Symbol'); ?></th>
					<th><?php echo _('Digital'); ?></th>
				</tr>
				<tr>
					<td><?php echo _($dinname); ?></td>
					<td><?php echo _($diniso); ?></td>
					<td><?php echo _($dinsym); ?></td>
	<?php
				if ($dindig == 1) {
					echo "\t\t\t\t<td>"._('Yes')."</td>\n";
				} else {
					echo "\t\t\t\t<td>"._('No')."</td>\n";
				}
	?>
				</tr>
		</table>
	</article>
<?php
include_once "admin-footer.php";
?>
