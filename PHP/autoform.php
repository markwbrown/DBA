<!DOCTYPE html>
<html>
<head>
<title>Post Form Receiver</title>
</head>
<body>
<?php
if ( isset( $_POST['firstname']) && isset( $_POST['lastname'])) {
  print "<p>Hello ".$_POST['firstname']." ".$_POST['lastname']."!</p>\n";
  print "<p><a href=''>Go again!</a></p>\n";
} else {
?>
<form action='' method='post'>  
  First name <input type='text' name='firstname'>
  Last name  <input type='text' name='lastname'>
  <input type='submit'>
</form>
<?php
}
?>

</body>
</html>
