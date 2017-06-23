<?php
  include 'database.php';
  
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
    
    $name = $_POST['name'];
    $attribute = (int)$_POST['attribute'];

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
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE models SET name=?, attribute=? WHERE id=?";
      $q = $pdo->prepare($sql);
      $q->execute(array($name,$attribute,$id));
      
      if ($q->rowCount()) {
        echo 'At least 1 row was updated...' . "\n";
      } else {
        echo 'No rows were affected...' . "\n";
      }
      
      Database::disconnect();
    } else {
      echo 'Input error';
    }
  }
?>