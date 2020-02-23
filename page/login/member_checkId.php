<?php
  $id = $_POST["inputId"];

  $con = mysqli_connect("localhost", "root", "123456789", "joo_db");
  $sql = "select * from member where id = '$id'";

  $result = mysqli_query($con, $sql);
  $result_record = mysqli_num_rows($result);

  if($result_record){
    echo "1";
  }else{
    echo "0";
  }

  mysqli_close($con);

 ?>
