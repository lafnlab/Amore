<?php
/*
 * pub/dash/edit-profile.php
 *
 * A user can edit their profile.
 *
 * since Amore version 0.2
 *
 */

include_once "../../conn.php";
include "../../functions.php";

if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
} else {
	unset($sel_id);
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
}

/* if a user id is set															*/
if (isset($sel_id)) {


	/* but $_COOKIE['id'] is not set											*/
	if(!isset($_COOKIE['id'])) {
		unset($sel_id);
		redirect("../index.php");
	}

	$usrq = "SELECT * FROM users WHERE user_id='".$sel_id."'";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usropt = mysqli_fetch_assoc($usrquery)) {
		$usrid		= $usropt['user_id'];
		$usrname		= $usropt['user_name'];
		$usremail	= $usropt['user_email'];
		$usrlevel	= $usropt['user_level'];
		$usrsince	= $usropt['user_created'];
	}

	$uspq = "SELECT * FROM user_profiles WHERE user_profiles_id='".$sel_id."'";
	$uspquery = mysqli_query($dbconn,$uspq);
	while($uspopt = mysqli_fetch_assoc($uspquery)) {
		$uspdname	= $uspopt['user_display_name'];
		$uspgendr	= $uspopt['user_profiles_gender'];
		$uspsexul	= $uspopt['user_profiles_sexuality'];
		$uspeye		= $uspopt['user_profiles_eye_color'];
		$usphair		= $uspopt['user_profiles_hair_color'];
		$uspplace	= $uspopt['user_profiles_location'];
		$uspnat		= $uspopt['user_profiles_nationality'];
		$uspi18n		= $uspopt['user_profiles_locale'];
		$uspspkn		= $uspopt['user_profiles_spoken_language'];
		$usptime		= $uspopt['user_profiles_time_zone'];
		$uspbio		= $uspopt['user_profiles_description'];
		$usphin		= $uspopt['user_profiles_height_in'];
		$usphcm		= $uspopt['user_profiles_height_cm'];
		$uspwlb		= $uspopt['user_profiles_weight_lbs'];
		$uspwkg		= $uspopt['user_profiles_weight_kg'];
	}
}
$objdescription = _("Dashboard for ").$usrname;
$visitortitle = $usrname;

// POST FORM SUBMISSION PROCESSING
if (isset($_POST['prosubmit'])) {
	$finame		= nicetext($_POST['proname']);
	$fidesc		= nicetext($_POST['prodesc']);
	$fiemail		= nicetext($_POST['proemail']);
	$figen		= $_POST['progen'];
	$fisxu		= $_POST['prosxu'];
	$fieye		= $_POST['proeye'];
	$fihar		= $_POST['prohar'];
	$filoc		= $_POST['proloc'];
	$finat		= $_POST['pronat'];
	$fii18		= $_POST['proi18'];
	$fispk		= $_POST['prospk'];
	$fitzt		= $_POST['protzt'];
	$fihin		= nicetext($_POST['prohin']);
	$fihcm		= nicetext($_POST['prohcm']);
	$fiwlbs		= nicetext($_POST['prowlbs']);
	$fiwkg		= nicetext($_POST['prowkg']);

	// check if the user is in the pro table
	$usrproq = "SELECT * FROM user_profiles WHERE user_profiles_id='".$usrid."'";
	$usrproquery = mysqli_query($dbconn,$usrproq);
	if (mysqli_num_rows($usrproquery) > 0) {

		// the user is in the pro table, so let's update their info
		$fiprouq = "UPDATE user_profiles SET user_display_name='".$finame."', user_profiles_gender='".$figen."',user_profiles_sexuality='".$fisxu."',user_profiles_eye_color='".$fieye."',user_profiles_hair_color='".$fihar."',user_profiles_location='".$filoc."',user_profiles_nationality='".$finat."',user_profiles_locale='".$fii18."',user_profiles_spoken_language='".$fispk."',user_profiles_time_zone='".$fitzt."',user_profiles_description='".$fidesc."',user_profiles_height_in='".$fihin."',user_profiles_height_cm='".$fihcm."',user_profiles_weight_lbs='".$fiwlbs."',user_profiles_weight_kg='".$fiwkg."' WHERE user_profiles_id='".$usrid."'";
		$fiemailq = "UPDATE users SET user_email='".$fiemail."' WHERE user_id='".$usrid."'";
#		$message = $fiprouq;
		$fiprouquery = mysqli_query($dbconn,$fiprouq);
		$fiemailquery = mysqli_query($dbconn,$fiemailq);
		redirect("my-profile.php?uid=".$usrid);
	} else if (mysqli_num_rows($usrproquery) == 0) {

		// the user is not in the pro table, so let's enter their info
		$fiprouq = "INSERT INTO user_profiles
					(user_profiles_id,
					user_display_name,
					user_profiles_gender,
					user_profiles_sexuality,
					user_profiles_eye_color,
					user_profiles_hair_color,
					user_profiles_location,
					user_profiles_nationality,
					user_profiles_locale,
					user_profiles_spoken_language,
					user_profiles_time_zone,
					user_profiles_description,
					user_profiles_height_in,
					user_profiles_height_cm,
					user_profiles_weight_lbs,
					user_profiles_weight_kg
					) VALUES (
					'$usrid',
					'$finame',
					'$figen',
					'$fisxu',
					'$fieye',
					'$fihar',
					'$filoc',
					'$finat',
					'$fii18',
					'$fispk',
					'$fitzt',
					'$fidesc',
					'$fihin',
					'$fihcm',
					'$fiwlbs',
					'$fiwkg'
					)";
		$fiemailq = "UPDATE users SET user_email='".$fiemail."' WHERE user_id='".$usrid."'";
#		$message = $fiprouq;
		$fiprouquery = mysqli_query($dbconn,$fiprouq);
		$fiemailquery = mysqli_query($dbconn,$fiemailq);
		redirect("my-profile.php?uid=".$usrid);
	}

} // end if isset $_POST['prosubmit']


