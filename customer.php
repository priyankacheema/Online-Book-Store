<html>
<head><title>Message Board</title></head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

try {
  $dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  print_r($dbh);
  $dbh->beginTransaction();
  $dbh->exec('delete from Customer where username="smith"');
  $dbh->exec('insert into Customer values("smith","405 Austin St, Arlington, TX","smith@cse.uta.edu","705-666","'. md5("mypass") . '")')
        or die(print_r($dbh->errorInfo(), true));
  $dbh->commit();

  $stmt = $dbh->prepare('select * from Customer');
  $stmt->execute();
  print "<pre>";
  while ($row = $stmt->fetch()) {
    print_r($row);
  }
  print "</pre>";
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
?>
</body>
</html>
