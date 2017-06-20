<?php
  include 'database.php';
  $pdo = Database::connect();
  $sql = 'SELECT * FROM models';
  
  foreach ($pdo->query($sql) as $row) {
    echo json_encode($row);
  }
  
  Database::disconnect();
?>