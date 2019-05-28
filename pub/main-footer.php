<?php
/*
 * pub/main-footer.php
 *
 * This footer ends the HTML for each public facing webpage in Amore.
 *
 * since Amore version 0.1
 *
 */
?>
		</div> <!-- end The Grid -->
	</main> <!-- end The Container -->
	<footer class="w3-container w3-large w3-theme-d1">
		<span><a href="<?php echo $website_url; ?>/atom.xml">Atom</a> | <a href="<?php echo $website_url; ?>/rss2.xml">RSS</a> | <a href="<?php echo $website_url; ?>/the-statistics.php"><?php echo _("Site Statistics"); ?></a> | <?php echo _("Powered by "); ?><a href="https://github.com/lafnlab/Amore"><?php echo VERSION; ?></a></span>
	</footer>
</body>
</html>
