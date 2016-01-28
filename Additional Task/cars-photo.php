<!DOCTYPE html>
<?php
require_once( 'lib/dbutils.php');
require_once("photoalbum-common.php");
?>
<html>
<head>
<title>Cars Photos Home Page</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='photoalbum.css'>
<link rel='stylesheet' href='http://www.w3schools.com/lib/w3.css'>
<script src='http://code.jquery.com/jquery-1.11.3.min.js'></script>
<link rel='stylesheet' href='lib/lightbox2/css/lightbox.css'>
</head>
<body>
<header class='w3-container w3-blue w3-center'>
  <h1>My Cars Photos Album</h1>
  <h2>Timothy Lam</h2>
  <p>Here are some photographs of cars and descriptions.</p>
</header>

<?php
$pdo = connect();
logInOrOut( $pdo, 'users');


if ( $_SESSION['user'] != "anonymous") {
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
	
}

print "<div class='w3-container w3-center'>\n";
if ( $_SESSION['user'] == "anonymous") {
  print "  <a href='#id02' class='link'>Log in</a>\n";
} else {
  print "  User: ".$_SESSION['user']." Role: ".$_SESSION['role']." <a href='?logout=true' class='link'>Log out</a>\n";
}
print "</div>\n";




$sql = "SELECT * FROM `carphotographs` ORDER BY `photoid`";
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
  if ( $_SESSION['user'] != "anonymous") {
	  print "      <a href='?deletionid=".$row['photoid']."' class='link'>(Delete)</a>";
  }
  print "      </div>\n";
  print "    </div>\n";
  print "  </div>\n";  
}

print "</div>\n";

print "<div class='w3-container w3-center'>";
if($_SESSION['user'] != "anonymous") {
	print "<a href='#id01' class='link'>Add images</a>";
}
print"</div>";

?>



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
            <input type='file' name='uploadfile' class='w3-input'>
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
<div id='id02' class='w3-modal'>
  <div class='w3-modal-dialog'>
    <div class='w3-modal-content w3-card-4'>
      <header class='w3-container w3-teal'> 
        <a href='#' class='w3-closebtn'>&times;</a>
        <h2>Log in</h2>
      </header>
      <div class='w3-container'>
        <form action='?' method='post' id='loginform' class='w3-container'>          
          <div class='w3-group'>   
            <input type='text' name='username' size='16' class='w3-input'>
            <label class='w3-label'>Username</label>
          </div>
          <div class='w3-group'>   
            <input type='password' name='password' size='16' class='w3-input'>
            <label class='w3-label'>Password</label>
          </div>
          <input type='hidden' name='formid' value='login'>
          <input type='submit' value='Log in' id='loginbutton' class='w3-btn'>
        </form>
      </div>
      <footer class='w3-container w3-teal'>
        <p></p>
      </footer>
    </div>
  </div>
</div>

<footer class='w3-container w3-blue w3-padding-jumbo'>
	<div class='w3-container w3-center'>
		<a href='mailto:timothylam92@hotmail.co.uk' class='link'>Contact me</a>
	</div>
</footer>
<script src='lib/lightbox2/js/jquery.js'></script>
<script src='lib/lightbox2/js/lightbox.js'></script>
</body>
</html>