<?php
  include_once('C:/Bitnami/wampstack-7.0.22-1/apache2/htdocs/vendor/autoload.php');
  use Firebase\JWT\JWT;

  $con = mysqli_connect("localhost", "root", "111111", "jggdev");
  if ( !$con ) {
    die( 'connect error: '.mysqli_connect_error() );
  }
  $companyID = $_GET["companyID"];
  $companyPW = $_GET["companyPW"];

  $statement = mysqli_prepare($con, "SELECT companyID, companyPW FROM COMPANY WHERE companyID = ? && companyPW = ?");
  mysqli_stmt_bind_param($statement, "ss", $companyID, $companyPW);
  if(!$statement) {
    die( 'mysql error : '.mysqli_error($con) );
  }
  if(!mysqli_stmt_execute($statement)){
    die( 'stmt error : '.mysqli_stmt_error($statement));
  }
  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $companyID, $companyPW);

  $response = array();
  $response["success"] = false;

  while(mysqli_stmt_fetch($statement)){
    $response["success"] = true;
    $response["companyID"] = $companyID;

    $tokenId = base64_encode("jggdevTokenID");
    $serverName = "serverName";

    $issuedAt = time();
    $notBefore = $issuedAt;
    $expire = $notBefore + 60*30;
    $secret_key = "jgg";
    $acco_id = $companyID;
    $data = array(
      'iss' => $serverName,
      'jti' => $tokenId,
      'iat' => $issuedAt,
      'nbf' => $notBefore,
      'exp' => $expire,
      'data' => [
        'acco_id' => $acco_id,
        ]

    );
    $jwt = JWT::encode($data, $secret_key);
    $response["token"] = $jwt;
  }
  echo json_encode($response);
  
?>
