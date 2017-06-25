<?php
  include 'lib/database.php';

  $id = null;

  if(!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
    settype($id, 'integer');
  }

  if (null==$id) {
    echo 'Please include id in query...' . "\n";
  } else {
    $pdo = Database::connect();
    $sql = 'SELECT id, name, attribute, created_at FROM models WHERE id = ?';
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    
    if ($data === false) {
      echo 'Not found...';
    } else {
      echo json_encode($data);
    }
    
    Database::disconnect();
  }
?>
