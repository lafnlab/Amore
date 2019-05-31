<?php
/*
 * pub/dash/admin/list-places.php
 *
 * Displays a list of continents, regions, countries, sub-national entities, cities, towns, etc in the database.
 *
 * since Amore version 0.1
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


include_once "admin-header.php";
include_once "admin-nav.php";
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
		$afriq = "SELECT * FROM locations WHERE location_parent LIKE \"%0000000001%\" ORDER BY location_name ASC";
		$afriquery = mysqli_query($dbconn, $afriq);
		#echo $afriq;


		while($afriopt = mysqli_fetch_assoc($afriquery)) {
			$afri_name	= $afriopt['location_name'];
			$afri_id		= $afriopt['location_id'];
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
		$antaq = "SELECT * FROM locations WHERE location_parent LIKE \"%0000000002%\" ORDER BY location_name ASC";
		$antaquery = mysqli_query($dbconn, $antaq);
		#echo $antaq;


		while($antaopt = mysqli_fetch_assoc($antaquery)) {
			$anta_name	= $antaopt['location_name'];
			$anta_id		= $antaopt['location_id'];
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
		$asiaq = "SELECT * FROM locations WHERE location_parent LIKE \"%0000000003%\" ORDER BY location_name ASC";
		$asiaquery = mysqli_query($dbconn, $asiaq);
		#echo $asiaq;


		while($asiaopt = mysqli_fetch_assoc($asiaquery)) {
			$asia_name	= $asiaopt['location_name'];
			$asia_id		= $asiaopt['location_id'];
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
		$caribq = "SELECT * FROM locations WHERE location_parent LIKE \"%0000000004%\" ORDER BY location_name ASC";
		$caribquery = mysqli_query($dbconn, $caribq);
		#echo $caribq;


		while($caribopt = mysqli_fetch_assoc($caribquery)) {
			$carib_name	= $caribopt['location_name'];
			$carib_id	= $caribopt['location_id'];
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
		$euroq = "SELECT * FROM locations WHERE location_parent LIKE \"%0000000005%\" ORDER BY location_name ASC";
		$euroquery = mysqli_query($dbconn, $euroq);
		#echo $euroq;


		while($euroopt = mysqli_fetch_assoc($euroquery)) {
			$euro_name	= $euroopt['location_name'];
			$euro_id		= $euroopt['location_id'];
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
		$northq = "SELECT * FROM locations WHERE location_parent LIKE \"%0000000006%\" ORDER BY location_name ASC";
		$northquery = mysqli_query($dbconn, $northq);
		#echo $northq;


		while($northopt = mysqli_fetch_assoc($northquery)) {
			$north_name	= $northopt['location_name'];
			$north_id	= $northopt['location_id'];
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
		$oceanq = "SELECT * FROM locations WHERE location_parent LIKE \"%0000000007%\" ORDER BY location_name ASC";
		$oceanquery = mysqli_query($dbconn, $oceanq);
		#echo $oceanq;


		while($oceanopt = mysqli_fetch_assoc($oceanquery)) {
			$ocean_name	= $oceanopt['location_name'];
			$ocean_id	= $oceanopt['location_id'];
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
		$southq = "SELECT * FROM locations WHERE location_parent LIKE \"%0000000008%\" ORDER BY location_name ASC";
		$southquery = mysqli_query($dbconn, $southq);
		#echo $southq;


		while($southopt = mysqli_fetch_assoc($southquery)) {
			$south_name	= $southopt['location_name'];
			$south_id	= $southopt['location_id'];
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
include_once "admin-footer.php";
?>
