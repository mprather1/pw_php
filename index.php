<?php
  include 'lib/methods/get.php';
  include 'lib/methods/post.php';
  include 'lib/methods/put.php';
  include 'lib/methods/delete.php';

  $method = $_SERVER['REQUEST_METHOD'];

  $id = null;

  if(!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
    settype($id, 'integer');
  }  

  if ($method === "GET" && !$id) {
    GET::request_all();
  }

  if ($method === 'GET' && $id) {
    GET::request_one($id);
  }

  if ($method === 'POST') {
    POST::request($_POST);
  }

  if ($method === 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
      PUT::request($id, $data);
  }

  if ($method === 'DELETE') {
    DELETE::request($id);
  }
?>
