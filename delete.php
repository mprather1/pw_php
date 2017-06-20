<?php
  include 'database.php';
  if (!empty($_POST)) {
    $id = $_POST['id'];
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM models WHERE id=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    echo "Successfully deleted 1 model...";
    Database::disconnect();
  }
?>