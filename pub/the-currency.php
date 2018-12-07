<?php
include_once	"../conn.php";
include			"../functions.php";

if (isset($_GET["did"])) {
	$sel_id = $_GET["did"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

if ($sel_id != '') {

	$dinq = "SELECT * FROM din WHERE din_id=\"".$sel_id."\"";
	$dinquery = mysqli_query($dbconn,$dinq);
	while($dinopt = mysqli_fetch_assoc($dinquery)) {
		$dinid		= $dinopt['din_id'];
		$dinname		= $dinopt['din_name'];
		$diniso		= $dinopt['din_iso'];
		$dinsym		= $dinopt['din_symbol'];
		$dindig		= $dinopt['din_digital'];
	}
}

$pagetitle = $dinname;
include_once 'main-header.php';
?>
	<article>
		<h4><?php echo _($dinname); ?></h4>
		<table>
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
include_once "main-footer.php";
?>
