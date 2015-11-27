<?php
require_once("lib/dbutils.php");

$pdo = connect();

if ( !tableExists( $pdo, 'users')) {
  print "<p>Creating users table...";
  $sql = "CREATE TABLE IF NOT EXISTS `users` (
    `user` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` enum( 'normal','admin') NOT NULL,
    PRIMARY KEY  (`user`)
  )";

  $pdo->exec( $sql);
  print "<p>Inserting default admin user admin/password... ";
  
  $sql = "INSERT INTO users SET `user`='admin', `password`='password', `role`='admin'";
  $pdo->exec( $sql);
  
}
print "<p>Done";
?>
