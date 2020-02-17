<meta charset='utf-8'>
<?php
  include "../../db/db_connector_main.php";
  date_default_timezone_set('Asia/Seoul');
  $send_id = $_GET["send_id"];
  $rv_id = $_GET["rv_id"];
  $mode = $_GET["mode"];
  $regist_day = date("Y-m-d (H:i)");


  // $connect = mysqli_connect("localhost", "root", "123456", "test");
  function message_insert($connect,$send_id,$rv_id,$regist_day)
  {
    $content = $_POST["content"];
    $content = htmlspecialchars($content, ENT_QUOTES);
    $sql = "select * from member where id='$send_id'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    $name = $row["name"];
    $num_record = mysqli_num_rows($result);
    if($num_record)
  	{
  		$sql = "insert into message values(null,'$send_id','$rv_id', '$name', '$content', '$regist_day')";
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
        echo "<script>location.href = '../main/main.php?check_id=$rv_id'</script>";
        break;
      case 'insert':
        message_insert($connect,$send_id,$rv_id,$regist_day);
        echo "<script>location.href = '../main/main.php?check_id=$rv_id'</script>";
        break;

      default:
        // code...
        break;
    }
 ?>
