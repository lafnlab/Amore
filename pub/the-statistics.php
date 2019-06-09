<?php
/*
 * pub/the-statistics.php
 *
 * This page presents detailed statistics about the site and its users.
 *
 * since Amore version 0.3
 *
 */

include_once	"../conn.php";
include			"../functions.php";
require			"includes/database-connect.php";
require_once	"includes/configuration-data.php";


$pagetitle = _("Statistics")." | ".$website_name." | Amore";

include_once "main-header.php";
?>

<!-- The Container for the main content -->
<main class="w3-container w3-content" style="max-width:1400px;margin-top:40px;">

<?php
  // messages should appear in <main> only, not in <nav>
  if ($message != '' || NULL) {
  	echo header_message($message);
  }
?>

    <!-- The Grid -->
	<div class="w3-row w3-container">
		<div class="w3-col m8 w3-row-padding w3-panel">
			<div class="w3-card-2 w3-padding w3-margin-bottom w3-theme-l3">
				<h2><?php echo _("Statistics for ").$website_name; ?></h2>
				<p><b><?php echo $website_description; ?></b></p>
			</div>
			<div class="w3-card-2 w3-padding w3-margin-bottom w3-theme-l3">
				<h2><?php echo _("Website statistics"); ?></h2>
				<ul>
					<li><?php echo _("Total number of accounts: ").user_quantity($user); ?></li>
					<li><?php echo _("Number of signed-in users in the past 30 days: ").users_past_month($active_users); ?></li>
					<li><?php echo _("Number of signed-in users in the past 180 months: ").users_half_year($sometimes_users); ?></li>
				</ul>
		</div>
		<div class="w3-card-2 w3-padding w3-margin-bottom w3-theme-l3">
			<h2><?php echo _("User statistics"); ?></h2>
				<h4><?php echo _("Genders"); ?></h4>
					<table>
<?php
	$gendersq = "SELECT * FROM genders ORDER BY gender_name ASC";
	$gendersquery = mysqli_query($dbconn,$gendersq);
	while ($genderopt = mysqli_fetch_assoc($gendersquery)) {

		// for each gender, count the number of users
		$genderid			= $genderopt['gender_id'];
		$gendername			= $genderopt['gender_name'];

		$gndrq		= "SELECT * FROM users WHERE user_gender='".$genderid."'";
		$gndrquery	= mysqli_query($dbconn,$gndrq);
		$gndrqty		= mysqli_num_rows($gndrquery);
		if ($gndrqty > 0) {
			echo "\t\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t\t<td>".$gendername."</td>";
			echo "<td>".$gndrqty."</td>\n";
			echo "\t\t\t\t\t\t</tr>\n";
		}
	}
?>
					</table>

				<h4><?php echo _("Sexuality"); ?></h4>
					<table>
<?php
	$sexualitiesq = "SELECT * FROM sexualities ORDER BY sexuality_name ASC";
	$sexualitiesquery = mysqli_query($dbconn,$sexualitiesq);
	while ($sexualityopt = mysqli_fetch_assoc($sexualitiesquery)) {

		// for each sexuality, count the number of users
		$sexualityid			= $sexualityopt['sexuality_id'];
		$sexualityname			= $sexualityopt['sexuality_name'];

		$sexuq		= "SELECT * FROM users WHERE user_sexuality='".$sexualityid."'";
		$sexuquery	= mysqli_query($dbconn,$sexuq);
		$sexuqty		= mysqli_num_rows($sexuquery);
		if ($sexuqty > 0) {
			echo "\t\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t\t<td>".$sexualityname."</td>";
			echo "<td>".$sexuqty."</td>\n";
			echo "\t\t\t\t\t\t</tr>\n";
		}
	}
?>
					</table>

				<h4><?php echo _("Location"); ?></h4>
					<table>
<?php
	$locationsq = "SELECT * FROM locations ORDER BY location_name ASC";
	$locationsquery = mysqli_query($dbconn,$locationsq);
	while ($locationopt = mysqli_fetch_assoc($locationsquery)) {

		// for each location, count the number of users
		$locationid				= $locationopt['location_id'];
		$locationname			= $locationopt['location_name'];

		$placeq			= "SELECT * FROM users WHERE user_location='".$locationid."'";
		$placequery		= mysqli_query($dbconn,$placeq);
		$placeqty		= mysqli_num_rows($placequery);
		if ($placeqty > 0) {
			echo "\t\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t\t<td>".$locationname."</td>";
			echo "<td>".$placeqty."</td>\n";
			echo "\t\t\t\t\t\t</tr>\n";
		}
	}
