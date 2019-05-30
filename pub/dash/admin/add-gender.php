<?php
/*
 * pub/dash/admin/add-gender.php
 *
 * Adds a gender to the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

// PROCESSING
if (isset($_POST['gensubmit'])) {

	$gnid			= makeid($newid);
	$gnname		= nicetext($_POST['genname']);

	// is the id unique in this table?
	$idq = "SELECT * FROM genders WHERE gender_id=\'".$gnid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$geaddq 	= "INSERT INTO genders (gender_id, gender_name) VALUES ('$gnid','$gnname')";
		$geaddquery	= mysqli_query($dbconn,$geaddq);
#		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
		redirect('list-genders.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'gensubmit'

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
				<h4><?php echo _("Add a gender"); ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="genname"><?php echo _('Gender name');?></label></td>
							<td><input type="text" name="genname" id="genname" class="w3-input w3-border w3-margin-bottom" required maxlength="100"></td>
						</tr>
					</table>
					<input type="submit" name="gensubmit" id="gensubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Submit'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
