<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle 	= "ADD EYE COLOR TITLE";
#$message		= 'test message';

// PROCESSING
if (isset($_POST['eyesubmit'])) {

	$eyid			= makeid($newid);
	$eycolor		= nicetext($_POST['eyecolor']);

	// is the id unique in this table?
	$idq = "SELECT * FROM eye WHERE eye_id=\'".$eyid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$eyaddq 	= "INSERT INTO eye (eye_id, eye_color) VALUES ('$eyid','$eycolor')";
		$eyaddquery	= mysqli_query($dbconn,$eyaddq);
		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
#		redirect('index.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'eyesubmit'

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
						<td class="inputlabel"><label for="eyecolor"><?php echo _('Eye color');?></label></td>
						<td><input type="text" name="eyecolor" id="eyecolor" class="inputtext" required maxlength="100"></td>
					</tr>
				</table>
				<input type="submit" name="eyesubmit" id="eyesubmit" class="button" value="<?php echo _('Submit'); ?>">
			</form>
		</article>

<?php
include_once "main-footer.php";
?>
