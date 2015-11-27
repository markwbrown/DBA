<!DOCTYPE html>
<?php
require_once( 'lib/dbutils.php');
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
  print "      </div>\n";
  print "    </div>\n";
  print "  </div>\n";  
}

print "</div>\n";


?>
<footer class='w3-container w3-orange w3-padding-jumbo'>
	<div class='w3-container w3-center'>
		<a href='mailto:childm@lsbu.ac.uk' class='link'>Contact me</a>
	</div>
</footer>
<script src='lib/lightbox2/js/jquery.js'></script>
<script src='lib/lightbox2/js/lightbox.js'></script>
</body>
</html>
        
