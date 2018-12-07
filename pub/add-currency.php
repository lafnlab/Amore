<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle 	= "ADD CURRENCY TITLE";
#$message		= 'test message';

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
	$idq = "SELECT * FROM din WHERE din_id=\'".$currid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$craddq 	= "INSERT INTO din (din_id, din_name, din_iso, din_symbol, din_digital) VALUES ('$currid','$currname','$curriso','$currsym','$currdigi')";
		$craddquery	= mysqli_query($dbconn,$craddq);
		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
#		redirect('index.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'currsubmit'

include_once "main-header.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
		<article>
			<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<table>
					<caption><?php echo _($pagetitle); ?></caption>
					<tr>
						<td class="inputlabel"><label for="currname"><?php echo _('Currency name');?></label></td>
						<td><input type="text" name="currname" id="currname" class="inputtext" required maxlength="100"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="curriso"><?php echo _('ISO code');?></label></td>
						<td><input type="text" name="curriso" id="curriso" class="inputtext" maxlength="100"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="currsym"><?php echo _('Symbol');?></label></td>
						<td><input type="text" name="currsym" id="currsym" class="inputtext" maxlength="10" value="¤"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="currdigi"><?php echo _('Digital?');?></label></td>
						<td><input type="checkbox" name="curriso" id="curriso" class="inputcheck"></td>
					</tr>
				</table>
				<input type="submit" name="currsubmit" id="currsubmit" class="button" value="<?php echo _('Submit'); ?>">
			</form>
		</article>

<?php
include_once "main-footer.php";
?>
