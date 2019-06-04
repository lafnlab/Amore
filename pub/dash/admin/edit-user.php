<?php
/*
 * pub/dash/admin/edit-user.php
 *
 * Admin can edit a user profile.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
} else {
	$sel_id = "";
}


if ($sel_id != '') {

	$userq = "SELECT * FROM users WHERE user_id=\"".$sel_id."\"";
	$userquery = mysqli_query($dbconn,$userq);
	while($useropt = mysqli_fetch_assoc($userquery)) {
		$userid				= $useropt['user_id'];
		$username			= $useropt['user_name'];
		$userdname			= $useropt['user_display_name'];
		$useremail			= $useropt['user_email'];
		$userdob				= $useropt['user_date_of_birth'];
		$userdobPRV			= $useropt['user_date_of_birth_privacy'];
		$userlevel			= $useropt['user_level'];
		$usertype			= $useropt['user_actor_type'];
		$useravatar			= $useropt['user_avatar'];
		$usergender			= $useropt['user_gender'];
		$usergenderPRV		= $useropt['user_gender_privacy'];
		$usersexual			= $useropt['user_sexuality'];
		$usersexualPRV		= $useropt['user_sexuality_privacy'];
		$userrelstat		= $useropt['user_relationship_status'];
		$userrelstatPRV	= $useropt['user_relationship_status_privacy'];
		$usereyes			= $useropt['user_eye_color'];
		$userhair			= $useropt['user_hair_color'];
		$userplace			= $useropt['user_location'];
		$userplacePRV		= $useropt['user_location_privacy'];
		$usernation			= $useropt['user_nationality'];
		$usernationPRV		= $useropt['user_nationality_privacy'];
		$userlocale			= $useropt['user_locale'];
		$usertz				= $useropt['user_time_zone'];
		$usertzPRV			= $useropt['user_time_zone_privacy'];
		$userbio				= $useropt['user_bio'];
		$userfollows		= $useropt['user_follows'];
		$userfollowers		= $useropt['user_followers'];
		$usersince			= $useropt['user_created'];
		$userlast			= $useropt['user_last_login'];
	}
}


// PROCESSING THE FORM
if (isset($_POST['usrsubmit'])) {

	// get the form data
	$uid			= $_POST['usrid'];
	$uname		= nicetext($_POST['usrname']);
	$udname		= nicetext($_POST['usrdname']);
	$uemail		= $_POST['usremail'];
	$udob			= $_POST['usrdob'];
	$udobprv		= $_POST['usrdobprv'];
	$ulevel		= $_POST['usrlevel'];
	$uactor		= $_POST['usractor'];
	$ugender		= $_POST['usrgender'];
	$ugenprv		= $_POST['usrgenprv'];
	$usexual		= $_POST['usrsexual'];
	$usexprv		= $_POST['usrsexprv'];
	$urelstat	= $_POST['usrrelstat'];
	$urelprv		= $_POST['usrrelprv'];
	$ueyes		= $_POST['usreyes'];
	$uhair		= $_POST['usrhair'];
	$uplace		= $_POST['usrplace'];
	$uplaprv		= $_POST['usrplaprv'];
	$unation		= $_POST['usrnation'];
	$ulocale		= $_POST['usrlocale'];
	$utz			= $_POST['usrtz'];
	$ubio			= nicetext($_POST['usrbio']);

	$usrupdq	= "UPDATE users SET user_name='".$uname."', user_display_name='".$udname."', user_email='".$uemail."', user_date_of_birth='".$udob."', user_date_of_birth_privacy='".$udobprv."', user_level='".$ulevel."', user_actor_type='".$uactor."', user_gender='".$ugender."', user_gender_privacy='".$ugenprv."', user_sexuality='".$usexual."', user_sexuality_privacy='".$usexprv."', user_relationship_status='".$urelstat."', user_relationship_status_privacy='".$urelprv."', user_eye_color='".$ueyes."', user_hair_color='".$uhair."', user_location='".$uplace."', user_location_privacy='".$uplaprv."', user_nationality='".$unation."', user_locale='".$ulocale."', user_time_zone='".$utz."', user_bio='".$ubio."'";
	$userupdquery = mysqli_query($dbconn,$usrupdq);
	redirect("list-users.php");
}


if ($userdname !== "") {
	$pagetitle = $userdname;
} else {
	$pagetitle = $username;
}

include_once "admin-header.php";
include_once "admin-nav.php";
?>
<?php
if ($message != '' || NULL) {
	echo header_message($message);
}
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($pagetitle); ?></h4>
				❗ <i><?php echo _("NOTE: Privacy levels aren't currently implemented. Please use caution when entering personal information."); ?></i>
				<form id="basicform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="hidden" name="usrid" value="<?php echo $userid; ?>">
				<table class="w3-table">
					<tr>
						<td><?php echo _('Username'); ?></td>
						<td><input type="text" name="usrname" id="usrname" class="w3-input w3-border w3-margin-bottom" required maxlength="50" value="<?php echo $username; ?>"></td>
					</tr>
					<tr>
						<td><?php echo _('Display name'); ?></td>
						<td><input type="text" name="usrdname" id="usrdname" class="w3-input w3-border w3-margin-bottom" maxlength="100" value="<?php echo $userdname; ?>"></td>
					</tr>
					<tr>
						<td><?php echo _('Email'); ?></td>
						<td><input type="email" name="usremail" id="useremail" class="w3-input w3-border w3-margin-bottom" maxlength="255" value="<?php echo $useremail; ?>"></td>
					</tr>
					<tr>
						<td><?php echo _('Date of birth'); ?></td>
						<td><input type="date" name="usrdob" id="usrdob" class="w3-input w3-border w3-margin-bottom" value="<?php echo $userdob; ?>"></td>
					</tr>
					<tr>
						<td><?php echo _('Date of birth privacy'); ?></td>
						<td>
							<select name="usrdobprv" id="usrdobprv" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the privacy levels
		$dobprivacyq = "SELECT * FROM privacy_levels ORDER BY privacy_level_name ASC";
		$dobprivacyquery = mysqli_query($dbconn,$dobprivacyq);
		while ($dobprivacyopt = mysqli_fetch_assoc($dobprivacyquery)) {
			if ($dobprivacyopt['privacy_level_id'] === $userdobPRV) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$dobprivacyopt['privacy_level_id']."\" selected>".$dobprivacyopt['privacy_level_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$dobprivacyopt['privacy_level_id']."\">".$dobprivacyopt['privacy_level_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('User level'); ?></td>
						<td>
							<select name="usrlevel" id="usrlevel" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the user levels
		$userlevelq = "SELECT * FROM user_levels ORDER BY user_level_name ASC";
		$userlevelquery = mysqli_query($dbconn,$userlevelq);
		while ($userlevelopt = mysqli_fetch_assoc($userlevelquery)) {
			if ($userlevelopt['user_level_id'] === $userlevel) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$userlevelopt['user_level_id']."\" selected>".$userlevelopt['user_level_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$userlevelopt['user_level_id']."\">".$userlevelopt['user_level_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Actor type'); ?></td>
						<td>
							<select name="usractor" id="usractor" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the actor types
		$actortypeq	= "SELECT * FROM actor_types ORDER BY actor_type_name ASC";
		$actortypequery = mysqli_query($dbconn,$actortypeq);
		while ($actortypeopt = mysqli_fetch_assoc($actortypequery)) {
			if ($actortypeopt['actor_type_id'] === $usertype) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$actortypeopt['actor_type_id']."\" selected>".$actortypeopt['actor_type_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$actortypeopt['actor_type_id']."\">".$actortypeopt['actor_type_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Gender'); ?></td>
						<td>
							<select name="usrgender" id="usrgender" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the genders
		$genq = "SELECT * FROM genders ORDER BY gender_name ASC";
		$genquery = mysqli_query($dbconn,$genq);
		while ($genderopt = mysqli_fetch_assoc($genquery)) {
			if ($genderopt['gender_id'] === $usergender) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$genderopt['gender_id']."\" selected>".$genderopt['gender_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$genderopt['gender_id']."\">".$genderopt['gender_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Gender privacy'); ?>&nbsp;❗</td>
						<td>
							<select name="usrgenprv" id="usrgenprv" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the privacy levels
		$genprivacyq = "SELECT * FROM privacy_levels ORDER BY privacy_level_name ASC";
		$genprivacyquery = mysqli_query($dbconn,$genprivacyq);
		while ($genprivacyopt = mysqli_fetch_assoc($genprivacyquery)) {
			if ($genprivacyopt['privacy_level_id'] === $usergenderPRV) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$genprivacyopt['privacy_level_id']."\" selected>".$genprivacyopt['privacy_level_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$genprivacyopt['privacy_level_id']."\">".$genprivacyopt['privacy_level_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Sexuality'); ?></td>
						<td>
							<select name="usrsexual" id="usrsexual" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the sexualities
		$sexq = "SELECT * FROM sexualities ORDER BY sexuality_name ASC";
		$sexquery = mysqli_query($dbconn,$sexq);
		while ($sexopt = mysqli_fetch_assoc($sexquery)) {
			if ($sexopt['sexuality_id'] === $usersexual) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$sexopt['sexuality_id']."\" selected>".$sexopt['sexuality_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$sexopt['sexuality_id']."\">".$sexopt['sexuality_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Sexuality privacy'); ?>&nbsp;❗</td>
						<td>
							<select name="usrsexprv" id="usrsexprv" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the privacy levels
		$sexprivacyq = "SELECT * FROM privacy_levels ORDER BY privacy_level_name ASC";
		$sexprivacyquery = mysqli_query($dbconn,$sexprivacyq);
		while ($sexprivacyopt = mysqli_fetch_assoc($sexprivacyquery)) {
			if ($sexprivacyopt['privacy_level_id'] === $usersexualPRV) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$sexprivacyopt['privacy_level_id']."\" selected>".$sexprivacyopt['privacy_level_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$sexprivacyopt['privacy_level_id']."\">".$sexprivacyopt['privacy_level_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Relationship status'); ?></td>
						<td>
							<select name="usrrelstat" id="usrrelstat" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the relationship statuses
		$relstatq = "SELECT * FROM relationship_statuses ORDER BY relationship_status_name ASC";
		$relstatquery = mysqli_query($dbconn,$relstatq);
		while ($relstatopt = mysqli_fetch_assoc($relstatquery)) {
			if ($relstatopt['relationship_status_id'] === $userrelstat) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$relstatopt['relationship_status_id']."\" selected>".$relstatopt['relationship_status_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$relstatopt['relationship_status_id']."\">".$relstatopt['relationship_status_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Relationship status privacy'); ?>&nbsp;❗</td>
						<td>
							<select name="usrrelprv" id="usrrelprv" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the privacy levels
		$relprivacyq = "SELECT * FROM privacy_levels ORDER BY privacy_level_name ASC";
		$relprivacyquery = mysqli_query($dbconn,$relprivacyq);
		while ($relprivacyopt = mysqli_fetch_assoc($relprivacyquery)) {
			if ($relprivacyopt['privacy_level_id'] === $userrelstatPRV) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$relprivacyopt['privacy_level_id']."\" selected>".$relprivacyopt['privacy_level_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$relprivacyopt['privacy_level_id']."\">".$relprivacyopt['privacy_level_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Eye color'); ?></td>
						<td>
							<select name="usreyes" id="usreyes" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the eye colors
		$eyecolq = "SELECT * FROM eye_colors ORDER BY eye_color_name ASC";
		$eyecolquery = mysqli_query($dbconn,$eyecolq);
		while ($eyecolopt = mysqli_fetch_assoc($eyecolquery)) {
			if ($eyecolopt['eye_color_id'] === $usereyes) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$eyecolopt['eye_color_id']."\" selected>".$eyecolopt['eye_color_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$eyecolopt['eye_color_id']."\">".$eyecolopt['eye_color_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Hair color'); ?></td>
						<td>
							<select name="usrhair" id="usrhair" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the hair colors
		$haircolq = "SELECT * FROM hair_colors ORDER BY hair_color_name ASC";
		$haircolquery = mysqli_query($dbconn,$haircolq);
		while ($haircolopt = mysqli_fetch_assoc($haircolquery)) {
			if ($haircolopt['hair_color_id'] === $userhair) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$haircolopt['hair_color_id']."\" selected>\n".$haircolopt['hair_color_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$haircolopt['hair_color_id']."\">".$haircolopt['hair_color_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Location'); ?></td>
						<td>
							<select name="usrplace" id="usrplace" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the locations
		$placeq = "SELECT * FROM locations ORDER BY location_name ASC";
		$placequery = mysqli_query($dbconn,$placeq);
		while ($placeopt = mysqli_fetch_assoc($placequery)) {
			if ($placeopt['location_id'] === $userplace) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$placeopt['location_id']."\" selected>".$placeopt['location_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$placeopt['location_id']."\">".$placeopt['location_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Location privacy'); ?>&nbsp;❗</td>
						<td>
							<select name="usrplaprv" id="usrplaprv" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the privacy levels
		$plaprivacyq = "SELECT * FROM privacy_levels ORDER BY privacy_level_name ASC";
		$plaprivacyquery = mysqli_query($dbconn,$plaprivacyq);
		while ($plaprivacyopt = mysqli_fetch_assoc($plaprivacyquery)) {
			if ($plaprivacyopt['privacy_level_id'] === $userplacePRV) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$plaprivacyopt['privacy_level_id']."\" selected>".$plaprivacyopt['privacy_level_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$plaprivacyopt['privacy_level_id']."\">".$plaprivacyopt['privacy_level_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Nationality'); ?></td>
						<td>
							<select name="usrnation" id="usrnation" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the nationalities
		$natq = "SELECT * FROM nationalities ORDER BY nationality_name ASC";
		$natquery = mysqli_query($dbconn,$natq);
		while ($natopt = mysqli_fetch_assoc($natquery)) {
			if ($natopt['nationality_id'] === $usernation) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$natopt['nationality_id']."\" selected>".$natopt['nationality_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$natopt['nationality_id']."\">".$natopt['nationality_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Locale'); ?></td>
						<td>
							<select name="usrlocale" id="usrlocale" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the locales
		$locq = "SELECT * FROM locales ORDER BY locale_language, locale_country ASC";
		$locquery = mysqli_query($dbconn,$locq);
		while ($locopt = mysqli_fetch_assoc($locquery)) {
			if ($locopt['locale_id'] === $userlocale) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$locopt['locale_id']."\" selected>".$locopt['locale_language']."_".$locopt['locale_country']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$locopt['locale_id']."\">".$locopt['locale_language']."_".$locopt['locale_country']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Time zone'); ?></td>
						<td>
							<select name="usrtz" id="usrtz" class="w3-input w3-border w3-margin-bottom">
								<option value="">---</option>
<?php
		// get the time zones
		$timezq = "SELECT * FROM time_zones ORDER BY time_zone_name ASC";
		$timezquery = mysqli_query($dbconn,$timezq);
		while ($timezopt = mysqli_fetch_assoc($timezquery)) {
			if ($timezopt['time_zone_id'] === $usertz) {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$timezopt['time_zone_id']."\" selected>".$timezopt['time_zone_name']."</option>\n";
			} else {
				echo "\t\t\t\t\t\t\t\t<option value=\"".$timezopt['time_zone_id']."\">".$timezopt['time_zone_name']."</option>\n";
			}
		}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo _('Bio'); ?></td>
						<td>
							<textarea name="usrbio" id="usrbio" class="w3-input w3-border w3-margin-bottom"><?php echo $userbio; ?></textarea>
						</td>
					</tr>
					<tr>
						<td>
						<input type="submit" name="usrsubmit" id="usrsubmit" class="w3-button w3-button-hover w3-theme-d3 w3-padding" value="<?php echo _('TO UPDATE'); ?>">
						</td>
					</tr>
				</table>
				</form>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
