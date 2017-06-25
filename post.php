<?php
  include 'lib/database.php';
  include 'lib/sanitizer.php';
  include 'lib/validator.php';
  include 'lib/response.php';

  if (!empty($_POST)) {
    $name = Sanitizer::sanitize($_POST['name']);
    $attribute = Sanitizer::sanitize((int)$_POST['attribute']);

    if (Validator::validate($name, $attribute)) {
      $pdo = Database::connect();
      $sql = 'INSERT INTO models (name, attribute) values(?, ?)';
      $q = $pdo->prepare($sql);
      $arr = array($name, $attribute);
      $q->execute($arr);

      if ($q->rowCount() === 1) {
        Response::getResponse(
          'success',
          'Successfully created ' . $q->rowCount() . ' rows...',
          array('name' => $arr[0], 'attribute' => $arr[1])
        );
      } else {
        Response::getResponse('failure', 'Failed to create row...', null);
      }

      Database::disconnect();
    }
  } else {
    Response::getResponse('failure', 'Input error...', null);
  }
?>
