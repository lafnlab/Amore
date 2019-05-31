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

$pagetitle = $dinname;
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-l3 w3-padding">
				<h4 id="basicform"><?php echo _($username); ?></h4>
				<table>
					<tr>
						<td><?php echo _('ID'); ?></td><td><?php echo $userid;?></td>
					</tr>
					<tr>
						<td><?php echo _('Email'); ?></td><td><?php echo $useremail;?></td>
					</tr>
					<tr>
						<td><?php echo _('Date of birth'); ?></td><td><?php echo $userdob;?></td>
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
