<?php
  //GET으로 보내는 모든것을 배열로
  $array = $_GET;

  //줄바꿈 값을 \n => <br/>로 변경
  function nl2br2($string) {
    $string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
    return $string;
  }

  //없는 값(미입력 값)을 null값으로 변경해주는 함수
  function deleteNull($arr){
    foreach($arr as $key => $value){
      if($value == '선택' || $value ==''){
        $value = null;
        $arr["$key"] = $value;
      }
      echo "key = {$key}"."  value = {$value}"."<br/>";
    }
    return $arr;
  }

    // stdClass를 Array로 바꿔 주는 함수 이를 통해서 JWT토큰의 ID를 받아 올 수 있다.

    $decoded = JWT::decode($jwt, $secret_key, array('HS256'));
    $decodeArr = (array) $decoded;

    function objectToArray($stdClass) {
      if (is_object($stdClass)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $stdClass = get_object_vars($stdClass);
      }

      if (is_array($stdClass)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $stdClass);
      }
      else {
        // Return array
        return $stdClass;
      }
    }


?>
