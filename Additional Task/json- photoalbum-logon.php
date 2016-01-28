<?php
header("content-type: application/json");
require_once("lib/dbutils.php");

$pdo = connect();

$action = logInOrOut( $pdo, 'users');

print "{";
print "\"action\": \"".$action."\"";
print ",";
print "\"user\": \"".$_SESSION['user']."\"";
print ",";
print "\"role\": \"".$_SESSION['role']."\"";
print "}";

?>