include_once "dash-header.php";
include_once "dash-nav.php";
?>
			<article class="w3-col w3-panel w3-cell m8">
				<div class="w3-card-2 w3-theme-l3 w3-padding">
					<h4><?php echo _("Edit your profile"); ?></h4>
				<table>
					<form id="editprofile" class="w3-card-2 w3-theme-l3 w3-padding maincard" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?uid=".$usrid); ?>">
					<tr>
						<td><label for="prouname"><?php echo _('Username');?></label></td>
						<td>@&nbsp;<input type="text" name="prouname" id="prouname" class="w3-border w3-margin-bottom" maxlength="255" value="<?php echo $usrname; ?>">&nbsp;@<?php echo short_url($website_url); ?></td>
					</tr>
					<tr>
						<td><label for="proname"><?php echo _('Display name');?></label></td>
						<td><input type="text" name="proname" id="proname" class="w3-input w3-border w3-margin-bottom" maxlength="255" value="<?php echo $uspdname; ?>"></td>
					</tr>
					<tr>
						<td><label for="prodesc"><?php echo _('Description/bio');?></label></td>
						<td><input type="text" name="prodesc" id="prodesc" class="w3-input w3-border w3-margin-bottom" maxlength="255" value="<?php echo $uspbio; ?>"></td>
					</tr>
					<tr>
						<td><label for="proemail"><?php echo _('Email address');?></label></td>
						<td><input type="email" name="proemail" id="proemail" class="w3-input w3-border w3-margin-bottom" maxlength="255" valur="<?php echo $usremail; ?>"></td>
					</tr>
					<tr>
						<td><label for="progen"><?php echo _('Gender');?></label></td>
						<td>
							<select class="w3-select" name="progen">
								<option value="">---</option>
