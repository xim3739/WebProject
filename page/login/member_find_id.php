<?php
include "../../db/db_connector.php";
if ($_POST["name"] == "" || $_POST["phone_two"] == "" || $_POST["phone_three"] == "") {
    echo '<script> alert("항목을 입력하세요"); history.back(); </script>';
} else {
    $username = $_POST['name'];
    $phone = $_POST['phone_one'].'-'.$_POST['phone_two'].'-'.$_POST['phone_three'];

    $con = mysqli_connect("localhost", "root", "123456", "joo_db");
    $sql = "select * from member where name = '$username' and phone = '$phone'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $db_name=$row["name"];
    $db_id=$row["id"];



    if ($db_name == $username) {
        echo "<script>alert('회원님의 ID는 ".$db_id."입니다.'); history.back();</script>";
    } else {
        echo "<script>alert('없는 계정입니다.'); history.back();</script>";
    }
}
