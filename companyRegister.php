<?php
  $con = mysqli_connect("localhost", "root", "111111", "jggdev");
  if ( !$con ) {
    die( 'connect error: '.mysqli_connect_error() );
  }

  $companyID = $_POST["companyID"];
  $companyPW = $_POST["companyPW"];
  $crNum = $_POST["crNum"];
  $companyName = $_POST["companyName"];
  $ceoName = $_POST["ceoName"];
  $companyAddr = $_POST["companyAddr"];
  $companyAddrDetale = $_POST["companyAddrDetale"];
  $elNum = $_POST["elNum"];

  $statement = mysqli_prepare($con, "INSERT INTO COMPANY(companyID, companyPW, crNum, companyName, ceoName, companyAddr, companyAddrDetale, elNum) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  mysqli_stmt_bind_param($statement, "ssssssss", $companyID, $companyPW, $crNum, $companyName, $ceoName, $companyAddr, $companyAddrDetale, $elNum);
  if(!$statement) {
    die( 'mysql error : '.mysqli_error($con) );
  }
  if(!mysqli_stmt_execute($statement)){
    die( 'stmt error : '.mysqli_stmt_error($statement));
  }

  $response = array();
  $response["success"] = true;

  echo json_encode($response);
  ?>
