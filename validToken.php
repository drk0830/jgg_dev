<?php
  $token = $_POST["token"];
  $decoded = JWT::decode($jwt, $secret_key, array('HS256'));
  $decodeArr = (array) $decoded;
  $tokenData = (array)$decodeArr["data"];
  $validAccount = $tokenData["acco_id"];
  
  $con = mysqli_connect("localhost", "root", "111111", "jggdev");
  if ( !$con ) {
    die( 'connect error: '.mysqli_connect_error() );
  }



?>
