<?php
/*
 * pub/dash/admin/the-locale.php
 *
 * Displays a locale.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["i18id"])) {
	$sel_id = $_GET["i18id"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$i18q = "SELECT * FROM locales WHERE locale_id=\"".$sel_id."\"";
	$i18query = mysqli_query($dbconn,$i18q);
	while($i18opt = mysqli_fetch_assoc($i18query)) {
		$i18id		= $i18opt['locale_id'];
		$i18lang		= $i18opt['locale_language'];
		$i18ctry		= $i18opt['locale_country'];
	}
}
if ($i18_ctry != '') {
	$pagetitle = $i18lang."_".$i18ctry;
} else {
	$pagetitle = $i18lang;
}
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<table class="w3-card-2 w3-theme-l3 w3-padding">
				<caption><?php echo _($pagetitle); ?></caption>
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
include_once "admin-footer.php";
?>
