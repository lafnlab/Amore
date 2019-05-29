<?php
/*
 * pub/dash/admin/add-currency.php
 *
 * Adds a currency to the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


// PROCESSING
if (isset($_POST['currsubmit'])) {

	$currid			= makeid($newid);
	$currname		= nicetext($_POST['currname']);
	$curriso			= nicetext($_POST['curriso']);
	$currsym			= nicetext($_POST['currsym']);
	if(isset($_POST['currdigi'])) {
		$currdigi	= 1;
	}

	// is the id unique in this table?
	$idq = "SELECT * FROM currencies WHERE currencies_id=\'".$currid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$craddq 	= "INSERT INTO currencies (currencies_id, currencies_name, currencies_iso, currencies_symbol, currencies_digital) VALUES ('$currid','$currname','$curriso','$currsym','$currdigi')";
		$craddquery	= mysqli_query($dbconn,$craddq);
#		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
		redirect('list-currencies.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'currsubmit'
include_once "dash-header.php";
include_once "dash-nav.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4><?php echo _("Add a currency"); ?></h4>
				<table>
					<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

					<tr>
						<td class="inputlabel"><label for="currname"><?php echo _('Currency name');?></label></td>
						<td><input type="text" name="currname" id="currname" class="w3-input w3-border w3-margin-bottom" required maxlength="100"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="curriso"><?php echo _('ISO code');?></label></td>
						<td><input type="text" name="curriso" id="curriso" class="w3-input w3-border w3-margin-bottom" maxlength="100"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="currsym"><?php echo _('Symbol');?></label></td>
						<td><input type="text" name="currsym" id="currsym" class="w3-input w3-border w3-margin-bottom" maxlength="10" value="¤"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="currdigi"><?php echo _('Digital?');?></label></td>
						<td><input type="checkbox" name="currdigi" id="currdigi" class="w3-check"></td>
					</tr>
					<tr>
						<td><input type="submit" name="currsubmit" id="currsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Submit'); ?>"></td>
					</tr>
					</form>
				</table>
			</div>
		</article>

<?php
include_once "dash-footer.php";
?>
