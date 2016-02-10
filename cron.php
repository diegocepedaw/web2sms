<?php
require "twilio-php-master/Services/Twilio.php";
 
// set your AccountSid and AuthToken from www.twilio.com/user/account
$AccountSid = "AC02807de8e3d508ec5086b92c225970e0";
$AuthToken = "082cc14a487761e6fcf8ca7692d78024"; 
 
$client = new Services_Twilio($AccountSid, $AuthToken);


$myfile = fopen("latest.txt", "r") or die("Unable to open file!");
$current = fread($myfile,filesize("latest.txt"));
echo $current;
fclose($myfile);


$xml = file_get_contents('http://en.wikinews.org/w/index.php?title=Special:NewsFeed&feed=atom&categories=Published&notcategories=No%20publish%7CArchived%7CAutoArchived%7Cdisputed&namespace=0&count=30&hourcount=124&ordermethod=categoryadd&stablepages=only');
$xml = html_entity_decode($xml);
function extract_from_tags($string, $tagname)
 {
    $pattern = "/<$tagname>(.*?)<\/$tagname>/";
    preg_match($pattern, $string, $matches);
    return $matches[1];
 }
$newl = "\r\n";
$instr = $xml;
$strarr = explode("</entry>",$instr);
$curarr = $strarr[0];
$strarr = explode("<entry>",$curarr);
$curarr = $strarr[1];
$havop = "Have an opinion on this";
$dint = strpos($curarr,$havop);
$newarr = substr_replace($curarr,"",$dint);
$havop = "<div class=\"infobox";
$dint = strpos($curarr,$havop); 
$titl = extract_from_tags($newarr,'title');
$titl = ltrim($titl);
$titl = rtrim($titl);
$newarr = explode("</updated>",$newarr);
$newarr = $newarr[1];
$newarr = explode("<p>",$newarr);
$skip = 0;
$finop = array();
foreach ($newarr as $ent)
{
	
	if ($ent[0] != "<" && $skip > 0)
	{
		$tent = strip_tags($ent);
		$tent = str_replace("\\'","'",$tent);
		$tent = str_replace("\\","",$tent);
		array_push($finop,$tent,$newl);
	}
	$skip = 1;
}
foreach ($finop as $ent)
{
	$value = $value . $ent;
}


if($value != $current)
{
	$myfile = fopen("latest.txt", "w");
	fwrite($myfile, $value);
	fclose($myfile);
	$connect = mysqli_connect("mysql2.000webhost.com","a7101706_admin","password123","a7101706_db");
	if (!$connect) {
		die('Could not connect: ' . mysql_error());
	}

	$sql = "SELECT * FROM user_phone_numbers";
	$count_t = mysqli_query($connect,$sql);
	//$num_r = mysqli_num_rows($count_t);
	while ($users = mysqli_fetch_array($count_t))
	{
		if ($users['Wiki'] == 1){

	  $cpn = $users['Phone_Number'];
	  $carrier = $users['Carrier'];
	  if($carrier == "Verizon")
	  $carrier = "vtext.com";
	  else if($carrier == "ATT")
	  $carrier = "text.att.net";
	  else if($carrier == "Sprint")
	  $carrier = "messaging.sprintpcs.com";
	  else if($carrier == "T-mobil")
	  $carrier = "tmomail.net";
	  $marr = $message;
	  $cpn = "+1" . $cpn;

		$message = $client->account->messages->create(array(
		"From" => "+16195682093",
		"To" => $cpn,
		"Body" => "WikiNews Update: " . $value,
		));
		 
		// Display a confirmation message on the screen
		echo "Sent message {$message->sid}";
}
	}

}


$myfile1 = fopen("latestrt.txt", "r") or die("Unable to open file!");
$current1 = fread($myfile1,filesize("latestrt.txt"));
echo $current1;
fclose($myfile1);

$xml = file_get_contents('http://feeds.reuters.com/Reuters/worldNews');
$xml = html_entity_decode($xml);
$strarr = explode("<item>",$xml);
$extr = $strarr[1];
$titl = extract_from_tags($extr,'title');
$titl = $titl . ":\r\n";
$strarr = explode("<description>",$extr);
$strarr = $strarr[1];
$strarr = explode("<",$strarr);
$strarr = $strarr[0];
$rets = $titl . $strarr;


