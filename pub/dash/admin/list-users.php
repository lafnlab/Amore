<?php
/*
 * pub/dash/list-users.php
 *
 * Displays a list of users in the database.
 *
 * since Amore version 0.2
 *
 */

include_once	"../../../conn.php";
include			"../../../functions.php";
require			"../../includes/database-connect.php";
require_once	"../../includes/configuration-data.php";

$pagetitle = _("List of users");
include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a user ')."<a href=\"add-user.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo _("List of users"); ?></h4>
				<table class="w3-table w3-striped">
					<tr class="w3-theme-d3">
						<th><?php echo _('Username'); ?></th>
						<th><?php echo _('Display name'); ?></th>
						<th><?php echo _('User since'); ?></th>
						<th><?php echo _('Last logged in'); ?></th>
						<th colspan="5"><?php echo _('Actions'); ?></th>
					</tr>
<?php
				$usq = "SELECT * FROM users ORDER BY user_name ASC";
				$usquery = mysqli_query($dbconn,$usq);

				while ($usopt = mysqli_fetch_assoc($usquery)) {
					$usrid				= $usopt['user_id'];
					$usrname				= $usopt['user_name'];
					$usrdname			= $usopt['user_display_name'];
					$usrsince			= $usopt['user_created'];
					$usrlast				= $usopt['user_last_login'];
					$usrsusp				= $usopt['user_is_suspended'];
					$usrban				= $usopt['user_is_banned'];


					// if a user is not banned and not suspended, they are shown on this list
					if ($usrban == 0) {
						if ($usrsusp == '0000-00-00 00:00:00' || $usrsusp === NULL) {
							echo "\t\t\t\t\t<tr>\n";
							echo "\t\t\t\t\t\t<td><a href=\"the-user.php?uid=".$usrid."\">".$usrname."</a></td>\n";
							echo "\t\t\t\t\t\t<td>".$usrdname."</td>\n";
							echo "\t\t\t\t\t\t<td>".$usrsince."</td>\n";
							echo "\t\t\t\t\t\t<td>".$usrlast."</td>\n";
							echo "\t\t\t\t\t\t<td><a href=\"edit-user.php?uid=".$usrid."\">"._('Edit')."</a></td>\n";
							echo "\t\t\t\t\t\t<td><a href=\"suspend-user.php?uid=".$usrid."\">"._('Suspend')."</a></td>\n";
							echo "\t\t\t\t\t\t<td><a href=\"ban-user.php?uid=".$usrid."\">"._('Ban')."</a></td>\n";
							echo "\t\t\t\t\t\t<td><a href=\"delete-user.php?uid=".$usrid."\">"._('Delete')."</a></td>\n";
							echo "\t\t\t\t\t\t<td><a href=\"passphrase-reset.php?uid=".$usrid."\">"._('Passphrase reset')."</a></td>\n";
							echo "\t\t\t\t\t<tr>\n";
						} else {
							// the user is suspended
							echo "\t\t\t\t\t<tr class=\"w3-amber w3-hover-grey\">\n";
							echo "\t\t\t\t\t\t<td><a href=\"the-user.php?uid=".$usrid."\">".$usrname."</a></td>\n";
							echo "\t\t\t\t\t\t<td>".$usrdname."</td>\n";
							echo "\t\t\t\t\t\t<td>".$usrsince."</td>\n";
							echo "\t\t\t\t\t\t<td>".$usrlast."</td>\n";
							echo "\t\t\t\t\t\t<td><a href=\"edit-user.php?uid=".$usrid."\">"._('Edit')."</a></td>\n";
							echo "\t\t\t\t\t\t<td></td>\n";
							echo "\t\t\t\t\t\t<td><a href=\"ban-user.php?uid=".$usrid."\">"._('Ban')."</a></td>\n";
							echo "\t\t\t\t\t\t<td><a href=\"delete-user.php?uid=".$usrid."\">"._('Delete')."</a></td>\n";
							echo "\t\t\t\t\t\t<td><a href=\"passphrase-reset.php?uid=".$usrid."\">"._('Passphrase reset')."</a></td>\n";
							echo "\t\t\t\t\t<tr>\n";
						}
					} else {
						// the user is banned
						echo "\t\t\t\t\t<tr class=\"w3-red w3-hover-black\">\n";
						echo "\t\t\t\t\t\t<td><a href=\"the-user.php?uid=".$usrid."\">".$usrname."</a></td>\n";
						echo "\t\t\t\t\t\t<td>".$usrdname."</td>\n";
						echo "\t\t\t\t\t\t<td>".$usrsince."</td>\n";
						echo "\t\t\t\t\t\t<td>".$usrlast."</td>\n";
						echo "\t\t\t\t\t\t<td><a href=\"edit-user.php?uid=".$usrid."\">"._('Edit')."</a></td>\n";
						echo "\t\t\t\t\t\t<td></td>\n";
						echo "\t\t\t\t\t\t<td></td>\n";
						echo "\t\t\t\t\t\t<td><a href=\"delete-user.php?uid=".$usrid."\">"._('Delete')."</a></td>\n";
						echo "\t\t\t\t\t\t<td></td>\n";
						echo "\t\t\t\t\t<tr>\n";
					}
				}
?>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
