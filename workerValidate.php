<?php
  $con = mysqli_connect("localhost", "root", "111111", "jggdev");
  if ( !$con ) {
    die( 'connect error: '.mysqli_connect_error() );
  }

  $workerID = $_POST["workerID"];

  $statement = mysqli_prepare($con, "SELECT workerID FROM WORKER WHERE workerID = ?");
  mysqli_stmt_bind_param($statement, "s", $workerID);
  if(!$statement) {
    die( 'mysql error : '.mysqli_error($con) );
  }
  if(!mysqli_stmt_execute($statement)){
    die( 'stmt error : '.mysqli_stmt_error($statement));
  }
  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $workerID);

  $response = array();
  $response["success"] = true;

  while(mysqli_stmt_fetch($statement)){
    $response["success"] = false;
    $response["workerID"] = $workerID;
  }

  echo json_encode($response);

?>
