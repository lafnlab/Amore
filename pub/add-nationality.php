<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle 	= "ADD NATIONALITY TITLE";
#$message		= 'test message';

// PROCESSING
if (isset($_POST['natsubmit'])) {

	$naid			= makeid($newid);
	$naname		= nicetext($_POST['natname']);

	// is the id unique in this table?
	$idq = "SELECT * FROM nat WHERE nat_id=\'".$naid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$naaddq 	= "INSERT INTO nat (nat_id, nat_name) VALUES ('$naid','$naname')";
		$naaddquery	= mysqli_query($dbconn,$naaddq);
		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
#		redirect('index.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'natsubmit'

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
						<td class="inputlabel"><label for="natname"><?php echo _('Nationality name');?></label></td>
						<td><input type="text" name="natname" id="natname" class="inputtext" required maxlength="100"></td>
					</tr>
				</table>
				<input type="submit" name="natsubmit" id="natsubmit" class="button" value="<?php echo _('Submit'); ?>">
			</form>
		</article>

<?php
include_once "main-footer.php";
?>
