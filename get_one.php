<?php
  include 'lib/database.php';
  include 'lib/response.php';

  $id = null;

  if(!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
    settype($id, 'integer');
  }

  if (null==$id) {
    Response::getResponse('failure', 'Please include id in query...', null);
  } else {
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
?>
