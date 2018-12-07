<?php
include_once	"../conn.php";
include_once	"../config.php";
include			"../functions.php";

if (isset($_GET["spid"])) {
	$sel_id = $_GET["spid"];
} else {
	$sel_id = "";
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

if ($sel_id != '') {

	$spkq = "SELECT * FROM spk WHERE spk_id=\"".$sel_id."\"";
	$spkquery = mysqli_query($dbconn,$spkq);
	while($spkopt = mysqli_fetch_assoc($spkquery)) {
		$spkid		= $spkopt['spk_id'];
		$spkname		= $spkopt['spk_name'];
	}
}

$pagetitle = $spkname;
include_once 'main-header.php';
?>
	<article>
		<h4><?php echo _($spkname); ?></h4>
		<!-- in the future, this might be a list of people who speak this language -->
	</article>
<?php
include_once "main-footer.php";
?>
