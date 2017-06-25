<?php
  include 'lib/database.php';

  $id = null;

  if (!empty($_GET)) {
    $id = $_GET['id'];
    settype($id, 'integer');
  }

  if (null==$id) {
    echo 'Please include id in query...' . "\n";
  } else {
    $pdo = Database::connect();
    $sql = "DELETE FROM models WHERE id=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    
    if ($q->rowCount() === 1) {
      echo 'Deleted 1 row...' . "\n";
      echo 'id: ' . $id;
    } else {
      echo 'No rows were affected...' . "\n";
    }
  
    Database::disconnect();
  }
?>
