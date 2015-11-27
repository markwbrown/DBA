<?php
require_once("lib/dbutils.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Log in demo</title>
</head>
<body>
<?php
$pdo = connect();
logInOrOut( $pdo, 'users');

if ( $_SESSION['user'] == 'anonymous') {
?>
<h1>Please log in to use this site</h1>
<form action='' method='post'>  
  Username <input type='text' name='username'>
  Password <input type='password' name='password'>
  <input type='hidden' name='formid' value='login'>
  <input type='submit'>
</form>
<?php
} else {
  print "<h1>You are logged in as ".$_SESSION['user']."</h1>\n";
  
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
  
  print "<p><a href='?logout=true'>Log out</a></p>\n";
}
?>
</body>
</html>

