<?php

  $filePath = "uploads/";

  $filePath = $filePath . basename( $_FILES['userfile']['name']);
  if(move_uploaded_file($_FILES['userfile']['tmp_name'], $filePath)) {
      echo "success";
  } else{
      echo "fail";

?>
