<!DOCTYPE html>
<html>
<head>
<title>Post Form Receiver</title>
</head>
<body>
<?php

if ( isset( $_POST['firstname']) && isset( $_POST['lastname'])) {
  print "<p>Hello ".$_POST['firstname']." ".$_POST['lastname']."!</p>\n";
} else {
  print "<p>You didn't tell me your first and last names!</p>\n";
}

?>
</body>
</html>
