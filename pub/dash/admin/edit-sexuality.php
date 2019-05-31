<?php
/*
 * pub/dash/admin/edit-sexuality.php
 *
 * Edit a sexuality in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["sid"])) {
	$sel_id = $_GET["sid"];
} else {
	$sel_id = "";
}

if ($sel_id != '') {

	$sexq = "SELECT * FROM sexualities WHERE sexuality_id=\"".$sel_id."\"";
	$sexquery = mysqli_query($dbconn,$sexq);
	while($sexopt = mysqli_fetch_assoc($sexquery)) {
		$sexid		= $sexopt['sexuality_id'];
		$sexname		= $sexopt['sexuality_name'];
	}
}

// PROCESSING
if (isset($_POST['sxusubmit'])) {

	$sxid			= $_POST['sxuid'];
	$sxname		= nicetext($_POST['sxuname']);

		$sxupdq 	= "UPDATE sexualities SET sexuality_name='".$sxname."' WHERE sexuality_id='".$sxid."'";
		$sxupdquery	= mysqli_query($dbconn,$sxupdq);
		redirect('list-sexualites.php');

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
				<h4><?php echo _("Edit ").$sexname; ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="sxuid" value="<?php echo $sexid; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="sxuname"><?php echo _('Sexuality name');?></label></td>
							<td><input type="text" name="sxuname" id="sxuname" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $sexname; ?>"></td>
						</tr>
					</table>
					<input type="submit" name="sxusubmit" id="sxusubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
