<?php
/*
 * pub/dash/admin/the-user.php
 *
 * Displays a user.
 *
 * since Amore version 0.2
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

if ($userdname !== "") {
	$pagetitle = $userdname;
} else {
	$pagetitle = $username;
}

include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($pagetitle); ?></h4>
				<table class="w3-table">
					<tr>
						<td><?php echo _('ID'); ?></td><td><?php echo $userid;?></td>
					</tr>
					<tr>
						<td><?php echo _('Username'); ?></td><td><?php echo $username;?></td>
					</tr>
					<tr>
						<td><?php echo _('Display name'); ?></td><td><?php echo $userdname;?></td>
					</tr>
					<tr>
						<td><?php echo _('Email'); ?></td><td><?php echo $useremail;?></td>
					</tr>
					<tr>
						<td><?php echo _('Date of birth'); ?></td><td><?php echo $userdob;?></td>
					</tr>
					<tr>
						<td><?php echo _('User level'); ?></td><td><?php
	$levelq = "SELECT * FROM user_levels WHERE user_level_id='".$userlevel."'";
	$levelquery = mysqli_query($dbconn,$levelq);
	while ($levelopt = mysqli_fetch_assoc($levelquery)) {
		echo $levelopt['user_level_name'];
	}
?></td>
					</tr>
					<tr>
						<td><?php echo _('Actor type'); ?></td><td><?php
	$actorq = "SELECT * FROM actor_types WHERE actor_type_id='".$usertype."'";
	$actorquery = mysqli_query($dbconn,$actorq);
	while ($actoropt = mysqli_fetch_assoc($actorquery)) {
		echo $actoropt['actor_type_name'];
	}
?></td>
					</tr>
					<tr>
						<td><?php echo _('Gender'); ?></td><td><?php
	$genderq = "SELECT * FROM genders WHERE gender_id='".$usergender."'";
	$genderquery = mysqli_query($dbconn,$genderq);
	while ($genderopt = mysqli_fetch_assoc($genderquery)) {
		echo $genderopt['gender_name'];
	}
?></td>
					</tr>
					<tr>
						<td><?php echo _('Sexuality'); ?></td><td><?php
	$sexualq = "SELECT * FROM sexualities WHERE sexuality_id='".$usersexual."'";
	$sexualquery = mysqli_query($dbconn,$sexualq);
	while ($sexualopt = mysqli_fetch_assoc($sexualquery)) {
		echo $sexualopt['sexuality_name'];
	}
?></td>
					</tr>
					<tr>
						<td><?php echo _('Relationship status'); ?></td><td><?php
	$relstatq = "SELECT * FROM relationship_statuses WHERE relationship_status_id='".$userrelstat."'";
	$relstatquery = mysqli_query($dbconn,$relstatq);
	while ($relstatopt = mysqli_fetch_assoc($relstatquery)) {
		echo $relstatopt['relationship_status_name'];
	}
?></td>
					</tr>
					<tr>
						<td><?php echo _('Eye color'); ?></td><td><?php
	$eyesq = "SELECT * FROM eye_colors WHERE eye_color_id='".$usereyes."'";
	$eyesquery = mysqli_query($dbconn,$eyesq);
	while ($eyesopt = mysqli_fetch_assoc($eyesquery)) {
		echo $eyesopt['eye_color_name'];
	}
?></td>
					</tr>
					<tr>
						<td><?php echo _('Hair color'); ?></td><td><?php
	$hairq = "SELECT * FROM hair_colors WHERE hair_color_id='".$userhair."'";
	$hairquery = mysqli_query($dbconn,$hairq);
	while ($hairopt = mysqli_fetch_assoc($hairquery)) {
		echo $hairopt['hair_color_name'];
	}
?></td>
					</tr>
					<tr>
						<td><?php echo _('Location'); ?></td><td><?php
	$placeq = "SELECT * FROM locations WHERE location_id='".$userplace."'";
	$placequery = mysqli_query($dbconn,$placeq);
	while ($placeopt = mysqli_fetch_assoc($placequery)) {
		echo $placeopt['location_name'];
	}
?></td>
					</tr>
					<tr>
						<td><?php echo _('Nationality'); ?></td><td><?php
	$natq = "SELECT * FROM nationalities WHERE nationality_id='".$usernation."'";
	$natquery = mysqli_query($dbconn,$natq);
	while ($natopt = mysqli_fetch_assoc($natquery)) {
		echo $natopt['nationality_name'];
	}
?></td>
					</tr>
					<tr>
						<td><?php echo _('Locale'); ?></td><td><?php
	$localeq = "SELECT * FROM locales WHERE locale_id='".$userlocale."'";
	$localequery = mysqli_query($dbconn,$localeq);
	while ($localeopt = mysqli_fetch_assoc($localequery)) {
		echo $localeopt['locale_language']."_".$localeopt['locale_country'];
	}
?></td>
					</tr>
					<tr>
						<td><?php echo _('Time zone'); ?></td><td><?php
	$tzq = "SELECT * FROM time_zones WHERE time_zone_id='".$usertz."'";
	$tzquery = mysqli_query($dbconn,$tzq);
	while ($tzopt = mysqli_fetch_assoc($tzquery)) {
		echo $tzopt['time_zone_name'];
	}
?></td>
					</tr>
					<tr>
						<td><?php echo _('Bio'); ?></td><td><?php echo $userbio;?></td>
					</tr>
					<tr>
						<td><?php echo _('Joined'); ?></td><td><?php echo $usersince;?></td>
					</tr>
					<tr>
						<td><?php echo _('Last login'); ?></td><td><?php echo $userlast;?></td>
					</tr>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
