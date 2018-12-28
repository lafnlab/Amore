<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle 	= "Add a place to social.media.dating";
#$message		= 'test message';

// PROCESSING
if (isset($_POST['placesubmit'])) {

	$plid			= makeid($newid);
	$plname		= nicetext($_POST['placename']);
	$plparent	= join(',',$_POST['placeparent']); // allows for multiple options

	// is the id unique in this table?
	$idq = "SELECT * FROM loc WHERE loc_id=\'".$plid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$pladdq 	= "INSERT INTO loc (loc_id, loc_name, loc_parent) VALUES ('$plid','$plname','$plparent')";
		$pladdquery	= mysqli_query($dbconn,$pladdq);
		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
#		redirect('index.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'placesubmit'

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
						<td class="inputlabel"><label for="placename"><?php echo _('Place name');?></label></td>
						<td><input type="text" name="placename" id="placename" class="inputtext" required maxlength="100"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="placeparent"><?php echo _('Place parent'); ?></label></td>
						<!-- this list is an imperfect mess, at best. It will be improved at some point -->
						<td>
							<select multiple name="placeparent[]" id="placeparent" class="inputselectmulti">
<?php
		$parentq = "SELECT * FROM loc ORDER BY loc_parent,loc_name ASC";
		$parentquery = mysqli_query($dbconn,$parentq);
		while ($parentopt = mysqli_fetch_assoc($parentquery)) {
			echo "\t\t\t\t\t\t\t\t\t<option value=\"".$parentopt['loc_id']."\">".$parentopt['loc_name']."</option>\n";
		}
?>
							</select>
						</td>
					</tr>
				</table>
				<input type="submit" name="placesubmit" id="placesubmit" class="button" value="<?php echo _('Submit'); ?>">
			</form>
		</article>

<?php
include_once "main-footer.php";
?>
