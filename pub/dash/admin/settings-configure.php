<?php
/*
 * pub/dash/admin/settings-configure.php
 *
 * This page allows admin users to set the website's primary configuration.
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
		redirect("../../index.php");
	}

	$usrq = "SELECT * FROM users WHERE user_id=\"".$sel_id."\"";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usropt = mysqli_fetch_assoc($usrquery)) {
		$usrid		= $usropt['user_id'];
		$usrname		= $usropt['user_name'];
	}

	include "../localization.php";
}

if (isset($_POST['configsubmit'])){

	// get the values from the form
	$confname		= nicetext($_POST['configname']);
	$confurl			= $_POST['configurl'];
	$confdesc		= nicetext($_POST['configdesc']);
	$conflocale		= $_POST['configlocale'];
	$confadmin		= nicetext($_POST['configadmin']);
	$confadmeml		= $_POST['configadmeml'];
	$confpost		= nicetext($_POST['configpost']);
	$confposts		= nicetext($_POST['confposts']);
	$confrepost		= nicetext($_POST['confrepost']);
	$confreposts	= nicetext($_POST['confreposts']);
	$conffave		= nicetext($_POST['configfavorite']);
	$conffaves		= nicetext($_POST['configfavorites']);
	$confdislike	= nicetext($_POST['configdislike']);
	$confdislikes	= nicetext($_POST['configdislikes']);
	$confuser		= nicetext($_POST['configuser']);
	$confusers		= nicetext($_POST['configusers']);
	$confmaxpost	= $_POST['configmaxpost'];

	if (isset($_POST['configregi'])) {
		$confregi = 1;
	} else {
		$confregi = 0;
	}

	$configq = "UPDATE configuration SET website_url='".$confurl."', website_name='".$confname."', website_description='".$confdesc."', default_locale='".$conflocale."', open_registrations='".$confregi."', admin_account='".$confadmin."', admin_email='".$confadmeml."', posts_are_called='".$confposts."', post_is_called='".$confpost."', reposts_are_called='".$confreposts."', repost_is_called='".$confrepost."', favorites_are_called='".$conffaves."', favorite_is_called='".$conffave."', dislikes_are_called='".$confdislikes."', dislike_is_called='".$confdislike."', users_are_called='".$confusers."', user_is_called='".$confuser."', max_post_length='".$confmaxpost."' WHERE primary_key='".SITEKEY."'";
	$configquery = mysqli_query($dbconn,$configq);
	redirect("index.php");
}


$pagetitle = $website_name._(" configuration");

include_once "admin-header.php";
include_once "admin-nav.php";
?>
			<article class="w3-col w3-panel w3-cell m9">
				<h3><?php echo _("Website configuration"); ?></h3>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<p>
						<label for "configname"><?php echo _("Site name"); ?></label>
						<input type="text" name="configname" id="configname" class="w3-input w3-border w3-margin-bottom" maxlength="75" required title="<?php echo _("The name of the website."); ?>" value="<?php echo $website_name; ?>">
					</p>
					<p>
						<label for "configurl"><?php echo _("URL"); ?></label>
						<input type="text" name="configurl" id="configurl" class="w3-input w3-border w3-margin-bottom" maxlength="255" required placeholder="https://amore.example.com" title="<?php echo _("The url of the website."); ?>" value="<?php echo $website_url; ?>">
					</p>
					<p>
						<label for "configdesc"><?php echo _("Description"); ?></label>
						<textarea name="configdesc" id="configdesc" class="w3-input w3-border w3-margin-bottom" placeholder="<?php echo _("This website is made with Amore! It's made for love!"); ?>" title="<?php echo _("The description appears on the front page and is a good way to introduce new visitors to the website."); ?>"><?php echo $website_description; ?></textarea>
					</p>
					<p>
						<label for "configlocale"><?php echo _("Default locale"); ?></label>
						<select name="configlocale" id="configlocale" class="w3-input w3-border w3-margin-bottom" title="<?php echo _("This is the site's default locale. Users can set their own if they so choose."); ?>">
<?php
		$localeq = "SELECT * FROM locales ORDER BY locale_language ASC";
		$localequery = mysqli_query($dbconn,$localeq);
		while($localeopt = mysqli_fetch_assoc($localequery)) {
			$localeid		= $localeopt['locale_id'];
			$localelang		= $localeopt['locale_language'];
			$localectry		= $localeopt['locale_country'];
			echo "\t\t\t\t\t\t\t<option value=\"".$localeid."\">".$localelang."-".$localectry."</option>\n";
		}
?>
						</select>
					</p>
					<p>
						<label for "configregi"><?php echo _("Membership"); ?></label>
<?php
	if ($open_registration == 0) {
		echo "\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"configregi\" id=\"configregi\" title=\""._('If checked, anyone is allowed to become a member.')."\" value=\"1\">&nbsp;&nbsp;"._("Anyone can join.")."\n";
	} else {
		echo "\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"configregi\" id=\"configregi\" title=\""._('If checked, anyone is allowed to become a member.')."\" checked value=\"1\">&nbsp;&nbsp;"._("Anyone can join.")."\n";
	}
?>

					</p>
					<p>
						<label for "configadmin"><?php echo _("Admin account"); ?></label>
						<input type="text" name="configadmin" id="configadmin" class="w3-input w3-border w3-margin-bottom" maxlength="30" required title="<?php echo _("This is the account for the primary site admin."); ?>" value="<?php echo $admin_account; ?>">
					</p>
					<p>
						<label for "configadmeml"><?php echo _("Admin email"); ?></label>
						<input type="email" name="configadmeml" id="configadmeml" class="w3-input w3-border w3-margin-bottom" maxlength="255" title="<?php echo _("The email address of the site's primary admin."); ?>" value="<?php echo $admin_email; ?>">
					</p>
					<p>
						<label for "configpost"><?php echo _("Post is called"); ?></label>
						<input type="text" name="configpost" id="configpost" class="w3-input w3-border w3-margin-bottom" maxlength="20" title="<?php echo _("Do you want to call a Post something else?"); ?>" value="<?php echo $post_is_called; ?>">
					</p>
					<p>
						<label for "configposts"><?php echo _("Posts are called"); ?></label>
						<input type="text" name="configposts" id="configposts" class="w3-input w3-border w3-margin-bottom" maxlength="20" title="<?php echo _("Do you want to call Posts something else?"); ?>" value="<?php echo $posts_are_called; ?>">
					</p>
					<p>
						<label for "configrepost"><?php echo _("Repost is called"); ?></label>
						<input type="text" name="configrepost" id="configrepost" class="w3-input w3-border w3-margin-bottom" maxlength="20" title="<?php echo _("Do you want to call a Repost something else?"); ?>" value="<?php echo $repost_is_called; ?>">
					</p>
					<p>
						<label for "configreposts"><?php echo _("Reposts are called"); ?></label>
						<input type="text" name="configreposts" id="configreposts" class="w3-input w3-border w3-margin-bottom" maxlength="20" title="<?php echo _("Do you want to call Reposts something else?"); ?>" value="<?php echo $reposts_are_called; ?>">
					</p>
					<p>
						<label for "configfavorite"><?php echo _("Favorite is called"); ?></label>
						<input type="text" name="configfavorite" id="configfavorite" class="w3-input w3-border w3-margin-bottom" maxlength="20" title="<?php echo _("Do you want to call a Like something else?"); ?>" value="<?php echo $favorite_is_called; ?>">
					</p>
					<p>
						<label for "configfavorites"><?php echo _("Favorites are called"); ?></label>
						<input type="text" name="configfavorites" id="configfavorites" class="w3-input w3-border w3-margin-bottom" maxlength="20" title="<?php echo _("Do you want to call Likes something else?"); ?>" value="<?php echo $favorites_are_called; ?>">
					</p>
					<p>
						<label for "configdislike"><?php echo _("Dislike is called"); ?></label>
						<input type="text" name="configdislike" id="configdislike" class="w3-input w3-border w3-margin-bottom" maxlength="20" title="<?php echo _("Do you want to call a Dislike something else?"); ?>" value="<?php echo $dislike_is_called; ?>">
					</p>
					<p>
						<label for "configdislikes"><?php echo _("Dislikes are called"); ?></label>
						<input type="text" name="configdislikes" id="configdislikes" class="w3-input w3-border w3-margin-bottom" maxlength="20" title="<?php echo _("Do you want to call Dislikes something else?"); ?>" value="<?php echo $dislikes_are_called; ?>">
					</p>
					<p>
						<label for "configuser"><?php echo _("User is called"); ?></label>
						<input type="text" name="configuser" id="configuser" class="w3-input w3-border w3-margin-bottom" maxlength="20" title="<?php echo _("Do you want to call a User something else?"); ?>" value="<?php echo $user_is_called; ?>">
					</p>
					<p>
						<label for "configusers"><?php echo _("Users are called"); ?></label>
						<input type="text" name="configusers" id="configusers" class="w3-input w3-border w3-margin-bottom" maxlength="20" title="<?php echo _("Do you want to call Users something else?"); ?>" value="<?php echo $users_are_called; ?>">
					</p>
					<p>
						<label for "configmaxpost"><?php echo _("Maximum characters per post"); ?></label>
						<input type="number" name="configmaxpost" id="configmaxpost" class="w3-input w3-border w3-margin-bottom" min="140" max="200001" title="<?php echo _("The maximum number of characters in a post."); ?>" value="<?php echo $max_post_length; ?>">
					</p>
					<p>
					<input type="submit" name="configsubmit" id="configsubmit" class="w3-button w3-button-hover w3-block w3-theme-d3 w3-section w3-padding" value="<?php echo _('TO UPDATE'); ?>">
				</p>
				</form>
			</article>
<?php
include_once "admin-footer.php";
?>
