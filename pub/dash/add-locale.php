<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle 	= "Add a locale";
#$message		= 'test message';

// PROCESSING
if (isset($_POST['i18submit'])) {

	$loid			= makeid($newid);
	$lolang		= strtolower(nicetext($_POST['i18lang'])); // must be lowercase
	$loctry		= strtoupper(nicetext($_POST['i18ctry'])); // must be uppercase

	// is the id unique in this table?
	$idq = "SELECT * FROM i18 WHERE i18_id=\'".$loid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$i18addq 	= "INSERT INTO i18 (i18_id, i18_language, i18_country) VALUES ('$loid','$lolang','$loctry')";
		$i18addquery	= mysqli_query($dbconn,$i18addq);
		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
#		redirect('index.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'i18submit'

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
						<td class="inputlabel"><label for="i18lang"><?php echo _('Locale language');?></label></td>
						<td><input type="text" name="i18lang" id="i18lang" class="inputtext" required maxlength="3"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="i18ctry"><?php echo _('Locale country');?></label></td>
						<td><input type="text" name="i18ctry" id="i18ctry" class="inputtext" maxlength="5"></td>
					</tr>
				</table>
				<input type="submit" name="i18submit" id="i18submit" class="button" value="<?php echo _('Submit'); ?>">
			</form>
		</article>

<?php
include_once "main-footer.php";
?>
