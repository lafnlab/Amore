<?php
include "conn.php";

// Creates a 10 character ID, because autoincremented primary keys are so banal
function makeid($newid) {
	// The characters we will use. Feel free to add your own.
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

// Sanitizes text inputs
function nicetext($text) {
	// get rid of whitespace characters at start or end of text
	$text = trim($text);

	// removes \ backslash escape characters
	$text = stripslashes($text);

	// converts special characters (i.e. < > &, etc) into their html entities
	$text = htmlspecialchars($text,ENT_HTML5,'UTF-8',true);
	return $text;
}

// Displays a message on a page
function header_message($message) {
	$msg = "\t<div class=\"clear\"></div>\n\n";
	$msg .= "\t<!-- div class message is for general messages & warnings -->\n";
	$msg .= "\t<div class=\"message\">".$message."</div>\n";

	return $msg;
}

// Short page redirect function
function redirect($location) {
	return header("Location: $location");
}

function user_age($userage) {
    // get the date of birth, return the age
    return floor((time() - strtotime($userage))/31556926);
}
?>
