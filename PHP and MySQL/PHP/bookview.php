<?php
require_once "lib/dbutils.php";
?>
<html>
<body>
<?php
$pdo = connect();
$results = $pdo->query("SELECT * FROM books WHERE bookid=".$_REQUEST['bookid']);
foreach( $results as $row) {
  print("<tr>");
  print("<h1>".$row['title']."</h1>");
  print("<table><tr>");
  print("<td valign='top'><img src=''></td>");
  print("<td>".$row['description']."</td>");
  print("</tr></table>");
  print("<ul>");
  print("<li>Publisher: ".$row['publisher']."</li>");
  if ( $row['instock'] == 1) {
    print("<li>In stock: Yes</li>");
  } else {
    print("<li>In stock: No</li>");
  }
  print("</ul>");
  print("<p><big><strong>PRICE: &pound;".$row['price']."</strong></big></p>");
} 
?>
<p><a href="books.php">Back to list</a></p>
</body>
</html>
