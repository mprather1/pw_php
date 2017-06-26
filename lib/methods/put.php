<?php
  include_once 'lib/database.php';
  include_once 'lib/sanitizer.php';
  include_once 'lib/validator.php';
  include_once 'lib/response.php';

  class PUT
  {
    public static function request ($id, $put) {
      if (null==$id) {
        Response::getResponse('failure', 'Please include id in query...', null);
      }

      if (!empty($put)) {
        $name = Sanitizer::sanitize($put['name']);
        $attribute = Sanitizer::sanitize((int)$put['attribute']);

        if (Validator::validate($name, $attribute)) {
          $pdo = Database::connect();
          $sql = "UPDATE models SET name=?, attribute=? WHERE id=?";
          $q = $pdo->prepare($sql);
          $arr = array($name,$attribute,$id);
          $q->execute($arr);

          if ($q->rowCount() === 1) {
            Response::getResponse(
              'success',
              'Successfully updated ' . $q->rowCount() . ' rows...',
              array('name' => $arr[0], 'attribute' => $arr[1], 'id' => $arr[2])
            );
          } else {
            Response::getResponse('failure', 'No rows were affected...', null);
          }

          Database::disconnect();
        }
      } else {
        Response::getResponse('failure', 'Input error...', null);
      }
    }
  }
?>
