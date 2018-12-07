<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle 	= "ADD HAIR COLOR TITLE";
#$message		= 'test message';

// PROCESSING
if (isset($_POST['harsubmit'])) {

	$haid			= makeid($newid);
	$hacolor		= nicetext($_POST['harcolor']);

	// is the id unique in this table?
	$idq = "SELECT * FROM har WHERE har_id=\'".$haid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$hraddq 	= "INSERT INTO har (har_id, har_color) VALUES ('$haid','$hacolor')";
		$hraddquery	= mysqli_query($dbconn,$hraddq);
		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
#		redirect('index.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'harsubmit'

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
						<td class="inputlabel"><label for="harcolor"><?php echo _('Hair color');?></label></td>
						<td><input type="text" name="harcolor" id="harcolor" class="inputtext" required maxlength="100"></td>
					</tr>
				</table>
				<input type="submit" name="harsubmit" id="harsubmit" class="button" value="<?php echo _('Submit'); ?>">
			</form>
		</article>

<?php
include_once "main-footer.php";
?>
