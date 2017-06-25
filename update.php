<?php
  include 'lib/database.php';
  include 'lib/sanitizer.php';

  $id = null;
  $valid = true;

  if(!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
    settype($id, 'integer');
  }

  if (null==$id) {
    echo 'Please include id in query...' . "\n";
    $valid = false;
  }

  if (!empty($_POST)) {
    $name_error = null;
    $attribute_error = null;

    $name = Sanitizer::sanitize($_POST['name']);
    $attribute = Sanitizer::sanitize((int)$_POST['attribute']);

    if (empty($name)) {
      $name_error = 'Please enter name...' . "\n";
      echo $name_error;
      $valid = false;
    }

    if (empty($attribute)) {
      $attribute_error = 'Please enter attribute...' . "\n";
      echo $attribute_error;
      $valid = false;
    }

    if ($valid) {
      $pdo = Database::connect();
      $sql = "UPDATE models SET name=?, attribute=? WHERE id=?";
      $q = $pdo->prepare($sql);
      $arr = array($name,$attribute,$id);
      $q->execute($arr);

      if ($q->rowCount() === 1) {
        $id = array_pop($arr);
        echo 'Updated 1 row...' . "\n";
        echo 'id: ' . $id  . ', values: ' . json_encode($arr);
      } else {
        echo 'No rows were affected...' . "\n";
      }

      Database::disconnect();
    } else {
      echo 'Input error...' . "\n";
    }
  }
?>
