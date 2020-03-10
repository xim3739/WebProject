<?php
include "../../db/db_connector.php";
if ($_POST["name"] == "" || $_POST["phone_two"] == "" || $_POST["phone_three"] == "") {
    echo '<script> alert("항목을 입력하세요"); history.back(); </script>';
} else {
    $username = $_POST['name'];
    $phone = $_POST['phone_one'].'-'.$_POST['phone_two'].'-'.$_POST['phone_three'];

    $sql = "SELECT * FROM `member` WHERE `name` = '$username' AND `phone` = '$phone'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
 // mysqli_query 를 통해 얻은 리절트 셋(result set)에서 레코드를 1개씩 리턴해주는 함수입니다. 일반배열과 연관배열
    $db_name=$row["name"];
    $db_id=$row["id"];


    if ($db_name == $username) {
        echo "<script>alert('회원님의 ID는 ".$db_id."입니다.'); history.back();</script>";
    } else {
        echo "<script>alert('없는 계정입니다.'); history.back();</script>";
    }
}
