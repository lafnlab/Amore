<?php
/*
 * pub/dash/admin/final.php
 *
 * This page is for final installation instructions.
 *
 * since Amore version 0.3
 *
 */

$pagetitle = _("Final installation instructions");
include_once "admin-header.php";
?>

	<!-- THE CONTAINER for the main content -->
	<main class="w3-container w3-content" style="max-width:1400px;margin-top:40px;">

	<!-- THE GRID -->
		<div class="w3-cell-row w3-container">
			<div class="w3-col w3-cell m3 l4">

			</div>
			<div class="w3-col w3-panel w3-cell m6 l4">
				<h3><?php echo _("We're done!"); ?></h3>
				<p><?php echo _("Move <code>conn.php</code> from the <code>pub/</code> directory to the <code>amore/</code> directory."); ?></p>
				<p><a href="../../the-login.php"><?php echo _("Go to login page"); ?></a></p>
			</div>
			<div class="w3-col w3-cell m3 l4">&nbsp;</div> <!-- empty div for the purpose of positioning -->
		</div> <!-- end THE GRID -->
<?php
include_once "admin-footer.php";
?>
