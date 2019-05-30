<?php
/*
 * pub/dash/admin/edit-hair-color.php
 *
 * Edit a hair color in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["hid"])) {
	$sel_id = $_GET["hid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$harq = "SELECT * FROM hair_colors WHERE hair_color_id=\"".$sel_id."\"";
	$harquery = mysqli_query($dbconn,$harq);
	while($haropt = mysqli_fetch_assoc($harquery)) {
		$harid		= $haropt['hair_color_id'];
		$harcolor	= $haropt['hair_color_name'];
	}
}

// PROCESSING
if (isset($_POST['harsubmit'])) {

	$haid			= $_POST['harid'];
	$hacolor		= nicetext($_POST['harcolor']);


		$hrupdq 	= "UPDATE hair_colors SET hair_color_name='".$hacolor."' WHERE hair_color_id='".$haid."'";
		$hrupdquery	= mysqli_query($dbconn,$hrupdq);
		redirect('list-hair-colors.php');

} // if isset $_POST 'harsubmit'

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
				<h4><?php echo _("Edit ").$harcolor; ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="harid" value="<?php echo $harid; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="harcolor"><?php echo _('Hair color');?></label></td>
							<td><input type="text" name="harcolor" id="harcolor" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $harcolor; ?>"></td>
						</tr>
					</table>
					<input type="submit" name="harsubmit" id="harsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
