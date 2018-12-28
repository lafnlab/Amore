<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

if (isset($_GET["i18id"])) {
	$sel_id = $_GET["i18id"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

if ($sel_id != '') {

	$i18q = "SELECT * FROM i18 WHERE i18_id=\"".$sel_id."\"";
	$i18query = mysqli_query($dbconn,$i18q);
	while($i18opt = mysqli_fetch_assoc($i18query)) {
		$i18id		= $i18opt['i18_id'];
		$i18lang		= $i18opt['i18_language'];
		$i18ctry		= $i18opt['i18_country'];
	}
}

$pagetitle = $i18lang."-".$i18ctry;
include_once 'main-header.php';
?>
	<article>
		<h4><?php echo _($pagetitle); ?></h4>
		<table>
			<tr>
				<th><?php echo _('Language'); ?></th>
				<th><?php echo _('Country'); ?></th>
			</tr>
			<tr>
				<td><?php echo _($i18lang); ?></td>
				<td><?php echo _($i18ctry); ?></td>
			</tr>
		</table>
	</article>
<?php
include_once "main-footer.php";
?>
