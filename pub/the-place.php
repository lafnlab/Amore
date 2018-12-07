<?php
include_once	"../conn.php";
include			"../functions.php";

if (isset($_GET["plid"])) {
	$sel_id = $_GET["plid"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

if ($sel_id != '') {

	$plaq = "SELECT * FROM loc WHERE loc_id=\"".$sel_id."\"";
	$plaquery = mysqli_query($dbconn,$plaq);
	while($plaopt = mysqli_fetch_assoc($plaquery)) {
		$plaid		= $plaopt['loc_id'];
		$planame		= $plaopt['loc_name'];
		$plaparent 	= $plaopt['loc_parent'];
		$parents		= mb_split(',', $plaparent);
	}
}

$pagetitle = $planame;
include_once 'main-header.php';
?>
	<article>
		<h4><?php echo _($planame); ?></h4>
		<!-- display the parent(s) -->
<?php
		echo "\t\t"._($planame)." "._('is part of');

		foreach($parents as $parent) {
			$pareq = "SELECT * FROM loc WHERE loc_id=\"".$parent."\"";
			$parequery = mysqli_query($dbconn,$pareq);
			while($pareopt = mysqli_fetch_assoc($parequery)) {
				$parename	= $pareopt['loc_name'];
				$pareid		= $pareopt['loc_id'];
				echo " <a href=\"the-place.php?plid=".$pareid."\">".$parename."</a>";
			}
		}
?>
		<!-- display the children, if any -->
	</article>
<?php
include_once "main-footer.php";
?>
