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


include_once "admin-header.php";
include_once "admin-nav.php";
?>
		<article class="w3-col w3-panel w3-cell m9">
			<div class="w3-card-2 w3-theme-d3 w3-padding w3-margin-bottom">
				<span><?php echo _('Add a user ')."<a href=\"add-user.php\">"._('here').".</a>";?></span>
			</div>
			<div class="w3-card-2 w3-theme-l3 w3-padding">
			<h4><?php echo _("List of users"); ?></h4>
				<table>
<?php
				$usq = "SELECT * FROM users ORDER BY user_name ASC";
				$usquery = mysqli_query($dbconn,$usq);

				while ($usopt = mysqli_fetch_assoc($usquery)) {
					$usrid				= $usopt['user_id'];
					$usrname				= $usopt['user_name'];
					$usrdname			= $usopt['user_display_name'];
					$usrlevel			= $usopt['user_level'];
					$usrtype				= $usopt['user_actor_type'];
					$usrsince			= $usopt['user_created'];
					$usrlast				= $usopt['user_last_login'];

					// get the user_level_name
					$levelq = "SELECT * FROM user_levels WHERE user_level_id=".$usrlevel;
					$levelquery = mysqli_query($dbconn,$levelq);
					while ($levelopt = mysqli_fetch_assoc($levelquery)) {
						$level	= $levelopt['user_level_name'];
					}

					// get the actor_type_name
					$actorq = "SELECT * FROM actor_types WHERE actor_type_id=".$usertype;
					$actorquery = mysqli_query($dbconn,$actorq);
					while ($actoropt = mysqli_fetch_assoc($actorquery)) {
						$actor	= $actoropt['actor_type_name'];
					}

					echo "\t\t\t\t\t<tr>\n";
					echo "\t\t\t\t\t\t<td><a href=\"the-user.php?uid=".$usrid."\">".$usrname."</a></td>\n";
					echo "\t\t\t\t\t\t<td>".$usrdname."</td>\n";
					echo "\t\t\t\t\t\t<td>".$level."</td>\n";
					echo "\t\t\t\t\t\t<td>".$actor."</td>\n";
					echo "\t\t\t\t\t\t<td>".$usrsince."</td>\n";
					echo "\t\t\t\t\t\t<td>".$usrlast."</td>\n";
					echo "\t\t\t\t\t\t<td><a href=\"edit-user.php?uid=".$usrid."\">"._('Edit')."</a></td>\n";
					echo "\t\t\t\t\t\t<td><a href=\"suspend-user.php?uid=".$usrid."\">"._('Suspend')."</a></td>\n";
					echo "\t\t\t\t\t\t<td><a href=\"ban-user.php?uid=".$usrid."\">"._('Ban')."</a></td>\n";
					echo "\t\t\t\t\t\t<td><a href=\"delete-user.php?uid=".$usrid."\">"._('Delete')."</a></td>\n";
					echo "\t\t\t\t\t</tr>\n";
				}
?>
				</table>
			</div>
		</article>
<?php
include_once "admin-footer.php";
?>
