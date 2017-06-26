<?php
  include_once 'lib/database.php';
  include_once 'lib/sanitizer.php';
  include_once 'lib/validator.php';
  include_once 'lib/response.php';

  class POST
  {
    public static function request($post) {
      if (!empty($post)) {
        $name = Sanitizer::sanitize($post['name']);
        $attribute = Sanitizer::sanitize((int)$post['attribute']);

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
    }
  }
?>
