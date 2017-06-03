<?php 
// define variables and set to empty values 
$nameErr = $emailErr = $genderErr = $websiteErr = ""; 
$name = $email = $gender = $comment = $website = ""; 
$valSts = "S";
$connSts = "";
$connStsOralce = "";
$insertSts = "";
$conn = "";
$test = "";

// Retrieve data from main form
$name = $_GET['name'];
$email = $_GET['email'];
$gender = $_GET['gender'];
$comment = $_GET['comment'];
$website = $_GET['website'];

include 'dbActions.php';
$conn = getConnection();
$connOracle = getConnectionOracle();
 
//if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  if (IsNullOrEmptyString($name)) { 
    $nameErr = "Name is required"; 
  } else { 
    $name = test_input($name); 
    // check if name only contains letters and whitespace 
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) { 
      $nameErr = "Only letters and white space allowed";  
    } 
  } 
   
  if (IsNullOrEmptyString($email)) { 
    $emailErr = "Email is required"; 
  } else { 
    $email = test_input($email); 
    // check if e-mail address is well-formed 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
      $emailErr = "Invalid email format";  
    } 
  } 
     
  if (IsNullOrEmptyString($website)) { 
     $websiteErr = "Website is required"; 
  } else { 
    $website = test_input($website); 
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL) 
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) { 
      $websiteErr = "Invalid URL";  
    } 
  } 
 
  if (IsNullOrEmptyString($comment)) { 
    $comment = ""; 
  } else { 
    $comment = test_input($comment); 
  } 
 
  if (IsNullOrEmptyString($gender)) { 
    $genderErr = "Gender is required"; 
  } else { 
    $gender = test_input($gender); 
  } 
//} 
//if (isset($_REQUEST['Submit'])) {
//if ($_SERVER["REQUEST_METHOD"] == "POST") {	
 if ($connOracle != ""or $connOracle != null) {
	 $connStsOralce = "Successful-Oracle";
 }
 elseif ($connOracle == "" or $connOracle == null) {
   $connStsOralce = "Unsuccessful-Oracle";
}

 if ($conn != "" or $conn != null) {
	$connSts = "Successful-MySQL";	 
 }
 elseif ($conn == "" or $conn == null) {
	$connSts = "Unsuccessful-MySQL";
}

// returning the values
//echo  json_encode(array('display_string' => $display_string, 'dummy' => "xxxxxx"),JSON_FORCE_OBJECT);
$valReturn = json_encode(array('connsts'=>$connSts." // ".$connStsOralce,'nameerr'=>$nameErr, 'emailerr'=>$emailErr,'websiteerr'=>$websiteErr,'gendererr'=>$genderErr),JSON_FORCE_OBJECT);
//header("Content-Type: application/json");
echo ($valReturn);

function test_input($data) { 
  $data = trim($data); 
  $data = stripslashes($data); 
  $data = htmlspecialchars($data); 
  return $data; 
} 

function IsNullOrEmptyString($val){
    return (!isset($val) || trim($val)==='');
}
?>