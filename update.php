<?php
  include 'lib/database.php';
  include 'lib/sanitizer.php';
  include 'lib/validator.php';
  include 'lib/response.php';
  
  $id = null;

  if(!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
    settype($id, 'integer');
  }

  if (null==$id) {
    Response::getResponse('failure', 'Please include id in query...', null);
  }

  if (!empty($_POST)) {
    $name = Sanitizer::sanitize($_POST['name']);
    $attribute = Sanitizer::sanitize((int)$_POST['attribute']);

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
    } else {
      Response::getResponse('failure', 'Input error...', null);
    }
  }
?>
