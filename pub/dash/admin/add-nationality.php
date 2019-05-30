<?php
/*
 * pub/dash/admin/add-nationality.php
 *
 * Adds a nationality to the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


// PROCESSING
if (isset($_POST['natsubmit'])) {

	$naid			= makeid($newid);
	$naname		= nicetext($_POST['natname']);

	// is the id unique in this table?
	$idq = "SELECT * FROM nationalities WHERE nationality_id=\'".$naid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$naaddq 	= "INSERT INTO nationalities (nationality_id, nationality_name) VALUES ('$naid','$naname')";
		$naaddquery	= mysqli_query($dbconn,$naaddq);
#		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
		redirect('list-nationalities.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'natsubmit'

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
				<h4><?php echo _("Add a nationality"); ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="natname"><?php echo _('Nationality name');?></label></td>
							<td><input type="text" name="natname" id="natname" class="w3-input w3-border w3-margin-bottom" required maxlength="100"></td>
						</tr>
					</table>
					<input type="submit" name="natsubmit" id="natsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Submit'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
