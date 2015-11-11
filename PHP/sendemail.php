<!DOCTYPE html>
<html>
<head>
<title>Email Confirmation</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='http://www.w3schools.com/lib/w3.css'>
</head>
<body class='w3-padding-large'>

<h1>Contact Confirmation Screen</h1>

<?php

// FIX THIS
$message = $_POST['message'];

// CHANGE THE LINE BELOW TO AN EMAIL ADDRESS YOU RECEIVE MESSAGES AT.
$toaddress = "timothylam92@hotmail.co.uk";    // PLEASE don't leave noOne@NoWhere in this - it won't work...

// create a subject line for the email - THIS SHOULD GIVE THE NAME ENTERED INTO THE FORM
$subjectline = "Message from ".$_POST['firstname']." ".$_POST['lastname'];

// set the from address for the email; this is required
$headers = "from:lamt3@lsbu.ac.uk\n"; // Daydream will send an email only if this header is present

$success = false; 
// Send the email. The mail command is commented out. Remove the // to activate it.
// It is commented out because if the server does not support sending mails it might crash the script.
$success = mail( $toaddress, $subjectline, $message, $headers);

// THIS TEXT SHOULD ALSO GIVE THE NAME ENTERED BY THE USER, NOT John Smith.
print "<p>Thank you, " .$_POST['firstname']." ".$_POST['lastname']." ,the following message has been sent to the website owner:</p>";
print "<div class='w3-card-16 w3-padding-large'>\n";
print "<p><b>Subject:</b> ".$subjectline."</p>\n";
print "<p>".$message."</p>\n";
print "<d/div>\n";

if ( !$success) {
  print "<h2>Error: Message not sent!</h2>\n";
}

?>
</body>
</html>
