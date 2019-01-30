<?php
/*
 * pub/dash/edit-hair-color.php
 *
 * Edit a hair color in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../conn.php";
#include_once	"../config.php";
include			"../../functions.php";

if (isset($_GET["hid"])) {
	$sel_id = $_GET["hid"];
} else {
	$sel_id = "";
}

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

if ($sel_id != '') {

	$harq = "SELECT * FROM hair_colors WHERE hair_colors_id=\"".$sel_id."\"";
	$harquery = mysqli_query($dbconn,$harq);
	while($haropt = mysqli_fetch_assoc($harquery)) {
		$harid		= $haropt['hair_colors_id'];
		$harcolor	= $haropt['hair_colors_color'];
	}
}

// PROCESSING
if (isset($_POST['harsubmit'])) {

	$haid			= $_POST['harid'];
	$hacolor		= nicetext($_POST['harcolor']);


		$hrupdq 	= "UPDATE hair_colors SET hair_colors_color='".$hacolor."' WHERE hair_colors_id='".$haid."'";
		$hrupdquery	= mysqli_query($dbconn,$hrupdq);
		redirect('list-hair-colors.php');

} // if isset $_POST 'harsubmit'

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
				<h4><?php echo _("Edit ").$harcolor; ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="harid" value="<?php echo $harid; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="harcolor"><?php echo _('Hair color');?></label></td>
							<td><input type="text" name="harcolor" id="harcolor" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $harcolor; ?>"></td>
						</tr>
					</table>
					<input type="submit" name="harsubmit" id="harsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Update'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "dash-footer.php";
?>
