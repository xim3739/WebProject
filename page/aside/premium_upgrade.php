<?php
  $premiums=$_GET["premium"];
  $now_id=$_GET["now_id"];
  include_once "../../db/db_connector_main.php";
  $sql = "select * from member where id='$now_id'";
  $result = mysqli_query($connect,$sql);
  $row = mysqli_fetch_array($result);
  $premium= $row["premium"];
  if ($premium === null && $premiums ==="yes") {
    $sql = "update member set premium='$premiums' where id='$now_id'";
    mysqli_query($connect,$sql);
    mysqli_close($connect);
  }else {
    echo "<script>alert('현재 프리미엄 회원이십니다.')</script>";
  }
 ?>
