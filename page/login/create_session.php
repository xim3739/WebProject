<?php
  session_start();
  if(!isset($_SESSION['username'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = 

      $_SESSION['username'] = $name;
      $_SESSION['userid'] = $email;

      echo "$name";
      echo "$email";

      include "../../db/db_connector.php";

      $sql = "SELECT `id` FROM `member` WHERE `id` = '$email' ";
      $result = mysqli_query($connect, $sql);

      $num_record = mysqli_num_rows($result);

      if(!$num_record){

      $sql = "INSERT INTO `member`(`id`,`name`) ";
      $sql .= "VALUES('$email','$name')";

      mysqli_query($connect, $sql);  // $sql 에 저장된 명령 실행
      mysqli_close($connect);
      }

  } else {
    echo "error";
  }



 ?>
