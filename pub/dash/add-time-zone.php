<?php
/*
 * pub/dash/add-time-zone.php
 *
 * Adds a time zone to the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../conn.php";
#include_once	"../config.php";
include			"../../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

// let's get the configuration data

$mysiteq = "SELECT * FROM configuration WHERE primary_key='".SITEKEY."'";
$mysitequery = mysqli_query($dbconn,$mysiteq);
while ($mysiteopt = mysqli_fetch_assoc($mysitequery)) {
	$website_url				= $mysiteopt['website_url'];
	$website_name				= $mysiteopt['website_name'];
	$website_description		= $mysiteopt['website_description'];
	$default_locale			= $mysiteopt['default_locale'];
	$open_registration		= $mysiteopt['open_registrations'];
	$posts_are_called			= $mysiteopt['posts_are_called'];
	$post_is_called			= $mysiteopt['post_is_called'];
	$reposts_are_called		= $mysiteopt['reposts_are_called'];
	$repost_is_called			= $mysiteopt['repost_is_called'];
	$users_are_called			= $mysiteopt['users_are_called'];
	$user_is_called			= $mysiteopt['user_is_called'];
	$favorites_are_called	= $mysiteopt['favorites_are_called'];
	$favorite_is_called		= $mysiteopt['favorite_is_called'];
	$max_post_length			= $mysiteopt['max_post_length'];
}

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
	$idq = "SELECT * FROM time_zones WHERE time_zones_id=\'".$loid."\'";
	$idquery = mysqli_query($dbconn,$idq);
	$message = $idq;
	if ($idquery == FALSE) {

		$tzaddq 	= "INSERT INTO time_zones (time_zones_id, time_zones_abbreviation, time_zones_name, time_zones_offset, time_zones_dst_offset) VALUES ('$tzid','$tzabbr','$tzname','$tzoffset','$tzdstoffset')";
		$tzaddquery	= mysqli_query($dbconn,$tzaddq);
		$message 	= "Operation complete. Add another section or click <a href=\"/\">here</a> to return to the main page.";
#		redirect('index.php');
	} else {
		#$message 	= "There was an error while processing. Please try again.";
#		redirect('index.html');
	}

} // if isset $_POST 'tztsubmit'

include_once "dash-header.php";
include_once "dash-nav.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4><?php echo _($pagetitle); ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table>
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
			</div>
		</article>

<?php
include_once "dash-footer.php";
?>
