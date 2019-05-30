<?php
/*
 * pub/dash/admin/edit-nationality.php
 *
 * Edit a nationality in the database.
 *
 * since Amore version 0.2
 *
 */

 include_once	"../../../conn.php";
 include			"../../../functions.php";
 require			"../../includes/database-connect.php";
 require_once	"../../includes/configuration-data.php";

if (isset($_GET["nid"])) {
	$sel_id = $_GET["nid"];
} else {
	$sel_id = "";
}

if ($sel_id != '') {

	$natq = "SELECT * FROM nationalities WHERE nationality_id=\"".$sel_id."\"";
	$natquery = mysqli_query($dbconn,$natq);
	while($natopt = mysqli_fetch_assoc($natquery)) {
		$natid		= $natopt['nationality_id'];
		$natname		= $natopt['nationality_name'];
	}
}

// PROCESSING
if (isset($_POST['natsubmit'])) {

	$naid			= $_POST['natid'];
	$naname		= nicetext($_POST['natname']);

		$naupdq 	= "UPDATE nationalities SET nationality_name='".$naname."' WHERE nationality_id='".$naid."'";
		$naupdquery	= mysqli_query($dbconn,$naupdq);
		redirect('list-nationalities.php');

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
				<h4><?php echo _("Edit ").$natname; ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="natid" value="<?php echo $natid; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="natname"><?php echo _('Nationality name');?></label></td>
							<td><input type="text" name="natname" id="natname" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $natname; ?>"></td>
						</tr>
					</table>
					<input type="submit" name="natsubmit" id="natsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
