<?php

function deletePhotograph( $pdo, $deletionid) {
  $errorMessage = "";
  // retrieve name of image file so we can delete it
  $stmt = $pdo->prepare("SELECT `image` FROM `photographs` WHERE `photoid`=?");
  $stmt->execute( array( $deletionid));  
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if ( count( $rows) == 1) {
    // delete file
    unlink( "images/".$rows[0]['image']);    
    // delete database record
    $stmt = $pdo->prepare("DELETE FROM `photographs` WHERE `photoid`=?");
    $stmt->execute( array( $deletionid));  
    $affected_rows = $stmt->rowCount();    
  } else if (count( $rows) > 1) {
    $errorMessage .= "ID matches more than one record. ";
  } else {
    $errorMessage .= "ID not found: nothing to delete. ";
  }
  return $errorMessage;
}

function addPhotograph( $pdo, $name, $description, $user, $fileinfo) {
  // create DB entry to get an ID
  $stmt = $pdo->prepare("INSERT INTO photographs ( `name`, `description`, `user`) VALUES (?, ?, ?)");
  $stmt->execute( array( $name, $description, $user));
  $photoid = $pdo->lastInsertId();
  
  // receive the files, I only have one
  $tmp_name = $fileinfo["tmp_name"];
  // create final image name from unique DB id
  $name = $photoid."_".$fileinfo["name"];
  // update the database with the final image name
  $stmt = $pdo->prepare("UPDATE photographs SET `image`=? WHERE `photoid`=?");
  $stmt->execute( array( $name, $photoid));
  // move the uploaded file to the final location
  $result = move_uploaded_file($tmp_name, "images/$name");
  return $photoid;  
}


?>
