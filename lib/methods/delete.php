<?php
  include_once 'lib/database.php';
  include_once 'lib/response.php';

  class DELETE
  {
    public static function request($id) {
      if (null==$id) {
        Response::getResponse('failure', 'Please include id in query...', null);
      } else {
        $pdo = Database::connect();
        $sql = "DELETE FROM models WHERE id=?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));

        if ($q->rowCount() === 1) {
          Response::getResponse(
            'success',
            'Successfully deleted ' . $q->rowCount() . ' row...',
            null
          );
        } else {
          Response::getResponse('failure', 'No rows were affected...', null);
        }

        Database::disconnect();
      }
    }
  }
?>
