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
          # of accounts by gender
          # of accounts by sexuality
          # of accounts by location
          # of accounts by nationality
          # of accounts by spoken language
          # of accounts by relationship status
          # of accounts by eye color
          # of accounts by hair color
          # of accounts by time zone
          # of accounts by user level
          # of accounts by actor type
        </div>
      </div>
    </div> <!-- end w3-row -->
<?php
include_once "main-footer.php";
?>
