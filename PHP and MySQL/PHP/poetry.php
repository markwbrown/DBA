<html>
<head>
<title>Poetry</title>
</head>
<body>
<?php

session_start();

if ( isset($_POST['firstname'])) {
  $_SESSION['firstname'] = $_POST['firstname'];
}
if ( isset($_POST['lastname'])) {
  $_SESSION['lastname'] = $_POST['lastname'];
}

print "<h1>A Poem for ".$_SESSION['firstname']." ".$_SESSION['lastname']."</h1>\n";

$nouns = array( "cat", "dog", "chimney", "floor", "bicycle", "cheese", "tree", "cloud", "sun", "moon", "balloon");
$verbs = array( "ran", "cried", "laughed", "loved", "ate", "stole", "bounced", "shone", "walked", "awoke");
$adj = array( "brown", "big", "small", "shy", "happy", "old", "young", "brave", "wise", "ancient", "orange", "kind");
$adv = array( "quickly", "slowly", "gracefully", "carefully", "enthusiastically", "foolishly", "forgetfully");

print "<p>";
for( $i = 0; $i < 4; $i++) {
  print "The ".$adj[ rand(0, count($adj)- 1)]." ".$nouns[ rand(0, count($nouns)- 1)]." ".$adv[ rand(0, count($adv)- 1)]." ".$verbs[ rand(0, count($verbs)- 1)]."<br>\n";
}
print "</p>\n";

print "<p><a href='?'>Another</a></p>\n";
?>
</body>
</html>
