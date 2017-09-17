<?php
  include_once('./vendor/autoload.php');
  use Firebase\JWT\JWT;

  $tokenId = base64_encode("jwtTest");
  $issuedAt = time();
  $notBefore = $issuedAt;
  $expire = $notBefore + 60*20;
  $serverName = "drk0830";


  $secret_key = "jgg";

  $acco_id = "shurima";
  $server_no = 1;

  $data = array(
    'iss' => $serverName,
    'iat' => $issuedAt,
    'jti' => $tokenId,
    'nbf' => $notBefore,
    'exp' => $expire,
    'data' => [
       'acco_id' => $acco_id,
       'server_no' => $server_no,
    ]
  );

  $jwt = JWT::encode($data, $secret_key);

  $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

  print_r($decoded);

?>

<?php
require_once('vendor/autoload.php');

/*
 * Application setup, database connection, data sanitization and user  
 * validation routines are here.
 */
$config = Factory::fromFile('config/config.php', true); // Create a Zend Config Object

if ($credentialsAreValid) {

    $tokenId    = base64_encode(mcrypt_create_iv(32));
    $issuedAt   = time();
    $notBefore  = $issuedAt + 10;             //Adding 10 seconds
    $expire     = $notBefore + 60;            // Adding 60 seconds
    $serverName = $config->get('serverName'); // Retrieve the server name from config file

    /*
     * Create the token as an array
     */
    $data = [
        'iat'  => $issuedAt,         // Issued at: time when the token was generated
        'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
        'iss'  => $serverName,       // Issuer
        'nbf'  => $notBefore,        // Not before
        'exp'  => $expire,           // Expire
        'data' => [                  // Data related to the signer user
            'userId'   => $rs['id'], // userid from the users table
            'userName' => $username, // User name
        ]
    ];

     /*
      * More code here...
      */
}
?>
