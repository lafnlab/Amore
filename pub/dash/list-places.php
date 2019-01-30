<?php
/*
 * pub/dash/list-places.php
 *
 * Displays a list of continents, regions, countries, sub-national entities, cities, towns, etc in the database.
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

include_once "dash-header.php";
include_once "dash-nav.php";
?>

<!-- get lists of places based on their continent/region of the globe -->
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a place ')."<a href=\"add-place.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom">
			<h4><?php echo _('Africa'); ?></h4>
				<table>
<?php
		$afriq = "SELECT * FROM locations WHERE locations_parent LIKE \"%0000000001%\" ORDER BY locations_name ASC";
		$afriquery = mysqli_query($dbconn, $afriq);
		#echo $afriq;


		while($afriopt = mysqli_fetch_assoc($afriquery)) {
			$afri_name	= $afriopt['locations_name'];
			$afri_id		= $afriopt['locations_id'];
			echo "\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-place.php?plid=".$afri_id."\">"._($afri_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-place.php?plid=".$afri_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-place.php?plid=".$afri_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>

<!--			<div class="w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom"> -->
<!--			<h4><?php echo _('Antarctica'); ?></h4> -->
<!--				<table> -->


<?php
		$antaq = "SELECT * FROM locations WHERE locations_parent LIKE \"%0000000002%\" ORDER BY locations_name ASC";
		$antaquery = mysqli_query($dbconn, $antaq);
		#echo $antaq;


		while($antaopt = mysqli_fetch_assoc($antaquery)) {
			$anta_name	= $antaopt['locations_name'];
			$anta_id		= $antaopt['locations_id'];
#			echo "\t\t\t\t\t<tr>\n";
#			echo "\t\t\t\t\t\t<td><a href=\"the-place.php?plid=".$anta_id."\">"._($anta_name)."</a></td>\n";
#			echo "\t\t\t\t\t\t<td><a href=\"edit-place.php?plid=".$anta_id."\">"._('Edit')."</a></td>\n";
#			echo "\t\t\t\t\t\t<td><a href=\"delete-place.php?plid=".$anta_id."\">"._('Delete')."</a></td>\n";
#			echo "\t\t\t\t\t</tr>\n";
		}
?>
<!--				</table> -->
<!-- 			</div> -->

			<div class="w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom">
			<h4><?php echo _('Asia'); ?></h4>
				<table>
<?php
		$asiaq = "SELECT * FROM locations WHERE locations_parent LIKE \"%0000000003%\" ORDER BY locations_name ASC";
		$asiaquery = mysqli_query($dbconn, $asiaq);
		#echo $asiaq;


		while($asiaopt = mysqli_fetch_assoc($asiaquery)) {
			$asia_name	= $asiaopt['locations_name'];
			$asia_id		= $asiaopt['locations_id'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-place.php?plid=".$asia_id."\">"._($asia_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-place.php?plid=".$asia_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-place.php?plid=".$asia_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>

			<div class="w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom">
			<h4><?php echo _('Caribbean'); ?></h4>
				<table>
<?php
		$caribq = "SELECT * FROM locations WHERE locations_parent LIKE \"%0000000004%\" ORDER BY locations_name ASC";
		$caribquery = mysqli_query($dbconn, $caribq);
		#echo $caribq;


		while($caribopt = mysqli_fetch_assoc($caribquery)) {
			$carib_name	= $caribopt['locations_name'];
			$carib_id	= $caribopt['locations_id'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-place.php?plid=".$carib_id."\">"._($carib_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-place.php?plid=".$carib_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-place.php?plid=".$carib_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>

			<div class="w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom">
			<h4><?php echo _('Europe'); ?></h4>
				<table>
<?php
		$euroq = "SELECT * FROM locations WHERE locations_parent LIKE \"%0000000005%\" ORDER BY locations_name ASC";
		$euroquery = mysqli_query($dbconn, $euroq);
		#echo $euroq;


		while($euroopt = mysqli_fetch_assoc($euroquery)) {
			$euro_name	= $euroopt['locations_name'];
			$euro_id		= $euroopt['locations_id'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-place.php?plid=".$euro_id."\">"._($euro_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-place.php?plid=".$euro_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-place.php?plid=".$euro_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>

			<div class="w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom">
			<h4><?php echo _('North America'); ?></h4>
				<table>
<?php
		$northq = "SELECT * FROM locations WHERE locations_parent LIKE \"%0000000006%\" ORDER BY locations_name ASC";
		$northquery = mysqli_query($dbconn, $northq);
		#echo $northq;


		while($northopt = mysqli_fetch_assoc($northquery)) {
			$north_name	= $northopt['locations_name'];
			$north_id		= $northopt['locations_id'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-place.php?plid=".$north_id."\">"._($north_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-place.php?plid=".$north_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-place.php?plid=".$north_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>

			<div class="w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom">
			<h4><?php echo _('Oceania'); ?></h4>
				<table>
<?php
		$oceanq = "SELECT * FROM locations WHERE locations_parent LIKE \"%0000000007%\" ORDER BY locations_name ASC";
		$oceanquery = mysqli_query($dbconn, $oceanq);
		#echo $oceanq;


		while($oceanopt = mysqli_fetch_assoc($oceanquery)) {
			$ocean_name	= $oceanopt['locations_name'];
			$ocean_id	= $oceanopt['locations_id'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-place.php?plid=".$ocean_id."\">"._($ocean_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-place.php?plid=".$ocean_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-place.php?plid=".$ocean_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>

			<div class="w3-card-2 w3-theme-l3 w3-padding w3-margin-bottom">
			<h4><?php echo _('South America'); ?></h4>
				<table>
<?php
		$southq = "SELECT * FROM locations WHERE locations_parent LIKE \"%0000000008%\" ORDER BY locations_name ASC";
		$southquery = mysqli_query($dbconn, $southq);
		#echo $southq;


		while($southopt = mysqli_fetch_assoc($southquery)) {
			$south_name	= $southopt['locations_name'];
			$south_id		= $southopt['locations_id'];
			echo "\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t<td><a href=\"the-place.php?plid=".$south_id."\">"._($south_name)."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"edit-place.php?plid=".$south_id."\">"._('Edit')."</a></td>\n";
			echo "\t\t\t\t\t\t<td><a href=\"delete-place.php?plid=".$south_id."\">"._('Delete')."</a></td>\n";
			echo "\t\t\t\t\t</tr>\n";
		}
?>
				</table>
			</div>
		</article>

<?php
include_once "dash-footer.php";
?>
