<?php

  include_once 'lib/database.php';
  include_once 'lib/response.php';

  class GET
  {
    public static function request_all () {
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
    }

    public static function request_one ($id) {
      $pdo = Database::connect();
      $sql = 'SELECT id, name, attribute, created_at FROM models WHERE id = ?';
      $q = $pdo->prepare($sql);
      $q->execute(array($id));
      $data = $q->fetch(PDO::FETCH_ASSOC);

      if ($data === false) {
        Response::getResponse('failure', 'Not found...', null);
      } else {
        Response::getResponse(
          'success',
          'Successfully fetched row with id -> ' . $id . '...',
          $data
        );
      }

      Database::disconnect();
    }
  }
?>
