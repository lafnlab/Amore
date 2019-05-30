<?php
/*
 * pub/dash/admin/edit-eye-color.php
 *
 * Edit an eye color in the database.
 *
 * since Amore version 0.2
 *
 */

 include_once	"../../../conn.php";
 include			"../../../functions.php";
 require			"../../includes/database-connect.php";
 require_once	"../../includes/configuration-data.php";

if (isset($_GET["eid"])) {
	$sel_id = $_GET["eid"];
} else {
	$sel_id = "";
}

if ($sel_id != '') {

	$eyeq = "SELECT * FROM eye_colors WHERE eye_color_id=\"".$sel_id."\"";
	$eyequery = mysqli_query($dbconn,$eyeq);
	while($eyeopt = mysqli_fetch_assoc($eyequery)) {
		$eyeid		= $eyeopt['eye_color_id'];
		$eyecolor	= $eyeopt['eye_color_name'];
	}
}

// PROCESSING
if (isset($_POST['eyesubmit'])) {

	$eyid			= $_POST['eyeid'];
	$eycolor		= nicetext($_POST['eyecolor']);

		$eyupdq 	= "UPDATE eye_colors SET eye_color_name='".$eycolor."' WHERE eye_color_id='".$eyid."'";
		$eyupdquery	= mysqli_query($dbconn,$eyupdq);
		redirect('list-eye-colors.php');

} // if isset $_POST 'eyesubmit'

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
				<h4><?php echo _("Edit ").$eyecolor._(" eye color"); ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="eyeid" value="<?php echo $eyeid; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="eyecolor"><?php echo _('Eye color');?></label></td>
							<td><input type="text" name="eyecolor" id="eyecolor" class="w3-input w3-border w3-margin-bottom" value="<?php echo $eyecolor; ?>" maxlength="100"></td>
						</tr>
					</table>
					<input type="submit" name="eyesubmit" id="eyesubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
