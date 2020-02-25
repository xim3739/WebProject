<?php
$id   = $_GET["id"];
$pass = $_POST["inputPassword"];
$name = $_POST["inputName"];
$phone1 = $_POST["phone_one"];
$phone2 = $_POST["phone_two"];
$phone3 = $_POST["phone_three"];

    $phone = $phone1."-".$phone2."-".$phone3;

    include "../../db/db_connector.php";

    $sql = "UPDATE 'member' SET 'password'='$pass', 'name'='$name', 'phone'='$phone' WHERE 'id'='$id'";

    mysqli_query($con, $sql);

    mysqli_close($con);


?>
