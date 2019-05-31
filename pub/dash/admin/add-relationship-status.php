<?php
/*
 * pub/dash/admin/add-relationship-status.php
 *
 * Adds a relationship status to the database.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


// PROCESSING
if (isset($_POST['rstsubmit'])) {

	$rsid			= makeid($newid);
	$rsname		= nicetext($_POST['rstname']);

	// is the id unique in this table?
	$idq = "SELECT * FROM relationship_statuses WHERE relationship_status_id=\'".$rsid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$rsaddq 	= "INSERT INTO relationship_statuses (relationship_status_id, relationship_status_name) VALUES ('$sxid','$sxname')";
		$rsaddquery	= mysqli_query($dbconn,$rsaddq);
#		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
		redirect('list-relationship-statuses.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'rstsubmit'

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
				<h4><?php echo _("Add a relationship status"); ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="rstname"><?php echo _('Relationship status');?></label></td>
							<td><input type="text" name="rstname" id="rstname" class="w3-input w3-border w3-margin-bottom" required maxlength="100"></td>
						</tr>
					</table>
					<input type="submit" name="rstsubmit" id="rstsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Submit'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
