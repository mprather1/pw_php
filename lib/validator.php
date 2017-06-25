<?php
  class Validator
  {
    public static function validate($name, $attribute) {
      if (empty($name)) {
        Response::getResponse('failure', 'Please enter name...');
        return false;
      }

      if (empty($attribute)) {
        Response::getResponse('failure', 'Please enter attribute...');
        return false;
      }

      return true;      
    }
  }
?>
