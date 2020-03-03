<?php
  $send_id = $_GET["send_id"];
  $rv_id = $_GET["rv_id"];
  $user_id = $_GET["user_id"];
  include_once "../../db/db_connector.php";
  $sql = "select distinct send_id,rv_id from message";
  $result = mysqli_query($connect,$sql);
  $total_record = mysqli_num_rows($result);
  $list=array();
  for ($i=0; $i <$total_record ; $i++) {
    $row = mysqli_fetch_array($result);
    $send_id= $row["send_id"];
    $rv_id= $row["rv_id"];
    array_push($list,array("result"=>$total_record,"send_id"=>$send_id,
    "rv_id"=>$rv_id,"user_id"=>$user_id));
  }
  mysqli_close($connect);
  echo json_encode($list , JSON_UNESCAPED_UNICODE);
 ?>
