<?php
include_once "../conn.php";
include_once "../config.php";
include "../functions.php";

if (isset($_GET["uid"])) {
	$sel_id = $_GET["uid"];
} else {
	unset($sel_id);
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($dbconn, "utf8");

/* if a user id is set															*/
if (isset($sel_id)) {


	/* but $_COOKIE['id'] is not set											*/
	if(!isset($_COOKIE['id'])) {
		unset($sel_id);
		redirect("index.php");
	}

	$usrq = "SELECT * FROM usr WHERE usr_id=\"".$sel_id."\"";
	$usrquery = mysqli_query($dbconn,$usrq);
	while($usropt = mysqli_fetch_assoc($usrquery)) {
		$usrid		= $usropt['usr_id'];
		$usrname		= $usropt['usr_name'];
	}
}
$objdescription = _("Dashboard for ").$usrname;
$visitortitle = $usrname;
$pagetitle = $greeting.", ".$visitortitle;

// PRE FORM SUBMISSION PROCESSING
 /*
  * When we get to version 0.2, this will check the profile table for the userid
  * and will pre-populate the values in the form with what it finds.
  */


// POST FORM SUBMISSION PROCESSING
if (isset($_POST['prosubmit'])) {
	$figen		= $_POST['progen'];
	$fisxu		= $_POST['prosxu'];
	$fieye		= $_POST['proeye'];
	$fihar		= $_POST['prohar'];
	$filoc		= $_POST['proloc'];
	$finat		= $_POST['pronat'];
	$fii18		= $_POST['proi18'];
	$fispk		= $_POST['prospk'];
	$fitzt		= $_POST['protzt'];

	// check if the user is in the pro table
	$usrproq = "SELECT * FROM pro WHERE pro_id='".$usrid."'";
	$usrproquery = mysqli_query($dbconn,$usrproq);
	if (mysqli_num_rows($usrproquery) > 0) {

		// the user is in the pro table, so let's update their info
		$fiprouq = "UPDATE pro SET pro_gen='".$figen."',pro_sxu='".$fisxu."',pro_eye='".$fieye."',pro_har='".$fihar."',pro_loc='".$filoc."',pro_nat='".$finat."',pro_i18='".$fii18."',pro_spk='".$fispk."',pro_tzt='".$fitzt."' WHERE pro_id='".$usrid."'";
#		$message = $fiprouq;
		$fiprouquery = mysqli_query($dbconn,$fiprouq);
		redirect("my-profile.php?uid=".$usrid);
	} else if (mysqli_num_rows($usrproquery) == 0) {

		// the user is not in the pro table, so let's enter their info
		$fiprouq = "INSERT INTO pro
					(pro_id,
					pro_gen,
					pro_sxu,
					pro_eye,
					pro_har,
					pro_loc,
					pro_nat,
					pro_i18,
					pro_spk,
					pro_tzt
					) VALUES (
					'$usrid',
					'$figen',
					'$fisxu',
					'$fieye',
					'$fihar',
					'$filoc',
					'$finat',
					'$fii18',
					'$fispk',
					'$fitzt'
					)";
#		$message = $fiprouq;
		$fiprouquery = mysqli_query($dbconn,$fiprouq);
		redirect("my-profile.php?uid=".$usrid);
	}

} // end if isset $_POST['prosubmit']


include_once "dash-header.php";
include_once "dash-nav.php";
?>
		<article>
			<form id="editprofile" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?uid=".$usrid); ?>">
				<table>
					<caption><?php echo _('Edit your profile'); ?></caption>
					<tr>
						<td class="inputlabel"><label for="progen"><?php echo _('Gender');?></label></td>
						<td>
							<select name="progen">
<?php
// get the genders
$genq = "SELECT * FROM gen ORDER BY gen_name ASC";
$genquery = mysqli_query($dbconn,$genq);
while($genopt = mysqli_fetch_assoc($genquery)) {
	echo "\t\t\t\t\t\t\t\t<option value=\"".$genopt['gen_id']."\">".$genopt['gen_name']."</option>\n";
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="prosxu"><?php echo _('Sexuality');?></label></td>
						<td>
							<select name="prosxu">
<?php
// get the sexualities
$sxuq = "SELECT * FROM sxu ORDER BY sxu_name ASC";
$sxuquery = mysqli_query($dbconn,$sxuq);
while($sxuopt = mysqli_fetch_assoc($sxuquery)) {
	echo "\t\t\t\t\t\t\t\t<option value=\"".$sxuopt['sxu_id']."\">".$sxuopt['sxu_name']."</option>\n";
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="proeye"><?php echo _('Eye color');?></label></td>
						<td>
							<select name="proeye">
<?php
// get the eye colors
$eyeq = "SELECT * FROM eye ORDER BY eye_color ASC";
$eyequery = mysqli_query($dbconn,$eyeq);
while($eyeopt = mysqli_fetch_assoc($eyequery)) {
	echo "\t\t\t\t\t\t\t\t<option value=\"".$eyeopt['eye_id']."\">".$eyeopt['eye_color']."</option>\n";
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="prohar"><?php echo _('Hair color');?></label></td>
						<td>
							<select name="prohar">
<?php
// get the hair colors
$harq = "SELECT * FROM har ORDER BY har_color ASC";
$harquery = mysqli_query($dbconn,$harq);
while($haropt = mysqli_fetch_assoc($harquery)) {
	echo "\t\t\t\t\t\t\t\t<option value=\"".$haropt['har_id']."\">".$haropt['har_color']."</option>\n";
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="proloc"><?php echo _('Location');?></label></td>
						<td>
							<select name="proloc">
<?php
// get the locations
$locq = "SELECT * FROM loc ORDER BY loc_name ASC";
$locquery = mysqli_query($dbconn,$locq);
while($locopt = mysqli_fetch_assoc($locquery)) {
	echo "\t\t\t\t\t\t\t\t<option value=\"".$locopt['loc_id']."\">".$locopt['loc_name']."</option>\n";
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="pronat"><?php echo _('Nationality');?></label></td>
						<td>
							<select name="pronat">
<?php
// get the nationalities
$natq = "SELECT * FROM nat ORDER BY nat_name ASC";
$natquery = mysqli_query($dbconn,$natq);
while($natopt = mysqli_fetch_assoc($natquery)) {
	echo "\t\t\t\t\t\t\t\t<option value=\"".$natopt['nat_id']."\">".$natopt['nat_name']."</option>\n";
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="proi18"><?php echo _('Locale');?></label></td>
						<td>
							<select name="proi18">
<?php
// get the locales
$i18q = "SELECT * FROM i18 ORDER BY i18_language ASC";
$i18query = mysqli_query($dbconn,$i18q);
while($i18opt = mysqli_fetch_assoc($i18query)) {
	echo "\t\t\t\t\t\t\t\t<option value=\"".$i18opt['i18_id']."\">".$i18opt['i18_language']."-".$i18opt['i18_country']."</option>\n";
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="prospk"><?php echo _('Languages spoken');?></label></td>
						<!-- for now, this is limited to one language -->
						<td>
							<select name="prospk">
<?php
// get the spoken languages
$spkq = "SELECT * FROM spk ORDER BY spk_name ASC";
$spkquery = mysqli_query($dbconn,$spkq);
while($spkopt = mysqli_fetch_assoc($spkquery)) {
	echo "\t\t\t\t\t\t\t\t<option value=\"".$spkopt['spk_id']."\">".$spkopt['spk_name']."</option>\n";
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="inputlabel"><label for="protzt"><?php echo _('Time zone');?></label></td>
						<td>
							<select name="protzt">
<?php
// get the time zones
$tztq = "SELECT * FROM tzt ORDER BY tzt_name ASC";
$tztquery = mysqli_query($dbconn,$tztq);
while($tztopt = mysqli_fetch_assoc($tztquery)) {
	echo "\t\t\t\t\t\t\t\t<option value=\"".$tztopt['tzt_id']."\">".$tztopt['tzt_name']."</option>\n";
}
?>
							</select>
						</td>
					</tr>
				</table>
				<input type="submit" id="prosubmit" name="prosubmit" value="<?php echo _('Update'); ?>">
			</form>
		</article>
<?php
include_once "dash-footer.php";
?>
