<?php
require_once("lib/dbutils.php");
require_once("photoalbum-common.php");
header("content-type: application/json");

/* For part e */

setUpSession();

if ( $_SESSION['user'] == "anonymous") { 
  print "{";
  print "\"result\": \"failure\"";
  print ",";
  print "\"error\": \"not logged in\"";
  print "}";
  exit();
}


// This is called twice, once with the form value file_upload_incoming set to the number of files, 
// and the file data then again with values of the form fields. Note that the file data DOES NOT
// come in the normal format $_FILES['formfieldname'] but as a numbered array $_FILES[0] etc.

$pdo = connect();

if ( isset( $_POST['file_upload_incoming'])) {
  // FIRST AJAX INVOCATION

  // create a databse record with dummy name and description but pointing to the uploaded photo
  $photoid = addPhotograph( $pdo, 'incoming', 'pending', 'self', $_FILES[0]);
  // send the photoid back to the javascript process on the client
  print "{\"photoid\": \"".$photoid."\"}";
} else {
  // SECOND AJAX INVOCATION
  
  // now update the database with the other fields
  $stmt = $pdo->prepare("UPDATE photographs SET `name`=?, `description`=? WHERE `photoid`=?");
  $stmt->execute( array( $_POST['name'], $_POST['description'], $_POST['photoid']));
  print "{\"completed photoid\": \"".$_POST['photoid']."\"}";
}

?>
