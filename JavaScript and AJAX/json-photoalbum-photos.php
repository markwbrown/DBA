<?php
header("content-type: application/json");
require_once("lib/dbutils.php");

$pdo = connect();

print jsonTable( $pdo, "photographs", "ORDER BY `photoid`");
?>
	