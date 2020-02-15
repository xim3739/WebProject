<meta charset='utf-8'>
<?php
  date_default_timezone_set('Asia/Seoul');
  $send_id = $_GET["send_id"];
  $rv_id = $_GET["rv_id"];


  $content = $_POST["content"];
  $content = htmlspecialchars($content, ENT_QUOTES);
  $regist_day = date("Y-m-d (H:i)");
  $con = mysqli_connect("localhost", "root", "123456", "test");
  $sql = "select * from member where id='$send_id'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $name = $row["name"];
  $num_record = mysqli_num_rows($result);
  if($num_record)
	{
		$sql = "insert into message values(null,'$send_id','$rv_id', '$name', '$content', '$regist_day')";
		mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
	} else {
		echo("
			<script>
			alert('수신 아이디가 잘못 되었습니다!');
			history.go(-1)
			</script>
			");
		exit;
	}
  mysqli_close($con);
  echo "<script>location.href = 'test.php?check_id=$rv_id'</script>";
 ?>
