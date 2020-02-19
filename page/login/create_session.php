<?php
  session_start();
  if(!isset($_SESSION['username'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];

      $_SESSION['username'] = $name;
      $_SESSION['userid'] = $email;

      echo "$name";
      echo "$email";


      $con = mysqli_connect("localhost", "root", "123456789", "test");
      $sql = "select id from member where id = '$email' ";
      $result = mysqli_query($con, $sql);

      $num_record = mysqli_num_rows($result);

      if(!$num_record){


      $sql = "insert into member(id,name) ";
      $sql .= "values('$email','$name')";

      mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
      mysqli_close($con);
      }

  } else {
    echo "error";
  }



 ?>
