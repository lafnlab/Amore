<?php
include_once	"../conn.php";
include			"../functions.php";

if (isset($_GET["nid"])) {
	$sel_id = $_GET["nid"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

if ($sel_id != '') {

	$natq = "SELECT * FROM nat WHERE nat_id=\"".$sel_id."\"";
	$natquery = mysqli_query($dbconn,$natq);
	while($natopt = mysqli_fetch_assoc($natquery)) {
		$natid		= $natopt['nat_id'];
		$natname		= $natopt['nat_name'];
	}
}

$pagetitle = $natname;
include_once 'main-header.php';
?>
	<article>
		<h4><?php echo _($natname); ?></h4>
		<!-- in the future, this might be a list of people with this nationality -->
	</article>
<?php
include_once "main-footer.php";
?>
