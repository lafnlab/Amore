<?php
/*
 * pub/the-feeds.php
 *
 * Starts/creates files for Nodeinfo, Atom, and RSS.
 *
 * since Amore version 0.3-alpha
 *
 */
?>
<?php
/*
 * NODEINFO CREATION
 */

	$nodeinfometa = fopen(".well-known/nodeinfo", "w") or die("Unable to open or create nodeinfo file");

	$json0 = "{\"links\":[{\"rel\":\"http://nodeinfo.diaspora.software/ns/schema/1.0\",\"href\":\"".$website_url."/nodeinfo/1.0\"},{\"rel\":\"http://nodeinfo.diaspora.software/ns/schema/2.0\",\"href\":\"".$website_url."/nodeinfo/2.0\"}]}";

	// let's try to write to it.
	fwrite($nodeinfometa,$json0);
	fclose($nodeinfometa);

// create or update the nodeinfo/1.0 file
	$nodeinfo1 = fopen("nodeinfo/1.0.jsonld", "w") or die("Unable to open or create nodeinfo 1.0 file");

	$json1 = "{\"version\":\"1.0\",\"software\":{\"name\":\"amore\",\"version\":\"v0.3-alpha\"},\"protocols\":{\"inbound\":[],\"outbound\":[]},\"services\":{\"inbound\":[],\"outbound\":[]},\"openRegistrations\":".$open.",\"usage\":{\"users\":{\"total\":".user_quantity($users).",\"activeHalfyear\":".users_half_year($sometimes_users).",\"activeMonth\":".users_past_month($active_users)."},\"localPosts\":".post_quantity($posts).",\"localComments\":},\"metadata\":{\"nodeName\":\"".$website_name."\"}}";

	fwrite($nodeinfo1,$json1);
	fclose($nodeinfo1);

// create or update nodeinfo/2.0 file
	$nodeinfo2 = fopen("nodeinfo/2.0.jsonld", "w") or die("Unable to open or create nodeinfo 2.0 file");

	$json2 = "{\"version\":\"2.0\",\"software\":{\"name\":\"amore\",\"version\":\"v0.3-alpha\"},\"protocols\":{\"inbound\":[],\"outbound\":[]},\"services\":{\"inbound\":[],\"outbound\":[]},\"openRegistrations\":".$open.",\"usage\":{\"users\":{\"total\":".user_quantity($users).",\"activeHalfyear\":".users_half_year($sometimes_users).",\"activeMonth\":".users_past_month($active_users)."},\"localPosts\":".post_quantity($posts).",\"localComments\":},\"metadata\":{\"nodeName\":\"".$website_name."\"}}";

	fwrite($nodeinfo2,$json2);
	fclose($nodeinfo2);

?>
