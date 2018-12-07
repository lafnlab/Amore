<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

if (isset($_GET["eid"])) {
	$sel_id = $_GET["eid"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

if ($sel_id != '') {

	$eyeq = "SELECT * FROM eye WHERE eye_id=\"".$sel_id."\"";
	$eyequery = mysqli_query($dbconn,$eyeq);
	while($eyeopt = mysqli_fetch_assoc($eyequery)) {
		$eyeid		= $eyeopt['eye_id'];
		$eyecolor	= $eyeopt['eye_color'];
	}
}

$pagetitle = $eyecolor;
include_once 'main-header.php';
?>
	<article>
		<h4><?php echo _($eyecolor); ?></h4>
		<!-- in the future, this might be a list of people with this eye color -->
	</article>
<?php
include_once "main-footer.php";
?>
