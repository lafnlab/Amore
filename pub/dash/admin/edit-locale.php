<?php
/*
 * pub/dash/admin/edit-locale.php
 *
 * Edit a locale in the database.
 *
 * since Amore version 0.2
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

if ($i18ctry != "") {
	$pagetitle 	= $i18lang."_".$i18ctry;
} else {
	$pagetitle	= $i18lang;
}

// PROCESSING
if (isset($_POST['i18submit'])) {

	$loid			= $_POST['i18id'];
	$lolang		= strtolower(nicetext($_POST['i18lang'])); // must be lowercase
	$loctry		= strtoupper(nicetext($_POST['i18ctry'])); // must be uppercase



		$i18updq 	= "UPDATE locales SET locale_language='".$i18lang."',locale_country='".$i18ctry."' WHERE locale_id='".$i18id."'";
		$i18updquery	= mysqli_query($dbconn,$i18updq);
		redirect('list-locales.php');


} // if isset $_POST 'i18submit'

include_once "admin-header.php";
include_once "admin-nav.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4><?php echo _("Edit ").$pagetitle; ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="i18id" value="<?php echo $i18id; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="i18lang"><?php echo _('Locale language');?></label></td>
							<td><input type="text" name="i18lang" id="i18lang" class="w3-input w3-border w3-margin-bottom" maxlength="3" value="<?php echo $i18lang; ?>"></td>
						</tr>
						<tr>
							<td class="inputlabel"><label for="i18ctry"><?php echo _('Locale country');?></label></td>
							<td><input type="text" name="i18ctry" id="i18ctry" class="w3-input w3-border w3-margin-bottom" maxlength="5" value="<?php echo $i18ctry; ?>"></td>
						</tr>
					</table>
					<input type="submit" name="i18submit" id="i18submit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
