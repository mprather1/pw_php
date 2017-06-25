<?php
  include 'lib/database.php';
  include 'lib/response.php';

  $pdo = Database::connect();
  $sql = 'SELECT id, name, attribute, created_at FROM models';
  $arr = array();

  foreach ($pdo->query($sql) as $row) {
    $entry = array('id' => $row['id'], 'name' => $row['name'], 'attribute' => $row['attribute'], 'created_at' => $row['created_at']);
    array_push($arr, $entry);
  }

  Response::getResponse(
    'success',
    'Successfully fetched all rows...',
    $arr
  );

  Database::disconnect();
?>
