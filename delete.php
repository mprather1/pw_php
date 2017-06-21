<?php
  include 'database.php';
  if (!empty($_POST)) {
    $id = (int)$_POST['id'];
  }
  if (null==$id) {
    echo 'Please include id in query...';
  } else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM models WHERE id=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    
    if ($q->rowCount()) {
      echo 'At least 1 row was deleted...';
    } else {
      echo 'No rows were affected...';
    }
    
    Database::disconnect();    
  }
?>