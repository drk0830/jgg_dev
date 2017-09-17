<?php
  $crNum = $_POST["crNum"];
  $response = array();

  if(!isset($crNum) && empty($crNum)){
    die(' 사업자번호를 작성해 주십시오. ');
  }
  if(!preg_match('#^[0-9]{10}$#', $crNum)){
    die(' 사업자 등록번호를 올바른 형식으로 입력해 주십시오.');
  }

  $checkKey = "137137135";
  $sum = 0;
	$lastNumber = 0;

  for($i=0; $i<9; $i++) {
    //1~8자리 까지 자리 수 별 checkKey과 곱하기 한 값 더하기
		$temp = ($checkKey[$i] * $crNum[$i]);
    $sum += $temp;
    if($i==8){
      // 9번째 곱셈의 결과를 각 자리수를 더함
      $temp2 = (string)$temp;
      $sum += (int)$temp2[0] + (int)$temp2[1];
  		$lastNumber = (10 - ($sum % 10)) % 10; // (10 - (체크섬 % 10)) % 10
    }
  }
	if( $crNum[9] == $lastNumber ) { // 마지막숫자가 같으면 OK
		$response["success"] = true;
	}
	else {
		$response["success"] = false;
	}

  echo json_encode($response);

?>
