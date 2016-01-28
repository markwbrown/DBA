<?php
header("content-type: application/json");
require_once("lib/dbutils.php");
require_once("photoalbum-common.php");

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

$pdo = connect();

if ( isset( $_POST['deletionid'])) {
  $errorMessage = deletePhotograph( $pdo, $_POST['deletionid']); 
} else {
  $errorMessage = "No id provided in post"; 
}

if ( $errorMessage == "") {
  print "{\"result\": \"success\"}";  
} else {
  print "{";
  print "\"result\": \"failure\"";
  print ",";
  print "\"error\": \"$errorMessage\"";
  print "}";
}
      
?>
