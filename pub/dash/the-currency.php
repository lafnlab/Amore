<?php
/*
 * pub/dash/the-currency.php
 *
 * Displays a currency.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../conn.php";
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

$pagetitle = $dinname;
include_once "dash-header.php";
include_once "dash-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<table class="w3-card-2 w3-theme-l3 w3-padding">
				<caption><?php echo _($dinname); ?></caption>
				<tr>
					<th><?php echo _('Currency name'); ?></th>
					<th><?php echo _('ISO code'); ?></th>
					<th><?php echo _('Symbol'); ?></th>
					<th><?php echo _('Digital'); ?></th>
				</tr>
				<tr>
					<td><?php echo _($dinname); ?></td>
					<td><?php echo _($diniso); ?></td>
					<td><?php echo _($dinsym); ?></td>
	<?php
				if ($dindig == 1) {
					echo "\t\t\t\t<td>"._('Yes')."</td>\n";
				} else {
					echo "\t\t\t\t<td>"._('No')."</td>\n";
				}
	?>
				</tr>
		</table>
	</article>
<?php
include_once "dash-footer.php";
?>
