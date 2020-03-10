<?php
  $send_id = $_GET["send_id"];
  $rv_id = $_GET["rv_id"];
  $user_id = $_GET["user_id"];
  include_once "../../db/db_connector.php";
  $sql = "select * from message where send_id = '$rv_id' or rv_id = '$rv_id' order by num asc ";
  $result = mysqli_query($connect,$sql);
  $total_record = mysqli_num_rows($result);
  if ($total_record === 0) {
    $sql = "select * from member where id = '$rv_id'";
    $result = mysqli_query($connect,$sql);
    $total_record = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    $rv_id=$row["id"];
    $title_name=$row["name"];
    $list=array();
    array_push($list,array("result"=>$total_record,"send_id"=>$send_id,"rv_id"=>$rv_id,"send_name"=>" ",
    "rv_name"=>" ","title_name"=>$title_name,"content"=>" ","regist_day"=>" "));
  }else {
    $sql = "select name from member where id = '$rv_id'";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($result);
    $title_name=$row["name"];
    $sql = "select * from message where send_id in ('$send_id','$rv_id') and rv_id in ('$rv_id','$send_id') order by num asc ";
    $result = mysqli_query($connect,$sql);
    $total_record = mysqli_num_rows($result);
    $list=array();
    for ($i=0; $i < $total_record; $i++) {
      mysqli_data_seek($result, $i);
      $row = mysqli_fetch_array($result);
      $regist_day = $row["regist_day"];
      $num=$row["num"];
      $send_id=$row["send_id"];
      $rv_id=$row["rv_id"];
      $send_name=$row["send_name"];
      $rv_name=$row["rv_name"];
      $content=$row["content"];
      $time = substr($regist_day,12,5);
      $time_hour = substr($time,0,2);
      $time_minute = substr($time,2,3);
      if ((int)$time_hour<12&&(int)$time_hour>0) {
        $time=$time_hour.$time_minute;
        $set_time="오전 ".$time;
      }else {
        $time=(string)((int)$time_hour-12).$time_minute;
        $set_time="오후 ".$time;
      }
      array_push($list,array("result"=>$total_record,"num"=>$num, "send_id"=>$send_id,"rv_id"=>$rv_id,
      "send_name"=>$send_name,"rv_name"=>$rv_name,"content"=>$content,"regist_day"=>$set_time,
      "title_name"=>$send_name,"user_id"=>$user_id));
    }
  }
  mysqli_close($connect);
  echo json_encode($list , JSON_UNESCAPED_UNICODE);
?>