?>
					</table>

				<h4><?php echo _("Nationality"); ?></h4>
					<table>
<?php
	$nationalitiesq = "SELECT * FROM nationalities ORDER BY nationality_name ASC";
	$nationalitiesquery = mysqli_query($dbconn,$nationalitiesq);
	while ($nationalityopt = mysqli_fetch_assoc($nationalitiesquery)) {

		// for each nationality, count the number of users
		$nationalityid				= $nationalityopt['nationality_id'];
		$nationalityname			= $nationalityopt['nationality_name'];

		$natoq			= "SELECT * FROM users WHERE user_nationality='".$nationalityid."'";
		$natoquery		= mysqli_query($dbconn,$natoq);
		$natoqty			= mysqli_num_rows($natoquery);
		if ($natoqty > 0) {
			echo "\t\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t\t<td>".$nationalityname."</td>";
			echo "<td>".$natoqty."</td>\n";
			echo "\t\t\t\t\t\t</tr>\n";
		}
	}
?>
					</table>

				<h4><?php echo _("Spoken language"); ?></h4>
					<table>
<?php
	$splanguagesq = "SELECT * FROM spoken_languages ORDER BY spoken_language_name ASC";
	$splanguagesquery = mysqli_query($dbconn,$splanguagesq);
	while ($splanguageopt = mysqli_fetch_assoc($splanguagesquery)) {

		// for each spoken language, count the number of users
		$splanguageid				= $splanguageopt['spoken_language_id'];
		$splanguagename			= $splanguageopt['spoken_language_name'];

		$splanq			= "SELECT * FROM users WHERE user_nationality='".$splanguageid."'";
		$splanquery		= mysqli_query($dbconn,$splanq);
		$splanqty			= mysqli_num_rows($splanquery);
		if ($splanqty > 0) {
			echo "\t\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t\t<td>".$splanguagename."</td>";
			echo "<td>".$splanqty."</td>\n";
			echo "\t\t\t\t\t\t</tr>\n";
		}
	}
?>
					</table>

				<h4><?php echo _("Relationship status"); ?></h4>
					<table>
<?php
	$relstatusesq = "SELECT * FROM relationship_statuses ORDER BY relationship_status_name ASC";
	$relstatusesquery = mysqli_query($dbconn,$relstatusesq);
	while ($relstatusopt = mysqli_fetch_assoc($relstatusesquery)) {

		// for each relationship status, count the number of users
		$relstatusid				= $relstatusopt['relationship_status_id'];
		$relstatusname				= $relstatusopt['relationship_status_name'];

		$rstatq			= "SELECT * FROM users WHERE user_relationship_status='".$relstatusid."'";
		$rstatquery		= mysqli_query($dbconn,$rstatq);
		$rstatqty			= mysqli_num_rows($rstatquery);
		if ($rstatqty > 0) {
			echo "\t\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t\t<td>".$relstatusname."</td>";
			echo "<td>".$rstatqty."</td>\n";
			echo "\t\t\t\t\t\t</tr>\n";
		}
	}
?>
					</table>

				<h4><?php echo _("Eye color"); ?></h4>
					<table>
<?php
	$eyecolorsq = "SELECT * FROM eye_colors ORDER BY eye_color_name ASC";
	$eyecolorsquery = mysqli_query($dbconn,$eyecolorsq);
	while ($eyecoloropt = mysqli_fetch_assoc($eyecolorsquery)) {

		// for each eye color, count the number of users
		$eyecolorid					= $eyecoloropt['eye_color_id'];
		$eyecolorname				= $eyecoloropt['eye_color_name'];

		$eyecq			= "SELECT * FROM users WHERE user_eye_color='".$eyecolorid."'";
		$eyecquery		= mysqli_query($dbconn,$eyecq);
		$eyecqty			= mysqli_num_rows($eyecquery);
		if ($eyecqty > 0) {
			echo "\t\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t\t<td>".$eyecolorname."</td>";
			echo "<td>".$eyecqty."</td>\n";
			echo "\t\t\t\t\t\t</tr>\n";
		}
	}
