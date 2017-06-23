<?php
  include 'lib/database.php';

  $pdo = Database::connect();
  $sql = 'SELECT id, name, attribute, created_at FROM models';
  $arr = array();

  foreach ($pdo->query($sql) as $row) {
    $entry = array('id' => $row['id'], 'name' => $row['name'], 'attribute' => $row['attribute'], 'created_at' => $row['created_at']);
    array_push($arr, $entry);
  }

  echo json_encode($arr);

  Database::disconnect();
?>
