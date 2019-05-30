<?php
/*
 * pub/dash/admin/edit-gender.php
 *
 * Edit a gender in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["gid"])) {
	$sel_id = $_GET["gid"];
} else {
	$sel_id = "";
}

if ($sel_id != '') {

	$genq = "SELECT * FROM genders WHERE gender_id=\"".$sel_id."\"";
	$genquery = mysqli_query($dbconn,$genq);
	while($genopt = mysqli_fetch_assoc($genquery)) {
		$genid		= $genopt['gender_id'];
		$genname		= $genopt['gender_name'];
	}
}

// PROCESSING
if (isset($_POST['gensubmit'])) {

	$gnid			= $_POST['genid'];
	$gnname		= nicetext($_POST['genname']);

	$genupdq = "UPDATE genders SET gender_name='".$gnname."' WHERE gender_id='".$gnid."'";
	$genupdquery = mysqli_query($dbconn,$genupdq);
	redirect('list-genders.php');

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
				<h4><?php echo _("Edit ").$genname; ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="genid" value="<?php echo $genid; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="genname"><?php echo _('Gender name');?></label></td>
							<td><input type="text" name="genname" id="genname" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $genname; ?>"></td>
						</tr>
					</table>
					<input type="submit" name="gensubmit" id="gensubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
