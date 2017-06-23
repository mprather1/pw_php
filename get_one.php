<?php
  include 'database.php';
  
  $id = null;
  
  if(!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
    settype($id, 'integer');
  }
  
  if (null==$id) {
    echo 'Please include id in query...' . "\n";
  } else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT id, name, attribute, created_at FROM models WHERE id = ?';
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);
    Database::disconnect();
  }
?>