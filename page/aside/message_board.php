<?php
  include "../../db/db_connector.php";
  date_default_timezone_set('Asia/Seoul');
  $send_id = $_GET["send_id"];
  $rv_id = $_GET["rv_id"];
  $user_id = $_GET["user_id"];
  $mode = $_GET["mode"];
  $regist_day = date("Y-m-d (H:i)");

  function message_insert($connect,$send_id,$rv_id,$user_id,$regist_day)
  {
    $content = $_GET["content"];
    $content = trim($content);
    $content = htmlspecialchars($content, ENT_QUOTES);
    $sql = "select name from member where id='$send_id'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    $send_name = $row["name"];

    $sql = "select name from member where id='$rv_id'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    $rv_name = $row["name"];

    $num_record = mysqli_num_rows($result);
    if($num_record)
  	{
      if ($send_id===$user_id) {
        $sql = "insert into message values(null,'$send_id','$rv_id','$send_name','$rv_name', '$content', '$regist_day')";
      }else {
        $sql = "insert into message values(null,'$rv_id','$send_id','$rv_name','$send_name', '$content', '$regist_day')";
      }
  		mysqli_query($connect, $sql);  // $sql 에 저장된 명령 실행
  	} else {
  		echo("
  			<script>
  			alert('수신 아이디가 잘못 되었습니다!');
  			history.go(-1)
  			</script>
  			");
  		exit;
  	}
    mysqli_close($connect);
    if($result==true){
    echo "1";
    }else{
      echo "0";
    }
  }
  function message_delete($connect,$send_id,$rv_id)
  {
    $num = $_GET["num"];
    $sql = "delete from message where send_id='$send_id' and rv_id='$rv_id' and num ='$num'";
    mysqli_query($connect,$sql);

    mysqli_close($connect);

  }
  switch ($mode) {
      case 'delete':
        message_delete($connect,$send_id,$rv_id);
        break;
      case 'insert':
        message_insert($connect,$send_id,$rv_id,$user_id,$regist_day);
        break;

      default:
        break;
    }
 ?>