?>
					</table>

				<h4><?php echo _("Hair color"); ?></h4>
					<table>
<?php
	$haircolorsq = "SELECT * FROM hair_colors ORDER BY hair_color_name ASC";
	$haircolorsquery = mysqli_query($dbconn,$haircolorsq);
	while ($haircoloropt = mysqli_fetch_assoc($haircolorsquery)) {

		// for each hair color, count the number of users
		$haircolorid					= $haircoloropt['hair_color_id'];
		$haircolorname					= $haircoloropt['hair_color_name'];

		$haircq			= "SELECT * FROM users WHERE user_hair_color='".$haircolorid."'";
		$haircquery		= mysqli_query($dbconn,$haircq);
		$haircqty			= mysqli_num_rows($haircquery);
		if ($haircqty > 0) {
			echo "\t\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t\t<td>".$haircolorname."</td>";
			echo "<td>".$haircqty."</td>\n";
			echo "\t\t\t\t\t\t</tr>\n";
		}
	}
?>
					</table>

				<h4><?php echo _("Time zone"); ?></h4>
					<table>
<?php
	$timezonesq = "SELECT * FROM time_zones ORDER BY time_zone_name ASC";
	$timezonesquery = mysqli_query($dbconn,$timezonesq);
	while ($timezoneopt = mysqli_fetch_assoc($timezonesquery)) {

		// for each time zone, count the number of users
		$timezoneid						= $timezoneopt['time_zone_id'];
		$timezonename					= $timezoneopt['time_zone_name'];

		$timezq			= "SELECT * FROM users WHERE user_time_zone='".$timezoneid."'";
		$timezquery		= mysqli_query($dbconn,$timezq);
		$timezqty			= mysqli_num_rows($timezquery);
		if ($timezqty > 0) {
			echo "\t\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t\t<td>".$timezonename."</td>";
			echo "<td>".$timezqty."</td>\n";
			echo "\t\t\t\t\t\t</tr>\n";
		}
	}
?>
					</table>

				<h4><?php echo _("User level"); ?></h4>
					<table>
<?php
	$userlevelsq = "SELECT * FROM user_levels ORDER BY user_level_name ASC";
	$userlevelsquery = mysqli_query($dbconn,$userlevelsq);
	while ($userlevelopt = mysqli_fetch_assoc($userlevelsquery)) {

		// for each user level, count the number of users
		$userlevelid		= $userlevelopt['user_level_id'];
		$userlevelname		= $userlevelopt['user_level_name'];

		$ulvlq			= "SELECT * FROM users WHERE user_level='".$userlevelid."'";
		$ulvlquery		= mysqli_query($dbconn,$ulvlq);
		$ulvlqty			= mysqli_num_rows($ulvlquery);
		if ($ulvlqty > 0) {
			echo "\t\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t\t<td>".$userlevelname."</td>";
			echo "<td>".$ulvlqty."</td>\n";
			echo "\t\t\t\t\t\t</tr>\n";
		}
	}
?>
					</table>

				<h4><?php echo _("User type"); ?></h4>
					<table>
<?php
	$usertypesq = "SELECT * FROM actor_types ORDER BY actor_type_name ASC";
	$usertypesquery = mysqli_query($dbconn,$usertypesq);
	while ($usertypeopt = mysqli_fetch_assoc($usertypesquery)) {

		// for each actor type, count the number of users
		$usertypeid			= $usertypeopt['actor_type_id'];
		$usertypename		= $usertypeopt['actor_type_name'];

		$typeq			= "SELECT * FROM users WHERE user_actor_type='".$usertypeid."'";
		$typequery		= mysqli_query($dbconn,$typeq);
		$typeqty			= mysqli_num_rows($typequery);
		if ($typeqty > 0) {
			echo "\t\t\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t\t\t<td>".$usertypename."</td>";
			echo "<td>".$typeqty."</td>\n";
			echo "\t\t\t\t\t\t</tr>\n";
		}
	}
?>
					</table>
        </div>
      </div>
    </div> <!-- end w3-row -->
<?php
include_once "main-footer.php";
?>
