<?php

  include "../../db/db_connector.php";

  $id = $_POST["inputId"];

  $sql = "SELECT * FROM `member` WHERE `id` = '$id'";

  $result = mysqli_query($connect, $sql);
  $result_record = mysqli_num_rows($result);

  if($result_record){
    echo "1";
  }else{
    echo "0";
  }

  mysqli_close($connect);

 ?>
