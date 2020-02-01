<?php
function getConnection() {
    $servername = 'localhost';
    $dbname 	= 'test';
	//$dbport 	= '3036';
    $username   = 'test_user';
    $password   = 'test123';
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        return $conn;			
    }
    catch (PDOException $e) {
        echo "MySQL Connection failed: " . $e->getMessage();
        return null;
    }    
}

function getConnectionOracle() {
    $servername = 'Nadeera';
    $dbname 	= 'xe';
	//$dbport 	= '1521';
    $username   = 'test_user';
    $password   = 'test_user';

	$tns = "  
	(DESCRIPTION =
		(ADDRESS_LIST =
		  (ADDRESS = (PROTOCOL = TCP)(HOST = Nadeera)(PORT = 1521))
		)
		(CONNECT_DATA =
		  (SERVICE_NAME = xe)
		)
	  )";
    
    try {
        $conn = new PDO("oci:dbname=".$tns,$username,$password);
        // set the PDO error mode to exception 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        return $conn;			
    }
    catch (PDOException $e) {
        echo "Oracle Connection failed: " . $e->getMessage();
        return null;
    }    
}

function insertRecord($connt, $name, $email, $website, $comments, $gender)
{
try {
    //$name     = mysqli_real_escape_string($name);	
    //$email     = mysqli_real_escape_string($email);
    //$website     = mysqli_real_escape_string($website);
    //$comments     = mysqli_real_escape_string($comments);
    //$gender     = mysqli_real_escape_string($gender);
	
	//$connt = getConnection(); // connection is received as an argument

    //$sql = "INSERT INTO MyGuests (name, email, website, comments, gender) VALUES ('$name', '$email', '$website', '$comments', '$gender')"; 
    //pquery("INSERT INTO cMyGuests (name, email, website, comments, gender) VALUES(?s, ?s, ?s, ?s, ?s)",$name, $email, $website, $comments, $gender);
    $sql = $connt->prepare("INSERT INTO MyGuests (name, email, website, comments, gender) VALUES(:name, :email, :website, :comments, :gender)");
	$sql->execute(array("name" => $name,
						"email" => $email,
						"website" => $website,
						"comments" => $comments,
						"gender" => $gender ));	
     
    return "New record created successfully"; 
    } 
catch(PDOException $e) 
    { 
    $connt->rollback(); 
    return $sql . "<br>" . $e->getMessage(); 
    }
}
?>