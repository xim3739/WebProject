<?php
$id   = $_POST["id"];
$password = $_POST["password"];
$name = $_POST["name"];

$phone1 = $_POST["phone_one"];
$phone2 = $_POST["phone_two"];
$phone3 = $_POST["phone_three"];


$phone = $phone1."-".$phone2."-".$phone3;

$con = mysqli_connect("localhost", "root", "123456789", "test");

    $sql = "insert into member(id, password, name, phone) ";
    $sql .= "values('$id', '$password', '$name', '$phone')";

    mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);

    echo "
	      <script>

            opener.parent.location.reload();
            window.close();
	      </script>
	  ";
 ?>
