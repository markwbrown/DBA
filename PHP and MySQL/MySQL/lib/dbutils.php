<?php

function connect() {
  $username = 'lamt3';
  $password = 'boiltow_';
  $mysqlhost = 'localhost';
  $dbname = $username;
  $pdo = new PDO('mysql:host='.$mysqlhost.';dbname='.$dbname.';charset=utf8', $username, $password);
  if ( $pdo) {
    // make errors throw exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  } else {
    die("Could not create PDO connection.");
  }
}

function tableExists( $pdo, $table) {
  $sql = "SHOW TABLES LIKE '$table'";
  return ( $pdo->query( $sql)->rowCount() > 0);    
}

function createDemoTable( $pdo) {  
  if ( !tableExists( $pdo, 'demotable')) {    
    $sql = "CREATE TABLE IF NOT EXISTS `demotable` (
      `idnumber` int(11) NOT NULL auto_increment,
      `firstname` varchar(255) NOT NULL,
      `lastname` varchar(255) NOT NULL,
      `age` int(11) NOT NULL,
      PRIMARY KEY  (`idnumber`)
    )";
    $pdo->exec( $sql);
    $sql = "INSERT INTO `demotable` 
      (`firstname`, `lastname`, `age`)
      VALUES
      ('John','Smith',23),
      ('Sue','Davis',13),
      ('Peter','Young',45),
      ('Alice','Brown',56),
      ('Frank','Gray',22),
      ('Betty','Redwood',27),
      ('Jane','Corner',29),
      ('Bob','Church',19),
      ('Mary','Collins',67),
      ('Herbert','River',42),
      ('Lucy','Hardy',13),
      ('Charles','Winter',81),
      ('Samantha','Weather',37),
      ('Karl','Saunders',34),
      ('Angela','Brown',35)"; 
    $pdo->exec( $sql);
  }
}

function dumpTable( $pdo, $table) {
  $sql = "SELECT * FROM `".$table."`";
  $stmt = $pdo->query( $sql);
  // get all rows in an array
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  print_r( $results);
}

function htmlTable( $pdo, $table) {
  $sql = "DESCRIBE `".$table."`";
  $stmt = $pdo->query( $sql);
  print "<table>";
  print "<tr>";
  foreach( $stmt as $v) {
    print "<th>".$v['Field']."</th>";
  }
  print "</tr>";
  
  $sql = "SELECT * FROM `".$table."`";
  // specify only an associative array to be returned
  $stmt = $pdo->query( $sql, PDO::FETCH_ASSOC);
  foreach( $stmt as $row) {
    print "<tr>";
    foreach( $row as $v) {
      print "<td>".$v."</td>";
    }
    print "</tr>";
  }
  print "</table>";  
}



?>
