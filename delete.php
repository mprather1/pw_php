<?php
  include 'database.php';
  
  $id = null;
  
  if (!empty($_GET)) {
    $id = $_GET['id'];
    settype($id, 'integer');
  }
  
  if (null==$id) {
    echo 'Please include id in query...' . "\n";
  } else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM models WHERE id=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    
    if ($q->rowCount()) {
      echo 'At least 1 row was deleted...' . "\n";
    } else {
      echo 'No rows were affected...' . "\n";
    }
    
    Database::disconnect();    
  }
?>