<?php

require_once("lib/dbutils.php");

$pdo = connect();

if ( !tableExists( $pdo, 'photographs')) {
	print "<p>Creating photographs table...";
	$sql = "CREATE TABLE IF NOT EXISTS `photographs` (
		`photoid` int(11) NOT NULL auto_increment,
		`user` varchar(255) NOT NULL,
		`image` varchar(255),
		`name` varchar(255) NOT NULL,
		`description` text NOT NULL,
		PRIMARY KEY  (`photoid`)
	)";

	$pdo->exec( $sql);
	print "<p>Importing photographs table... ";
	importTable( $pdo, "photographs", "photographs.txt");
}

print "<p>Done";
?>