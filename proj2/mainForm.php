<!DOCTYPE HTML>   
<html> 
<head> 
<style> 
.error {color: #FF0000;} 
</style> 
<style> 
.notify {color: #2ECC71;} 
</style> 
</head> 
<body>   
 
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

include 'dbActions.php';
$conn = getConnection();
$connOracle = getConnectionOracle();
 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  if (empty($_POST["name"])) { 
    $nameErr = "Name is required"; 
  } else { 
    $name = test_input($_POST["name"]); 
    // check if name only contains letters and whitespace 
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) { 
      $nameErr = "Only letters and white space allowed";  
    } 
  } 
   
  if (empty($_POST["email"])) { 
    $emailErr = "Email is required"; 
  } else { 
    $email = test_input($_POST["email"]); 
    // check if e-mail address is well-formed 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
      $emailErr = "Invalid email format";  
    } 
  } 
     
  if (empty($_POST["website"])) { 
    $website = ""; 
  } else { 
    $website = test_input($_POST["website"]); 
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL) 
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) { 
      $websiteErr = "Invalid URL";  
    } 
  } 
 
  if (empty($_POST["comment"])) { 
    $comment = ""; 
  } else { 
    $comment = test_input($_POST["comment"]); 
  } 
 
  if (empty($_POST["gender"])) { 
    $genderErr = "Gender is required"; 
  } else { 
    $gender = test_input($_POST["gender"]); 
  } 
} 
//if (isset($_REQUEST['Submit'])) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {	
 if ($connOracle != ""or $connOracle != null) {
	 $connStsOralce = "Successful-Oracle";
 }
 elseif ($connOracle == "" or $connOracle == null) {
   $connStsOralce = "Unsuccessful-Oracle";
}
	 
 if ($conn != ""or $conn != null) {
	 $connSts = "Successful";
	 
	//if (isset($_REQUEST['Submit'])) {
		if (($nameErr == "" or $nameErr == null) and ($emailErr == "" or $emailErr == null) and (
		     $genderErr == "" or $genderErr == null) and ($websiteErr == "" or $websiteErr == null)) {
			$insertSts = insertRecord($conn, $name, $email, $website, $comment, $gender);
		}
		else {
			$insertSts	=	"Not Done";
		}		
	//}	 
	 
 }
 elseif ($conn == "" or $conn == null) {
   $connSts = "Unsuccessful";
}}

function test_input($data) { 
  $data = trim($data); 
  $data = stripslashes($data); 
  $data = htmlspecialchars($data); 
  return $data; 
} 
?> 
 
<h2>PHP Form Validation Example</h2> 
<p><span class="error">* required field.</span></p> 
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">   
  <p>Connection Status:<span class="notify"> <?php echo $connSts." -/- ".$connStsOralce;?></span></p>
  Name: <input type="text" name="name" value="<?php echo $name;?>"> 
  <span class="error">* <?php echo $nameErr;?></span> 
  <br><br> 
  E-mail: <input type="text" name="email" value="<?php echo $email;?>"> 
  <span class="error">* <?php echo $emailErr;?></span> 
  <br><br> 
  Website: <input type="text" name="website" value="<?php echo $website;?>"> 
  <span class="error"><?php echo $websiteErr;?></span> 
  <br><br> 
  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea> 
  <br><br> 
  Gender: 
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female 
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male 
  <span class="error">* <?php echo $genderErr;?></span> 
  <br><br> 
  <input type="submit" name="submit" value="Submit">   
</form> 
 
<?php 
echo "<br>"; 
echo "Record Insert Status: <span class=\"notify\">".$insertSts."</span>"; 
echo "<h2>Your Input:</h2>"; 
echo $name; 
echo "<br>"; 
echo $email; 
echo "<br>"; 
echo $website; 
echo "<br>"; 
echo $comment; 
echo "<br>"; 
echo $gender; 
?> 
 
</body> 
</html> 