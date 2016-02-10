<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/foundation.css">
  <script src="js/vendor/modernizr.js"></script>
  <style> 
  .footy {
    
    bottom: 40px; 
    margin-right: auto;
    margin-left: auto;
  }
  </style>
</head>


<body>
<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">Web2SMS - Hackathon</a></h1>
    </li>
  </ul>
</nav>
<br>

<div class="row panel">
  <h3>What is Web2SMS</h3>

  <p>Web2SMS scrapes reliable online news sources like Reuters and Wikinews and delivers plain text versions of their latest articles in real time via SMS.</p> 

  <h3>Why Web2SMS</h3>

  <p>Whether it&#39s because of geographical location, poverty, or an oppressive regime the vast majority of the world lacks internet access, however, we at team Web2SMS believe that access to information is a fundamental human right so we created Web2SMS as a way to empower the billions of mobile phone users who rely on more basic communication technologies. With a whopping 75% of the world&#39s population owning a mobile phone Web2SMS has the potential to become a massively important tool for education and progress all throughout the world.</p>
  <p>How to: Enter your phone number. If you would like to unsubscribe click Unsubscribe and you shall receive SMS no more. If you would like to subscribe or update preferences from an existing subscription, simply check your preferences and click Register Number!</p>
</div>

<div id="container" class = "row">
    <form action="" method="post" data-abide>
     <div class="row input-wrapper">
       <label for="phoneNumber">Phone Number
       <input type="text" name="phoneNumber" id="phoneNumber" placeholder="ex: 3855550168" required pattern="^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$"/>
        </label>
       <small class="error">Please Enter a Valid Phone Number</small>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Subscribe to:</label>
        <input type="radio" name="wikiNews" value="wikn" id="wikiNews"><label for="wikiNews">WikiNews</label>
        <input type="radio" name="reWorld" value="rwo" id="reWorld"><label for="reWorld">Reuters World News</label>
        <input type="radio" name="reSport" value="rsp" id="reSport"><label for="rSport">Reuters Sports News</label>
        <input type="radio" name="rePeeps" value="rpe" id="rePeeps"><label for="rePeeps">Reuters People News</label>
        <input type="radio" name="reBuis" value="rbs" id="reBuis"><label for="reBuis">Reuters Business News</label>
        <input type="radio" name="reUSAN" value="rus" id="reUSAN"><label for="reUSAN">Reuters USA News</label>
      </div>
    </div>
     <div class="row">
      <div class = "columns large-6"><input class = "button radius large-12" onclick="myFunction()" type="submit" name="regNumber" id="regNumber" value="Register Number" /></div>
     <div class="columns large-6"><input class = "button radius alert large-12" onclick="myFunction()" type="submit" name="unsNumber" id="unsNumber" value="Unsubscribe Number"/></div>
    
     </div>
   </form>
  </div>

<div class = "row large-centered footy" data-equalizer>
  <div class="large-6 small-6 columns" data-equalizer-watch>
    <ul class="panel no-bullet">
      <li><b>Diego Cepeda</b></li>
      <li><a href="www.linkedin.com/pub/diego-cepeda/94/429/921">www.linkedin.com/pub/diego-cepeda/94/429/921</a></li>
      <li class="email"><a href="#">diegocepedaw@gmail.com</a></li>
    </ul>
</div>
 <div class="large-6 small-6 columns" data-equalizer-watch>
  <ul class="panel no-bullet">
    <li><b>Joseph Monroe</b></li>
    <li><a href="www.linkedin.com/pub/joseph-monroe/9a/324/7a/">www.linkedin.com/pub/joseph-monroe/9a/324/7a/</a></li>
    <li class="email"><a href="#">josroe9595@gmail.com</a></li>
  </ul>
</div>
</div>
  

<?php
//$dbname = "a6516563_rss";
$connect = mysqli_connect("diegocepedacom.ipagemysql.com","web2sms","password123","web2sms");
if (!$connect) {
	echo "stopped ";
    die('Could not connect: ' . mysql_error());
}

if ($_POST['unsNumber']) {
  $rempn = $_REQUEST['phoneNumber'];
  $sql = "DELETE FROM user_phone_numbers WHERE Phone_Number = $rempn";
  $result = mysqli_query($connect,"SELECT Phone_Number FROM user_phone_numbers WHERE Phone_Number = '$rempn'");
  $matchFound = mysqli_num_rows($result) > 0 ? 'yes' : 'no';
  
  if (mysqli_query($connect,$sql) === TRUE && $matchFound == 'yes'){
    echo "<script type='text/javascript'>alert('Successfully Deleted Number!');</script>";
    sleep(3);
    unset($_POST);
    mysqli_close($connect);
    //header("Location:index.php");
  } else {
    echo "Some problem occurred.";
  }
}

