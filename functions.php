<?php
include "conn.php";
include "config.php";

// put this here for various functions to use
$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

// creates a 10 character ID
function makeid($newid) {
	// the characters we will use
	$chars	= "0123456789abcdefghijklmnopqrstuvwxyzабвдежзийклмнопрстуфхцчшщъыьэюяàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿßABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞẞ";

	// splits $chars into an array of individual characters
	$tmp = preg_split("//u", $chars, -1, PREG_SPLIT_NO_EMPTY);

	// shuffles/randomizes the $tmp array
	shuffle($tmp);

	// turns the randomized array into a string
	$tmp2 = join("", $tmp);

	// returns the first 10 characters of the randomized string
	return mb_substr($tmp2,0,10,"UTF-8");
}

// sanitizes text inputs
function nicetext($text) {
	// get rid of whitespace characters at start or end of text
	$text = trim($text);

	// removes \ backslash escape characters
	$text = stripslashes($text);

	// converts special characters (i.e. < > &, etc) into their html entities
	$text = htmlspecialchars($text,ENT_QUOTES,'UTF-8',true);
	return $text;
}

// displays a message on a page
function header_message($message) {
	$msg = "\t<div class=\"clear\"></div>\n\n";
	$msg .= "\t<!-- div class message is for general messages & warnings -->\n";
	$msg .= "\t<div class=\"message\">".$message."</div>\n";

	return $msg;
}

// redirects to another page
function redirect($location) {
	return header("Location: $location");
}

// get the date of birth, return the age
function user_age($userage) {
    return floor((time() - strtotime($userage))/31556926);
}

// make time differences nice looking

function timediff($time) {

	// What time is love? (see The KLF)
	$now = date('Y-m-d H:i:s');
	$diff = (strtotime($time) - strtotime($now));

	// yes, I know I should do this with case. something for the future.
	// These should also be localized in the future.

	if ($diff <= 30) {
		return _("A few seconds ago");
	} else if (($diff > 30) and ($diff <= 50)) {
		return _("About half a minute ago");
	} else if (($diff > 50) and ($diff <= 99)) {
		return _("A minute ago");
	} else if (($diff > 99) and ($diff <= 160)) {
		return _("A couple of minutes ago");
	} else if (($diff > 160) and ($diff <= 350)) {
		return _("A few minutes ago");
	} else if (($diff > 350) and ($diff <= 570)) {
		return _("Several minutes ago");
	} else if (($diff > 570) and ($diff <= 780)) {
		return _("About 10 minutes ago");
	} else if (($diff > 780) and ($diff <= 1100)) {
		return _("About 15 minutes ago");
	} else if (($diff > 1100) and ($diff <= 1500)) {
		return _("About 20 minutes ago");
	} else if (($diff > 1500) and ($diff <= 3300)) {
		return _("About half an hour ago");
	} else if (($diff > 3300) and ($diff <= 6300)) {
		return _("About an hour ago");
	} else if (($diff > 6300) and ($diff <= 9900)) {
		return _("A couple of hours ago");
	} else if (($diff > 9900) and ($diff <= 14400)) {
		return _("A few hours ago");
	} else if (($diff > 14400) and ($diff <= 34200)) {
		return _("Several hours ago");
	} else if (($diff > 34200) and ($diff <= 72000)) {
		return _("About half a day ago");
	} else if (($diff > 72000) and ($diff <= 86400)) {
		return _("Almost a day ago");
	} else if (($diff > 86400) and ($diff <= 17200)) {
		return _("Yesterday");
	} else if (($diff > 17200) and ($diff <= 249200)) {
		return _("A couple of days ago");
	} else if (($diff > 249200) and ($diff <= 345600)) {
		return _("A few days ago");
	} else if (($diff > 345600) and ($diff <= 604800)) {
		return _("Several days ago");
	} else if (($diff > 604800) and ($diff <= 1209600)) {
		return _("Last week");
	} else if (($diff > 1209600) and ($diff <= 2592000)) {
		return _("A few weeks ago");
	} else if (($diff > 2592000) and ($diff <= 5184000)) {
		return _("Last month");
	} else if (($diff > 5184000) and ($diff <= 14688000)) {
		return _("A few months ago");
	} else if (($diff > 14688000) and ($diff <= 29808000)) {
		return _("About half a year ago");
	} else if (($diff > 29808000) and ($diff <= 33696000)) {
		return _("Around a year ago");
	} else if (($diff > 33696000) and ($diff <= 62208000)) {
		return _("More than a year ago");
	} else if (($diff > 62208000) and ($diff <= 93312000)) {
		return _("More than two years ago");
	} else if ($diff > 93312000) {
		return _("More than three years ago");
	}

}

// get the number of users
function user_quantity($users) {
	$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$userqq = "SELECT * FROM usr";
	$userqquery = mysqli_query($dbconn,$userqq);
	$userqty = mysqli_num_rows($userqquery);

	return $userqty;
}

// get the number of posts
function post_quantity($posts) {
	$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$postqq = "SELECT * FROM pst";
	$postqquery = mysqli_query($dbconn,$postqq);
	$postqty = mysqli_num_rows($postqquery);

	return $postqty;
}
?>
