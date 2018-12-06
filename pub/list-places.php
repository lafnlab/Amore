<?php
include_once	"../conn.php";
include			"../functions.php";

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

$pagetitle = "List of places";


include_once "main-header.php";
?>

<!-- get lists of places based on their continent/region of the globe -->
		<article>
			<h4><?php echo _("Africa"); ?></h4>
<?php
		$afriq = "SELECT * FROM loc WHERE loc_parent LIKE \"%0000000001%\" ORDER BY loc_name ASC";
		$afriquery = mysqli_query($dbconn, $afriq);
		#echo $afriq;


		while($afriopt = mysqli_fetch_assoc($afriquery)) {
			$afri_name	= $afriopt['loc_name'];
			$afri_id		= $afriopt['loc_id'];
			echo "\t\t\t<a href=\"the-place.php?plid=".$afri_id."\">".$afri_name."</a><br>\n";
		}
?>
		</article>

<!-- 		<article> -->
<!--			<h4><?php echo _("Antarctica"); ?></h4> -->
<?php
		$antaq = "SELECT * FROM loc WHERE loc_parent LIKE \"%0000000002%\" ORDER BY loc_name ASC";
		$antaquery = mysqli_query($dbconn, $antaq);
		#echo $antaq;


		while($antaopt = mysqli_fetch_assoc($antaquery)) {
			$anta_name	= $antaopt['loc_name'];
			$anta_id		= $antaopt['loc_id'];
#			echo "\t\t\t<a href=\"the-place.php?plid=".$anta_id."\">".$anta_name."</a><br>\n";
		}
?>
<!--		</article> -->

		<article>
			<h4><?php echo _("Asia"); ?></h4>
<?php
		$asiaq = "SELECT * FROM loc WHERE loc_parent LIKE \"%0000000003%\" ORDER BY loc_name ASC";
		$asiaquery = mysqli_query($dbconn, $asiaq);
		#echo $asiaq;


		while($asiaopt = mysqli_fetch_assoc($asiaquery)) {
			$asia_name	= $asiaopt['loc_name'];
			$asia_id		= $asiaopt['loc_id'];
			echo "\t\t\t<a href=\"the-place.php?plid=".$asia_id."\">".$asia_name."</a><br>\n";
		}
?>
		</article>

		<article>
			<h4><?php echo _("Caribbean"); ?></h4>
<?php
		$caribq = "SELECT * FROM loc WHERE loc_parent LIKE \"%0000000004%\" ORDER BY loc_name ASC";
		$caribquery = mysqli_query($dbconn, $caribq);
		#echo $caribq;


		while($caribopt = mysqli_fetch_assoc($caribquery)) {
			$carib_name	= $caribopt['loc_name'];
			$carib_id	= $caribopt['loc_id'];
			echo "\t\t\t<a href=\"the-place.php?plid=".$carib_id."\">".$carib_name."</a><br>\n";
		}
?>
		</article>

		<article>
			<h4><?php echo _("Europe"); ?></h4>
<?php
		$euroq = "SELECT * FROM loc WHERE loc_parent LIKE \"%0000000005%\" ORDER BY loc_name ASC";
		$euroquery = mysqli_query($dbconn, $euroq);
		#echo $euroq;


		while($euroopt = mysqli_fetch_assoc($euroquery)) {
			$euro_name	= $euroopt['loc_name'];
			$euro_id		= $euroopt['loc_id'];
			echo "\t\t\t<a href=\"the-place.php?plid=".$euro_id."\">".$euro_name."</a><br>\n";
		}
?>
		</article>

		<article>
			<h4><?php echo _("North America"); ?></h4>
<?php
		$northq = "SELECT * FROM loc WHERE loc_parent LIKE \"%0000000006%\" ORDER BY loc_name ASC";
		$northquery = mysqli_query($dbconn, $northq);
		#echo $northq;


		while($northopt = mysqli_fetch_assoc($northquery)) {
			$north_name	= $northopt['loc_name'];
			$north_id		= $northopt['loc_id'];
			echo "\t\t\t<a href=\"the-place.php?plid=".$north_id."\">".$north_name."</a><br>\n";
		}
?>
		</article>

		<article>
			<h4><?php echo _("Oceania"); ?></h4>
<?php
		$oceanq = "SELECT * FROM loc WHERE loc_parent LIKE \"%0000000007%\" ORDER BY loc_name ASC";
		$oceanquery = mysqli_query($dbconn, $oceanq);
		#echo $oceanq;


		while($oceanopt = mysqli_fetch_assoc($oceanquery)) {
			$ocean_name	= $oceanopt['loc_name'];
			$ocean_id	= $oceanopt['loc_id'];
			echo "\t\t\t<a href=\"the-place.php?plid=".$ocean_id."\">".$ocean_name."</a><br>\n";
		}
?>
		</article>

		<article>
			<h4><?php echo _("South America"); ?></h4>
<?php
		$southq = "SELECT * FROM loc WHERE loc_parent LIKE \"%0000000008%\" ORDER BY loc_name ASC";
		$southquery = mysqli_query($dbconn, $southq);
		#echo $southq;


		while($southopt = mysqli_fetch_assoc($southquery)) {
			$south_name	= $southopt['loc_name'];
			$south_id		= $southopt['loc_id'];
			echo "\t\t\t<a href=\"the-place.php?plid=".$south_id."\">".$south_name."</a><br>\n";
		}
?>
		</article>

<?php
include_once "main-footer.php";
?>
