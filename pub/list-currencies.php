<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle = "LIST CURRENCIES TITLE";

include_once "main-header.php";
?>
<!-- gets a list of currencies -->
		<article>
			<h4><?php echo _('Currencies'); ?></h4>
			<table>
				<tr>
					<td><?php echo _('ISO code'); ?></td>
					<td><?php echo _('Currency name'); ?></td>
					<td><?php echo _('Symbol'); ?></td>
					<td><?php echo _('Digital?'); ?></td>
				</tr>
<?php
		$dinq = "SELECT * FROM din ORDER BY din_iso ASC";
		$dinquery = mysqli_query($dbconn,$dinq);

		while ($dinopt = mysqli_fetch_assoc($dinquery)) {
			$din_digi	= $dinopt['din_digital'];
			$din_sym		= $dinopt['din_symbol'];
			$din_name	= $dinopt['din_name'];
			$din_iso		= $dinopt['din_iso'];
			$din_id		= $dinopt['din_id'];

			if ($din_digi == 0) {
				$digital = _('No');
			} else {
				$digital = _('Yes');
			}
			echo "\t\t\t<tr>\n";
			echo "\t\t\t\t<td>".$din_iso."</td>\n";
			echo "\t\t\t\t<td><a href=\"the-currency.php?did=".$din_id."\">".$din_name."</a></td>\n";
			echo "\t\t\t\t<td>".$din_sym."</td>\n";
			echo "\t\t\t\t<td>".$digital."</td>\n";
			echo "\t\t\t</tr>\n";
		}
?>
			</table>
		</article>
<?php
include_once "main-footer.php";
?>
