<?php
/*
 * pub/dash/admin/add-hair-color.php
 *
 * Adds a hair color to the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


// PROCESSING
if (isset($_POST['harsubmit'])) {

	$haid			= makeid($newid);
	$hacolor		= nicetext($_POST['harcolor']);

	// is the id unique in this table?
	$idq = "SELECT * FROM hair_colors WHERE hair_color_id=\'".$haid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$hraddq 	= "INSERT INTO hair_colors (hair_color_id, hair_color_name) VALUES ('$haid','$hacolor')";
		$hraddquery	= mysqli_query($dbconn,$hraddq);
#		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
		redirect('list-hair-colors.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

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
				<h4><?php echo _("Add a hair color"); ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="harcolor"><?php echo _('Hair color');?></label></td>
							<td><input type="text" name="harcolor" id="harcolor" class="w3-input w3-border w3-margin-bottom" required maxlength="100"></td>
						</tr>
					</table>
					<input type="submit" name="harsubmit" id="harsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Submit'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
