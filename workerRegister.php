<?php
  $con = mysqli_connect("localhost", "root", "111111", "jggdev");
  if ( !$con ) {
    die( 'connect error: '.mysqli_connect_error() );
  }

  $postArr = checkNull($_POST);

  $workerID = $postArr["workerID"];  $workerPW = $postArr["workerPW"];  $workerName = $postArr["workerName"];  $workerAge = $postArr["workerAge"];
  $mainPart = $postArr["mainPart"];  $middlePart = $postArr["middlePart"];
  $careerPart1 = $postArr["careerPart1"];  $careerPeriod1 = $postArr["careerPeriod1"];
  $careerPart2 = $postArr["careerPart2"];  $careerPeriod2 = $postArr["careerPeriod2"];
  $certiPart1 = $postArr["certiPart1"];  $certiNum1 = $postArr["certiNum1"];
  $certiPart2 = $postArr["certiPart2"];  $certiNum2 = $postArr["certiNum2"];

  $query = "INSERT INTO WORKER(workerID, workerPW, workerName, workerAge, mainPart, middlePart,
    careerPart1, careerPeriod1, careerPart2, careerPeriod2, certiPart1, certiNum1, certiPart2, certiNum2)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $statement = mysqli_prepare($con, $query);

  mysqli_stmt_bind_param($statement, "sssissssssssss", $workerID, $workerPW, $workerName, $workerAge, $mainPart, $middlePart,
    $careerPart1, $careerPeriod1, $careerPart2, $careerPeriod2, $certiPart1, $certiNum1, $certiPart2, $certiNum2);

  if(!$statement) {
    die( 'mysql error : '.mysqli_error($con) );
  }
  if(!mysqli_stmt_execute($statement)){
    die( 'stmt error : '.mysqli_stmt_error($statement));
  }

  $response = array();
  $response["success"] = true;

  echo json_encode($response);

  function checkNull($array){
    foreach($array as $key => $value){
      if($value == '선택' || $value ==''){
        $value = null;
        $array["$key"] = $value;
      }
    }
    return $array;
  }
  ?>
