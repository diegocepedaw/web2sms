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
</div>

<div id="container" class = "row">
    <form action="" method="post" data-abide>
     <div class="row input-wrapper">
       <label for="phoneNumber">Phone Number
       <input type="text" name="phoneNumber" id="phoneNumber" placeholder="ex: 3855550168" required pattern="^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$"/>
        </label>
       <small class="error">Please Enter a Valid Phone Number</small>
    </div>
     <div class="row large-12"><div class = "columns"><input class = "button radius large-6" type="submit" name="regNumber" id="regNumber" value="Register Number" /></div>
     <div class="columns"><input class = "button radius alert large-5" type="submit" name="unsNumber" id="unsNumber" value="Unsubscribe Number"/></div>
    
     </div>
   </form>
  </div>

<div class = "row large-centered footy" data-equalizer>
  <div class="large-3 small-6 columns" data-equalizer-watch>
  <ul class="vcard">
  <li class="fn">Diego Cepeda</li>
  <li class="street-address">199 Burdett Ave, BARH</li>
  <li class="locality">Troy</li>
  <li><span class="state">New York</span>, <span class="zip">12180</span></li>
  <li class="email"><a href="#">diegocepedaw@gmail.com</a></li>
  </ul>
</div>
 <div class="large-3 small-6 columns" data-equalizer-watch>
  <ul class="vcard">
  <li class="fn">Joseph Monroe</li>
  <li class="street-address">107 Sunset Terrace</li>
  <li class="locality">Troy</li>
  <li><span class="state">New York</span>, <span class="zip">12180</span></li>
  <li class="email"><a href="#">josroe9595@gmail.com</a></li>
  </ul>
</div>
</div>
  
<?php
 
//$dbname = "a6516563_rss";
$connect = mysqli_connect("mysql2.000webhost.com","a7101706_admin","password123","a7101706_db");
if (!$connect) {
    die('Could not connect: ' . mysql_error());
}

if ($_POST['unsNumber']){
  $rempn = $_REQUEST['phoneNumber'];
  $sql = "DELETE FROM user_phone_numbers WHERE Phone_Number = $rempn";

  if (mysqli_query($connect,$sql) === TRUE) {
    echo "Number Deleted";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
  }

  mysqli_close($connect);
}

else if ( isset( $_REQUEST ) && !empty( $_REQUEST ) ) {
 if (
 isset( $_REQUEST['phoneNumber']) &&
  !empty( $_REQUEST['phoneNumber'] ) &&
  is_numeric($_REQUEST['phoneNumber']) &&
  strlen($_REQUEST['phoneNumber']) == 10
 ) {

  $message = fopen("latest.txt","r");
  $message = fread($message,filesize("latest.txt"));

  $marr = $message;
  $to = "+1" . $_REQUEST['phoneNumber'];
  
  require "twilio-php-master/Services/Twilio.php";
 
  // set your AccountSid and AuthToken from www.twilio.com/user/account
  $AccountSid = "AC02807de8e3d508ec5086b92c225970e0";
  $AuthToken = "082cc14a487761e6fcf8ca7692d78024";
 
  $client = new Services_Twilio($AccountSid, $AuthToken);
 
  $message = $client->account->messages->create(array(
  "From" => "+16195682093",
  "To" => $to,
  "Body" => $marr,
));
   
      
     
  
  $addpn = $_REQUEST['phoneNumber'];
  $sql = "INSERT INTO user_phone_numbers (Phone_Number) VALUES ($addpn)";

  if (mysqli_query($connect,$sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
  }

  mysqli_close($connect);
 } else {
  print 'Not all information was submitted.';
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