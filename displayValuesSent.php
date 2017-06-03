<?php

// Retrieve data from POST String
$name = $_GET['name'];
$email = $_GET['email'];
$gender = $_GET['gender'];
$course = $_GET['course'];
$class = $_GET['class'];
$subject = $_GET['subject'];

$display_string = "<p>Your name is $name</p>";
$display_string .= "<p> your email address is $email</p>";
$display_string .= "<p>Your class time at $course</p>";
$display_string .= "<p>your class info $class </p>";
$display_string .= "<p>your gender is $gender</p>";
$display_string .= "<p>your gender is $subject</p>";

echo $display_string;
?>
