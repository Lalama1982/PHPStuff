<?php

$dbhost = "localhost";
$dbuser = "test_user";
$dbpass = "test123";
$dbname = "test";

//Connect to MySQL Server
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    echo "Could not connect: " . mysqli_connect_errno() . PHP_EOL;
} else {
    echo 'Connected successfully';
    echo "</br>Host information: " . mysqli_get_host_info($conn) . PHP_EOL;
//    mysqli_close($conn);
}

// Retrieve data from Query String
$age = $_GET['age'];
$sex = $_GET['sex'];
$wpm = $_GET['wpm'];

//build query
$query = "SELECT * FROM ajax_example WHERE sex = '$sex'";

if (is_numeric($age))
    $query .= " AND age <= $age";

if (is_numeric($wpm))
    $query .= " AND wpm <= $wpm";

//Execute query
$qry_result = mysqli_query($conn, $query); // or die(mysqli_error($conn));

//Build Result String
$display_string = "<table>";
$display_string .= "<tr>";
$display_string .= "<th>Name</th>";
$display_string .= "<th>Age</th>";
$display_string .= "<th>Sex</th>";
$display_string .= "<th>WPM</th>";
$display_string .= "</tr>";

// Insert a new row in the table for each person returned
while ($row = mysqli_fetch_array($qry_result)) {
    $display_string .= "<tr>";
    $display_string .= "<td>$row[name]</td>";
    $display_string .= "<td>$row[age]</td>";
    $display_string .= "<td>$row[sex]</td>";
    $display_string .= "<td>$row[wpm]</td>";
    $display_string .= "</tr>";
}
echo "Query: " . $query . "<br />";

$display_string .= "</table>";
//$retd[display_string] = $display_string;
//$retd[dummy] = "xxxxxx";
echo $display_string;
mysqli_close($conn);
?>