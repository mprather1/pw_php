<?php
  include 'database.php';
  
  $id = null;

  if(!empty($_GET['id'])) {
    $id = (int)$_REQUEST['id'];
  }
  
  if (null==$id) {
    echo 'Please include id in query...';
  }
  
  if (!empty($_POST)) {
    $name_error = null;
    $attribute_error = null;
    
    $name = $_POST['name'];
    $attribute = (int)$_POST['attribute'];

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
      $sql = "UPDATE models SET name=?, attribute=? WHERE id=?";
      $q = $pdo->prepare($sql);
      $q->execute(array($name,$attribute,$id));
      
      if ($q->rowCount()) {
        echo 'At least 1 row was updated...';
      } else {
        echo 'No rows were affected...';
      }
      
      Database::disconnect();
    } else {
      'Input error';
    }
  }
?>