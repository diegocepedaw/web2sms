<?php
	require "twilio-php-master/Services/Twilio.php";
	 
	// set your AccountSid and AuthToken from www.twilio.com/user/account
	$AccountSid = "AC02807de8e3d508ec5086b92c225970e0";
	$AuthToken = "082cc14a487761e6fcf8ca7692d78024";
	 
	$client = new Services_Twilio($AccountSid, $AuthToken);


	$message = $client->account->messages->create(array(
    "From" => "+16195682093",
    "To" => $_REQUEST['From'],
    "Body" =>  "You are currenty subcribed to Web2SMS, to unsubscribe please visit our website web2.sms.net76.net",
	));
	
?>

