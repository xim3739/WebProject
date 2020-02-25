<?php

include "../../db/db_connector.php";

$id   = $_POST["inputId"];
$password = $_POST["inputPassword"];
$name = $_POST["inputName"];

$phone1 = $_POST["phone_one"];
$phone2 = $_POST["phone_two"];
$phone3 = $_POST["phone_three"];


$phone = $phone1."-".$phone2."-".$phone3;

$sql = "INSERT INTO `member`(`id`, `password`, `name`, `phone`)";
$sql .="VALUES('$id', '$password', '$name', '$phone')";

mysqli_query($connect, $sql);  // $sql 에 저장된 명령 실행
mysqli_close($connect);

echo "
	<script>

        opener.parent.location.reload();
        window.close();
	</script>
	";
 ?>
