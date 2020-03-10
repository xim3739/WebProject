<?php
include "../../db/db_connector.php";

if ($_POST["userid"] == "" || $_POST["phone_two"] == "" || $_POST["phone_three"] == "") {
    echo '<script> alert("항목을 입력하세요"); history.back(); </script>';
} else {
    $userid = $_POST['userid'];
    $phone = $_POST['phone_one'].'-'.$_POST['phone_two'].'-'.$_POST['phone_three'];

    $sql = "SELECT * FROM `member` WHERE `id` = '$userid' AND `phone` = '$phone'";

    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);

    $db_id=$row["id"];
    $db_pass=$row["password"];

    $get_pass= substr($db_pass, 0,-2);
    //문자열의 일부분을 추출하는 함수입니다. 추출대상 문자열, 추출을 시작하는 위치, 추출할 문자의 개수.
    if ($db_id == $userid) {
      echo "<script>alert('회원님의 Password는 ".$get_pass."** 입니다.'); history.back();</script>";
    } else {
        echo "<script>alert('없는 계정입니다.'); history.back();</script>";
    }
}
