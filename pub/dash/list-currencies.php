<?php
/*
 * pub/dash/list-currencies.php
 *
 * Displays a list of currencies in the database.
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

$pagetitle = "List of currencies";


include_once "dash-header.php";
include_once "dash-nav.php";
?>
<!-- gets a list of currencies -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a currency ')."<a href=\"add-currency.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4><?php echo _($pagetitle); ?></h4>
				<table>
					<tr>
						<td><?php echo _('ISO code'); ?></td>
						<td><?php echo _('Currency name'); ?></td>
						<td><?php echo _('Symbol'); ?></td>
						<td><?php echo _('Digital?'); ?></td>
					</tr>
<?php
		$dinq = "SELECT * FROM currencies ORDER BY currencies_name ASC";
		$dinquery = mysqli_query($dbconn,$dinq);

		while ($dinopt = mysqli_fetch_assoc($dinquery)) {
			$din_digi	= $dinopt['currencies_digital'];
			$din_sym		= $dinopt['currencies_symbol'];
			$din_name	= $dinopt['currencies_name'];
			$din_iso		= $dinopt['currencies_iso'];
			$din_id		= $dinopt['currencies_id'];

			if ($din_digi == 0) {
				$digital = _("No");
			} else {
				$digital = _('Yes');
			}
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td>".$din_iso."</td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-currency.php?did=".$din_id."\">"._($din_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td>".$din_sym."</td>\n";
			echo "\t\t\t\t\t\t<td>".$digital."</td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-currency.php?did=".$din_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-currency.php?did=".$din_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>
<?php
include_once "dash-footer.php";
?>
