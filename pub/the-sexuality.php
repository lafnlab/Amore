<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

if (isset($_GET["sid"])) {
	$sel_id = $_GET["sid"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

if ($sel_id != '') {

	$sexq = "SELECT * FROM sxu WHERE sxu_id=\"".$sel_id."\"";
	$sexquery = mysqli_query($dbconn,$sexq);
	while($sexopt = mysqli_fetch_assoc($sexquery)) {
		$sexid		= $sexopt['sxu_id'];
		$sexname		= $sexopt['sxu_name'];
	}
}

$pagetitle = $sexname;
include_once 'main-header.php';
?>
	<article>
		<h4><?php echo _($sexname); ?></h4>
		<!-- in the future, this might be a list of people with this sexuality -->
	</article>
<?php
include_once "main-footer.php";
?>
