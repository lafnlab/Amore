<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle 	= "Add a time zone";
#$message		= 'test message';

// PROCESSING
if (isset($_POST['tztsubmit'])) {

	$tzid				= makeid($newid);
	$tzabbr			= nicetext($_POST['tzabbr']);
	$tzname			= nicetext($_POST['tzname']);
	$tzoffset		= nicetext($_POST['tzoffset']);
	$tzdstoffset	= nicetext($_POST['tzdstoff']);

	// is the id unique in this table?
	$idq = "SELECT * FROM tzt WHERE tzt_id=\'".$loid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$tzaddq 	= "INSERT INTO tzt (tzt_id, tzt_abbr, tzt_name, tzt_offset, tzt_dst_offset) VALUES ('$tzid','$tzabbr','$tzname','$tzoffset','$tzdstoffset')";
		$tzaddquery	= mysqli_query($dbconn,$tzaddq);
		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
#		redirect('index.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'tztsubmit'

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
						<td class="inputlabel"><label for="tzabbr"><?php echo _('Time zone abbreviation');?></label></td>
						<td><input type="text" name="tzabbr" id="tzabbr" class="inputtext" maxlength="100"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="tzname"><?php echo _('Time zone name');?></label></td>
						<td><input type="text" name="tzname" id="tzname" class="inputtext" required maxlength="100"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="tzoffset"><?php echo _('Time zone offset');?></label></td>
						<td><input type="text" name="tzoffset" id="tzoffset" class="inputtext" required value="+00:00" maxlength="100"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="tzdstoff"><?php echo _('Time zone DST offset');?></label></td>
						<td><input type="text" name="tzdstoff" id="tzdstoff" class="inputtext" required value="+00:00"maxlength="100"></td>
					</tr>
				</table>
				<input type="submit" name="tztsubmit" id="tztsubmit" class="button" value="<?php echo _('Submit'); ?>">
			</form>
		</article>

<?php
include_once "main-footer.php";
?>
