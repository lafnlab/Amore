<?php
/*
 * pub/dash/edit-currency.php
 *
 * Edit a currency in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../conn.php";
#include_once	"../config.php";
include			"../../functions.php";

if (isset($_GET["did"])) {
	$sel_id = $_GET["did"];
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

	$dinq = "SELECT * FROM currencies WHERE currencies_id=\"".$sel_id."\"";
	$dinquery = mysqli_query($dbconn,$dinq);
	while($dinopt = mysqli_fetch_assoc($dinquery)) {
		$dinid		= $dinopt['currencies_id'];
		$dinname		= $dinopt['currencies_name'];
		$diniso		= $dinopt['currencies_iso'];
		$dinsym		= $dinopt['currencies_symbol'];
		$dindig		= $dinopt['currencies_digital'];
	}
}

$pagetitle 	= "Edit ".$dinname;
#$message		= 'test message';

// PROCESSING
if (isset($_POST['currsubmit'])) {

	$currid			= $_POST['currid'];
	$currname		= nicetext($_POST['currname']);
	$curriso			= nicetext($_POST['curriso']);
	$currsym			= nicetext($_POST['currsym']);
	if(isset($_POST['currdigi'])) {
		$currdigi	= 1;
	} else {
		$currdigi	= 0;
	}

		$crupdq 	= "UPDATE currencies SET currencies_name='".$currname."', currencies_iso='".$curriso."', currencies_symbol='".$currsym."', currencies_digital='".$currdigi."' WHERE currencies_id='".$currid."'";
		$crupdquery	= mysqli_query($dbconn,$crupdq);

		redirect('list-currencies.php');

} // if isset $_POST 'currsubmit'

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
				<table>
					<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<input type="hidden" name="currid" value="<?php echo $dinid; ?>">
					<tr>
						<td class="inputlabel"><label for="currname"><?php echo _('Currency name');?></label></td>
						<td><input type="text" name="currname" id="currname" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $dinname; ?>"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="curriso"><?php echo _('ISO code');?></label></td>
						<td><input type="text" name="curriso" id="curriso" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $diniso; ?>"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="currsym"><?php echo _('Symbol');?></label></td>
						<td><input type="text" name="currsym" id="currsym" class="w3-input w3-border w3-margin-bottom" maxlength="10" value="<?php echo $dinsym; ?>"></td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="currdigi"><?php echo _('Digital?');?></label></td>
<?php
			if ($dindig == true) {
				echo "\t\t\t\t\t\t<td><input type=\"checkbox\" name=\"currdigi\" id=\"currdigi\" class=\"w3-check\" checked></td>\n";
			} else {
				echo "\t\t\t\t\t\t<td><input type=\"checkbox\" name=\"currdigi\" id=\"currdigi\" class=\"w3-check\"></td>\n";
			}
?>

					</tr>
					<tr>
						<td><input type="submit" name="currsubmit" id="currsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('Update'); ?>"></td>
					</tr>
					</form>
				</table>
			</div>
		</article>

<?php
include_once "dash-footer.php";
?>
