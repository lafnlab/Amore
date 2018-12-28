<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

if (isset($_GET["hid"])) {
	$sel_id = $_GET["hid"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

if ($sel_id != '') {

	$harq = "SELECT * FROM har WHERE har_id=\"".$sel_id."\"";
	$harquery = mysqli_query($dbconn,$harq);
	while($haropt = mysqli_fetch_assoc($harquery)) {
		$harid		= $haropt['har_id'];
		$harcolor	= $haropt['har_color'];
	}
}

$pagetitle = $harcolor;
include_once 'main-header.php';
?>
	<article>
		<h4><?php echo _($harcolor); ?></h4>
		<!-- in the future, this might be a list of people with this hair color -->
	</article>
<?php
include_once "main-footer.php";
?>
