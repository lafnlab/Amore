<?php
/*
 * pub/dash/admin/settings-privacy.php
 *
 * This page allows or disallows certain privacy settings for all users.
 *
 * since Amore version 0.3
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";


/* if a user id is set															*/
if (isset($sel_id)) {


	/* but $_COOKIE['id'] is not set											*/
	if(!isset($_COOKIE['id'])) {
		unset($sel_id);
		redirect("../index.php");
	}

	$usrq = "SELECT * FROM users WHERE user_id=\"".$sel_id."\"";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usropt = mysqli_fetch_assoc($usrquery)) {
		$usrid		= $usropt['user_id'];
		$usrname		= $usropt['user_name'];
	}

	include "localization.php";
}

// FORM PROCESSING
if (isset($_POST['privsubmit'])) {
	$prvage		= $_POST['privage'];
	$prvgender	= $_POST['privgender'];
	$prvsexual	= $_POST['privsexual'];
	$prvrelstat	= $_POST['privrelstat'];
	$prvloca		= $_POST['privloca'];
	$prvnat		= $_POST['privnat'];
	$prvtz		= $_POST['privtz'];

	$privq	= "UPDATE configuration SET allow_user_age_privacy='".$prvage."', allow_user_gender_privacy='".$prvgender."', allow_user_sexuality_privacy='".$prvsexual."', allow_user_relationship_status_privacy='".$prvrelstat."', allow_user_location_privacy='".$prvloca."', allow_user_nationality_privacy='".$prvnat."', allow_user_time_zone_privacy='".$prvtz."'";
	$privquery = mysqli_query($dbconn,$privq);
	redirect("index.php");
}

$pagetitle = _("Privacy configuration");

include_once "admin-header.php";
include_once "admin-nav.php";
?>
			<article class="w3-col w3-panel w3-cell m9">
				<div class="w3-card-2 w3-theme-l3 w3-padding">
					<h3><?php echo $pagetitle; ?></h3>
					<p><?php echo _('Will users be able to set these fields to private? If checked, these users can set these fields to private.'); ?></p>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
						<table>
							<tr>
								<td><?php echo _("Age"); ?></td>
								<td><input type="checkbox" name="privage" id="privage" title="<?php echo _('If checked, users will be able to set their age to private.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Gender"); ?></td>
								<td><input type="checkbox" name="privgender" id="privgender" title="<?php echo _('If checked, users will be able to set their gender to private.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Sexuality"); ?></td>
								<td><input type="checkbox" name="privsexual" id="privsexual" title="<?php echo _('If checked, users will be able to set their sexuality to private.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Relationship status"); ?></td>
								<td><input type="checkbox" name="privrelstat" id="privrelstat" title="<?php echo _('If checked, users will be able to set their relationship privacy to private.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Location"); ?></td>
								<td><input type="checkbox" name="privloca" id="privloca" title="<?php echo _("If checked, users will be able to set their location to private."); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Nationality"); ?></td>
								<td><input type="checkbox" name="privnat" id="privnat" title="<?php echo _('If checked, users will be able to set their nationality to private.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Time zone"); ?></td>
								<td><input type="checkbox" name="privtz" id="privtz" title="<?php echo _('If checked, users will be able to set their time zone to private.'); ?>" checked value="1"></td>
							</tr>
							<tr>
							<td colspan="2"><input type="submit" name="privsubmit" id="privsubmit" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('TO UPDATE'); ?>"></td>
							</tr>
						</table>
					</form>
				</div>
			</article>
<?php
include_once "admin-footer.php";
?>
