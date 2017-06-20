<?php
  include 'database.php';
  
  $id = null;
  
  if(!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
  }
  
  if (null==$id) {
    echo 'Please include id in query...';
  }
  
  if (!empty($_POST)) {
    $name_error = null;
    $attribute_error = null;
    
    $name = $_REQUEST['name'];
    $attribute = $_REQUEST['attribute'];
    
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
      echo "Successfully updated 1 model...";
      Database::disconnect();
    } else {
      'Input error';
    }
  }
?>