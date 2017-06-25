<?php
  class Response
  {
    private static $response = array('status' => null, 'msg' => null);

    public static function getResponse($status, $msg, $body) {
      header('Content-Type: application/json');

      self::$response['status'] = $status;
      self::$response['msg'] = $msg;

      if ($body) {
        self::$response['body'] = $body;
      }

      echo json_encode(self::$response);
    }
  }
?>
