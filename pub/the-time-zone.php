<?php
include_once	"../conn.php";
include			"../functions.php";

if (isset($_GET["tzid"])) {
	$sel_id = $_GET["tzid"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

if ($sel_id != '') {

	$tztq = "SELECT * FROM tzt WHERE tzt_id=\"".$sel_id."\"";
	$tztquery = mysqli_query($dbconn,$tztq);
	while($tztopt = mysqli_fetch_assoc($tztquery)) {
		$tztid		= $tztopt['tzt_id'];
		$tztabbr		= $tztopt['tzt_abbr'];
		$tztname		= $tztopt['tzt_name'];
		$tztoff		= $tztopt['tzt_offset'];
		$tztdst		= $tztopt['tzt_dst_offset'];
	}
}

$pagetitle = $tztname;
include_once 'main-header.php';
?>
	<article>
		<h4><?php echo _($tztname); ?></h4>
		<table>
			<tr>
				<th><?php echo _('Abbreviation'); ?></th>
				<th><?php echo _('Offset'); ?></th>
				<th><?php echo _('DST offset'); ?></th>
			</tr>
			<tr>
				<td><?php echo _($tztabbr); ?></td>
				<td><?php echo _($tztoff); ?></td>
				<td><?php echo _($tztdst); ?></td>
			</tr>
		</table>
	</article>
<?php
include_once "main-footer.php";
?>
