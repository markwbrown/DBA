<?php
require_once "lib/dbutils.php";
?>
<html>
<body>
<h2 align="center">Books</h2>
<table border="1" width="100%">
  <tr>
    <td width="10%" align="center"><big><b>Book id </b></big></td>
    <td width="30%" align="center"><big><b>Title</b></big></td>
    <td width="20%" align="center"><big><b>Publisher</b></big></td>
    <td width="20%" align="center"><big><b>Price</b></big></td> 
    <td width="20%" align="center"><big><b>In stock</b></big></td> 
  </tr>
<?php
  $pdo = connect();
  $results = $pdo->query("SELECT * FROM books", PDO::FETCH_ASSOC);
  foreach( $results as $row) {
    print("<tr>");
    print("<td>".$row['bookid']."</td>");
    print("<td>".$row['title']."</td>");
    print("<td>".$row['publisher']."</td>");
    print("<td>".$row['price']."</td>");
    print("<td>".$row['instock']."</td>");
    print("</tr>");
  };
?>
</table>
</body>
</html>