if($rets != $current1)
{
	$myfile1 = fopen("latestrt.txt", "w");
	fwrite($myfile1, $rets);
	fclose($myfile1);
	$connect = mysqli_connect("mysql2.000webhost.com","a7101706_admin","password123","a7101706_db");
	if (!$connect) {
		die('Could not connect: ' . mysql_error());
	}

	$sql = "SELECT * FROM user_phone_numbers";
	$count_t = mysqli_query($connect,$sql);
	//$num_r = mysqli_num_rows($count_t);
	while ($users = mysqli_fetch_array($count_t))
	{
		if ($users['World'] == 1){
	  $cpn = $users['Phone_Number'];
	  $marr = $message;
	  $cpn = "+1" . $cpn;

		$message = $client->account->messages->create(array(
		"From" => "+16195682093",
		"To" => $cpn,
		"Body" => "World News Update: " . $rets,
		));
		 
		// Display a confirmation message on the screen
		echo "Sent message {$message->sid}";
}
	}

}

$myfile1 = fopen("latestsp.txt", "r") or die("Unable to open file!");
$current1 = fread($myfile1,filesize("latestsp.txt"));
echo $current1;
fclose($myfile1);

$xml = file_get_contents('http://feeds.reuters.com/reuters/sportsNews');
$xml = html_entity_decode($xml);
$strarr = explode("<item>",$xml);
$extr = $strarr[1];
$titl = extract_from_tags($extr,'title');
$titl = $titl . ":\r\n";
$strarr = explode("<description>",$extr);
$strarr = $strarr[1];
$strarr = explode("<",$strarr);
$strarr = $strarr[0];
$rets = $titl . $strarr;


if($rets != $current1)
{
	$myfile1 = fopen("latestsp.txt", "w");
	fwrite($myfile1, $rets);
	fclose($myfile1);
	$connect = mysqli_connect("mysql2.000webhost.com","a7101706_admin","password123","a7101706_db");
	if (!$connect) {
		die('Could not connect: ' . mysql_error());
	}

	$sql = "SELECT * FROM user_phone_numbers";
	$count_t = mysqli_query($connect,$sql);
	//$num_r = mysqli_num_rows($count_t);
	while ($users = mysqli_fetch_array($count_t))
	{
		if ($users['Sports'] == 1){
	  $cpn = $users['Phone_Number'];
	  $marr = $message;
	  $cpn = "+1" . $cpn;

		$message = $client->account->messages->create(array(
		"From" => "+16195682093",
		"To" => $cpn,
		"Body" => "Sports News Update: " . $rets,
		));
		 
		// Display a confirmation message on the screen
		echo "Sent message {$message->sid}";
}
	}

}

$myfile1 = fopen("latestpp.txt", "r") or die("Unable to open file!");
$current1 = fread($myfile1,filesize("latestpp.txt"));
echo $current1;
fclose($myfile1);

$xml = file_get_contents('http://feeds.reuters.com/reuters/peopleNews');
$xml = html_entity_decode($xml);
$strarr = explode("<item>",$xml);
$extr = $strarr[1];
$titl = extract_from_tags($extr,'title');
$titl = $titl . ":\r\n";
$strarr = explode("<description>",$extr);
$strarr = $strarr[1];
$strarr = explode("<",$strarr);
$strarr = $strarr[0];
$rets = $titl . $strarr;


if($rets != $current1)
{
	$myfile1 = fopen("latestpp.txt", "w");
	fwrite($myfile1, $rets);
	fclose($myfile1);
	$connect = mysqli_connect("mysql2.000webhost.com","a7101706_admin","password123","a7101706_db");
	if (!$connect) {
		die('Could not connect: ' . mysql_error());
	}

	$sql = "SELECT * FROM user_phone_numbers";
	$count_t = mysqli_query($connect,$sql);
	//$num_r = mysqli_num_rows($count_t);
	while ($users = mysqli_fetch_array($count_t))
	{
		if ($users['People'] == 1){
	  $cpn = $users['Phone_Number'];
	  $marr = $message;
	  $cpn = "+1" . $cpn;

		$message = $client->account->messages->create(array(
		"From" => "+16195682093",
		"To" => $cpn,
		"Body" => "People News Update: " . $rets,
		));
		 
		// Display a confirmation message on the screen
		echo "Sent message {$message->sid}";
}
	}

}

