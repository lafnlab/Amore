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
// define current date and time
$nowa = date('c',strtotime("now")); // for Atom
$nowb = date('r',strtotime("now")); // for RSS2 lastBuildDate
$nowp = date('r',strtotime("today")); // for RSS2 pubDate

/*
 *
 * NODEINFO CREATION
 */

	$nodeinfometa = fopen(".well-known/nodeinfo", "w") or die("Unable to open or create nodeinfo file");

	$json0 = "{\"links\":[{\"rel\":\"http://nodeinfo.diaspora.software/ns/schema/1.0\",\"href\":\"".$website_url."/nodeinfo/1.0\"},{\"rel\":\"http://nodeinfo.diaspora.software/ns/schema/2.0\",\"href\":\"".$website_url."/nodeinfo/2.0\"}]}";

	// let's try to write to it.
	fwrite($nodeinfometa,$json0);
	fclose($nodeinfometa);

// create or update the nodeinfo/1.0 file
	$nodeinfo1 = fopen("nodeinfo/1.0.jsonld", "w") or die("Unable to open or create nodeinfo 1.0 file");

	$json1 = "{\"version\":\"1.0\",\"software\":{\"name\":\"amore\",\"version\":\"v0.3-alpha\"},\"protocols\":{\"inbound\":[],\"outbound\":[]},\"services\":{\"inbound\":[],\"outbound\":[atom1.0]},\"openRegistrations\":".$open.",\"usage\":{\"users\":{\"total\":".user_quantity($users).",\"activeHalfyear\":".users_half_year($sometimes_users).",\"activeMonth\":".users_past_month($active_users)."},\"localPosts\":".post_quantity($posts).",\"localComments\":},\"metadata\":{\"nodeName\":\"".$website_name."\"}}";

	fwrite($nodeinfo1,$json1);
	fclose($nodeinfo1);

// create or update nodeinfo/2.0 file
	$nodeinfo2 = fopen("nodeinfo/2.0.jsonld", "w") or die("Unable to open or create nodeinfo 2.0 file");

	$json2 = "{\"version\":\"2.0\",\"software\":{\"name\":\"amore\",\"version\":\"v0.3-alpha\"},\"protocols\":{\"inbound\":[],\"outbound\":[]},\"services\":{\"inbound\":[],\"outbound\":[atom1.0]},\"openRegistrations\":".$open.",\"usage\":{\"users\":{\"total\":".user_quantity($users).",\"activeHalfyear\":".users_half_year($sometimes_users).",\"activeMonth\":".users_past_month($active_users)."},\"localPosts\":".post_quantity($posts).",\"localComments\":},\"metadata\":{\"nodeName\":\"".$website_name."\"}}";

	fwrite($nodeinfo2,$json2);
	fclose($nodeinfo2);

/*
 *
 * ATOM FEED
 */
	$atommeta = fopen("atom.xml", "w") or die("Unable to open or create atom.xml file");
	$atomstart = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<feed xmlns=\"http://www.w3.org/2005/Atom\">\n\n\t<title>".$website_name."</title>\n\t<link rel=\"self\" href=\"".$website_url."/atom.xml\"/>\n\t<updated>".$nowa."</updated>\n\t<id>".$website_url."/</id>\n\n";
	fwrite($atommeta,$atomstart);

	// if we have posts, display the most recent 25.
	if (post_quantity($posts) > 0) {
		$pst_q = "SELECT * FROM posts WHERE posts_privacy_level=\"6ьötХ5áзÚZ\" ORDER BY posts_timestamp DESC LIMIT 25";
		$pst_query = mysqli_query($dbconn,$pst_q);
		while ($pst_opt = mysqli_fetch_assoc($pst_query)) {
			$postid		= $pst_opt['posts_id'];
			$postby		= $pst_opt['posts_by'];
			$posttime	= date('c',strtotime($pst_opt['posts_timestamp']));
			$posttext	= $pst_opt['posts_text'];
			$postlang	= $pst_opt['posts_language'];
			$postpriv	= $pst_opt['posts_privacy_level'];

			$by_q = "SELECT * FROM users WHERE user_id=\"".$postby."\"";
			$by_query = mysqli_query($dbconn,$by_q);
			while($by_opt = mysqli_fetch_assoc($by_query)) {
				$byname		= $by_opt['user_name'];
			}
			$atompost = "\n\t<entry>\n\t\t<title type=\"html\">".$posttext."</title>\n\t\t<link href=\"".$website_url."/post/".urlencode($postid)."\" />\n\t\t<id>".$website_url."/post/".urlencode($postid)."</id>\n\t\t<updated>".$posttime."</updated>\n\t\t<author>\n\t\t\t<name>".$byname."</name>\n\t\t</author>\n\t\t<content type=\"html\">".$posttext."</content>\n\t</entry>";
			fwrite($atommeta,$atompost);

		} // end while $pst_opt...
	} // end if post_quantity($posts)...


	$atomend = "</feed>";
	fwrite($atommeta,$atomend);
	fclose($atommeta);


/*
 *
 * RSS 2.0 FEED
 */

	$rss2meta = fopen("rss2.xml", "w") or die("Unable to open or create rss2.xml file");
	$rss2start = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<rss version=\"2.0\">\n<channel>\n\t<title>".$website_name."</title>\n\t<description>"._('The primary RSS feed of')." ".$website_name."</description>\n\t<link>".$website_url."/</link><pubDate>".$nowp."</pubDate>\n\t<lastBuildDate>".$nowb."</lastBuildDate>\n\n";
	fwrite ($rss2meta,$rss2start);

	// if we have posts, display the most recent 25.
	if (post_quantity($posts) > 0) {
		$rsspst_q = "SELECT * FROM posts WHERE posts_privacy_level=\"6ьötХ5áзÚZ\" ORDER BY posts_timestamp DESC LIMIT 25";
		$rsspst_query = mysqli_query($dbconn,$rsspst_q);
		while ($rsspst_opt = mysqli_fetch_assoc($rsspst_query)) {
			$rsspostid		= $rsspst_opt['posts_id'];
			$rsspostby		= $rsspst_opt['posts_by'];
			$rssposttime	= date('r',strtotime($rsspst_opt['posts_timestamp']));
			$rssposttext	= $rsspst_opt['posts_text'];
			$rsspostlang	= $rsspst_opt['posts_language'];
			$rsspostpriv	= $rsspst_opt['posts_privacy_level'];

			$rssby_q = "SELECT * FROM users WHERE user_id=\"".$rsspostby."\"";
			$rssby_query = mysqli_query($dbconn,$rssby_q);
			while($rssby_opt = mysqli_fetch_assoc($rssby_query)) {
				$rssbyname		= $rssby_opt['user_name'];
			}
			$rss2post = "\n\t<item>\n\t\t<title>".$rssposttext."</title>\n\t\t<link>".$website_url."/post/".$rsspostid."\"</link>\n\t\t<pubDate>".$rssposttime."</pubDate>\n\t\t<author>@".$rssbyname."@".short_url($website_url)."</author>\n\t\t<description>".$rssposttext."</description>\n\t</item>";
			fwrite($rss2meta,$rss2post);

		} // end while $rsspst_opt...
	} // end if post_quantity($posts)...


	$rss2end = "\n</channel>\n</rss>";
	fwrite($rss2meta,$rss2end);
	fclose($rss2meta);

?>
