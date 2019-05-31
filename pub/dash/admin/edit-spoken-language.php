<?php
/*
 * pub/dash/admin/edit-spoken-language.php
 *
 * Edit a spoken language in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["spid"])) {
	$sel_id = $_GET["spid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$spkq = "SELECT * FROM spoken_languages WHERE spoken_language_id=\"".$sel_id."\"";
	$spkquery = mysqli_query($dbconn,$spkq);
	while($spkopt = mysqli_fetch_assoc($spkquery)) {
		$spkid		= $spkopt['spoken_language_id'];
		$spkname		= $spkopt['spoken_language_name'];
	}
}

// PROCESSING
if (isset($_POST['spksubmit'])) {

	$spid			= $_POST['spkid'];
	$spname		= nicetext($_POST['spkname']);

		$spupdq 	= "UPDATE spoken_languages SET spoken_language_name='".$spname."' WHERE spoken_language_id='".$spid."'";
		$spupdquery	= mysqli_query($dbconn,$spupdq);
		redirect('list-spoken-languages.php');

} // if isset $_POST 'spksubmit'

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
				<h4><?php echo _("Edit ").$spkname; ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="spkid" value="<?php echo $spkid; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="spkname"><?php echo _('Spoken language name');?></label></td>
							<td><input type="text" name="spkname" id="spkname" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $spkname; ?>"></td>
						</tr>
					</table>
					<input type="submit" name="spksubmit" id="spksubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
