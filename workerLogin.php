<?php
  include_once('C:/Bitnami/wampstack-7.0.22-1/apache2/htdocs/vendor/autoload.php');
  use Firebase\JWT\JWT;

  $con = mysqli_connect("localhost", "root", "111111", "jggdev");
  if ( !$con ) {
    die( 'connect error: '.mysqli_connect_error() );
  }
  $workerID = $_POST["workerID"];
  $workerPW = $_POST["workerPW"];

  $statement = mysqli_prepare($con, "SELECT workerID, workerPW FROM WORKER WHERE workerID = ? && workerPW = ?");
  mysqli_stmt_bind_param($statement, "ss", $workerID, $workerPW);
  if(!$statement) {
    die( 'mysql error : '.mysqli_error($con) );
  }
  if(!mysqli_stmt_execute($statement)){
    die( 'stmt error : '.mysqli_stmt_error($statement));
  }
  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $workerID, $workerPW);

  $response = array();
  $response["success"] = false;

  while(mysqli_stmt_fetch($statement)){
    $response["success"] = true;
    $response["workerID"] = $workerID;

    $tokenId = base64_encode("jggdevTokenID");
    $serverName = "serverName";

    $issuedAt = time();
    $notBefore = $issuedAt;
    $expire = $notBefore + 60*30;
    $secret_key = "jgg";
    $acco_id = $workerID;
    $data = array(
      'iss' => $serverName,
      'jti' => $tokenId,
      'iat' => $issuedAt,
      'nbf' => $notBefore,
      'exp' => $expire,
      'acco_id' => $acco_id,
    );
    $jwt = JWT::encode($data, $secret_key);
    $response["token"] = $jwt;
  }
  echo json_encode($response);

?>
