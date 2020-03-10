<?php
  session_start();
  if(!isset($_SESSION['username'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];

      $_SESSION['username'] = $name;
      $_SESSION['userid'] = $email;

      echo "$name";
      echo "$email";

      include "../../db/db_connector.php";

      $sql = "SELECT `id` FROM `member` WHERE `id` = '$email' ";
      $result = mysqli_query($connect, $sql);

      $num_record = mysqli_num_rows($result);
      //리절트 셋(result set)의 총 레코드 수를 반환합니다.
      // mysqli_data_seek 함수는 리절트 셋(result set)에서 원하는 순번의 데이터를 선택하는데 쓰입니다.
      //보통의 경우 mysqli_data_seek 함수로 원하는 순번을 선택하고 mysqli_fetch_row 로 선택한 데이터를 가져옵니다.
      if(!$num_record){

      $sql = "INSERT INTO `member`(`id`,`password`,`name`,`phone`) ";
      $sql .= "VALUES('$email','0000','$name','010-0000-0000')";

      mysqli_query($connect, $sql);  // $sql 에 저장된 명령 실행
      mysqli_close($connect);
      }

  } else {
    echo "error";
  }



 ?>
