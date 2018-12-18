<?php
include_once "../conn.php";
include_once "../config.php";

if (isset($_SESSION['uname'])) {
	$visitortitle = $_SESSION['uname'];
}

$pagetitle = "🖤";
$objdescription = $metadescription;

include_once "main-header.php";
?>

<?php

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
?>
<?php
include_once "main-footer.php";
?>
