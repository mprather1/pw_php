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
    echo "Successfully deleted 1 model...";
    Database::disconnect();    
  }
?>