<?php
/*
 * pub/dash/admin/add-sexuality.php
 *
 * Adds a sexuality to the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


// PROCESSING
if (isset($_POST['sxusubmit'])) {

	$sxid			= makeid($newid);
	$sxname		= nicetext($_POST['sxuname']);

	// is the id unique in this table?
	$idq = "SELECT * FROM sexualities WHERE sexuality_id=\'".$sxid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$sxaddq 	= "INSERT INTO sexualities (sexuality_id, sexuality_name) VALUES ('$sxid','$sxname')";
		$sxaddquery	= mysqli_query($dbconn,$sxaddq);
#		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
		redirect('list-sexualities.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'sxusubmit'

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
				<h4><?php echo _("Add a sexuality"); ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="sxuname"><?php echo _('Sexuality name');?></label></td>
							<td><input type="text" name="sxuname" id="sxuname" class="w3-input w3-border w3-margin-bottom" required maxlength="100"></td>
						</tr>
					</table>
					<input type="submit" name="sxusubmit" id="sxusubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Submit'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
