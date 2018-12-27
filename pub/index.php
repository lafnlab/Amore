<?php
include_once "../conn.php";
include_once "../config.php";
include "../functions.php";

if (isset($_SESSION['uname'])) {
	$visitortitle = $_SESSION['uname'];
}

if ($open_registration == FALSE) {
	$open = "false";
} else {
	$open = "true";
}


$pagetitle = "🖤";
$objdescription = $metadescription;

include_once "main-header.php";
?>

<?php
// trigger nodeinfo creation
	$nodeinfometa = fopen(".well-known/nodeinfo", "w") or die("Unable to open or create nodeinfo file");

	$json0 = "{\"links\":[{\"rel\":\"http://nodeinfo.diaspora.software/ns/schema/1.0\",\"href\":\"".$siteurl."/nodeinfo/1.0\"},{\"rel\":\"http://nodeinfo.diaspora.software/ns/schema/2.0\",\"href\":\"".$siteurl."/nodeinfo/2.0\"}]}";

	// let's try to write to it.
	fwrite($nodeinfometa,$json0);
	fclose($nodeinfometa);

// create or update the nodeinfo/1.0 file
	$nodeinfo1 = fopen("nodeinfo/1.0", "w") or die("Unable to open or create nodeinfo 1.0 file");

	$json1 = "{\"version\":\"1.0\",\"software\":{\"name\":\"amore\",\"version\":\"v0.1\"},\"protocols\":{\"inbound\":[],\"outbound\":[]},\"services\":{\"inbound\":[],\"outbound\":[]},\"openRegistrations\":".$open.",\"usage\":{\"users\":{\"total\":".user_quantity($users).",\"activeHalfyear\":,\"activeMonth\":},\"localPosts\":".post_quantity($posts).",\"localComments\":},\"metadata\":{\"nodeName\":\"".$sitetitle."\"}}";

	fwrite($nodeinfo1,$json1);
	fclose($nodeinfo1);

// create or update nodeinfo/2.0 file
	$nodeinfo2 = fopen("nodeinfo/2.0", "w") or die("Unable to open or create nodeinfo 2.0 file");

	$json2 = "{\"version\":\"2.0\",\"software\":{\"name\":\"amore\",\"version\":\"v0.1\"},\"protocols\":{\"inbound\":[],\"outbound\":[]},\"services\":{\"inbound\":[],\"outbound\":[]},\"openRegistrations\":".$open.",\"usage\":{\"users\":{\"total\":".user_quantity($users).",\"activeHalfyear\":,\"activeMonth\":},\"localPosts\":".post_quantity($posts).",\"localComments\":},\"metadata\":{\"nodeName\":\"".$sitetitle."\"}}";

	fwrite($nodeinfo2,$json2);
	fclose($nodeinfo2);

// if registration of closed display a login panel
if ($open_registration == FALSE) {
	echo "\t\t<article>\n";
	echo "\t\t\t<div id=\"mainpagelogin\">\n";
	echo "\t\t\t\t<form method=\"post\" action=\"".htmlspecialchars("the-login.php")."\">\n";
	echo "\t\t\t\t<h2>"._("Login to ").$sitetitle."</h2>\n";
	echo "\t\t\t\t\t<p>\n";
	echo "\t\t\t\t\t\t<label for=\"loginuser\">"._('Username')."</label>\n";
	echo "\t\t\t\t\t\t<input type=\"text\" name=\"loginuser\" id=\"loginuser\" class=\"smallinputtext\" required maxlength=\"50\">\n";
	echo "\t\t\t\t\t</p>\n";
	echo "\t\t\t\t\t<p>\n";
	echo "\t\t\t\t\t\t<label for=\"loginpass\">"._('Passphrase')."</label>\n";
	echo "\t\t\t\t\t\t<input type=\"password\" name=\"loginpass\" id=\"loginpass\" class=\"smallinputtext\" required>\n";
	echo "\t\t\t\t\t</p>\n";
	echo "\t\t\t\t\t<input type=\"submit\" name=\"loginsubmit\" id=\"loginsubmit\" class=\"button\" value=\""._('Login')."\">\n";
	echo "\t\t\t\t</form>\n";
	echo "\t\t\t</div>\n";
	echo "\t\t</article>\n";
} else {
// if registration is open, display a registration/login panel
	echo "\t\t<article>\n";
	echo "\t\t\t<div id=\"mainpagelogin\">\n";
	echo "\t\t\t\t<form method=\"post\" action=\"".htmlspecialchars("the-registration.php")."\">\n";
	echo "\t\t\t\t<h2>"._("Registration for ").$sitetitle."</h2>\n";
	echo "\t\t\t\t\t<p>\n";
	echo "\t\t\t\t\t\t<label for=\"acctuser\">"._('Username')."</label>\n";
	echo "\t\t\t\t\t\t<input type=\"text\" name=\"acctuser\" id=\"acctuser\" class=\"smallinputtext\" required maxlength=\"50\">\n";
	echo "\t\t\t\t\t</p>\n";
	echo "\t\t\t\t\t<p>\n";
	echo "\t\t\t\t\t\t<label for=\"acctpass1\">"._('Passphrase')."</label>\n";
	echo "\t\t\t\t\t\t<input type=\"password\" name=\"acctpass1\" id=\"acctpass1\" class=\"smallinputtext\" required>\n";
	echo "\t\t\t\t\t</p>\n";
	echo "\t\t\t\t\t<p>\n";
	echo "\t\t\t\t\t\t<label for=\"acctpass2\">"._('Verify passphrase')."</label>\n";
	echo "\t\t\t\t\t\t<input type=\"password\" name=\"acctpass2\" id=\"acctpass2\" class=\"smallinputtext\" required>\n";
	echo "\t\t\t\t\t</p>\n";
	echo "\t\t\t\t\t<p>\n";
	echo "\t\t\t\t\t\t<label for=\"acctdob\">"._('Date of birth')."</label>\n";
	echo "\t\t\t\t\t\t<input type=\"date\" name=\"acctdob\" id=\"acctdob\" class=\"smallinputtext\" required min=\"1900-01-01\">\n";
	echo "\t\t\t\t\t</p>\n";
	echo "\t\t\t\t\t<input type=\"submit\" name=\"acctsubmit\" id=\"acctsubmit\" class=\"button\" value=\""._('Register')."\">\n";
	echo "\t\t\t\t</form>\n";
	echo "\t\t\t\t<hr>\n";
	echo "\t\t\t\t<p>\n";
	echo "\t\t\t\t\t"._('Already a user?')."\n";
	echo "\t\t\t\t\t<a href=\"the-login.php\">"._('Login')."</a>\n";
	echo "\t\t\t\t</p>\n";
	echo "\t\t\t</div>\n";
	echo "\t\t</article>\n";
}

	echo "Number of users = ".user_quantity($user)."<br>\n";
	echo "Number of posts = ".post_quantity($post)."<br>\n";
?>
<?php
include_once "main-footer.php";
?>
