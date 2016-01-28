<?php

function connect() {
  $username = 'lamt3';
  $password = '3215402';
  $mysqlhost = 'bcimsql.lsbu.ac.uk';
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

function importTable( $pdo, $table, $file) {
  $data = file( $file, FILE_IGNORE_NEW_LINES);
  $numLines = count( $data);
  $columns = explode("\t",$data[0]);
  for( $i = 1; $i < $numLines; $i++) {
    $values = explode("\t", $data[$i]);
    $sql = "INSERT INTO `$table` SET ";
    for( $j = 0; $j < count( $columns); $j++) {
      if ( $j > 0) {
        $sql .= ", ";
      }      
      $sql .= "`".$columns[$j]."`=";
      // permit specifying NULL values with the word NULL
      if ( $values[$j] == 'NULL') {
        $sql .= "NULL";  
      } else {
        $sql .= "'".$values[$j]."'";  
      }      
    }
    $pdo->exec( $sql);
  }
  print ($numLines - 1)." rows imported into table $table.";
}

function setUpSession() {
  session_start();
  if ( !isset( $_SESSION['user'])) {
    $_SESSION['user'] = "anonymous";
  }
  if ( !isset( $_SESSION['role'])) {  
    $_SESSION['role'] = "anonymous";
  }
}

/*
Session variables are set to anonymous IF THEY HAVE NO VALUE or if
a log in attempt is made and the credentials fail, or if a logout
attempt is made. If nothing is attempted and values are set, they
stay the same. 
*/
function logInOrOut( $pdo, $usersTable) {
  setUpSession();
  
  $action = "none";
  if ( isset( $_POST['formid']) && $_POST['formid'] == 'login') {
    $stmt = $pdo->prepare("SELECT * FROM `$usersTable` WHERE user=? AND password=?");
    $stmt->execute( array( $_POST['username'], $_POST['password']));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ( count( $rows) == 1) {
      $_SESSION['user'] = $rows[0]['user'];
      $_SESSION['role'] = $rows[0]['role'];
      $action = "login success";
    } else if ( count( $rows) == 0) {
      $action = "login failure";
      $_SESSION['user'] = "anonymous";
      $_SESSION['role'] = "anonymous";
    } else {
      die( "System error: ".count( $rows)." rows in database for user ".$_POST['username']);
    }
  } else if ( isset( $_REQUEST['logout'])) {
    $_SESSION['user'] = "anonymous";
    $_SESSION['role'] = "anonymous";
    $action = "logout";
  }

  return $action;
}

function jsonTable( $pdo, $table, $whereOrder = "") {
  $sql = "SELECT * FROM `".$table."`";
  if ( $whereOrder != "") {
    $sql .= " ".$whereOrder;
  }
  // specify only an associative array to be returned
  $stmt = $pdo->query( $sql, PDO::FETCH_ASSOC);
  print json_encode( $stmt->fetchAll(PDO::FETCH_ASSOC));
}

?>
