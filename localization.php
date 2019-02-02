<?php
/*
 * localization.php
 *
 * This file makes it convenient to localize each page.
 *
 * since Amore version 0.2
 *
 */

include "conn.php";

if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
} else {
	unset($sel_id);
}

// put this here for various functions to use
$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

/* if a user id is set															*/
if (isset($sel_id)) {


	$usrq = "SELECT * FROM users WHERE user_id=\"".$sel_id."\"";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usropt = mysqli_fetch_assoc($usrquery)) {
		$usrid		= $usropt['user_id'];
		$usrname		= $usropt['user_name'];
	}

	// get the user's preferred locale and have Amore use that localization
	$usrpq = "SELECT * FROM user_profiles WHERE user_profiles_id=\"".$sel_id."\"";
	$usrpquery = mysqli_query($dbconn,$usrpq);
	while($usrpopt = mysqli_fetch_assoc($usrpquery)) {

		// get the user's locale from the user_profiles table
		$usrploc = $usrpopt['user_profiles_locale'];

		// since that only returns the locale ID, we need to get the language and country from the locales table
		$usrlocq = "SELECT * FROM locales WHERE locales_id=\"".$usrploc."\"";
		$usrlocquery = mysqli_query($dbconn,$usrlocq);
		while($usrlocopt = mysqli_fetch_assoc($usrlocquery)) {
			$uloclang = $usrlocopt['locales_language'];
			$ulocctry = $usrlocopt['locales_country'];

			// if the country exists in this locale, separate it from the language with and underscore
			if ($ulocctry != '') {
				$user_locale = $uloclang."_".$ulocctry;
			} else {

				// otherwise just use the language code
				$user_locale = $uloclang;
			} // end if $ulocctry != ''

		} // end while $usrlocopt

	} // end while $usrpopt

}

 	// have Amore use the right localization
	putenv("LC_MESSAGES=".$user_locale);
	setlocale(LC_MESSAGES, $user_locale);

	// set the textdomain
	$textdomain = "amore";
	bindtextdomain($textdomain, "../locale");
	bind_textdomain_codeset($textdomain, 'UTF-8');
	textdomain($textdomain);
?>
