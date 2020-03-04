<meta charset="utf-8">
<?php
include "../../db/db_connector.php";
session_start();
$group_num  = $_GET["num"];
$group_num = (int)$group_num;
$recomment_num = (int)$_GET["d_num"];
$comment_num = $_GET["comment_num"];
$ord = $_GET["ord"];
var_dump($recomment_num);
$sql ="DELETE FROM `comment` WHERE `num`=$recomment_num";
$result = mysqli_query($connect,$sql);
mysqli_close($connect);
echo "<script>
      // location.href='../../page/board/board_widen.php?num=$group_num';
      </script>";

 ?>
