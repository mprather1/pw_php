<?php
class Database
{
  private static $db_name = 'development';
  private static $db_host = 'localhost';
  private static $db_user = 'mike';
  private static $db_password = 'password';
  
  private static $cont = null;
  
  private function __construct() {
    die('Not allowed....');
  }
  
  public static function connect() {
    if ( null == self::$cont) {
      try {
        self::$cont = new PDO( "mysql:host=".self::$db_host.";"."dbname=".self::$db_name, self::$db_user, self::$db_password);
      } catch (PDOExeption $e) {
        die($e->getMessage());
      }
    }
    return self::$cont;
  }
  
  public static function disconnect() {
    self::$cont = null;
  }
}
?>