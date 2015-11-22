<!DOCTYPE html>
<html>
<head>
<title>Feelings</title>
<link rel='stylesheet' href='http://www.w3schools.com/lib/w3.css'>
</head>
<style>
<?php
print "img{";
print "width:100%";
print "}";
?>
</style>
<body>
<header class="w3-container w3-purple">
<?php
if ( isset( $_GET['feeling']) and $_GET['feeling']=='happy') {
  print "<h1>Hurrah, I'm so glad you're feeling happy!</h1>\n";
} 
else if (isset($_GET['feeling']) and $_GET['feeling']=='sad'){
  print "<h1>Oh dear, why are you feeling sad?</h1>\n";
}
else if (isset($_GET['feeling']) and $_GET['feeling']=='fruity') {
	print"<h1>Ooh la la, mais les fruits sont bons!</h1>\n";
} 
else if(isset($_GET['feeling']) and $_GET['feeling']=='Anger') {
	print "<h1>Oh dear, why are you feeling Angry!</h1>\n";
} else {
	print "<h1> so tell me how you feel today?</h1>\n";
}
?>
</header>

<?php

print "<div class='w3-content w3-image'>";
if ($_GET['feeling']=='happy'){
	print "\n<img src='images/happy.jpg' class='w3-image'>";
	print "\n<div class='w3-title w3-text-white'>";
	print date("G:i l jS Y");
	print"\n</div>";
	}

else if ($_GET['feeling']=='sad'){
	print "\n<img src='images/sad.jpg' class='w3-image'>";
	print "\n<div class='w3-title w3-text-white'>";
	print date("G:i l jS Y");
	print"\n</div>";
	}
else if ($_GET['feeling']=='fruity'){
	print "\n<img src='images/fruity.jpg' class='w3-image'>";
	print "\n<div class='w3-title w3-text-white'>";
	print date("G:i l jS Y");
	print"\n</div>";
	}
else if ($_GET['feeling']=='Anger'){
	print "\n<img src='images/Anger.jpg' class='w3-image'>";
	print "\n<div class='w3-title w3-text-white'>";
	print date("G:i l jS Y");
	print"\n</div>";
}
print"\n</div>";

?>



<footer class='w3-container w3-purple w3-row w3-row-padding w3-large'>
<?php
print "<div class='w3-card-16 w3-white w3-third w3-center'>";
print "\n<a href='?feeling=happy'>Click here to feel happy!</a>";
print "\n</div>";
print "\n<div class='w3-card-16 w3-white w3-third w3-center'>";
print "\n<a href='?feeling=sad'>Click here to feel sad!</a>";
print "\n</div>";
print "\n<div class='w3-card-16 w3-white w3-third w3-center'>";
print "\n<a href='?feeling=fruity'>Click here to feel fruity!</a>";
print "\n</div>";
print "\n<div class='w3-card-16 w3-white w3-third w3-center'>";
print "\n<a href='?feeling=Anger'>Click here to feel Angry!</a>";
print "\n</div>";
?>
</footer>

</body>
</html>