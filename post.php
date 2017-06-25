<?php
  include 'lib/database.php';
  include 'lib/sanitizer.php';

  if (!empty($_POST)) {
    $name_error = null;
    $attribute_error = null;

    $name = Sanitizer::sanitize($_POST['name']);
    $attribute = Sanitizer::sanitize((int)$_POST['attribute']);

    $valid = true;
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
      $sql = 'INSERT INTO models (name, attribute) values(?, ?)';
      $q = $pdo->prepare($sql);
      $arr = array($name, $attribute);
      $q->execute($arr);
      
      if ($q->rowCount()) {
        echo 'Successfully created model...' . "\n";
        echo 'values: ' . json_encode($arr);
      } else {
        echo 'No rows were affected...' . "\n";
      }

      Database::disconnect();
    }
  } else {
    echo 'Input error...' . "\n";
  }
?>
