<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle = "List of time zones";


include_once "main-header.php";
?>
<!-- gets a list of time zones -->
		<article>
			<h4><?php echo _('Time zones'); ?></h4>
				<table>
					<tr>
						<td><?php echo _('Abbreviation'); ?></td>
						<td><?php echo _('Time zone name'); ?></td>
						<td><?php echo _('Offset'); ?></td>
						<td><?php echo _('DST offset'); ?></td>
					</tr>
<?php
		$tztq = "SELECT * FROM tzt ORDER BY tzt_name ASC";
		$tztquery = mysqli_query($dbconn,$tztq);

		while ($tztopt = mysqli_fetch_assoc($tztquery)) {
			$tzt_abbr	= $tztopt['tzt_abbr'];
			$tzt_name	= $tztopt['tzt_name'];
			$tzt_id		= $tztopt['tzt_id'];
			$tzt_off		= $tztopt['tzt_offset'];
			$tzt_dst		= $tztopt['tzt_dst_offset'];
			echo "\t\t\t<tr>\n";
			echo "\t\t\t\t<td>".$tzt_abbr."</td>\n";
			echo "\t\t\t\t<td><a href=\"the-time-zone.php?tzid=".$tzt_id."\">".$tzt_name."</a></td>\n";
			echo "\t\t\t\t<td>".$tzt_off."</td>\n";
			echo "\t\t\t\t<td>".$tzt_dst."</td>\n";
			echo "\t\t\t</tr>\n";
		}
?>
		</article>
<?php
include_once "main-footer.php";
?>