else if ( isset( $_REQUEST ) && !empty( $_REQUEST ) ) {
 if (
 isset( $_REQUEST['phoneNumber']) &&
  !empty( $_REQUEST['phoneNumber'] ) &&
  is_numeric($_REQUEST['phoneNumber']) &&
  strlen($_REQUEST['phoneNumber']) == 10
 ) {


  $addpn = $_REQUEST['phoneNumber'];
  $result = mysqli_query($connect,"SELECT Phone_Number FROM user_phone_numbers WHERE Phone_Number = '$addpn'");
  $sql = "INSERT INTO user_phone_numbers (Phone_Number) VALUES ($addpn)";
  $matchFound = mysqli_num_rows($result) > 0 ? 'yes' : 'no'; 

  if ($matchFound == 'yes'){
    $addwik = 0;
    $addwor = 0;
    $addspr = 0;
    $addpep = 0;
    $addbiz = 0;
    $addusa = 0;
    if (isset($_REQUEST['wikiNews'])){
      $addwik = 1;
    }
    if (isset($_REQUEST['reWorld'])){
      $addwor = 1;
    }
    if (isset($_REQUEST['reSport'])){
      $addspr = 1;
    }
    if (isset($_REQUEST['rePeeps'])){
      $addpep = 1;
    }
    if (isset($_REQUEST['reBuis'])){
      $addbiz = 1;
    }
    if (isset($_REQUEST['reUSAN'])){
      $addusa = 1;
    }
    $sql = "DELETE FROM user_phone_numbers WHERE Phone_Number = $addpn";
    $result = mysqli_query($connect,"SELECT Phone_Number FROM user_phone_numbers WHERE Phone_Number = '$rempn'");
    mysqli_query($connect,$sql);
    $sql = "INSERT INTO user_phone_numbers (Phone_Number,Wiki,World,Sports,People,Buisness,USA) VALUES ($addpn,$addwik,$addwor,$addspr,$addpep,$addbiz,$addusa)";
    mysqli_query($connect,$sql);
    mysqli_close($connect);
    echo "<script type='text/javascript'>alert('Successfully Updated Number Preferences!');</script>";
    sleep(3);
    unset($_POST);
    //header("Location:index.php");
  }
  if ($matchFound == 'no'){
    $addwik = 0;
    $addwor = 0;
    $addspr = 0;
    $addpep = 0;
    $addbiz = 0;
    $addusa = 0;
    if (isset($_REQUEST['wikiNews'])){
      $addwik = 1;
    }
    if (isset($_REQUEST['reWorld'])){
      $addwor = 1;
    }
    if (isset($_REQUEST['reSport'])){
      $addspr = 1;
    }
    if (isset($_REQUEST['rePeeps'])){
      $addpep = 1;
    }
    if (isset($_REQUEST['reBuis'])){
      $addbiz = 1;
    }
    if (isset($_REQUEST['reUSAN'])){
      $addusa = 1;
    }
    $sql = "INSERT INTO user_phone_numbers (Phone_Number,Wiki,World,Sports,People,Buisness,USA) VALUES ($addpn,$addwik,$addwor,$addspr,$addpep,$addbiz,$addusa)";
  if (mysqli_query($connect,$sql) == TRUE) {
    
    

    mysqli_close($connect);
     $marr = $message;
      $to = "+1" . $_REQUEST['phoneNumber'];
      
      require "twilio-php-master/Services/Twilio.php";
     
      // set your AccountSid and AuthToken from www.twilio.com/user/account
      $AccountSid = "AC02807de8e3d508ec5086b92c225970e0";
      $AuthToken = "082cc14a487761e6fcf8ca7692d78024";
	  
	  
     
      $client = new Services_Twilio($AccountSid, $AuthToken);
	  
	  $message = $client->account->messages->create(array(
      "From" => "+16195682093",
      "To" => "+18587509496",
      "Body" => "New Subscriber",
      ));
	  
    if ($addwik == 1){
      $message = fopen("latest.txt","r");
      $message = fread($message,filesize("latest.txt"));
      $marr = $message;
    
     
      $message = $client->account->messages->create(array(
      "From" => "+16195682093",
      "To" => $to,
      "Body" => "Latest Wiki News: " . $marr,
      ));
    }
    if ($addwor == 1){
    $message = fopen("latestrt.txt","r");
    $message = fread($message,filesize("latestrt.txt"));
    $marr = $message;
     
     $message = $client->account->messages->create(array(
    "From" => "+16195682093",
    "To" => $to,
    "Body" => "Latest World News: " .$marr,
    ));
   }
   if ($addspr == 1){
    $message = fopen("latestsp.txt","r");
    $message = fread($message,filesize("latestsp.txt"));
    $marr = $message;
     
     $message = $client->account->messages->create(array(
    "From" => "+16195682093",
    "To" => $to,
    "Body" => "Latest Sports News: " .$marr,
    ));
   }
   if ($addpep == 1){
    $message = fopen("latestpp.txt","r");
    $message = fread($message,filesize("latestpp.txt"));
    $marr = $message;
     
     $message = $client->account->messages->create(array(
    "From" => "+16195682093",
    "To" => $to,
    "Body" => "Latest People News: " .$marr,
    ));
   }
   if ($addbiz == 1){
    $message = fopen("latestbs.txt","r");
    $message = fread($message,filesize("latestbs.txt"));
    $marr = $message;
     
     $message = $client->account->messages->create(array(
    "From" => "+16195682093",
    "To" => $to,
    "Body" => "Latest Business News: " .$marr,
    ));
   }
   if ($addusa == 1){
    $message = fopen("latestus.txt","r");
    $message = fread($message,filesize("latestus.txt"));
    $marr = $message;
     
     $message = $client->account->messages->create(array(
    "From" => "+16195682093",
    "To" => $to,
    "Body" => "Latest USA News: " .$marr,
    ));
   }
   
    
    $marr = "Unfortunately running an sms gateway isn't free so for the time being Web2SMS will only be offering a limited trial of its services. Contact diegocepedaw@gmail.com for any questions.";
     
     $message = $client->account->messages->create(array(
    "From" => "+16195682093",
    "To" => $to,
    "Body" => "Attention: " .$marr,
    ));
	
    echo "<script type='text/javascript'>alert('Successfully Added Number!');</script>";
    sleep(3);
    unset($client);
    unset($_POST);
    //header("Location:index.php");
  } 
  }
  
}

}

?>


<script src="/js/vendor/jquery.js"></script>
<script src="/js/vendor/fastclick.js"></script>
<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script src="js/foundation/foundation.js"></script>
<script src="js/foundation/foundation.abide.js"></script>

</body>
</html>