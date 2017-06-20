<?php
  include 'database.php';
  if (!empty($_POST)) {
    $name_error = null;
    $attribute_error = null;
    
    $name = $_POST['name'];
    $attribute = $_POST['attribute'];
    
    $valid = true;
    if (empty($name)) {
      $name_error = 'Please enter name...';
      echo $name_error;
      $valid = false;
    }
    
    if (empty($attribute)) {
      $attribute_error = 'Please enter attribute...';
      echo $attribute_error;
      $valid = false;
    }    
    
    if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = 'INSERT INTO models (name, attribute) values(?, ?)';
      $q = $pdo->prepare($sql);
      $q->execute(array($name,$attribute));
      echo 'Successfully added 1 model...';
      Database::disconnect();
    }
  } else {
    echo 'Input error...';
  }
?>