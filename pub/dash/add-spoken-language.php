<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle 	= "Add a spoken language";
#$message		= 'test message';

// PROCESSING
if (isset($_POST['spksubmit'])) {

	$spid			= makeid($newid);
	$spname		= nicetext($_POST['spkname']);

	// is the id unique in this table?
	$idq = "SELECT * FROM spk WHERE spk_id=\'".$spid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$spaddq 	= "INSERT INTO spk (spk_id, spk_name) VALUES ('$spid','$spname')";
		$spaddquery	= mysqli_query($dbconn,$spaddq);
		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
#		redirect('index.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'spksubmit'

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
						<td class="inputlabel"><label for="spkname"><?php echo _('Spoken language name');?></label></td>
						<td><input type="text" name="spkname" id="spkname" class="inputtext" required maxlength="100"></td>
					</tr>
				</table>
				<input type="submit" name="spksubmit" id="spksubmit" class="button" value="<?php echo _('Submit'); ?>">
			</form>
		</article>

<?php
include_once "main-footer.php";
?>
