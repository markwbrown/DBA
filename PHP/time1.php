<!DOCTYPE html>
<html>
<head>
<title><?php print time();?></title>
<link rel='stylesheet' href='http://www.w3schools.com/lib/w3.css'>
<style>
body{
	background: yellow;
	$words = background;
}

</style
</head>
<body>
<?php
print "<h1>The date is ";
print date("D, d M Y");
print "</h1>";
print "<h1>The time is: ";
print date("G:i:s a e P");
print "</h1>";
?>

<?php
$words = array( "happy", "sad", "<i>fruity</i>","joyful", "playful");
$r = rand(0,4);
print "<h2>Are you feeling ".$words[$r]."?</h2>\n";
$row = count($words,COUNT_RECURSIVE);
print "There are {$row} words in the list";
function timestable( $n) {
  $text = "<p>\n";
  for( $i = 1; $i < 13; $i++) {
    $text .= $i." times ".$n." is ".($i * $n)."<br>\n"; 
  }
  $text .= "</p>\n";
  return $text;
}
print timestable(7);
// code to print out all twelve times tables
print "<table class='w3-table-all'>\n";
print "<tr>\n";
print "<td>".timestable(1)."</td>\n";
print "<td>".timestable(2)."</td>\n";
print "<td>".timestable(3)."</td>\n";
print "<td>".timestable(4)."</td>\n";
print "<td>".timestable(5)."</td>\n";
print "<td>".timestable(6)."</td>\n";
print "</tr>\n";
print "<tr>\n";
print "<td>".timestable(7)."</td>\n";
print "<td>".timestable(8)."</td>\n";
print "<td>".timestable(9)."</td>\n";
print "<td>".timestable(10)."</td>\n";
print "<td>".timestable(11)."</td>\n";
print "<td>".timestable(12)."</td>\n";
print "</tr>\n";
print "</table>\n";
// code to print out LOTS of times tables
print "<table class='w3-table-all'>\n";
for( $i = 1; $i < 1000; $i += 6) {
  print "<tr>\n";
  for( $j = 0; $j < 7; $j++) {
    print "<td>".timestable($i + $j)."</td>\n";
  }
  print "</tr>\n";
}
print "</table>\n";
?>


</body>
</html>
