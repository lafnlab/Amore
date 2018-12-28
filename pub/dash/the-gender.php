<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

if (isset($_GET["gid"])) {
	$sel_id = $_GET["gid"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

if ($sel_id != '') {

	$genq = "SELECT * FROM gen WHERE gen_id=\"".$sel_id."\"";
	$genquery = mysqli_query($dbconn,$genq);
	while($genopt = mysqli_fetch_assoc($genquery)) {
		$genid		= $genopt['gen_id'];
		$genname		= $genopt['gen_name'];
	}
}

$pagetitle = $genname;
include_once 'main-header.php';
?>
	<article>
		<h4><?php echo _($genname); ?></h4>
		<!-- in the future, this might be a list of people with this gender -->
	</article>
<?php
include_once "main-footer.php";
?>
