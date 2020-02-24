<?php
$id   = $_GET["id"];
$pass = $_POST["inputPassword"];
$name = $_POST["inputName"];
$phone1 = $_POST["phone_one"];
$phone2 = $_POST["phone_two"];
$phone3 = $_POST["phone_three"];

    $phone = $phone1."-".$phone2."-".$phone3;

    $con = mysqli_connect("localhost", "root", "123456", "joo_db");
    $sql = "update member set password='$pass', name='$name', phone='$phone'";
    $sql .= " where id='$id'";
    mysqli_query($con, $sql);

    mysqli_close($con);


?>
