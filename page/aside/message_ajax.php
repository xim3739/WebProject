<?php
  $check_id = $_GET["check_id"];
  $now_id = $_GET["now_id"];
  $connect = mysqli_connect("localhost","root","123456","test");
  $sql = "select * from message where send_id in ('$check_id','$now_id') and rv_id in ('$now_id','$check_id') order by num asc ";
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
    $name=$row["name"];
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
    array_push($list,array("result"=>$total_record,"num"=>$num, "send_id"=>$send_id,"rv_id"=>$rv_id,"name"=>$name,
    "content"=>$content,"regist_day"=>$set_time,"now_id"=>$now_id));
  }
  mysqli_close($connect);
  echo json_encode($list , JSON_UNESCAPED_UNICODE);
?>
