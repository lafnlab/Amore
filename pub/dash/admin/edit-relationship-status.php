<?php
/*
 * pub/dash/admin/edit-relationship-status.php
 *
 * Edit a relationship status in the database.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["rid"])) {
	$sel_id = $_GET["rid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$relq = "SELECT * FROM relationship_statuses WHERE relationship_status_id=\"".$sel_id."\"";
	$relquery = mysqli_query($dbconn,$relq);
	while($relopt = mysqli_fetch_assoc($relquery)) {
		$relid    = $relopt['relationship_status_id'];
		$relname  = $relopt['relationship_status_name'];
	}
}

// PROCESSING
if (isset($_POST['rstsubmit'])) {

	$rsid			= $_POST['rstid'];
	$rsname		= nicetext($_POST['rstname']);

		$rsupdq 	= "UPDATE relationship_statuses SET relationship_status_name='".$rsname."' WHERE relationship_status_id='".$rsid."'";
		$rsupdquery	= mysqli_query($dbconn,$rsupdq);
		redirect('list-relationship-statuses.php');

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
				<h4><?php echo _("Edit ").$relname; ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="rstid" value="<?php echo $relid; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="rstname"><?php echo _('Relationship status');?></label></td>
							<td><input type="text" name="rstname" id="rstname" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $relname; ?>"></td>
						</tr>
					</table>
					<input type="submit" name="rstsubmit" id="rstsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
