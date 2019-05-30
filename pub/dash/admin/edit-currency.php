<?php
/*
 * pub/dash/admin/edit-currency.php
 *
 * Edit a currency in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["did"])) {
	$sel_id = $_GET["did"];
} else {
	$sel_id = "";
}

if ($sel_id != '') {

	$dinq = "SELECT * FROM currencies WHERE currency_id=\"".$sel_id."\"";
	$dinquery = mysqli_query($dbconn,$dinq);
	while($dinopt = mysqli_fetch_assoc($dinquery)) {
		$dinid		= $dinopt['currency_id'];
		$dinname		= $dinopt['currency_name'];
		$diniso		= $dinopt['currency_iso'];
		$dinsym		= $dinopt['currency_symbol'];
		$dindig		= $dinopt['currency_digital'];
	}
}

// PROCESSING
if (isset($_POST['currsubmit'])) {

	$currid			= $_POST['currid'];
	$currname		= nicetext($_POST['currname']);
	$curriso			= nicetext($_POST['curriso']);
	$currsym			= nicetext($_POST['currsym']);
	if(isset($_POST['currdigi'])) {
		$currdigi	= 1;
	} else {
		$currdigi	= 0;
	}

		$crupdq 	= "UPDATE currencies SET currency_name='".$currname."', currency_iso='".$curriso."', currency_symbol='".$currsym."', currency_digital='".$currdigi."' WHERE currency_id='".$currid."'";
		$crupdquery	= mysqli_query($dbconn,$crupdq);

		redirect('list-currencies.php');

} // if isset $_POST 'currsubmit'

include_once "admin-header.php";
include_once "../dash-nav.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4><?php echo _("Edit ").$dinname; ?></h4>
				<table>
					<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<input type="hidden" name="currid" value="<?php echo $dinid; ?>">
					<tr>
						<td class="inputlabel"><label for="currname"><?php echo _('Currency name');?></label></td>
						<td><input type="text" name="currname" id="currname" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $dinname; ?>"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="curriso"><?php echo _('ISO code');?></label></td>
						<td><input type="text" name="curriso" id="curriso" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $diniso; ?>"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="currsym"><?php echo _('Symbol');?></label></td>
						<td><input type="text" name="currsym" id="currsym" class="w3-input w3-border w3-margin-bottom" maxlength="10" value="<?php echo $dinsym; ?>"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="currdigi"><?php echo _('Digital?');?></label></td>
<?php
			if ($dindig == true) {
				echo "\t\t\t\t\t\t<td><input type=\"checkbox\" name=\"currdigi\" id=\"currdigi\" class=\"w3-check\" checked></td>\n";
			} else {
				echo "\t\t\t\t\t\t<td><input type=\"checkbox\" name=\"currdigi\" id=\"currdigi\" class=\"w3-check\"></td>\n";
			}
?>

					</tr>
					<tr>
						<td><input type="submit" name="currsubmit" id="currsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>"></td>
					</tr>
					</form>
				</table>
			</div>
		</article>

<?php
include_once "admin-footer.php";
?>
