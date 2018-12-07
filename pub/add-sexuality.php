<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle 	= "ADD SEXUALITY TITLE";
#$message		= 'test message';

// PROCESSING
if (isset($_POST['sxusubmit'])) {

	$sxid			= makeid($newid);
	$sxname		= nicetext($_POST['sxuname']);

	// is the id unique in this table?
	$idq = "SELECT * FROM sxu WHERE sxu_id=\'".$naid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$sxaddq 	= "INSERT INTO sxu (sxu_id, sxu_name) VALUES ('$sxid','$sxname')";
		$sxaddquery	= mysqli_query($dbconn,$sxaddq);
		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
#		redirect('index.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'sxusubmit'

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
						<td class="inputlabel"><label for="sxuname"><?php echo _('Sexuality name');?></label></td>
						<td><input type="text" name="sxuname" id="sxuname" class="inputtext" required maxlength="100"></td>
					</tr>
				</table>
				<input type="submit" name="sxusubmit" id="sxusubmit" class="button" value="<?php echo _('Submit'); ?>">
			</form>
		</article>

<?php
include_once "main-footer.php";
?>
