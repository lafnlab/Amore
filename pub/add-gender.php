<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle 	= "ADD GENDER TITLE";
#$message		= 'test message';

// PROCESSING
if (isset($_POST['gensubmit'])) {

	$gnid			= makeid($newid);
	$gnname		= nicetext($_POST['genname']);

	// is the id unique in this table?
	$idq = "SELECT * FROM gen WHERE gen_id=\'".$gnid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$geaddq 	= "INSERT INTO gen (gen_id, gen_name) VALUES ('$gnid','$gnname')";
		$geaddquery	= mysqli_query($dbconn,$gnaddq);
		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
#		redirect('index.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'gensubmit'

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
						<td class="inputlabel"><label for="genname"><?php echo _('Gender name');?></label></td>
						<td><input type="text" name="genname" id="genname" class="inputtext" required maxlength="100"></td>
					</tr>
				</table>
				<input type="submit" name="gensubmit" id="gensubmit" class="button" value="<?php echo _('Submit'); ?>">
			</form>
		</article>

<?php
include_once "main-footer.php";
?>