$myfile1 = fopen("latestbs.txt", "r") or die("Unable to open file!");
$current1 = fread($myfile1,filesize("latestbs.txt"));
echo $current1;
fclose($myfile1);

$xml = file_get_contents('http://feeds.reuters.com/reuters/businessNews');
$xml = html_entity_decode($xml);
$strarr = explode("<item>",$xml);
$extr = $strarr[1];
$titl = extract_from_tags($extr,'title');
$titl = $titl . ":\r\n";
$strarr = explode("<description>",$extr);
$strarr = $strarr[1];
$strarr = explode("<",$strarr);
$strarr = $strarr[0];
$rets = $titl . $strarr;


if($rets != $current1)
{
	$myfile1 = fopen("latestbs.txt", "w");
	fwrite($myfile1, $rets);
	fclose($myfile1);
	$connect = mysqli_connect("mysql2.000webhost.com","a7101706_admin","password123","a7101706_db");
	if (!$connect) {
		die('Could not connect: ' . mysql_error());
	}

	$sql = "SELECT * FROM user_phone_numbers";
	$count_t = mysqli_query($connect,$sql);
	//$num_r = mysqli_num_rows($count_t);
	while ($users = mysqli_fetch_array($count_t))
	{
		if ($users['Buisness'] == 1){
	  $cpn = $users['Phone_Number'];
	  $marr = $message;
	  $cpn = "+1" . $cpn;

		$message = $client->account->messages->create(array(
		"From" => "+16195682093",
		"To" => $cpn,
		"Body" => "Business News Update: " . $rets,
		));
		 
		// Display a confirmation message on the screen
		echo "Sent message {$message->sid}";
}
	}

}

$myfile1 = fopen("latestus.txt", "r") or die("Unable to open file!");
$current1 = fread($myfile1,filesize("latestus.txt"));
echo $current1;
fclose($myfile1);

$xml = file_get_contents('http://feeds.reuters.com/Reuters/domesticNews');
$xml = html_entity_decode($xml);
$strarr = explode("<item>",$xml);
$extr = $strarr[1];
$titl = extract_from_tags($extr,'title');
$titl = $titl . ":\r\n";
$strarr = explode("<description>",$extr);
$strarr = $strarr[1];
$strarr = explode("<",$strarr);
$strarr = $strarr[0];
$rets = $titl . $strarr;


if($rets != $current1)
{
	$myfile1 = fopen("latestus.txt", "w");
	fwrite($myfile1, $rets);
	fclose($myfile1);
	$connect = mysqli_connect("mysql2.000webhost.com","a7101706_admin","password123","a7101706_db");
	if (!$connect) {
		die('Could not connect: ' . mysql_error());
	}

	$sql = "SELECT * FROM user_phone_numbers";
	$count_t = mysqli_query($connect,$sql);
	//$num_r = mysqli_num_rows($count_t);
	while ($users = mysqli_fetch_array($count_t))
	{
		if ($users['USA'] == 1){
	  $cpn = $users['Phone_Number'];
	  $marr = $message;
	  $cpn = "+1" . $cpn;

		$message = $client->account->messages->create(array(
		"From" => "+16195682093",
		"To" => $cpn,
		"Body" => "USA News Update: " . $rets,
		));
		 
		// Display a confirmation message on the screen
		echo "Sent message {$message->sid}";
}
	}

}
/*$message = $client->account->messages->create(array(
		"From" => "+16195682093",
		"To" => "+18587509496",
		"Body" => "Web2SMS update: " . "CRONWORKS!",
		));
		 
		// Display a confirmation message on the screen
		echo "Sent message {$message->sid}";*/

?>