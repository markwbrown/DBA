<?php 
  require_once( 'lib/dbutils.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>DB Test</title>
<style>
  table {
    border-collapse: collapse;  
  }
  tr:nth-of-type(odd) {
    background: #ffff99;
  }
  tr:nth-of-type(even) {
    background: #dddd88;
  }
  th {
    background: #ffffff;
    border-bottom: solid 2px black;
    text-align: left;
    padding: 4px 16px;
  }
  td {
    padding: 4px 16px;
  }
</style>

</head>
<body>

<?php

$pdo = connect();

if ( $pdo) {
  print "<h1>Successfully connected!</h1>\n";
} else {
  print "<h1>Did not connect.</h1>\n";
}

createDemoTable( $pdo);
print "<pre>\n";
dumpTable( $pdo, 'demotable');
print "</pre>\n";

print"<h2>Result:</h2>";
htmlTable( $pdo, 'demotable');

?>

</body>
</html>
