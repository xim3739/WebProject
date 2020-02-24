<?php
include "../../db/db_connector.php";

if ($_POST["userid"] == "" || $_POST["phone_two"] == "" || $_POST["phone_three"] == "") {
    echo '<script> alert("항목을 입력하세요"); history.back(); </script>';
} else {
    $userid = $_POST['userid'];
    $phone = $_POST['phone_one'].'-'.$_POST['phone_two'].'-'.$_POST['phone_three'];

    $con = mysqli_connect("localhost", "root", "123456", "joo_db");
    $sql = "select * from member where id = '$userid' and phone = '$phone'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $db_id=$row["id"];
    $db_pass=$row["password"];

    $get_pass= substr($db_pass, 0,-2);
    if ($db_id == $userid) {
      echo "<script>alert('회원님의 Password는 ".$get_pass."** 입니다.'); history.back();</script>";
    } else {
        echo "<script>alert('없는 계정입니다.'); history.back();</script>";
    }
}
