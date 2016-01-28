<!DOCTYPE html>
<?php
require_once( 'lib/dbutils.php');
require_once("photoalbum-common.php");
?>
<html>
<head>
<title>HTML Photo Album</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='photoalbum.css'>
<link rel='stylesheet' href='http://www.w3schools.com/lib/w3.css'>
<script src='http://code.jquery.com/jquery-1.11.3.min.js'></script>
<link rel='stylesheet' href='lib/lightbox2/css/lightbox.css'>
</head>
<body>

<header class='w3-container w3-orange w3-center'>
  <h1>My Photo Album</h1>
  <h2>Your Name</h2>
  <p>Here are some photographs and descriptions.</p>
</header>

<?php

$pdo = connect();

if ( isset( $_GET['deletionid'])) {
  $errorMessage = deletePhotograph( $pdo, $_GET['deletionid']);
  if ( $errorMessage != "") {
    print "<div class='errormessage'>$errorMessage</div>\n";
  } else {
    print "<div class='message'>Image deleted.</div>\n";    
  }
}

if ( isset( $_POST['formid']) && $_POST['formid'] == 'fileupload') {
  $photoid = addPhotograph( $pdo, $_POST['name'], $_POST['description'], 'self', $_FILES['uploadfile']);
}




$sql = "SELECT * FROM `photographs` ORDER BY `photoid`";
$stmt = $pdo->query( $sql);
// get all rows in an array
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$numberOfPhotos = count( $rows);
  
for( $i = 0; $i < $numberOfPhotos; $i++) {
  
  if ( $i % 3 == 0) {
    if ( $i > 0) { print "</div>\n"; }
    print "<div class='w3-row'>\n";
  }

  $row = $rows[$i];
  print "  <div class='w3-container w3-row w3-col l4'>\n";
  print "    <div class='w3-container w3-card-8 w3-margin-8'>\n";
  print "      <div class='w3-container w3-half w3-image'>\n";
  print "        <a class='example-image-link' data-lightbox='example-1' href='images/".$row['image']."'><img src='images/".$row['image']."' class='example-image w3-circle'></a>\n";
  print "        <div class='w3-title w3-text-purple'>".$row['name']."</div>\n";
  print "      </div>\n";
  print "      <div class='w3-container w3-half'>\n";
  print $row['description']."\n";
  print "      <a href='?deletionid=".$row['photoid']."' class='link'>(Delete)</a>";
  print "      </div>\n";
  print "    </div>\n";
  print "  </div>\n";  
}

print "</div>\n";


?>
<div class='w3-container w3-center'>
  <a href="#id01" class='link'>Add images</a>
</div>

<div id="id01" class="w3-modal">
  <div class="w3-modal-dialog">
    <div class="w3-modal-content w3-card-4">
      <header class="w3-container w3-teal"> 
        <a href="#" class="w3-closebtn">&times;</a>
        <h2>Upload photograph</h2>
      </header>
      <div class="w3-container">
        <form action='?' method='post' enctype='multipart/form-data' id='photoform' class='w3-container'>
          <div class="w3-group">
            <input type='file' name='uploads[]' multiple='multiple' class='w3-input'>
            <label class="w3-label">Image file</label>
          </div>
          <div class="w3-group">   
            <input type='text' name='name' class='w3-input' required>
            <label class="w3-label">Name</label>
          </div>
          <div class="w3-group">   
            <textarea name='description' class='w3-input' required></textarea>
            <label class="w3-label">Description</label>
          </div>
          <input type='hidden' name='formid' value='fileupload'>

          <input type='submit' value='Upload' id='uploadbutton' class='w3-btn'>
        </form>
      </div>
      <footer class="w3-container w3-teal">
        <p></p>
      </footer>
    </div>
  </div>
</div>

<footer class='w3-container w3-orange w3-padding-jumbo'>
	<div class='w3-container w3-center'>
		<a href='mailto:childm@lsbu.ac.uk' class='link'>Contact me</a>
	</div>
</footer>
<script src='lib/lightbox2/js/jquery.js'></script>
<script src='lib/lightbox2/js/lightbox.js'></script>
</body>
</html>
        
