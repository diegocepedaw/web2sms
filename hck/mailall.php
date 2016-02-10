
<?php
require "../twilio-php-master/Services/Twilio.php";
 
// set your AccountSid and AuthToken from www.twilio.com/user/account
$AccountSid = "AC02807de8e3d508ec5086b92c225970e0";
$AuthToken = "082cc14a487761e6fcf8ca7692d78024";
 
$client = new Services_Twilio($AccountSid, $AuthToken);


$message = "Thank you for your interest in Web2SMS, unfortunately running an SMS gateway is not free so for the time being Web2SMS is only offering a short term demo subscriptions. Contact Diego Cepeda at diegocepedaw@gmail.com for any questions regarding Web2SMS.";

	
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
		"Body" => $marr,
		));
		 
		// Display a confirmation message on the screen
		echo "Sent message {$message->sid}";
}
}

?>