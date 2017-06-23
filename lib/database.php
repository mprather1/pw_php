<?php
include 'env.php';

class Database
{
  private static $db_name = null;
  private static $db_host = null;
  private static $db_user = null;
  private static $db_password = null;

  private static $conn = null;

  private function __construct() {
    die('Not allowed....');
  }

  public static function connect() {
    if (self::$db_name === null) {
      self::$db_name = getenv('DB_NAME');
    }

    if (self::$db_host === null) {
      self::$db_host = getenv('DB_HOST');
    }

    if (self::$db_user === null) {
      self::$db_user = getenv('DB_USER');
    }  

    if (self::$db_password === null) {
      self::$db_password = getenv('DB_PASSWORD');
    }

    if ( null == self::$conn) {
      try {
        self::$conn = new PDO( "mysql:host=".self::$db_host.";"."dbname=".self::$db_name, self::$db_user, self::$db_password);
        self::$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
      } catch (PDOExeption $e) {
        die($e->getMessage());
      }
    }
    return self::$conn;
  }

  public static function disconnect() {
    self::$conn = null;
  }
}
?>
