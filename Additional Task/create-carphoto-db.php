<?php

require_once("lib/dbutils.php");

$pdo = connect();

if ( !tableExists( $pdo, 'carphotographs')) {
	print "<p>Creating photographs table...";
	$sql = "CREATE TABLE IF NOT EXISTS `carphotographs` (
		`photoid` int(11) NOT NULL auto_increment,
		`user` varchar(255) NOT NULL,
		`image` varchar(255),
		`name` varchar(255) NOT NULL,
		`description` text NOT NULL,
		PRIMARY KEY  (`photoid`)
	)";

	$pdo->exec( $sql);
	print "<p>Importing carphotographs table... ";
	importTable( $pdo, "carphotographs", "carphotographs.txt");
}

print "<p>Done";
?>