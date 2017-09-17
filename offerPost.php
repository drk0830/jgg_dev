<?php 
  $con = mysqli_connect("localhost", "root", "111111", "jggdev");
  if ( !$con ) {
    die( 'connect error: '.mysqli_connect_error() );
  }

  $postArr = checkNull($_POST);

  $workTitle = $postArr["workTitle"];  $workTermStart = $postArr["workTermStart"];  $workTermFinish = $postArr["workTermFinish"];
  $workLocation = $postArr["workLocation"]; $workLocationDetale = $postArr["workLocationDetale"];  $scaleGround = $postArr["scaleGround"];
  $scaleUnderground = $postArr["scaleUnderground"];  $careerPart = $postArr["careerPart"];  $careerPeriod = $postArr["careerPeriod"];
  $certi = $postArr["certi"];  $deadLine = $postArr["deadLine"];  $payroll = $postArr["payroll"];
  $workPart1 = $postArr["workPart1"]; $workPay1 = $postArr["workPay1"]; $workNum1 = $postArr["workNum1"];
  $workPart2 = $postArr["workPart2"]; $workPay2 = $postArr["workPay2"]; $workNum2 = $postArr["workNum2"];
  $workPart3 = $postArr["workPart3"]; $workPay3 = $postArr["workPay3"]; $workNum3 = $postArr["workNum3"];
  $workPart4 = $postArr["workPart4"]; $workPay4 = $postArr["workPay4"]; $workNum4 = $postArr["workNum4"];
  $workPart5 = $postArr["workPart5"]; $workPay5 = $postArr["workPay5"]; $workNum5 = $postArr["workNum5"];
  $workPart6 = $postArr["workPart6"]; $workPay6 = $postArr["workPay6"]; $workNum6 = $postArr["workNum6"];
  $staffPhone1 = $postArr["staffPhone1"];  $staffPhone2 = $postArr["staffPhone2"];  $staffPhone3 = $postArr["staffPhone3"];
  $staffPhone4 = $postArr["staffPhone4"];  $staffPhone5 = $postArr["staffPhone5"];  $staffPhone6 = $postArr["staffPhone6"];
  $staffPhone7 = $postArr["staffPhone7"];  $staffPhone8 = $postArr["staffPhone8"];  $staffPhone9 = $postArr["staffPhone9"];  $staffPhone10 = $postArr["staffPhone10"];
  $information = $postArr["information"];  $construction = $postArr["construction"]; $postState = $postArr["postState"];


/*
* 입력 값 없는 것들 추가 처리(Pay, Num, information, construction 등)
* 많은 양의 스트링 text 형식(엔터가 있거나 한 문장 형식이 아니라 글 형식일 때 처리를 어떻게 해야할 지)
* 사무실 Server로 어떻게 접속 할 수 있는지(ip를 통한 접속이나 ftp 서버로 오픈하는 방법 확인 하기)
*/


  //43개의 param....
  $query = "INSERT INTO POST(workTitle, workTermStart, workTermFinish, workLocation, workLocationDetale,
              scaleGround, scaleUnderground, careerPart, careerPeriod, certi, deadLine, payroll,
              workPart1, workPay1, workNum1, workPart2, workPay2, workNum2, workPart3, workPay3, workNum3,
              workPart4, workPay4, workNum4, workPart5, workPay5, workNum5, workPart6, workPay6, workNum6,
              staffPhone1, staffPhone2, staffPhone3, staffPhone4, staffPhone5, staffPhone6, staffPhone7, staffPhone8, staffPhone9, staffPhone10,
              information, construction, postState)
              VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";

  $statement = mysqli_prepare($con, $query);

  mysqli_stmt_bind_param($statement, "ssssssssssssssississississississssssssssssi",
    $workTitle, $workTermStart, $workTermFinish, $workLocation, $workLocationDetale, $scaleGround, $scaleUnderground,
    $careerPart, $careerPeriod, $certi, $deadLine, $payroll,
    $workPart1, $workPay1, $workNum1, $workPart2, $workPay2, $workNum2, $workPart3, $workPay3, $workNum3,
    $workPart4, $workPay4, $workNum4, $workPart5, $workPay5, $workNum5, $workPart6, $workPay6, $workNum6,
    $staffPhone1, $staffPhone2, $staffPhone3, $staffPhone4, $staffPhone5, $staffPhone6, $staffPhone7, $staffPhone8, $staffPhone9, $staffPhone10,
    $information, $construction, $postState);

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