<?php
// get the genders
$genq = "SELECT * FROM genders ORDER BY genders_name ASC";
$genquery = mysqli_query($dbconn,$genq);
while($genopt = mysqli_fetch_assoc($genquery)) {
	if ($genopt['genders_id']=== $uspgendr) {
		echo "\t\t\t\t\t<option value=\"".$genopt['genders_id']."\" selected>".$genopt['genders_name']."</option>\n";
	} else {
		echo "\t\t\t\t\t<option value=\"".$genopt['genders_id']."\">".$genopt['genders_name']."</option>\n";
	}
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="prosxu"><?php echo _('Sexuality');?></label></td>
						<td>
							<select class="w3-select" name="prosxu">
								<option value="">---</option>
<?php
// get the sexualities
$sxuq = "SELECT * FROM sexualities ORDER BY sexualities_name ASC";
$sxuquery = mysqli_query($dbconn,$sxuq);
while($sxuopt = mysqli_fetch_assoc($sxuquery)) {
	if ($sxuopt['sexualities_id'] === $uspsexul) {
		echo "\t\t\t\t\t<option value=\"".$sxuopt['sexualities_id']."\" selected>".$sxuopt['sexualities_name']."</option>\n";
	} else {
		echo "\t\t\t\t\t<option value=\"".$sxuopt['sexualities_id']."\">".$sxuopt['sexualities_name']."</option>\n";
	}
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="proeye"><?php echo _('Eye color');?></label></td>
						<td>
							<select class="w3-select" name="proeye">
							<option value="">---</option>
<?php
// get the eye colors
$eyeq = "SELECT * FROM eye_colors ORDER BY eye_colors_color ASC";
$eyequery = mysqli_query($dbconn,$eyeq);
while($eyeopt = mysqli_fetch_assoc($eyequery)) {
	if ($eyeopt['eye_colors_id'] === $uspeye) {
		echo "\t\t\t\t\t<option value=\"".$eyeopt['eye_colors_id']."\" selected>".$eyeopt['eye_colors_color']."</option>\n";
	} else {
		echo "\t\t\t\t\t<option value=\"".$eyeopt['eye_colors_id']."\">".$eyeopt['eye_colors_color']."</option>\n";
	}
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="prohar"><?php echo _('Hair color');?></label></td>
						<td>
							<select class="w3-select" name="prohar">
								<option value="">---</option>
<?php
// get the hair colors
$harq = "SELECT * FROM hair_colors ORDER BY hair_colors_color ASC";
$harquery = mysqli_query($dbconn,$harq);
while($haropt = mysqli_fetch_assoc($harquery)) {
	if ($haropt['hair_colors_id'] === $usphair) {
		echo "\t\t\t\t\t<option value=\"".$haropt['hair_colors_id']."\" selected>".$haropt['hair_colors_color']."</option>\n";
	} else {
		echo "\t\t\t\t\t<option value=\"".$haropt['hair_colors_id']."\">".$haropt['hair_colors_color']."</option>\n";
	}
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="proloc"><?php echo _('Location');?></label></td>
						<td>
							<select class="w3-select" name="proloc">
								<option value="">---</option>
<?php
// get the locations
$locq = "SELECT * FROM locations ORDER BY locations_name ASC";
$locquery = mysqli_query($dbconn,$locq);
while($locopt = mysqli_fetch_assoc($locquery)) {
	if ($locopt['locations_id'] === $uspplace) {
			echo "\t\t\t\t\t<option value=\"".$locopt['locations_id']."\" selected>".$locopt['locations_name']."</option>\n";
		} else {
			echo "\t\t\t\t\t<option value=\"".$locopt['locations_id']."\">".$locopt['locations_name']."</option>\n";
		}
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="pronat"><?php echo _('Nationality');?></label></td>
						<td>
							<select class="w3-select" name="pronat">
								<option value="">---</option>
<?php
// get the nationalities
$natq = "SELECT * FROM nationalities ORDER BY nationalities_name ASC";
$natquery = mysqli_query($dbconn,$natq);
while($natopt = mysqli_fetch_assoc($natquery)) {
	if ($natopt['nationalities_id'] === $uspnat) {
		echo "\t\t\t\t\t<option value=\"".$natopt['nationalities_id']."\" selected>".$natopt['nationalities_name']."</option>\n";
	} else {
		echo "\t\t\t\t\t<option value=\"".$natopt['nationalities_id']."\">".$natopt['nationalities_name']."</option>\n";
	}
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="proi18"><?php echo _('Locale');?></label></td>
						<td>
							<select class="w3-select" name="proi18">
								<option value="">---</option>
<?php
// get the locales
$i18q = "SELECT * FROM locales ORDER BY locales_language ASC";
$i18query = mysqli_query($dbconn,$i18q);
while($i18opt = mysqli_fetch_assoc($i18query)) {
	if ($i18opt['locales_id'] === $uspi18n) {
		if ($i18opt['locales_country'] != '') {
			echo "\t\t\t\t\t<option value=\"".$i18opt['locales_id']."\" selected>".$i18opt['locales_language']."_".$i18opt['locales_country']."</option>\n";
		} else {
						echo "\t\t\t\t\t<option value=\"".$i18opt['locales_id']."\" selected>".$i18opt['locales_language']."</option>\n";
		}
	} else {
		if ($i18opt['locales_country'] != '') {
			echo "\t\t\t\t\t<option value=\"".$i18opt['locales_id']."\">".$i18opt['locales_language']."_".$i18opt['locales_country']."</option>\n";
		} else {
			echo "\t\t\t\t\t<option value=\"".$i18opt['locales_id']."\">".$i18opt['locales_language']."</option>\n";
		}
	}
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="prospk"><?php echo _('Languages spoken');?></label></td>
						<!-- for now, this is limited to one language -->
						<td>
							<select class="w3-select" name="prospk">
								<option value="">---</option>
<?php
// get the spoken languages
$spkq = "SELECT * FROM spoken_languages ORDER BY spoken_languages_name ASC";
$spkquery = mysqli_query($dbconn,$spkq);
while($spkopt = mysqli_fetch_assoc($spkquery)) {
	if ($spkopt['spoken_languages_id'] === $uspspkn) {
		echo "\t\t\t\t\t<option value=\"".$spkopt['spoken_languages_id']."\" selected>".$spkopt['spoken_languages_name']."</option>\n";
	} else {
		echo "\t\t\t\t\t<option value=\"".$spkopt['spoken_languages_id']."\">".$spkopt['spoken_languages_name']."</option>\n";
	}
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="protzt"><?php echo _('Time zone');?></label></td>
						<td>
							<select class="w3-select" name="protzt">
								<option value="">---</option>
<?php
// get the time zones
$tztq = "SELECT * FROM time_zones ORDER BY time_zones_name ASC";
$tztquery = mysqli_query($dbconn,$tztq);
while($tztopt = mysqli_fetch_assoc($tztquery)) {
	if ($tztopt['time_zones_id'] === $usptime) {
		echo "\t\t\t\t\t<option value=\"".$tztopt['time_zones_id']."\" selected>".$tztopt['time_zones_name']."</option>\n";
	} else {
		echo "\t\t\t\t\t<option value=\"".$tztopt['time_zones_id']."\">".$tztopt['time_zones_name']."</option>\n";
	}
}

?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="prohin"><?php echo _('Height (inches)');?></label></td>
						<td><input type="number" name="prohin" id="prohin" class="w3-input w3-border w3-margin-bottom" min="24" max="100" value="<?php echo $usphin; ?>"></td>
					</tr>
					<tr>
						<td><label for="prohcm"><?php echo _('Height (cm)');?></label></td>
						<td><input type="number" name="prohcm" id="prohcm" class="w3-input w3-border w3-margin-bottom" min="61" max="272" value="<?php echo $usphcm; ?>"></td>
					</tr>
					<tr>
						<td><label for="prowlbs"><?php echo _('Weight (pounds)');?></label></td>
						<td><input type="number" name="prowlbs" id="prowlbs" class="w3-input w3-border w3-margin-bottom" min="80" max="1400" value="<?php echo $uspwlb; ?>"></td>
					</tr>
					<tr>
						<td><label for="prowkg"><?php echo _('Weight (kilos)');?></label></td>
						<td><input type="number" name="prowkg" id="prowkg" class="w3-input w3-border w3-margin-bottom" min="36" max="635" value="<?php echo $uspwkg; ?>"></td>
					</tr>
					<tr>
						<td><input type="submit" id="prosubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" name="prosubmit" value="<?php echo _('TO UPDATE'); ?>"></td>
					</tr>
			</form>
				</table>
				</div>
			</article>
<?php
include_once "dash-footer.php";
?>
