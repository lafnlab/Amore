<?php
/*
 * pub/dash/edit-sexuality.php
 *
 * Edit a sexuality in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../conn.php";
include			"../../functions.php";

if (isset($_GET["sid"])) {
	$sel_id = $_GET["sid"];
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

	$sexq = "SELECT * FROM sexualities WHERE sexualities_id=\"".$sel_id."\"";
	$sexquery = mysqli_query($dbconn,$sexq);
	while($sexopt = mysqli_fetch_assoc($sexquery)) {
		$sexid		= $sexopt['sexualities_id'];
		$sexname		= $sexopt['sexualities_name'];
	}
}

// PROCESSING
if (isset($_POST['sxusubmit'])) {

	$sxid			= $_POST['sxuid'];
	$sxname		= nicetext($_POST['sxuname']);

		$sxupdq 	= "UPDATE sexuaities SET sexualities_name='".$sxname."' WHERE sexualities_id='".$sxid."'";
		$sxupdquery	= mysqli_query($dbconn,$sxupdq);
		redirect('list-sexualites.php');

} // if isset $_POST 'sxusubmit'

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
				<h4><?php echo _("Edit ").$sexname; ?></h4>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="sxuid" value="<?php echo $sexid; ?>">
					<table>
						<tr>
							<td class="inputlabel"><label for="sxuname"><?php echo _('Sexuality name');?></label></td>
							<td><input type="text" name="sxuname" id="sxuname" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $sexname; ?>"></td>
						</tr>
					</table>
					<input type="submit" name="sxusubmit" id="sxusubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
				</form>
			</div>
		</article>

<?php
include_once "dash-footer.php";
?>
