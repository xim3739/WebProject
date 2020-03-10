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
