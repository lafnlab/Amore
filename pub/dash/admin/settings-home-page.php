<?php
/*
 * pub/dash/admin/settings-home-page.php
 *
 * This page allows admin users to determine how the website's home page should appear.
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
if (isset($_POST['homesubmit'])) {

	$hlogin		= $_POST['homelogin'];
	$husers		= $_POST['homeusers'];
	$hposts		= $_POST['homeposts'];
	$hstats		= $_POST['homestats'];
	$habout		= $_POST['homeabout'];
	$hpriv		= $_POST['homepriv'];
	$hsite		= $_POST['homesite'];
	$hmeta		= $_POST['homemeta'];
	$hadmin		= $_POST['homeadmin'];
	$htime		= $_POST['hometime'];

	$homeq	= "UPDATE configuration SET display_home_page_login_form='".$hlogin."', display_home_page_users_quantity='".$husers."', display_home_page_posts_quantity='".$hposts."', display_home_page_statistics_link='".$hstats."', display_home_page_about_link='".$habout."', display_home_page_privacy_policy_link='".$hpriv."', display_home_page_site_description='".$hsite."', display_home_page_meta_description='".$hmeta."', display_home_page_admin_info='".$hadmin."', display_home_page_timeline='".$htime."'";
	$homequery = mysqli_query($dbconn,$homeq);
	redirect("index.php");
}

$pagetitle = _("Home page configuration");

include_once "admin-header.php";
include_once "admin-nav.php";
?>
			<article class="w3-col w3-panel w3-cell m9">
				<div class="w3-card-2 w3-theme-l3 w3-padding">
					<h3><?php echo $pagetitle; ?></h3>
					<p><?php echo _('Will these items be displayed on the home page? If checked, these items will appear on the website\'s main page.'); ?></p>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
						<table>
							<tr>
								<td><?php echo _("Login/Registration form"); ?></td>
	<?php
			if ($open_registration == 0) {
				echo "\t\t\t\t\t\t\t<td><input type=\"checkbox\" name=\"homelogin\" id=\"homelogin\" title=\""._('If checked, login or registration form will be displayed.')."\" value=\"1\"></td>\n";
			} else {
				echo "\t\t\t\t\t\t\t<td><input type=\"checkbox\" name=\"homelogin\" id=\"homelogin\" title=\""._('If checked, login or registration form will be displayed.')."\" checked value=\"1\"></td>\n";
			}
	?>
							</tr>
							<tr>
								<td><?php echo _("Number of users"); ?></td>
								<td><input type="checkbox" name="homeusers" id="homeusers" title="<?php echo _('If checked, the number of total users will be displayed.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Number of posts"); ?></td>
								<td><input type="checkbox" name="homeposts" id="homeposts" title="<?php echo _('If checked, the number of total posts will be displayed.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Statistics"); ?></td>
								<td><input type="checkbox" name="homestats" id="homestats" title="<?php echo _('If checked, a link to the public statistics page will be displayed.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("About"); ?></td>
								<td><input type="checkbox" name="homeabout" id="homeabout" title="<?php echo _('If checked, a link to the About page will be displayed.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Privacy policy"); ?></td>
								<td><input type="checkbox" name="homepriv" id="homepriv" title="<?php echo _("If checked, a link to the website\'s privacy policy will be displayed."); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Site description"); ?></td>
								<td><input type="checkbox" name="homesite" id="homesite" title="<?php echo _('If checked, the website\'s description will be displayed.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Meta description"); ?></td>
								<td><input type="checkbox" name="homemeta" id="homemeta" title="<?php echo _('If checked, a description of Amore software will be displayed.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Administrator"); ?></td>
								<td><input type="checkbox" name="homeadmin" id="homeadmin" title="<?php echo _('If checked, the name of the website administrator will be displayed.'); ?>" checked value="1"></td>
							</tr>
							<tr>
								<td><?php echo _("Public timeline"); ?></td>
								<td><input type="checkbox" name="hometime" id="hometime" title="<?php echo _('If checked, the website\'s public timeline will be displayed.'); ?>" checked value="1"></td>
							</tr>
							<tr>
							<td colspan="2"><input type="submit" name="homesubmit" id="homesubmit" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('TO UPDATE'); ?>"></td>
							</tr>
						</table>
					</form>
				</div>
			</article>
<?php
include_once "admin-footer.php";
?>
